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
        $this->ViewData['BranchUsers'] = $this->BaseModel->where('company_id',auth()->user()->company_id)->with('branch')->whereHas('roles', function ($query) {
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
        $this->ViewData['Branches'] = BranchModel::where('company_id',auth()->user()->company_id)->get();
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

    public function suppliersedit()
    {
        $this->ModuleTitle = __('Edit Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.edit', $this->ViewData);
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

    
}



