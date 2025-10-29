<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BranchModel;
use App\Models\CompanyModel;
use App\Models\FFBTransactionsModel;
use App\Models\Suppliers;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class ConsolidatedFFBController extends Controller
{

    public function __construct()
    {

        $this->ViewData = [];
        $this->ModuleView = 'admin.consolidated-ffb.';
    }

    public function YearlyCashCredit()
    {
        $this->ModuleTitle = __('Yearly Cash Vs Credit');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'yearly-cash-credit', $this->ViewData);
    }

    public function creditPurchase()
    {
        $companyId = auth()->user()->company_id;
        $this->ViewData['moduleAction'] = 'Credit Purchase';
        $this->ViewData['Branches'] = BranchModel::where('company_id', $companyId)->get();
        return view($this->ModuleView . 'credit-purchase', $this->ViewData);
    }
    public function cashPurchase()
    {
        $companyId = auth()->user()->company_id;
        $this->ViewData['moduleAction'] = 'Cash Purchase';
        $this->ViewData['Branches'] = BranchModel::where('company_id', $companyId)->get();
        return view($this->ModuleView . 'cash-purchase', $this->ViewData);
    }
    public function purchaseSalse()
    {
        $this->ModuleTitle = __('Purchase & Salse');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'purchase-salse', $this->ViewData);
    }

    public function getYearlyCashCreditRecords(Request $request)
    {
        $year = $request->year ?? date('Y');
        $companyId = auth()->user()->company_id ?? 1;

        $branches = BranchModel::where('company_id', $companyId)->get();

        $transactions = FFBTransactionsModel::where('company_id', $companyId)
            ->whereYear('bill_date', $year)
            ->get()
            ->groupBy('branch_id');
           // dd($transactions);
        $data = [];
        $months = range(1, 12);

        foreach ($branches as $branch) {
            $row = ['branch_name' => $branch->name];
            $grandCash = 0;
            $grandCredit = 0;

            $branchTransactions = $transactions->get($branch->id) ?? collect();

            foreach ($months as $month) {
                $monthTx = $branchTransactions->filter(function ($t) use ($year, $month) {
                    return \Carbon\Carbon::parse($t->bill_date)->month == $month;
                });

                $cash = $monthTx->where('purchase_type', 'cash')->sum('weight_mt');
                $credit = $monthTx->where('purchase_type', 'credit')->sum('weight_mt');

                $row["month_{$month}_cash"] = $cash;
                $row["month_{$month}_credit"] = $credit;
                $row["month_{$month}_total"] = $cash + $credit;

                $grandCash += $cash;
                $grandCredit += $credit;
            }

            $row['grand_cash'] = $grandCash;
            $row['grand_credit'] = $grandCredit;
            $row['grand_total'] = $grandCash + $grandCredit;

            $data[] = $row;
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function getConsolidatedCreditPurchaseAnalysisRecords(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');
            $branchId = $request->branch_id;
            $companyId = auth()->user()->company_id ?? 1;

            if (!$branchId) {
                return response()->json(['data' => []]);
            }

            // 1️⃣ Fetch suppliers under this branch
            $loggedInUser = auth()->user();
            $baseQuery = Suppliers::select('id', 'supplier_id', 'supplier_name');
            if ($loggedInUser->hasRole('hq')) {
                $baseQuery->where('user_id', $loggedInUser->id);
                $baseQuery->where('supplier_mode','branch');
            }else if ($loggedInUser->hasRole('branch')) {
                $baseQuery->where('user_id', $loggedInUser->id);
            }
            $suppliers = $baseQuery->orderBy('supplier_name')
                ->get();

            // 2️⃣ Fetch transactions for that branch/year
            $transactions = FFBTransactionsModel::where('company_id', $companyId)
                ->where('branch_id', $branchId)
                ->whereYear('bill_date', $year);
                if($request->has('purchaseType') && in_array($request->purchaseType, ['cash','credit'])){
                    $transactions = $transactions->where('purchase_type', $request->purchaseType);
                }
            $transactions = $transactions->where('purchase_type', 'credit') // only credit purchases
                ->get();

            $months = range(1, 12);
            $data = [];
            $monthlyTotals = array_fill_keys($months, 0);

            // 3️⃣ For each supplier, calculate monthly totals
            foreach ($suppliers as $supplier) {
                $row = [
                    'supplier_name' =>$supplier->supplier_id.' '.$supplier->supplier_name,
                ];
                $supplierTotal = 0;

                foreach ($months as $month) {
                    $monthTotal = $transactions
                        ->where('supplier_id', $supplier->id)
                        ->filter(fn($t) => \Carbon\Carbon::parse($t->bill_date)->month == $month)
                        ->sum('weight_mt');

                    $row["month_$month"] = number_format($monthTotal, 2);
                    $supplierTotal += $monthTotal;
                    $monthlyTotals[$month] += $monthTotal;
                }

                $row['total'] = number_format($supplierTotal, 2);
                $data[] = $row;
            }

            // 4️⃣ Footer totals
            $footer = [
                'supplier_id' => '',
                'supplier_name' => 'Total',
            ];
            $grandTotal = 0;
            foreach ($months as $month) {
                $footer["month_$month"] = number_format($monthlyTotals[$month], 2);
                $grandTotal += $monthlyTotals[$month];
            }
            $footer['total'] = number_format($grandTotal, 2);

            return response()->json([
                'data' => $data,
                'footer' => $footer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching consolidated supplier data',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function exportConsolidatedCreditPurchaseAnalysisPDF(Request $request)
    {
        try {
            $year = $request->year ?? date('Y');
            $branchId = $request->branch_id;
            $companyId = auth()->user()->company_id ?? 1;

            if (!$branchId) {
                return back()->with('error', 'Branch is required');
            }

            $branch = BranchModel::find($branchId);
            $records = $this->getConsolidatedCreditPurchaseAnalysisRecords($request)->getData(true);
            $suppliers = $records['data'] ?? [];
            $footer = $records['footer'] ?? [];

            $pdf = \PDF::loadView($this->ModuleView.'branch_consolidated_analysis_pdf', [
                'year' => $year,
                'branch' => $branch,
                'suppliers' => $suppliers,
                'footer' => $footer,
                'company_name' => 'Main Tree Company'
            ])->setPaper('A4', 'landscape');

            $fileName = "VC_{$year}_{$branch->name}_{$request->purchaseType}_Purchase_Analysis.pdf";

            // 👇 Preview vs Download
            if ($request->has('preview')) {
                return $pdf->stream($fileName);
            }

            return $pdf->download($fileName);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error generating Branch Consolidated PDF',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    
}
