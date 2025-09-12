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

use Log;
use Exception;
use Session;

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
        $branchCode = $user->branch->code; // e.g. "VC"

        $this->ViewData['creditInvoiceNo'] = $this->generateInvoiceNumber($branchCode, 'credit');
        $this->ViewData['cashInvoiceNo'] = $this->generateInvoiceNumber($branchCode, 'cash');

        $this->ViewData['suppliers_credit'] = Suppliers::where('supplier_type', 'credit')->get();
        $this->ViewData['suppliers_cash'] = Suppliers::where('supplier_type', 'cash')->get();


        return view('admin.masters.masterForm', $this->ViewData);
    }

    public function HQmainForm()
    {
        $userId = auth()->user()->id;
        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Vehicles'] = Vehicle::all();
        $this->ViewData['Mills'] = Mill::all();
        $this->ViewData['Suppliers'] = Suppliers::with('user')
            ->where('user_id', $userId)
            ->get();
        return view('admin.masters.hq-masterForm', $this->ViewData);
    }

    public function storeFFBTransaction(Request $request)
    {

        try {
            // dd($request->all());

            $this->BaseModel = new FFBTransactionsModel();
            $this->BaseModel->company_id = $request->input('company_id');
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
        $supplier = Suppliers::find($id);
        if ($supplier) {
            $yearMonth = Session::has('yearMonth') ? Session::get('yearMonth') : now()->format('Ym');
            $startOfMonth = \Carbon\Carbon::createFromFormat('Ym', $yearMonth)->startOfMonth();
            $endOfMonth = \Carbon\Carbon::createFromFormat('Ym', $yearMonth)->endOfMonth();
            //dd($startOfMonth, $endOfMonth , $id);
            $deductions = Deduction::where('supplier_id', $id)
                ->whereBetween('date', [$startOfMonth, $endOfMonth])
                ->select('type', \DB::raw('SUM(amount) as total'))
                ->groupBy('type')
                ->pluck('total', 'type');


            return response()->json([
                'status' => 'success',
                'data' => $supplier,
                'deductions' => $deductions
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Supplier not found'
            ], 404);
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
}
