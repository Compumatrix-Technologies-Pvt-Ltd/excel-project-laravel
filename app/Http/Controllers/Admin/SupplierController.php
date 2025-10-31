<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SuppliersExport;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Suppliersrequest;
use App\Models\Suppliers;
use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SuppliersImport;
use carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function index(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $this->ViewData['userId'] = null;
        if ($encodedId) {
            $this->ViewData['userId'] = $encodedId;
        }
        $this->ViewData['moduleAction'] = 'Suppliers Listing';
        return view($this->ModuleView . 'index', $this->ViewData);
    }
    public function suppliersGpsList(Request $request)
    {
        $this->ViewData['moduleAction'] = 'Supplier GPS Listing';
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId));
        return view($this->ModuleView . 'suppliers-gps-list', $this->ViewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['moduleAction'] = 'Create Supplier';
        $this->ViewData['banks'] = Bank::where('user_id',$userId)->get();
        return view($this->ModuleView . 'create', $this->ViewData);
    }

    public function hqSuppliers()
    {
        $this->ViewData['moduleAction'] = 'HQ Suppliers';
        return view($this->ModuleView . 'suppliers-hq', $this->ViewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Suppliersrequest $request)
    {
        try {
            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.suppliers.index');
            if (!empty($request->hidden_user_id)) {
                $response['url'] .= '?encodedId=' . urlencode($request->hidden_user_id);
            }
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function hqSuppliersStore(Suppliersrequest $request)
    {
        // dd($request->all());
        try {
            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.hq-suppliers.index');
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

        $user = auth()->user();
        if ($user->hasRole('branch')) {
            $prefix = $request->prefix;
            $type = $request->type;
            $supplier_mode = 'branch';

            $supplierId = $this->BaseModel->generateSupplierId($prefix, $type);
            $SuppliersData->supplier_id = $supplierId;

        } elseif ($user->hasRole('hq')) {
            if(!empty($request->supplier_type) && !empty($request->prefix) && !empty($request->type)){
                $prefix = $request->prefix;
                $type = $request->type;
                $supplier_mode = 'branch';

                $supplierId = $this->BaseModel->generateSupplierId($prefix, $type);
                $SuppliersData->supplier_id = $supplierId;
            }else{
                $SuppliersData->supplier_id = $request->supplier_id;
                $supplier_mode = 'hq';
            }
        }
        $userId =  $request->hidden_user_id ? base64_decode(base64_decode($request->hidden_user_id)) : $user->id;
        $SuppliersData->user_id = $userId;
        $SuppliersData->supplier_type = $request->supplier_type;
        $SuppliersData->supplier_mode = $supplier_mode;
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

    public function editHqSupplier(string $encID)
    {
        $intID = base64_decode(base64_decode($encID));
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }
    
    public function edit(Request $request,string $encID)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
                $this->ViewData['banks'] = Bank::where('user_id',$userId)->get();

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

    public function update(Suppliersrequest $request, string $id)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request,'admin.suppliers.index', $id);
        if (!empty($request->hidden_user_id)) {
            $response['url'] .= '?encodedId=' . urlencode($request->hidden_user_id);
        }
        return response()->json($response);
    }

    public function update1(Suppliersrequest $request)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.suppliers.index', $request->id);
        return response()->json($response);
    }
    public function suppliersUpdate(Suppliersrequest $request)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.hq-suppliers.index', $request->hidden_id);
        return response()->json($response);
    }

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

        if ($loggedInUser->hasRole('hq') && empty($request->userId)) {
            $baseQuery->where('user_id', $loggedInUser->id);
        } elseif ($loggedInUser->hasRole('branch') && empty($request->userId)) {
            $baseQuery->where('user_id', $loggedInUser->id);
        }
        $baseQuery->where('supplier_mode', 'branch');
        if (!empty($request->userId)) {
            $userId = base64_decode(base64_decode($request->userId));
            $baseQuery->where('user_id', $userId);
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
            if (!empty($request->userId)) {
                $ediRoute = route('admin.suppliers.edit', base64_encode(base64_encode($supplier->id))) 
                    . '?encodedId=' . urlencode($request->userId);
            } else {
                $ediRoute = route('admin.suppliers.edit', base64_encode(base64_encode($supplier->id)));
            }

            $data[] = [
                'checkbox'=>'<th scope="col" style="width: 10px;">
                    <div class="form-check">
                        <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                    </div>
                </th>',
                'id' => $count ?? 'N/A',
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
                          <a class="dropdown-item" 
                            href="' .$ediRoute . '" 
                            id="edit-supplier-btn">
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
            $count++;
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $intTotalData,
            'recordsFiltered' => $intTotalFiltered,
            'data' => $data,
        ]);
    }

    public function HQgetRecords(Request $request)
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
                'checkbox'=>'<th scope="col" style="width: 10px;">
                        <div class="form-check">
                            <input class="form-check-input fs-15" type="checkbox" id="checkAll">
                        </div>
                    </th>',
                'id' => $count ?? 'N/A',
                'supplier_id' => $supplier->supplier_id ?? 'N/A',
                'supplier_name' => $supplier->supplier_name ?? 'N/A',
                'email' => $supplier->email ?? 'N/A',
                'telphone_1' => $supplier->telphone_1 ?? 'N/A',
                'actions' => '
                <div class="dropdown d-inline-block">
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item edit-supplier-btn" href="javascript:void(0)" data-id="'.base64_encode(base64_encode($supplier->id)).'">
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
            $count++;
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

    public function getSupplierGPSRecords(Request $request)
    {
        try {
            $loggedInUser = auth()->user();

            $start = $request->start ?? 0;
            $length = $request->length ?? 10;

            $query = Suppliers::query()
                ->select([
                    'supplier_id',
                    'supplier_name',
                    'mpob_lic_no',
                    'mspo_cert_no',
                    'land_size',
                    'latitude',
                    'longitude'
                ]);

            // ✅ Search functionality
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where(function ($q) use ($search) {
                    $q->where('supplier_id', 'LIKE', "%{$search}%")
                        ->orWhere('supplier_name', 'LIKE', "%{$search}%")
                        ->orWhere('mpob_lic_no', 'LIKE', "%{$search}%")
                        ->orWhere('mspo_cert_no', 'LIKE', "%{$search}%");
                });
            }
            if ($loggedInUser->hasRole('hq') && empty($request->hidden_user_id)) {
                $query->where('user_id', $loggedInUser->id);
                $query->where('supplier_mode', 'branch');
            } elseif ($loggedInUser->hasRole('branch') && empty($request->hidden_user_id)) {
                $query->where('user_id', $loggedInUser->id);
            }
            if(!empty($request->hidden_user_id)) {
                $query->where('user_id', base64_decode(base64_decode($request->hidden_user_id)));
            }

            $totalRecords = $query->count();

            // ✅ Pagination
            $records = $query
                ->skip($start)
                ->take($length)
                ->get();

            // ✅ Format data for DataTables
            $data = $records->map(function ($supplier) {
                return [
                    'supplier_id' => $supplier->supplier_id ?? 'N/A',
                    'supplier_name' => $supplier->supplier_name ?? 'N/A',
                    'mpob_lic_no' => $supplier->mpob_lic_no ?? '-',
                    'mspo_cert_no' => $supplier->mspo_cert_no ?? '-',
                    'land_size' => number_format($supplier->land_size ?? 0, 2),
                    'latitude' => $supplier->latitude ?? '',
                    'longitude' => $supplier->longitude ?? '',
                ];
            });

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching supplier GPS records',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function supplierLicenceExpiryPDF(Request $request)
    {
        try {
            $loggedInUser = auth()->user();
            $expiryType = $request->expiry_type ?? 'mpob';
            if (!empty($request->expiry_date)) {
                try {
                    // Try to detect format dynamically
                    if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->expiry_date)) {
                        // Already in Y-m-d
                        $expiryDate = $request->expiry_date;
                    } else {
                        // Convert from d-m-Y to Y-m-d
                        $expiryDate = Carbon::createFromFormat('d-m-Y', $request->expiry_date)->format('Y-m-d');
                    }
                } catch (\Exception $e) {
                    $expiryDate = now()->format('Y-m-d');
                }
            } else {
                $expiryDate = now()->format('Y-m-d');
            }

            $query = Suppliers::query();
                if ($loggedInUser->hasRole('hq')) {
                    $baseQuery->where('user_id', $loggedInUser->id);
                    $baseQuery->where('supplier_mode','branch');
                }else if ($loggedInUser->hasRole('branch')) {
                    $baseQuery->where('user_id', $loggedInUser->id);
                }
            if ($expiryType === 'mpob') {
                $query->whereNotNull('mpob_exp_date')
                    ->whereDate('mpob_exp_date', '<=', $expiryDate);
            } elseif ($expiryType === 'mspo') {
                $query->whereNotNull('mspo_exp_date')
                    ->whereDate('mspo_exp_date', '<=', $expiryDate);
            } elseif ($expiryType === 'all') {
                $query->where(function($q) use ($expiryDate) {
                    $q->whereDate('mpob_exp_date', '<=', $expiryDate)
                    ->orWhereDate('mspo_exp_date', '<=', $expiryDate);
                });
            }

            $suppliers = $query->orderBy('supplier_name')->get();

            $pdf = Pdf::loadView($this->ModuleView . 'supplier_licence_expiry_pdf', [
                'suppliers' => $suppliers,
                'expiryType' => strtoupper($expiryType),
                'expiryDate' => $expiryDate,
                'company_name' => 'Main Tree Company',
            ])->setPaper('A4', 'landscape');

            if ($request->has('preview')) {
                return $pdf->stream("Supplier_Licence_Expiry_{$expiryType}.pdf");
            }

            return $pdf->download("Supplier_Licence_Expiry_{$expiryType}.pdf");

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate Supplier Licence Expiry PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function supplierGPSPDF(Request $request)
    {
        try {
            $loggedInUser = auth()->user();
            $baseQuery = Suppliers::select('supplier_id', 'supplier_name', 'mpob_lic_no', 'mspo_cert_no', 'land_size', 'latitude', 'longitude');
            if ($loggedInUser->hasRole('hq')) {
                $baseQuery->where('user_id', $loggedInUser->id);
                $baseQuery->where('supplier_mode','branch');
            }else if ($loggedInUser->hasRole('branch')) {
                $baseQuery->where('user_id', $loggedInUser->id);
            }
            $suppliers = $baseQuery->orderBy('supplier_name')
                ->get();

            $pdf = Pdf::loadView( $this->ModuleView . 'supplier_gps_pdf', [
                'suppliers' => $suppliers,
                'company_name' => 'Main Tree Company',
            ])->setPaper('A4', 'landscape');

            if ($request->has('preview')) {
                return $pdf->stream("Supplier_GPS_Coordinates.pdf");
            }

            return $pdf->download("Supplier_GPS_Coordinates.pdf");
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate GPS PDF',
                'message' => $e->getMessage(),
            ], 500);
        }
    }




}
