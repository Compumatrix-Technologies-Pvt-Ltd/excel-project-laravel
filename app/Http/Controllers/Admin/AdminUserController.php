<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\RegistrationRequest;
use App\Mail\EmailVerificationMail;
use App\Models\Branch;
use App\Models\BranchModel;
use App\Models\CompanyModel;
use App\Models\Suppliers;
use App\Models\Transaction;
use App\Models\User;
use DB;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Log;
use Mail;
use Spatie\Permission\Models\Role;
use Str;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct(
        User $UserModel,
        Role $RoleModel
    ) {
        $this->BaseModel = $UserModel;
        $this->RoleModel = $RoleModel;
        $this->ViewData = [];
        $this->ModuleView = 'admin.users.';
    }
    public function index()
    {
        $this->ModuleTitle = __('User Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['BranchUsers'] = $this->BaseModel->with('branch')->whereHas('roles', function ($query) {
            $query->where('name', 'branch');
        })->get();
        $this->ViewData['rolesCollection'] = $this->RoleModel
            ->whereNotIn('name', ['super-admin', 'hq'])
            ->orderBy('name', 'ASC')
            ->get();
        $this->ViewData['Branches'] = BranchModel::all();
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->ModuleTitle = __('Create Users');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['rolesCollection'] = $this->RoleModel
            ->whereNotIn('name', ['super-admin', 'hq'])
            ->orderBy('name', 'ASC')
            ->get();
        $this->ViewData['Branches'] = BranchModel::all();
        return view($this->ModuleView . 'create', $this->ViewData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistrationRequest $request)
    {
        // dd($request->all());
        try {

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.users.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function _storeOrUpdate($UserData, $request)
    {
        $user = auth()->user();
        $plainPassword = Str::random(6);
        $strRole = $this->RoleModel->where('id', base64_decode(base64_decode($request->role)))
            ->pluck('name')
            ->first();
        // dd($strRole);
        $UserData->assignRole(strtolower($strRole));
        $UserData->name = $request->name;
        $UserData->email = $request->email;
        $UserData->mobile_number = $request->mobile_number;
        $UserData->status = $request->status ?? 'inactive';
        $UserData->password = Hash::make($plainPassword);
        $UserData->company_id = $user->company_id;
        $UserData->parent_id = $user->id;
        $UserData->branch_id = $request->branch_id;
        $UserData->save();

        try {

            $data = [
                'user' => $UserData,
                'plain_password' => $plainPassword,
            ];

            Mail::to($user->email)->send(new EmailVerificationMail('login_credentials', $data));

        } catch (Exception $e) {
            Log::error("Failed to send OTP email: " . $e->getMessage());
        }

        return $UserData;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.users.index', $request->id);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    // public function suppliersIndex(){
    //     $this->ModuleTitle = __('Suppliers Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.suppliers.index', $this->ViewData);
    // }

    // public function suppliersCreate(){
    //      $this->ModuleTitle = __('Create Supplier');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.suppliers.create', $this->ViewData);
    // }
    public function suppliersedit()
    {
        $this->ModuleTitle = __('Edit Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.edit', $this->ViewData);
    }

    public function suppliersGpsList()
    {
        $this->ModuleTitle = __('Supplier GPS Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.suppliers-gps-list', $this->ViewData);
    }

    public function suppliersHqIndex()
    {
        $this->ModuleTitle = __('Supplier Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.suppliers-hq', $this->ViewData);
    }

    // public function transactionIndex(){
    //      $this->ModuleTitle = __('Transactions');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.daily-transactions.index', $this->ViewData);
    // }

    // public function bankIndex(){
    //      $this->ModuleTitle = __('Bank Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.banks.index', $this->ViewData);
    // }
    // public function deductionIndex(){
    //      $this->ModuleTitle = __('Deduction Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.deductions.deduction-index', $this->ViewData);
    // }

    public function creditPurchaseIndex()
    {
        $this->ModuleTitle = __('Credit Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.credit-purchases.credit-purchase', $this->ViewData);
    }

    public function creditPurchaseAnalysisIndex()
    {
        $this->ModuleTitle = __('Credit Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.credit-purchase-analysis', $this->ViewData);
    }

    public function purchaseAnalysisIndex()
    {
        $this->ModuleTitle = __('Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.purchase-analysis', $this->ViewData);
    }

    public function suppliesDetails()
    {
        $this->ModuleTitle = __('Supplies Details');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.supplies.supplies-details', $this->ViewData);
    }
    public function suppliesSummary()
    {
        $this->ModuleTitle = __('Supplies Summary');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.supplies.supplies-summary', $this->ViewData);
    }
    public function suppliesAnalysis()
    {
        $this->ModuleTitle = __('Supplies Analysis');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.supplies-analysis', $this->ViewData);
    }
    public function plansIndex()
    {
        $this->ModuleTitle = __('Plans');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.subscriptions.plans', $this->ViewData);
    }
    public function planUsersIndex()
    {
        $this->ModuleTitle = __('Users');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.subscriptions.users', $this->ViewData);
    }

    public function YearlyCashCredit()
    {
        $this->ModuleTitle = __('Yearly Cash Vs Credit');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.yearly-cash-credit', $this->ViewData);
    }
    public function creditPurchase()
    {
        $this->ModuleTitle = __('Credit Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.credit-purchase', $this->ViewData);
    }
    public function cashPurchase()
    {
        $this->ModuleTitle = __('Cash Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.cash-purchase', $this->ViewData);
    }
    public function purchaseSalse()
    {
        $this->ModuleTitle = __('Purchase & Salse');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.purchase-salse', $this->ViewData);
    }
    public function mainForm()
    {
        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.masters.masterForm', $this->ViewData);
    }
    public function HQmainForm()
    {
        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.masters.hq-masterForm', $this->ViewData);
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
            //  supplier by name or ID
            $column = $type === 'bySupName' ? 'supplier_name' : 'supplier_id';

            $supplier = Suppliers::where($column, $value)
                ->whereIn('user_id', $hqUserIds)
                ->first();

                // dd($supplier);

            if ($supplier) {
                // latest transaction for that supplier
                $transaction = Transaction::with(['supplier', 'vehicle', 'mill'])
                    ->where('supplier_id', $supplier->id)
                    ->whereIn('user_id', $hqUserIds)
                    ->orderByDesc('trx_date')
                    ->first();

            }
        }

        $data = [
            'ticket_no' => $transaction->ticket_no ?? '-',
            'trx_date' => $transaction->trx_date ?? '-',
            'vehicle_id' => $transaction->vehicle->name ?? '-',
            'mill_id' => $transaction->mill->mill_id ?? '-',
            'mill_name' => $transaction->mill->name ?? '-',
            'weight' => $transaction->weight ?? '-',
            'ticket_photo' => $transaction->ticket_photo ?? asset('assets/admin/images/palm-oil.jpg'),

            'company_name' => $companyName,

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

}



