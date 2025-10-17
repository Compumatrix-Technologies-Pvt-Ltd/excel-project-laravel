<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function __construct(Vehicle $DeductionModel)
    {
        $this->BaseModel = $DeductionModel;
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.vehicles.';
    }

    public function index()
    {

        $this->ModuleTitle = __('Vehicles Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Vehicles'] = $this->BaseModel->all();
        return view($this->ModuleView . 'index', $this->ViewData);
    }

   
    public function create()
    {

    }

   
    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $rules = [
                'name' => 'required|unique:vehicles,name',
            ];

            $messages = [
                'name.required' => 'Vehicle name is required.',
                'name.unique' => 'Vehicle name must be unique',
            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.vehicles.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
    public function show(string $id)
    {
        
    }

       public function edit(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }

    public function update(Request $request)
    {
        // dd("here");
        // dd($request->all());
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.vehicles.index', $request->id);
        return response()->json($response);
    }

    public function _storeOrUpdate($vehicleData, $request)
    {
        $vehicleData->name = $request->name;
        $vehicleData->company_id = auth()->user()->company_id;
        $vehicleData->save();
        return $vehicleData;
    }
    
    public function destroy(string $encID)
    {
        $response = Helper::destroyRecord($this->BaseModel, $encID);
        return response()->json($response);
    }
}
