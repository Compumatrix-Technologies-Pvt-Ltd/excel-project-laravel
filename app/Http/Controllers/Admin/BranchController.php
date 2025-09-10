<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\BranchModel;
use Exception;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    //

    public function __construct(BranchModel $BranchModel)
    {

        $this->BaseModel = $BranchModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.branch.';
    }

    public function index()
    {
        $this->ViewData['moduleAction'] = "Branch Management";
        $this->ViewData['branches'] = $this->BaseModel->all();
        return view('admin.branch.index', $this->ViewData);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                //'company_id' => 'required|exists:company_info,id',
                'code' => 'required|unique:company_branches,code',
                'name' => 'required',
                'phone' => 'required',
            ];

            $messages = [
                //'company_id.required' => 'Company ID is required.',
                'code.unique' => 'Branch code must be unique.',
                'name.required' => 'Branch name is required.',
                'phone.required' => 'Branch phone number is required.',
            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.branch.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.branch.index', $request->hidden_id);
        return response()->json($response);
    }
    

    public function _storeOrUpdate($branchData, $request)
    {
        $branchData->company_id = Auth::user()->company_id;
        $branchData->code = $request->code;
        $branchData->name = $request->name;
        $branchData->address = $request->address;
        $branchData->phone = $request->phone;
        $branchData->save();
        return $branchData;
    }

    public function edit($encID)
    {
        // dd("here");
        $intID = base64_decode(base64_decode($encID));
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }

     public function destroy($encID)
    {
        // dd("here");
        // dd($encID);
        $response = Helper::destroyRecord($this->BaseModel, $encID);
        return response()->json($response);

    }


}
