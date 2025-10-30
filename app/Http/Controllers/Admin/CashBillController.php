<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FFBTransactionsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class CashBillController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.supplier-cash-bill.';
    }

    public function supplierCashBillView(Request $request, $id)
    {
        $this->ViewData['moduleAction'] = "Supplier Cash Bill";
        $supplierId = base64_decode(base64_decode($id));
        $this->ViewData['invoice'] = FFBTransactionsModel::with('supplier')->where(['supplier_id' => $supplierId,'period' => Helper::getPeriod(),'purchase_type'=>'cash'])->orderBy('id', 'desc')->first();

        $this->ViewData['otherInvoices'] = FFBTransactionsModel::where([
        'supplier_id'   => $supplierId,
        'period'        => Helper::getPeriod(),
        'purchase_type' => 'cash',
        ])
        ->pluck('invoice_no'); // only get invoice numbers
        return view($this->ModuleView.'supplier-cash-bill-view', $this->ViewData);
    }
    public function supplierCashBill(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        $this->ViewData['moduleAction'] = "Supplier Cash Bill";
        return view($this->ModuleView.'supplier-cash-bill', $this->ViewData);
    }
    public function generateCashBillPdf($invoice_no)
    {
        $invoice = FFBTransactionsModel::with('supplier')->where('invoice_no', $invoice_no)->firstOrFail();

        $pdf = Pdf::loadView($this->ModuleView.'supplier-cash-bill-pdf', compact('invoice'))->setPaper('A4');

        return $pdf->stream("SUPPLIER_CASH_BILL_{$invoice_no}.pdf");
    }
    
    public function getCashBillDetails($invoice_no)
    {
        try {
            // Fetch invoice by number
            $invoice = FFBTransactionsModel::with('supplier')
                ->where('invoice_no', $invoice_no)
                ->firstOrFail();

            // Prepare HTML snippet (render partial view)
            $html = view($this->ModuleView.'cash-bill-details', compact('invoice'))->render();

            return response()->json([
                'success' => true,
                'html' => $html,
                'cbDate' => $invoice->bill_date ? date('d-M-Y', strtotime($invoice->bill_date)) : 'N/A',
                'cbNo' => $invoice->invoice_no ?? 'N/A',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invoice not found or error fetching details.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }



    public function supplierCashBillGetRecords(Request $request)
    {
        try {
       
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $column = 0;
            $dir = 'asc';

            if ($request->has('order') && isset($request->order[0])) {
                $column = $request->order[0]['column'];
                $dir = $request->order[0]['dir'];
            }

            $filter = [
                0 => 'bill_date',
                1 => 'invoice_no',
                2 => 'supplier_id',
                3 => 'supplier_name',
                4 => 'bill_date',
                5 => 'net_pay',
            ];

            $sortColumn = $filter[$column] ?? 'bill_date';

            $baseQuery = FFBTransactionsModel::with('supplier')
                ->where(['purchase_type' => 'cash', 'period' => Helper::getPeriod()]);

            // User filter
            if ($request->hidden_user_id) {
                $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                $baseQuery->where('user_id', $decodedUserId);
            } else {
                $baseQuery->where('user_id', auth()->id());
            }
            // Optional filter
            if ($request->has('payment_method') && $request->payment_method) {
                $baseQuery->where('pay_by', '=', $request->payment_method);
            }

            // Search
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $baseQuery->where(function ($q) use ($search) {
                    $q->where('invoice_no', 'LIKE', "%{$search}%")
                        ->orWhere('bill_date', 'LIKE', "%{$search}%")
                        ->orWhereHas('supplier', function ($sq) use ($search) {
                            $sq->where('supplier_name', 'LIKE', "%{$search}%")
                                ->orWhere('supplier_id', 'LIKE', "%{$search}%");
                        });
                });
            }

            // 🧮 Group by supplier and period, and sum totals
            $groupedQuery = $baseQuery
                ->selectRaw('
                    supplier_id,
                    period,
                    MIN(bill_date) as start_date,
                    MAX(bill_date) as end_date,
                    SUM(weight_mt) as total_weight,
                    AVG(price) as avg_price,
                    SUM(net_pay) as total_amount
                ')
                ->groupBy('supplier_id', 'period');

            $intTotalData = FFBTransactionsModel::distinct('supplier_id')->count('supplier_id');
            $intTotalFiltered = $groupedQuery->count();

            // 🧾 Totals for footer
            $totals = (clone $baseQuery)
            ->selectRaw('SUM(net_pay) as grand_total')
            ->first();


            // Pagination
            $records = $groupedQuery
                ->with('supplier')
                ->orderBy('end_date', $dir)
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            $cnt = $start + 1;

            foreach ($records as $record) {
                $supplier = $record->supplier->supplier_name ?? 'N/A';
                $dateRange = date('d-M-Y', strtotime($record->start_date)) . ' - ' . date('d-M-Y', strtotime($record->end_date));

                $data[] = [
                    'id' => $cnt++,
                    'date' => $dateRange,
                    'supplier_name' => $supplier,
                    'net_weight' => number_format($record->total_weight, 2),
                    'price' => number_format($record->avg_price, 2),
                    'amount' => number_format($record->total_amount, 2),
                    'actions' => '<a href="' . route('admin.supplier.cash.bill.view', base64_encode(base64_encode($record->supplier_id))) . '" class="btn btn-sm btn-primary">View</a>',
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalData,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
                'footerTotals' => [
                    'grand_total' => number_format($totals->grand_total ?? 0, 2),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error while fetching grouped supplier records',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

   


}
