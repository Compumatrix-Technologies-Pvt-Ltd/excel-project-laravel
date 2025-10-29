<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FFBTransactionsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseInvoiceController extends Controller
{
     public function __construct()
    {
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.sales-invoice.';
    }

    public function salesInvoice(Request $request, $id)
    {
        $invoiceId = base64_decode(base64_decode($id)); // because your listing encodes twice

        $invoice = FFBTransactionsModel::with('supplier')->find($invoiceId);

        if (!$invoice) {
            return redirect()->back()->with('error', 'Invoice not found');
        }

        $this->ViewData['moduleAction'] = "Sales Invoice";
        $this->ViewData['invoice'] = $invoice;

        return view('admin.sales-invoice.sales-invoice', $this->ViewData);
    }

    public function salesInvoiceIndex(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $this->ViewData['userId'] = $encodedId ?? null;
        $this->ViewData['moduleAction'] = "Sales Invoice";
        return view('admin.sales-invoice.index', $this->ViewData);   
    }
    public function salesInvoiceRecords(Request $request)
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
                2 => 'supplier_name',
                3 => 'total_deductions',
                4 => 'net_pay',
            ];

            $sortColumn = $filter[$column] ?? 'bill_date';

            $baseQuery = FFBTransactionsModel::with('supplier')->where(['purchase_type'=>'cash','period'=>Helper::getPeriod()]);
            if (!empty($request->userId)) {
                $userId = base64_decode(base64_decode($request->userId));
                $baseQuery->where('user_id', $userId);
            }

            if ($request->has('start_date') && $request->start_date) {
                $baseQuery->where('bill_date','>=',$request->start_date);
            }

            if ($request->has('end_date') && $request->end_date) {
                $baseQuery->where('bill_date','<=',$request->end_date);
            }

            // 🔍 Apply search filter
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $baseQuery->where(function ($q) use ($search) {
                    $q->where('invoice_no', 'LIKE', "%{$search}%")
                        ->orWhere('bill_date', 'LIKE', "%{$search}%")
                        ->orWhere('ticket_no', 'LIKE', "%{$search}%")
                        ->orWhereHas('supplier', function ($sq) use ($search) {
                            $sq->where('supplier_name', 'LIKE', "%{$search}%")
                                ->orWhere('supplier_id', 'LIKE', "%{$search}%");
                        });
                });
            }

            $intTotalData = FFBTransactionsModel::count();
            $intTotalFiltered = $baseQuery->count();

            // ✅ Totals for all filtered records (not just paginated)
            $totals = $baseQuery->clone()
                ->selectRaw('SUM(total_deductions) as total_deductions, SUM(subsidy_amt) as total_subsidy, SUM(net_pay) as total_netpay')
                ->first();

            $records = $baseQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            foreach ($records as $record) {
                $data[] = [
                    'bill_date' => date('d-M-Y', strtotime($record->bill_date)),
                    'invoice_no' => $record->invoice_no ?? 'N/A',
                    //'supplier_id' => $record->supplier->supplier_id ?? 'N/A',
                    'supplier_name' => $record->supplier->supplier_name ?? 'N/A',
                    //'ticket_no' => $record->ticket_no ?? '-',
                // 'weight_kg' => number_format($record->weight_mt, 2),
                    'total_deductions' => number_format($record->total_deductions, 2),
                    'net_pay' => number_format($record->net_pay, 2),
                    //'subsidy_amt' => number_format($record->subsidy_amt, 2),
                    'actions' => '<a href="'.route('admin.sales-invoice.view',base64_encode(base64_encode($record->id))).'" class="btn btn-sm btn-primary">View</a>',
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalData,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
                'footerTotals' => [
                    'total_deductions' => number_format($totals->total_deductions, 2),
                    'net_pay' => number_format($totals->total_netpay, 2),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error while fetching records',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function preview($id)
    {
        $invoice = FFBTransactionsModel::with('supplier')->findOrFail($id);
        $moduleAction = 'Invoice Preview';
        $pdf = Pdf::loadView('admin.sales-invoice.sales-invoice', compact('invoice', 'moduleAction'));
    }

    public function createPdf($id)
    {
        $this->ViewData['invoice'] = FFBTransactionsModel::with('supplier')->findOrFail($id);
        $this->ViewData['moduleAction'] = 'Invoice PDF';

        $pdf = Pdf::loadView($this->ModuleView . 'sales-invoice-pdf', $this->ViewData);

        $pdf = Pdf::loadView('admin.sales-invoice.sales-invoice-pdf', $this->ViewData)
            ->setPaper('A4', 'portrait');

        return $pdf->download('invoice_'.$this->ViewData['invoice']->invoice_no.'.pdf');
    }

    

}
