<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SuppliersExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliersrequest;
use App\Models\Suppliers;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SuppliersImport;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(Suppliers $supplierModel)
    {
        $this->BaseModel = $supplierModel;
        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.suppliers.';
    }
    public function index()
    {
        $this->ModuleTitle = __('Suppliers Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->ModuleTitle = __('Create Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'create', $this->ViewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Suppliersrequest $request)
    {
        // dd($request->all());
        try {
            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.suppliers.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function _storeOrUpdate($SuppliersData, $request)
    {
        $prefix = $request->prefix;
        $type = $request->type;

        $supplierId = $this->BaseModel->generateSupplierId($prefix, $type);

        $SuppliersData->supplier_id = $supplierId;
        $userId = auth()->user()->id;
        $SuppliersData->user_id = $userId;
        $SuppliersData->supplier_id = $request->supplier_id;
        $SuppliersData->supplier_type = $request->supplier_type;
        $SuppliersData->supplier_name = $request->supplier_name;
        $SuppliersData->address1 = $request->address1;
        $SuppliersData->address2 = $request->address2;
        $SuppliersData->mpob_lic_no = $request->mpob_lic_no;
        $SuppliersData->mpob_exp_date = $request->mpob_exp_date;
        $SuppliersData->mspo_cert_no = $request->mspo_cert_no;
        $SuppliersData->mspo_exp_date = $request->mspo_exp_date;
        $SuppliersData->tin = $request->tin;
        $SuppliersData->subsidy_rate = $request->subsidy_rate;
        $SuppliersData->land_size = $request->land_size;
        $SuppliersData->latitude = $request->latitude;
        $SuppliersData->longitude = $request->longitude;
        $SuppliersData->email = $request->email;
        $SuppliersData->telphone_1 = $request->telphone_1;
        $SuppliersData->telphone_2 = $request->telphone_2;
        $SuppliersData->bank_id = $request->bank_id;
        $SuppliersData->bank_acc_no = $request->bank_acc_no;
        $SuppliersData->remark = $request->remark;

        $SuppliersData->save();

        return $SuppliersData;

    }
    /**
     * Display the specified resource.
     */
    public function show(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));
        // dd($intID);
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));

        $data = $this->BaseModel->find($intID);
        $parts = explode('-', $data->supplier_id);

        $data->prefix = $parts[0] ?? '';
        $data->type = $parts[1] ?? '';
        $data->sequence = $parts[2] ?? '';

        if (!$data) {

            return redirect()->route('admin.suppliers.index')->with('error', 'Supplier not found');
        }

        $this->ViewData['supplier'] = $data;
        $this->ViewData['moduleAction'] = "Edit Supplier";

        return view($this->ModuleView . 'edit', $this->ViewData);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Suppliersrequest $request, string $id)
    {
        // dd($id);
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.suppliers.index', $id);
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $encID)
    {
        $response = Helper::destroyRecord($this->BaseModel, $encID);
        return response()->json($response);
    }

    public function getRecords(Request $request)
    {
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;

        $column = 0;
        $dir = 'asc';

        if ($request->has('order') && isset($request->order[0])) {
            $column = $request->order[0]['column'];
            $dir = $request->order[0]['dir'];
        }

        $filter = [
            0 => 'supplier_id',
            1 => 'supplier_name',
            2 => 'email',
            3 => 'telphone_1',
        ];

        $sortColumn = $filter[$column] ?? 'supplier_id';

        $loggedInUser = auth()->user();

        $baseQuery = $this->BaseModel::with('user');

        if ($loggedInUser->hasRole('hq')) {
            $baseQuery->where('user_id', $loggedInUser->id);
        } elseif ($loggedInUser->hasRole('branch')) {
            // Branch-user can only see their own suppliers
            $baseQuery->where('user_id', $loggedInUser->id);
        }


        $intTotalData = $baseQuery->count();

        $modelQuery = clone $baseQuery;

        if (!empty($request->search['value'])) {
            $strSearch = $request->search['value'];

            $modelQuery->where(function ($query) use ($strSearch) {
                $query->where('supplier_id', 'LIKE', "%{$strSearch}%")
                    ->orWhere('supplier_name', 'LIKE', "%{$strSearch}%")
                    ->orWhere('email', 'LIKE', "%{$strSearch}%")
                    ->orWhere('telphone_1', 'LIKE', "%{$strSearch}%");
            });
        }

        $intTotalFiltered = $modelQuery->count();

        $objects = $modelQuery->orderBy($sortColumn, $dir)
            ->skip($start)
            ->take($length)
            ->get();

        $data = [];
        $count = $start + 1;

        foreach ($objects as $supplier) {
            $data[] = [
                'supplier_id' => $supplier->supplier_id ?? 'N/A',
                'supplier_name' => $supplier->supplier_name ?? 'N/A',
                'email' => $supplier->email ?? 'N/A',
                'telphone_1' => $supplier->telphone_1 ?? 'N/A',
                'view_info' => '
                                <a class="btn btn-sm btn-warning view-supplier-btn"  href="javascript:void(0);" data-id="' . base64_encode(base64_encode($supplier->id)) . '"  title="View Info">
                                    <i class="ri-eye-fill"></i>
                                </a>
                            ',
                'actions' => '
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="' . route('admin.suppliers.edit', base64_encode(base64_encode($supplier->id))) . '" id="edit-supplier-btn">
                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route('admin.suppliers.destroy', [base64_encode(base64_encode($supplier->id))]) . '" class="dropdown-item remove-item-btn">
                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                            </a>
                        </li>
                    </ul>
                </div>
            ',
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $intTotalData,
            'recordsFiltered' => $intTotalFiltered,
            'data' => $data,
        ]);
    }




    public function importSuppliers(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $file = $request->file('file');

            Excel::import(new SuppliersImport, $file);

            $this->JsonData['status'] = 'success';
            $this->JsonData['url'] = route('admin.suppliers.index');
            $this->JsonData['msg'] = 'Import Successfully';
        } catch (Exception $e) {
            $this->JsonData['status'] = 'error';
            $this->JsonData['url'] = route('admin.suppliers.index');
            $this->JsonData['msg'] = $e->getMessage();
        }

        return response()->json($this->JsonData);
    }

    public function exportSuppliers()
    {
        try {
            $fileName = 'suppliers_' . date('Y-m-d') . '.xlsx';
            return Excel::download(new SuppliersExport(), $fileName);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error exporting patients.'], 500);

        }
    }


}
