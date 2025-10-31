<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Mill;
use App\Models\User;
use App\Models\Vehicle;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Suppliers;
use App\Models\FFBTransactionsModel;
use App\Models\Transaction;
use App\Models\Deduction;
use App\Models\Bank;

use Log;
use Exception;
use Session;
use Auth;
use Carbon\Carbon;

class MasterController extends Controller
{

    public function __construct(FFBTransactionsModel $ffbTransactionsModel)
    {

        $this->BaseModel = $ffbTransactionsModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.master.';
    }

    public function mainForm(Request $request)
    {
        $purchaseType = $request->input('purchaseType', 'credit'); // default to credit purchase

        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;

        // Filter suppliers by supplier_type matching purchaseType value
        $this->ViewData['suppliers'] = Suppliers::where([
            'supplier_type' => $purchaseType,
            'user_id' => auth()->id()
        ])->get();

        $user = auth()->user();
        // Check if user has a branch, otherwise use company name
        if ($user->branch) {
            $branchCode = $user->branch->code; // e.g. "VC"
        } else {
            $branchCode = $user->company->code ?? 'DEFAULT'; // Use company name as fallback
        }

        
       

        $this->ViewData['creditInvoiceNo'] = $this->generateInvoiceNumber($branchCode, 'credit');
        $this->ViewData['cashInvoiceNo'] = $this->generateInvoiceNumber($branchCode, 'cash');

        $this->ViewData['suppliers_credit'] = Suppliers::where('supplier_type', 'credit')->get();
        $this->ViewData['suppliers_cash'] = Suppliers::where('supplier_type', 'cash')->get();


        return view('admin.masters.masterForm', $this->ViewData);
    }

