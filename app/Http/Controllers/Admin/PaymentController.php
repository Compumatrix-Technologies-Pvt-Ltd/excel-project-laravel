<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FFBTransactionsModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.payments.';
    }

    public function paymentIndex(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        $this->ViewData['moduleAction'] = "Payments";
        return view($this->ModuleView .'index', $this->ViewData);
    }

   
    public function paymentgetRecords(Request $request)
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
            $decodedUserId = null;

            if (!empty($request->userId)) {
                $decoded = base64_decode(base64_decode($request->userId), true);
                if ($decoded !== false && is_numeric($decoded)) {
                    $decodedUserId = (int) $decoded;
                }
            }

            $userId = $decodedUserId ?? auth()->id();
            $baseQuery->where('user_id', $userId);

            if ($request->has('payment_method') && $request->payment_method) {
                $baseQuery->where('pay_by', '=', $request->payment_method);
            }

            if ($request->has('end_date') && $request->end_date) {
                $baseQuery->where('bill_date', '<=', $request->end_date);
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

            $intTotalData = FFBTransactionsModel::count();
            $intTotalFiltered = $baseQuery->count();

            $totals = $baseQuery->clone()
                ->selectRaw('SUM(net_pay) as total_netpay')
                ->first();

            $records = $baseQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            $cnt = $start + 1;
            foreach ($records as $record) {
                $data[] = [
                    'id' => $cnt++,
                    'invoice_no' => $record->invoice_no ?? 'N/A',
                    'supplier_id' => $record->supplier->supplier_id ?? 'N/A',
                    'supplier_name' => $record->supplier->supplier_name ?? 'N/A',
                    'bill_date' => date('d-M-Y', strtotime($record->bill_date)),
                    'net_pay' => number_format($record->net_pay, 2),
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalData,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
                'footerTotals' => [
                    'grand_total' => number_format($totals->total_netpay, 2),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error while fetching records',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function createPaymentListPdf(Request $request)
    {
        try {
            $method = $request->payment_method ?? 'cash';

            $payments = FFBTransactionsModel::with('supplier')
                ->where(['purchase_type' => 'cash', 'period' => Helper::getPeriod()])
                ->when($method, fn($q) => $q->where('pay_by', $method))
                ->orderBy('invoice_no', 'asc')
                ->get();

            $grandTotal = $payments->sum('net_pay');
            $monthPeriod = Helper::getPeriod(); // e.g. 202504
            $data = [
                'payments' => $payments,
                'method' => ucfirst($method),
                'monthPeriod' => $monthPeriod,
                'grandTotal' => $grandTotal,
            ];

            $pdf = \PDF::loadView('admin.payments.payment-list-pdf', $data)
                ->setPaper('A4', 'portrait');

            return $pdf->download("VC_{$monthPeriod}_Payment_List.pdf");

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function previewPaymentListPdf(Request $request)
    {
        try {
            $method = $request->payment_method ?? 'cash';

            $payments = FFBTransactionsModel::with('supplier')
                ->where(['purchase_type' => 'cash', 'period' => Helper::getPeriod()])
                ->when($method, fn($q) => $q->where('pay_by', $method))
                ->orderBy('invoice_no', 'asc')
                ->get();

            $grandTotal = $payments->sum('net_pay');
            $monthPeriod = Helper::getPeriod(); // e.g. 202504

            $data = [
                'payments' => $payments,
                'method' => ucfirst($method),
                'monthPeriod' => $monthPeriod,
                'grandTotal' => $grandTotal,
            ];

            // 👇 Preview (stream instead of download)
            $pdf = \PDF::loadView('admin.payments.payment-list-pdf', $data)
                ->setPaper('A4', 'portrait');

            return $pdf->stream("VC_{$monthPeriod}_Payment_List.pdf");
            // 👆 "stream()" = open in browser (Preview)
            // 👇 "download()" = force download (you can switch if needed)
            // return $pdf->download("VC_{$monthPeriod}_Payment_List.pdf");

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


}
