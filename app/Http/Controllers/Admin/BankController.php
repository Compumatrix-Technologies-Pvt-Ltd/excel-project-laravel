<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{

    public function __construct(Bank $bankModel)
    {
        $this->BaseModel = $bankModel;
        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.banks.';
    }



    public function index()
    {
        $this->ModuleTitle = __('Bank Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['banks'] = $this->BaseModel->all();
        return view('admin.banks.index', $this->ViewData);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                'bank_id' => 'required|unique:banks,bank_id',
                'name' => 'required',
                'bic_code' => 'required|unique:banks,bic_code',
            ];

            $messages = [
                'bank_id.required' => 'Bank ID is required.',
                'bank_id.unique' => 'Bank ID must be unique.',
                'name.required' => 'Bank name is required.',
                'bic_code.required' => 'BIC Code is required.',
                'bic_code.unique' => 'BIC Code must be unique.',
            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.banks.index');
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
        // dd("here");
        // dd($request->all());
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.banks.index', $request->id);
        return response()->json($response);
    }

    public function _storeOrUpdate($bankData, $request)
    {
        $bankData->bank_id = $request->bank_id;
        $bankData->name = $request->name;
        $bankData->bic_code = $request->bic_code;
        $bankData->pay_type = $request->pay_type;
        $bankData->save();
        return $bankData;
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
