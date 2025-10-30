<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\FFBTransactionsModel;
use App\Models\Suppliers;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;

class PurchaseAnalysisController extends Controller
{
    public function __construct(FFBTransactionsModel $FFBTransactionsModel)
    {
        $this->BaseModel = $FFBTransactionsModel;
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.analysis.';
    }

    public function index(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        $this->ViewData['moduleAction'] = 'Purches Listing';
        return view($this->ModuleView . 'purchase-analysis', $this->ViewData);
    }
    public function creditPurchaseAnalysisIndex(Request $request)
    {
        $this->ViewData['moduleAction'] = 'Credit Purches Listing';
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        return view($this->ModuleView . 'credit-purchase-analysis', $this->ViewData);
    }
    
    public function supplierCashBillGetRecords(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');

            $query = FFBTransactionsModel::selectRaw("
                    MONTH(bill_date) as month_num,
                    SUM(CASE WHEN purchase_type = 'credit' THEN weight_mt ELSE 0 END) as credit_weight,
                    SUM(CASE WHEN purchase_type = 'cash' THEN weight_mt ELSE 0 END) as cash_weight
                ")
                ->whereYear('bill_date', $year)
                //->where('period', Helper::getPeriod())
                ->groupBy(DB::raw('MONTH(bill_date)'))
                ->orderBy(DB::raw('MONTH(bill_date)'));

                if ($request->hidden_user_id) {
                    $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                    $query->where('user_id', $decodedUserId);
                } else {
                    $query->where('user_id', auth()->id());
                }
                $query = $query->get();

            // Month mapping (1–12)
            $months = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
                7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
            ];

            $data = [];
            foreach ($months as $num => $name) {
                $record = $query->firstWhere('month_num', $num);
                $credit = $record->credit_weight ?? 0;
                $cash = $record->cash_weight ?? 0;
                $total = $credit + $cash;

                $data[] = [
                    'month' => $name,
                    'credit' => number_format($credit, 2),
                    'cash' => number_format($cash, 2),
                    'total' => number_format($total, 2),
                ];
            }

            // Totals for footer
            $totalCredit = $query->sum('credit_weight');
            $totalCash = $query->sum('cash_weight');
            $grandTotal = $totalCredit + $totalCash;

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => 12, // fixed months
                'recordsFiltered' => 12,
                'data' => $data,
                'footerTotals' => [
                    'total_credit' => number_format($totalCredit, 2),
                    'total_cash' => number_format($totalCash, 2),
                    'total_weight' => number_format($grandTotal, 2),
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching monthly purchase data',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getPurchaseChartData(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');

            $query = FFBTransactionsModel::selectRaw("
                    MONTH(bill_date) as month_num,
                    SUM(CASE WHEN purchase_type = 'credit' THEN weight_mt ELSE 0 END) as credit_weight,
                    SUM(CASE WHEN purchase_type = 'cash' THEN weight_mt ELSE 0 END) as cash_weight
                ")
                ->whereYear('bill_date', $year)
                //->where('period', Helper::getPeriod())
                ->groupBy(DB::raw('MONTH(bill_date)'))
                ->orderBy(DB::raw('MONTH(bill_date)'));
                if ($request->hidden_user_id) {
                    $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                    $query->where('user_id', $decodedUserId);
                } else {
                    $query->where('user_id', auth()->id());
                }
                $query = $query->get();

            // Monthly data for each month (Jan–Dec)
            $months = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
                7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
            ];

            $monthly = [];
            foreach ($months as $num => $name) {
                $record = $query->firstWhere('month_num', $num);
                $credit = $record->credit_weight ?? 0;
                $cash = $record->cash_weight ?? 0;
                $total = $credit + $cash;

                $monthly[] = [
                    'month' => $name,
                    'credit' => $credit,
                    'cash' => $cash,
                    'total' => $total,
                ];
            }

            $totalCredit = $query->sum('credit_weight');
            $totalCash = $query->sum('cash_weight');
            $grandTotal = $totalCredit + $totalCash;

            return response()->json([
                'year' => $year,
                'monthly' => $monthly,
                'summary' => [
                    'credit' => $totalCredit,
                    'cash' => $totalCash,
                    'total' => $grandTotal,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching chart data',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    private function getPurchaseData($year)
    {
        $query = FFBTransactionsModel::selectRaw("
                MONTH(bill_date) as month_num,
                SUM(CASE WHEN purchase_type = 'credit' THEN weight_mt ELSE 0 END) as credit_weight,
                SUM(CASE WHEN purchase_type = 'cash' THEN weight_mt ELSE 0 END) as cash_weight
            ")
            ->whereYear('bill_date', $year)
            //->where('period', Helper::getPeriod())
            ->groupBy(DB::raw('MONTH(bill_date)'))
            ->orderBy(DB::raw('MONTH(bill_date)'))
            ->get();

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
            7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
        ];

        $monthly = [];
        foreach ($months as $num => $name) {
            $record = $query->firstWhere('month_num', $num);
            $credit = $record->credit_weight ?? 0;
            $cash = $record->cash_weight ?? 0;
            $total = $credit + $cash;

            $monthly[] = [
                'month' => $name,
                'credit' => $credit,
                'cash' => $cash,
                'total' => $total,
            ];
        }

        $totalCredit = $query->sum('credit_weight');
        $totalCash = $query->sum('cash_weight');
        $grandTotal = $totalCredit + $totalCash;

        return [
            'year' => $year,
            'monthly' => $monthly,
            'summary' => [
                'credit' => $totalCredit,
                'cash' => $totalCash,
                'total' => $grandTotal,
            ],
        ];
    }

    public function purchaseAnalysisPdf(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');
            $records = $this->getPurchaseData($year);

            $pdf = Pdf::loadView($this->ModuleView . 'purchase-analysis-pdf', [
                'records' => $records,
                'year' => $year,
                'company_name' => 'VC MAJUMAS SDN BHD',
                'chart1' => $request->chart1 ?? null, // base64 image
                'chart2' => $request->chart2 ?? null,
            ]);

            $fileName = "Purchase_Analysis_{$year}.pdf";
            $filePath = storage_path("app/public/reports/{$fileName}");
            $pdf->save($filePath);

            if ($request->has('preview')) {
                return response()->file($filePath, ['Content-Type' => 'application/pdf']);
            }

            return response()->download($filePath)->deleteFileAfterSend(false);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error generating PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getCreditPurchaseAnalysisRecords(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');
            $mspo_certification = $request->mspo_certification ?? null;  // 'registered' / 'non-registered' / null
            $purchases = $request->purchases ?? 'credit';
            $analysis_in = $request->analysis_in ?? 'mton'; // 'mton' or 'rm'

            // -------------------------------------------
            // 1️⃣ Build base query with dynamic conditions
            // -------------------------------------------
            $query = FFBTransactionsModel::with('supplier')
                ->where('purchase_type', $purchases)
                ->whereYear('bill_date', $year)
                ->when($mspo_certification, function ($q) use ($mspo_certification) {
                    // Filter suppliers by MSPO certification
                    $q->whereHas('supplier', function ($supplierQuery) use ($mspo_certification) {
                        if ($mspo_certification === 'registered') {
                            $supplierQuery->whereNotNull('mspo_cert_no');
                        } elseif ($mspo_certification === 'non-registered') {
                            $supplierQuery->whereNull('mspo_cert_no');
                        }
                    });
                });

            // -------------------------------------------
            // 2️⃣ Select proper measure (M/Ton or RM)
            // -------------------------------------------
            $query->selectRaw("
                supplier_id,
                MONTH(bill_date) as month_num,
                SUM(" . ($analysis_in === 'rm' ? 'net_pay' : 'weight_mt') . ") as total_weight
            ")
                ->groupBy('supplier_id', DB::raw('MONTH(bill_date)'))
                ->orderBy('supplier_id');

            // Actually execute it
            if ($request->hidden_user_id) {
                $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                $query->where('user_id', $decodedUserId);
            } else {
                $query->where('user_id', auth()->id());
            }

            $records = $query->get();


            $userId = $decodedUserId ?? auth()->id();

            $Suppliers = Suppliers::where('user_id', $userId)
                ->where('supplier_mode', 'branch')
                ->pluck('id')
                ->toArray();


            // -------------------------------------------
            // 3️⃣ Prepare reference data
            // -------------------------------------------
            $suppliers = Suppliers::select('id', 'supplier_name', 'supplier_id as sID')->get()->keyBy('id');

            $months = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun',
                7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'
            ];

            // -------------------------------------------
            // 4️⃣ Transform data into DataTables format
            // -------------------------------------------
            $data = [];
            $monthlyTotals = array_fill_keys(array_keys($months), 0);
            $grandTotal = 0;

            foreach ($records->groupBy('supplier_id') as $supplierId => $supplierRecords) {
                $supplierInfo = $suppliers[$supplierId] ?? null;

                $row = [
                    'supplier_id'   => $supplierInfo->id ?? $supplierId,
                    'sID'           => $supplierInfo->sID ?? 'N/A',
                    'supplier_name' => $supplierInfo->supplier_name ?? 'N/A',
                ];

                $supplierTotal = 0;

                foreach ($months as $num => $label) {
                    $value = $supplierRecords->firstWhere('month_num', $num)->total_weight ?? 0;
                    $row[$label] = number_format($value, 2);
                    $monthlyTotals[$num] += $value;
                    $supplierTotal += $value;
                }

                $row['total'] = number_format($supplierTotal, 2);
                $grandTotal += $supplierTotal;
                $data[] = $row;
            }

            // -------------------------------------------
            // 5️⃣ Prepare footer (month + total columns)
            // -------------------------------------------
            $footer = ['Total'];
            foreach ($months as $num => $label) {
                $footer[] = number_format($monthlyTotals[$num], 2);
            }
            $footer[] = number_format($grandTotal, 2);

            // -------------------------------------------
            // ✅ Return JSON for DataTables
            // -------------------------------------------
            return response()->json([
                'draw'            => intval($request->draw),
                'recordsTotal'    => count($data),
                'recordsFiltered' => count($data),
                'data'            => $data,
                'footerTotals'    => $footer,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error'   => 'Error fetching supplier credit analysis',
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(), // optional for debugging
            ], 500);
        }
    }


    public function creditPurchaseAnalysisPdf(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');
            $mspo_certification = $request->mspo_certification ?? null;
            $purchases = $request->purchases ?? 'credit';
            $analysis_in = $request->analysis_in ?? 'mton';
            $unitLabel = $analysis_in === 'rm' ? 'RM' : 'M/Ton';

            // 🔹 Fetch the same dataset used for the table
            $records = $this->getCreditPurchaseAnalysisRecords($request)->getData(true);

            // 🔹 Pass to PDF view
            $pdf = Pdf::loadView($this->ModuleView .'credit_purchase_analysis_pdf', [
                'records' => $records,
                'year' => $year,
                'unit' => $unitLabel,
                'mspo_certification' => $mspo_certification,
                'purchases' => ucfirst($purchases),
                'companyName' => 'Your Company Name',
            ]);

            $filename = "Credit_Purchase_Analysis_{$year}.pdf";
            $pdf->setPaper('A4', 'landscape');

            if ($request->has('preview')) {
                // Return PDF in browser (for preview)
                return $pdf->stream($filename);
            }
            return $pdf->download($filename);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error generating Credit Purchase Analysis PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