    public function HQmainForm(Request $request)
    {
        $userId = auth()->user()->id;
        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;


        $this->ViewData['Vehicles'] = Vehicle::where('company_id',auth()->user()->company_id)->get();
        $this->ViewData['Mills'] = Mill::where('company_id',auth()->user()->company_id)->get();


        $this->ViewData['Suppliers'] = Suppliers::with('user')
            ->where('user_id', $userId)
            ->where('supplier_mode', 'hq')
            ->get();
            
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['banks'] = Bank::where('user_id', $userId)->get();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId));
        return view('admin.masters.hq-masterForm', $this->ViewData);
    }

    public function storeFFBTransaction(Request $request)
    {

        try {
            if( Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('ym') != date('ym', strtotime($request->input('bill_date'))) ){
                $this->JsonData['status'] = 'error';
                $this->JsonData['url'] = "";
                $this->JsonData['msg'] = 'Bill date does not match the selected period.';
                return response()->json($this->JsonData);   
            }
            // dd($request->all());

            $this->BaseModel = new FFBTransactionsModel();
            $this->BaseModel->company_id = $request->input('company_id');
            $this->BaseModel->user_id = auth()->user()->id;
            $this->BaseModel->branch_id = $request->input('branch_id');
            $this->BaseModel->supplier_id = $request->input('supplier_id');
            $this->BaseModel->purchase_type = $request->input('purchase_type', 'credit');
            $this->BaseModel->invoice_no = $request->input('invoice_no');
            $this->BaseModel->period = Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('ym');
            $this->BaseModel->particulars = $request->input('particulars');
            $this->BaseModel->weight_mt = $request->input('weight_mt', 0);
            $this->BaseModel->price = $request->input('price', 0);
            $this->BaseModel->incentive_rate = $request->input('incentive_rate', 0) ?? 0;
            $this->BaseModel->subsidy_amt = $request->input('subsidy_amt', 0) ?? 0;
            $this->BaseModel->amt_before_ded = $request->input('amt_before_ded', 0) ?? 0;
            $this->BaseModel->debit_bal_bf = $request->input('debit_bal_bf', 0) ?? 0;
            $this->BaseModel->transport = $request->input('transport', 0) ?? 0;
            $this->BaseModel->advance = $request->input('advance', 0) ?? 0;
            $this->BaseModel->others = $request->input('others', 0) ?? 0;
            $this->BaseModel->others_desc = $request->input('others_desc');
            $this->BaseModel->total_deductions = $request->input('total_deductions', 0) ?? 0;
            $this->BaseModel->bill_date = $request->input('bill_date');
            $this->BaseModel->net_pay = $request->input('net_pay', 0) ?? 0;
            $this->BaseModel->pay_by = $request->input('pay_by', 'cash');
            $this->BaseModel->debit_bal_cf = $request->input('debit_bal_cf', 0) ?? 0;
            $this->BaseModel->remark = $request->input('remark');
            $this->BaseModel->save();

            $this->JsonData['status'] = 'success';
            $this->JsonData['url'] = "";
            $this->JsonData['msg'] = 'FFB Transaction recorded successfully.';

        } catch (\Exception $e) {
            $this->JsonData['msg'] = 'Something went wrong on server.Please contact to Server.';
            $this->JsonData['error_msg'] = $e->getMessage();
        }
        return response()->json($this->JsonData);
    }

    public function generateInvoiceNumber($branchCode, $purchaseType)
    {
        // Determine prefix
        $prefix = $branchCode;
        $typeCode = $purchaseType === 'credit' ? 'SI' : 'CB';

        // Current period YYMM, e.g. '2505' for May 2025
        $period = Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('ym');

        $fullPrefix = "{$prefix}{$typeCode}{$period}";

        // Find last invoice_no starting with this prefix
        $lastRecord = $this->BaseModel::where('invoice_no', 'like', $fullPrefix . '%')
            ->orderBy('invoice_no', 'desc')
            ->first();

        if ($lastRecord) {
            // Extract numeric suffix
            $lastNumber = intval(substr($lastRecord->invoice_no, strlen($fullPrefix)));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Zero-pad to fixed length (e.g., 4 digits)
        $newNumberStr = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        return $fullPrefix . $newNumberStr;
    }

    public function getSupplierDetails(Request $request, $id)
    {
        //dd('h');
        $supplier = Suppliers::find($id);
        if ($supplier) {
            $yearMonth = Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('Ym');
            $startOfMonth = \Carbon\Carbon::createFromFormat('Ym', $yearMonth)->startOfMonth();
            $endOfMonth = \Carbon\Carbon::createFromFormat('Ym', $yearMonth)->endOfMonth();
            //dd($startOfMonth, $endOfMonth , $id);
            $totalWeight = Transaction::where('supplier_id', $id)
            ->whereBetween('trx_date', [$startOfMonth, $endOfMonth])
            ->sum('weight');
        

            $deductions = Deduction::where('supplier_id', $id)
                ->whereBetween('date', [$startOfMonth, $endOfMonth])
                ->select('type', \DB::raw('SUM(amount) as total'))
                ->groupBy('type')
                ->pluck('total', 'type');


            return response()->json([
                'status' => 'success',
                'data' => $supplier,
                'deductions' => $deductions,
                'total_weight' => $totalWeight
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found'
            ], 404);
        }
    }
    public function getSupplierDetailsMain(Request $request, $id, $type)
    {
        $yearMonth = session()->has('yearMonth') ? session()->get('yearMonth') : now()->format('Ym');

        if ($type == 'bysupId' || $type == 'bySupName') {
            $supplier = Suppliers::find($id);
            $FFBTransaction = FFBTransactionsModel::where([
                'supplier_id' => $id,
                'period' => $yearMonth,
            ])->first();
        } else {
            $FFBTransaction = FFBTransactionsModel::find($id);
            $supplier = $FFBTransaction ? Suppliers::with('bankDetails')->find($FFBTransaction->supplier_id) : null;
        }

        return response()->json([
            'status' => 'success',
            'data' => $supplier,
            'FFBTransaction' => $FFBTransaction,
        ]);
    }
    public function getFfbTransaction($id)
    {
        try {
            $transaction = FFBTransactionsModel::with([
                'supplier.bankDetails' // relationship
            ])->find($id);

            if (!$transaction) {
                return response()->json(['status' => 'error', 'message' => 'Transaction not found.'], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $transaction->supplier, // supplier data
                'FFBTransaction' => $transaction  // transaction data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function getDropDownValues(Request $request)
    {

        $type = $request->input('type');

        $enumValues = [];

        $hqUserIds = User::role('hq')->pluck('id')->toArray();

        if ($type === 'byTicket') {
            $enumValues = DB::table('transactions')
                ->whereIn('user_id', $hqUserIds)
                ->pluck('ticket_no')
                ->unique()
                ->toArray();

        } elseif ($type === 'bySupName' || $type === 'bysupId') {
            $query = DB::table('suppliers')
                ->whereIn('user_id', $hqUserIds)
                ->orderBy($type === 'bySupName' ? 'supplier_name' : 'supplier_id');

            $column = $type === 'bySupName' ? 'supplier_name' : 'supplier_id';

            $enumValues = $query->pluck($column)->unique()->toArray();
        }

        return response()->json($enumValues);
    }

    public function getBranchSupplierDropDownValues(Request $request)
    {
        $type = $request->input('type');
        $enumValues = [];

        // Get all user IDs with the 'hq' role
        $hqUserIds = User::role('hq')->pluck('id')->toArray();

        if ($type === 'byInv') {
            // Fetch unique invoice_no keyed by id for current user's branch
            $enumValues = FFBTransactionsModel::where('branch_id', Auth::user()->branch_id)
                ->pluck('invoice_no', 'id') // pluck(key, value) returns array[id => invoice_no]
                ->unique()
                ->toArray();

            // Convert to array of objects with 'id' and 'label' for frontend consistency
            $enumValues = collect($enumValues)->map(function ($label, $id) {
                return ['id' => $id, 'label' => $label];
            })->values()->all();

        } elseif ($type === 'bySupName' || $type === 'bysupId') {
            $column = $type === 'bySupName' ? 'supplier_name' : 'supplier_id';

            $query = DB::table('suppliers')
                ->whereIn('user_id', $hqUserIds)
                ->orderBy($column);

            // Select id and the label column
            $enumValues = $query->select('id', $column . ' as label')->get()->unique('label')->values()->all();
        }

        return response()->json($enumValues);
    }



    public function getAllDetails(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');
        $hqUserIds = User::role('hq')->pluck('id')->toArray();

        $supplier = null;
        $transaction = null;

        $companyName = auth()->user()->company->name ?? '-';

        if ($type === 'byTicket') {
            //  transaction by ticket
            $transaction = Transaction::with(['supplier', 'vehicle', 'mill'])
                ->where('ticket_no', $value)
                ->whereIn('user_id', $hqUserIds)
                ->first();

            $supplier = $transaction->supplier ?? null;

        } else {
            $column = $type === 'bySupName' ? 'supplier_name' : 'supplier_id';

            $supplier = Suppliers::where($column, $value)
                ->whereIn('user_id', $hqUserIds)
                ->first();

            // dd($supplier);

            if ($supplier) {
                $transaction = Transaction::with(['supplier', 'vehicle', 'mill'])
                    ->where('supplier_id', $supplier->id)
                    ->whereIn('user_id', $hqUserIds)
                    ->orderByDesc('trx_date')
                    ->first();

            }
        }

        $data = [
            'trx_hidden_id' => $transaction->id ?? '-',
            'ticket_no' => $transaction->ticket_no ?? '-',
            'trx_date' => $transaction->trx_date ?? '-',
            'vehicle_id' => $transaction->vehicle->name ?? '-',
            'mill_id' => $transaction->mill->mill_id ?? '-',
            'mill_name' => $transaction->mill->name ?? '-',
            'weight' => $transaction->weight ?? '-',
            'ticket_photo' => $transaction->ticket_photo ?? asset('assets/admin/images/palm-oil.jpg'),

            'company_name' => $companyName,

            'supplier_hidden_id' => $supplier->id ?? '-',
            'supplier_id' => $supplier->supplier_id ?? '-',
            'supplier_name' => $supplier->supplier_name ?? '-',
            'address' => $supplier->address1 ?? '-',
            'email' => $supplier->email ?? '-',
            'telphone_1' => $supplier->telphone_1 ?? '-',
            'telphone_2' => $supplier->telphone_2 ?? '-',
            'bank_id' => $supplier->bank_id ?? '-',
            'bank_no' => $supplier->bank_no ?? '-',
        ];

        return response()->json($data);
    }

    public function editSupplier(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));
        // dd($intID);
        $data = Suppliers::find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }

    public function creditPurchaseIndex(Request $request)
    {
        $this->ViewData['moduleAction'] = 'Credit Purches Listing';
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['ffbTransactions'] = FFBTransactionsModel::with('supplier')->where('period',Helper::getPeriod())->where('purchase_type','credit')->where('user_id',$userId)->get();
        return view('admin.credit-purchases.credit-purchase', $this->ViewData);
    }
    public function cashPurchaseList(Request $request)
    {
        $this->ViewData['moduleAction'] = "Cash Purchases Listing";
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        return view('admin.cash-purchase.cash-purchase-index', $this->ViewData);
    }
    public function cashPurchaseGetRecords(Request $request)
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
                3 => 'ticket_no',
                4 => 'weight_mt',
            ];

            $sortColumn = $filter[$column] ?? 'bill_date';

            $baseQuery = FFBTransactionsModel::with('supplier')->where(['purchase_type'=>'cash','period'=>Helper::getPeriod()]);
            
            if ($request->has('start_date') && $request->start_date) {
                $baseQuery->where('bill_date','>=',$request->start_date);
            }

            if ($request->has('end_date') && $request->end_date) {
                $baseQuery->where('bill_date','<=',$request->end_date);
            }

            $decodedUserId = null;

            if (!empty($request->userId)) {
                $decoded = base64_decode(base64_decode($request->userId), true);
                if ($decoded !== false && is_numeric($decoded)) {
                    $decodedUserId = (int) $decoded;
                }
            }

            $userId = $decodedUserId ?? auth()->id();
            $baseQuery->where('user_id', $userId);
            
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
                ->selectRaw('SUM(weight_mt) as total_weight, SUM(subsidy_amt) as total_subsidy, SUM(net_pay) as total_netpay')
                ->first();

            $records = $baseQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            foreach ($records as $record) {
                $data[] = [
                    'checkbox' => '<div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" name="checkAll">
                                </div>',
                    'date' => date('d-M-Y', strtotime($record->bill_date)),
                    'invoice_no' => $record->invoice_no ?? 'N/A',
                    'supplier_id' => $record->supplier->supplier_id ?? 'N/A',
                    'supplier_name' => $record->supplier->supplier_name ?? 'N/A',
                    'ticket_no' => $record->ticket_no ?? '-',
                    'weight_kg' => number_format($record->weight_mt, 2),
                    'price' => number_format($record->price, 2),
                    'subsidy_amt' => number_format($record->subsidy_amt, 2),
                    'net_pay' => number_format($record->net_pay, 2),
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalData,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
                'footerTotals' => [
                    'weight_kg' => number_format($totals->total_weight * 1000, 2),
                    'subsidy_amt' => number_format($totals->total_subsidy, 2),
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
    public function cashPurchaseSummary(Request $request)
    {
        $this->ViewData['moduleAction'] = "Cash Purchase Summary";
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        return view('admin.cash-purchase.cash-purchase-summary', $this->ViewData);
    }
    public function cashPurchaseSummaryGetRecords(Request $request)
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

            // Define sortable columns
            $filter = [
                0 => 'ffb_transactions.supplier_id',
                1 => 'suppliers.supplier_name',
                2 => 'total_weight',
                3 => 'total_subsidy',
                4 => 'total_netpay',
            ];

            $sortColumn = $filter[$column] ?? 'suppliers.supplier_name';

            // 🔹 Base Query
            $baseQuery = FFBTransactionsModel::query()
                ->join('suppliers', 'suppliers.id', '=', 'ffb_transactions.supplier_id')
                ->where(['purchase_type' => 'cash', 'period' => Helper::getPeriod()]);

            // 🔹 User Filter
            if ($request->has('hidden_user_id') && $request->hidden_user_id) {
                $baseQuery->where('ffb_transactions.user_id', '=', base64_decode(base64_decode($request->hidden_user_id)));
            }

            // 🔹 Date Filters
            if ($request->has('start_date') && $request->start_date) {
                $baseQuery->where('bill_date', '>=', $request->start_date);
            }
            if ($request->has('end_date') && $request->end_date) {
                $baseQuery->where('bill_date', '<=', $request->end_date);
            }

            // 🔹 Search Filter
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $baseQuery->where(function($q) use ($search) {
                    $q->where('suppliers.supplier_name', 'LIKE', "%{$search}%")
                    ->orWhere('ffb_transactions.supplier_id', 'LIKE', "%{$search}%");
                });
            }

            // 🔹 Group by supplier for summary
            $summaryQuery = $baseQuery->select(
                    'ffb_transactions.supplier_id',
                    'suppliers.supplier_name',
                    'suppliers.supplier_id',
                    DB::raw('SUM(ffb_transactions.weight_mt) as total_weight'),
                    DB::raw('SUM(ffb_transactions.subsidy_amt) as total_subsidy'),
                    DB::raw('SUM(ffb_transactions.net_pay) as total_netpay')
                )
                ->groupBy(
                    'ffb_transactions.supplier_id',
                    'suppliers.supplier_name',
                    'suppliers.supplier_id'
                );

            // 🔹 Total filtered records
            $intTotalFiltered = $summaryQuery->count();

            // 🔹 Fetch paginated records
            $records = $summaryQuery
                ->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            // 🔹 Calculate footer totals (ignore pagination)
            $footerTotals = $baseQuery->selectRaw('
                    SUM(ffb_transactions.weight_mt) as total_weight,
                    SUM(ffb_transactions.subsidy_amt) as total_subsidy,
                    SUM(ffb_transactions.net_pay) as total_netpay
                ')
                ->first();

            // 🔹 Format response
            $data = [];
            foreach ($records as $record) {
                $data[] = [
                    'supplier_id' => $record->supplier_id,
                    'supplier_name' => $record->supplier_name ?? 'N/A',
                    'weight_mt' => number_format($record->total_weight, 2),
                    'subsidy' => number_format($record->total_subsidy, 2),
                    'net_pay' => number_format($record->total_netpay, 2),
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalFiltered,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
                'footerTotals' => [
                    'weight_mt' => number_format($footerTotals->total_weight ?? 0, 2),
                    'subsidy' => number_format($footerTotals->total_subsidy ?? 0, 2),
                    'net_pay' => number_format($footerTotals->total_netpay ?? 0, 2),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error while fetching summary records',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function dailyCashPurchaseSummary(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId)) ?? null;
        $this->ViewData['moduleAction'] = "Daily Cash Purchase Summary";
        return view('admin.cash-purchase.daily-cash-purchase-summary', $this->ViewData);
    }
   public function dailyCashPurchaseSummaryGetRecords(Request $request)
    {
        try {
            $query = FFBTransactionsModel::where([
                'purchase_type' => 'cash',
                'period' => Helper::getPeriod()
            ]);

            // User filter
            if ($request->hidden_user_id) {
                $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                $query->where('user_id', $decodedUserId);
            } else {
                $query->where('user_id', auth()->id());
            }
            // Optional date filters
            if ($request->start_date) {
                $query->where('bill_date', '>=', $request->start_date);
            }
            if ($request->end_date) {
                $query->where('bill_date', '<=', $request->end_date);
            }

            // Grouped query
            $records = $query->selectRaw('
                    bill_date,
                    MIN(invoice_no) as min_invoice,
                    MAX(invoice_no) as max_invoice,
                    SUM(weight_mt) as total_weight,
                    AVG(price) as avg_price,
                    SUM(net_pay) as total_net_pay
                ')
                ->groupBy('bill_date')
                ->orderBy('bill_date', 'asc')
                ->get();

            // Format rows
            $data = $records->map(function ($item) {
                $invoiceRange = $item->min_invoice === $item->max_invoice
                    ? $item->min_invoice
                    : "{$item->min_invoice} - {$item->max_invoice}";

                return [
                    'date'          => Carbon::parse($item->bill_date)->format('d-M-Y'),
                    'invoice_range' => $invoiceRange,
                    'total_weight'  => number_format($item->total_weight, 2),
                    'avg_price'     => number_format($item->avg_price, 2),
                    'total'         => number_format($item->total_net_pay, 2),
                    'daily_weight'  => number_format($item->total_weight, 2),
                    'daily_total'   => number_format($item->total_net_pay, 2),
                ];
            });

            // Footer totals
            $footerTotals = [
                'total_weight' => number_format($records->sum('total_weight'), 2),
                'daily_total'  => number_format($records->sum('total_net_pay'), 2),
            ];

            return response()->json([
                'data' => $data,
                'footerTotals' => $footerTotals,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    

   
}
