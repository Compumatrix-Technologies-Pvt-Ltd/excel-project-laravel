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
        $this->ModuleTitle = __('Credit Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Branches'] = BranchModel::where('company_id', $companyId)->get();
        // dd(BranchModel::where('company_id',$companyId)->get());
        return view($this->ModuleView . 'credit-purchase', $this->ViewData);
    }
    public function cashPurchase()
    {
        $this->ModuleTitle = __('Cash Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
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

    public function creditPurchaseRecords(Request $request)
    {
        $year = $request->year ?? date('Y');
        $companyId = auth()->user()->company_id ?? 1;

        $branches = BranchModel::where('company_id', $companyId)->get();

        $transactions = FFBTransactionsModel::where('company_id', $companyId)
            ->whereYear('bill_date', $year)
            ->get()
            ->groupBy('branch_id');
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
}
