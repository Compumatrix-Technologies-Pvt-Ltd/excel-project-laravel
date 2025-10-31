<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deduction;
use App\Models\FFBTransactionsModel;
use App\Models\Mill;
use App\Models\Transaction;
use Illuminate\Http\Request;

//models
use App\Models\User;
use App\Models\ProductsOrderModel;
use App\Models\ProductsModel;
use App\Models\ClientCompaniesModel;

//requests
use DB;
use Carbon\Carbon;
use Auth;

class DashboardController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;


    public function __construct(
        User $UserModel,

    ) {
        // $this->middleware('auth');
        $this->BaseModel = $UserModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleView = 'admin.dashboard.';
        $this->ModulePath = 'dashboard.';


    }

    public function index(Request $request)
    {
        $user = auth()->user();
        $this->ViewData['moduleAction'] = "Dashboard";

        if ($user->hasRole('hq')) {

            $todaysTickets = Transaction::where([
                'transaction_by' => 'hq'
            ])->whereDate('created_at', today())->count();

            $todaysTicketsThisMonth = Transaction::where([
                'transaction_by' => 'hq'
            ])->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)->count();

            $totalWeight = Transaction::where([
                'transaction_by' => 'hq'
            ])->whereDate('created_at', today())->sum('weight');

            $totalWeightThisMonth = Transaction::where([
                'transaction_by' => 'hq'
            ])->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('weight');

            $totalCreditTransactions = FFBTransactionsModel::where('purchase_type', 'credit')->count();
            $totalCashTransactions = FFBTransactionsModel::where('purchase_type', 'cash')->count();
            $totalCreditRM = FFBTransactionsModel::where('purchase_type', 'credit')->sum('net_pay');
            $totalCashRM = FFBTransactionsModel::where('purchase_type', 'cash')->sum('net_pay');

            $totalMills = Mill::where('user_id', $user->id)->count();

            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $ticketsByDay = Transaction::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(weight) as total_mt')
            )
                ->where('transaction_by', 'hq')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy(DB::raw('DAY(created_at)'))
                ->orderBy(DB::raw('DAY(created_at)'))
                ->get();

            // Pass it to the view
            $this->ViewData['ticketsByDay'] = $ticketsByDay;

            $topSuppliers = Transaction::select(
                'supplier_id',
                DB::raw('SUM(weight) as total_mt')
            )
                ->where('transaction_by', 'hq')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('supplier_id')
                ->orderByDesc('total_mt')
                ->limit(10)
                ->get();


            $supplierNames = [];
            foreach ($topSuppliers as $supplier) {
                $supplierNames[] = optional($supplier->supplier)->supplier_name ?? 'Unknown';
            }

            $supplierMT = $topSuppliers->pluck('total_mt');

            $this->ViewData['supplierMT'] = $supplierMT;
            $this->ViewData['supplierNames'] = $supplierNames;

            $millMix = Transaction::select(
                'mill_id',
                DB::raw('SUM(weight) as total_mt')
            )
                ->where('transaction_by', 'hq')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('mill_id')
                ->orderByDesc('total_mt')
                ->get();

            $millNames = [];
            foreach ($millMix as $mill) {
                $millNames[] = optional($mill->mill)->name ?? 'Unknown';
            }

            $millWeights = $millMix->pluck('total_mt');

            $this->ViewData['millNames'] = $millNames;
            $this->ViewData['millWeights'] = $millWeights;

            $creditCashData = FFBTransactionsModel::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw("CASE WHEN purchase_type = 'credit' THEN 'Credit' ELSE 'Cash' END as type"),
                DB::raw('SUM(net_pay) as total_rm')
            )
                ->whereYear('created_at', $currentYear)
                ->groupBy(DB::raw('MONTH(created_at)'), 'type')
                ->orderBy(DB::raw('MONTH(created_at)'))
                ->get();

            $months = collect(range(1, 12))->map(fn($m) => date('M', mktime(0, 0, 0, $m, 1)));
            $credit = [];
            $cash = [];

            foreach ($months as $index => $monthName) {
                $monthNumber = $index + 1;
                $creditVal = $creditCashData->where('month', $monthNumber)
                    ->where('type', 'Credit')
                    ->sum('total_rm');
                $cashVal = $creditCashData->where('month', $monthNumber)
                    ->where('type', 'Cash')
                    ->sum('total_rm');
                $credit[] = round($creditVal, 2);
                $cash[] = round($cashVal, 2);
            }


            $this->ViewData['months'] = $months;
            $this->ViewData['credit'] = $credit;
            $this->ViewData['cash'] = $cash;

            $deductions = Deduction::select(
                'type',
                DB::raw('SUM(amount) as total_amount')
            )
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->groupBy('type')
                ->pluck('total_amount', 'type');

            $hq_categories = ['Advance', 'Transport', 'Others'];

            $hq_data = [
                $deductions['advance'] ?? 0,
                $deductions['transport'] ?? 0,
                $deductions['others'] ?? 0,
            ];

            $this->ViewData['hq_categories'] = $hq_categories;
            $this->ViewData['hq_data'] = $hq_data;


            $currentDate = Carbon::now();
            $startDate = $currentDate->copy()->subMonths(5)->startOfMonth();

            $pricePerMT = FFBTransactionsModel::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(price) / NULLIF(SUM(weight_mt), 0) as avg_price_per_mt')
            )
                ->where('created_at', '>=', $startDate)
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();

            $month = [];
            $data = [];

            foreach ($pricePerMT as $row) {
                $monthName = Carbon::create()->month($row->month)->format('M'); // Apr, May, Jun...
                $month[] = $monthName;
                $data[] = round($row->avg_price_per_mt, 2);
            }

            $this->ViewData['priceMonths'] = $month;
            $this->ViewData['priceData'] = $data;

            $this->ViewData['data'] = $data;
            $this->ViewData['todaysTickets'] = $todaysTickets;
            $this->ViewData['todaysTicketsThisMonth'] = $todaysTicketsThisMonth;
            $this->ViewData['totalTodayMT'] = $totalWeight;
            $this->ViewData['totalWeightThisMonth'] = $totalWeightThisMonth;
            $this->ViewData['totalCreditTransactions'] = $totalCreditTransactions;
            $this->ViewData['totalCreditRM'] = $totalCreditRM;
            $this->ViewData['totalCashTransactions'] = $totalCashTransactions;
            $this->ViewData['totalCashRM'] = $totalCashRM;
            $this->ViewData['totalMills'] = $totalMills;


        } elseif ($user->hasRole('branch')) {

            $todaysTickets = Transaction::where([
                'transaction_by' => 'branch'
            ])->whereDate('created_at', today())->count();



            $totalWeight = Transaction::where([
                'transaction_by' => 'branch'
            ])->whereDate('created_at', today())->sum('weight');



            $totalCashTransactions = FFBTransactionsModel::where('purchase_type', 'cash')->whereDate('created_at', today())->count();
            $totalCashRM = FFBTransactionsModel::where('purchase_type', 'cash')
                ->whereDate('created_at', today())->sum('net_pay');


            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;

            $startDate = Carbon::now()->subDays(13)->startOfDay(); // include today
            $endDate = Carbon::now()->endOfDay();

            $ticketsByDay = Transaction::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(weight) as total_mt')
            )
                ->where('transaction_by', 'branch')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy(DB::raw('DATE(created_at)'))
                ->orderBy('date')
                ->get();

            // Prepare data for chart
            $dates = collect();
            $data = collect();

            for ($i = 13; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i)->format('M d');
                $dbDate = Carbon::now()->subDays($i)->toDateString();

                $record = $ticketsByDay->firstWhere('date', $dbDate);
                $dates->push($date);
                $data->push($record ? round($record->total_mt, 2) : 0);
            }

            $this->ViewData['ticketDates'] = $dates;
            $this->ViewData['ticketData'] = $data;


            $topSuppliers = Transaction::select(
                'supplier_id',
                DB::raw('SUM(weight) as total_mt')
            )
                ->where('transaction_by', 'branch')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy('supplier_id')
                ->orderByDesc('total_mt')
                ->limit(10)
                ->get();

            $supplierNames = [];
            foreach ($topSuppliers as $supplier) {
                $supplierNames[] = optional($supplier->supplier)->supplier_name ?? 'Unknown';
            }

            $supplierMT = $topSuppliers->pluck('total_mt');

            $this->ViewData['br_supplierNames'] = $supplierNames;
            $this->ViewData['br_supplierMT'] = $supplierMT;

            $cashDaily = FFBTransactionsModel::select(
                DB::raw('DAY(created_at) as day'),
                DB::raw('SUM(net_pay) as total_rm')
            )
                ->where('purchase_type', 'cash')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->groupBy(DB::raw('DAY(created_at)'))
                ->orderBy(DB::raw('DAY(created_at)'))
                ->get();

            $days = $cashDaily->pluck('day')->toArray();
            $dailyAmounts = $cashDaily->pluck('total_rm')->map(fn($v) => (float) $v)->toArray();

            $this->ViewData['br_cashDays'] = $days;
            $this->ViewData['br_cashAmounts'] = $dailyAmounts;

            $deductions = Deduction::select(
                'type',
                DB::raw('SUM(amount) as total_amount')
            )
                ->whereMonth('date', $currentMonth)
                ->whereYear('date', $currentYear)
                ->groupBy('type')
                ->pluck('total_amount', 'type');

            $categories = ['Advance', 'Transport', 'Others'];

            $deductionValues = [
                $deductions['advance'] ?? 0,
                $deductions['transport'] ?? 0,
                $deductions['others'] ?? 0,
            ];

            $this->ViewData['deductionLabels'] = ['Advance', 'Transport', 'Other'];
            $this->ViewData['deductionValues'] = $deductionValues;


            $this->ViewData['todaysTickets'] = $todaysTickets;
            $this->ViewData['totalTodayMT'] = $totalWeight;
            $this->ViewData['totalCashTransactions'] = $totalCashTransactions;
            $this->ViewData['totalCashRM'] = $totalCashRM;


        }

        return view('admin.dashboard', $this->ViewData);
    }

}