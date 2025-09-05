<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Mill;
use Exception;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MillController extends Controller
{
    //

    public function __construct(Mill $millModel)
    {

        $this->BaseModel = $millModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.mill.';
    }

    public function index()
    {
        $this->ViewData['moduleAction'] = "Mill Management";
        $this->ViewData['mills'] = $this->BaseModel->all();
        return view('admin.mill.index', $this->ViewData);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'mill_id' => 'required|unique:mills,mill_id',
                'name' => 'required',
                'mpob_lic_no' => 'required|unique:mills,mpob_lic_no',
            ];

            $messages = [
                'mill_id.required' => 'Mill ID is required.',
                'mill_id.unique' => 'Mill ID must be unique.',
                'name.required' => 'Mill name is required.',
                'mpob_lic_no.required' => 'MPOB license number is required.',
                'mpob_lic_no.unique' => 'MPOB license number must be unique.',
            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.mill.management');
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
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.mill.management', $request->id);
        return response()->json($response);
    }

    public function _storeOrUpdate($millData, $request)
    {
        $millData->mill_id = $request->mill_id;
        $millData->name = $request->name;
        $millData->mpob_lic_no = $request->mpob_lic_no;
        $millData->save();
        return $millData;
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
