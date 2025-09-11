<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeductionRequest;
use App\Models\Deduction;
use App\Models\Suppliers;
use Exception;
use Illuminate\Http\Request;

class DeductionController extends Controller
{

    public function __construct(Deduction $DeductionModel)
    {
        $this->BaseModel = $DeductionModel;
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.deductions.';
    }
    public function index()
    {
        $userId = auth()->user()->id;
        // dd($userId);
        $this->ModuleTitle = __('Deduction Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Suppliers'] = Suppliers::with('user')
            ->where('user_id', $userId)
            ->get();

        return view($this->ModuleView . 'deduction-index', $this->ViewData);
    }

    public function create()
    {

    }

    public function store(DeductionRequest $request)
    {
        // dd($request->all());
        try {
            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.deductions.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function _storeOrUpdate($DeductionsData, $request)
    {

        $DeductionsData->date = $request->date;
        $DeductionsData->period = $request->period;
        $DeductionsData->supplier_id = $request->supplier_id;
        $DeductionsData->type = $request->type;
        $DeductionsData->amount = $request->amount;
        $DeductionsData->remark = $request->remark;

        $DeductionsData->save();

        return $DeductionsData;

    }

    public function show(string $id)
    {

    }


    public function edit(string $id)
    {

    }


    public function update(Request $request, string $id)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.deductions.index', $id);
        return response()->json($response);
    }


    public function destroy(string $encID)
    {
        $response = Helper::destroyRecord($this->BaseModel, $encID);
        return response()->json($response);
    }

    public function getRecords(Request $request)
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
                0 => 'date',
                1 => 'supplier_id',
                2 => 'type',
                3 => 'amount',
            ];

            $sortColumn = $filter[$column] ?? 'supplier_id';

            $loggedInUser = auth()->user();

            $baseQuery = $this->BaseModel::with('supplier.user');

            if ($loggedInUser->role === 'hq') {
                $baseQuery->whereHas('supplier.user', function ($q) {
                    $q->where('role', 'hq');
                });
            } elseif ($loggedInUser->role === 'branch-user') {
                $baseQuery->whereHas('supplier.user', function ($q) {
                    $q->where('role', 'branch-user');
                });
            }


            $intTotalData = $baseQuery->count();

            $modelQuery = clone $baseQuery;

            if (!empty($request->search['value'])) {
                $strSearch = $request->search['value'];

                $modelQuery->where(function ($query) use ($strSearch) {
                    $query->where('date', 'LIKE', "%{$strSearch}%")
                        ->orWhere('supplier_id', 'LIKE', "%{$strSearch}%")
                        ->orWhere('type', 'LIKE', "%{$strSearch}%")
                        ->orWhere('amount', 'LIKE', "%{$strSearch}%");
                });
            }

            $intTotalFiltered = $modelQuery->count();

            $objects = $modelQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            $data = [];
            $count = $start + 1;

            foreach ($objects as $deduction) {

                $data[] = [
                    'sr.no' => $count,
                    'date' => $deduction->date ?? 'N/A',
                    'period' => $deduction->period ?? 'N/A',
                    'supplier_id' => $deduction->supplier->supplier_id . ' ' . $deduction->supplier->supplier_name ?? 'N/A',
                    'type' => ucfirst($deduction->type) ?? 'N/A',
                    'amount' => $deduction->amount ?? 'N/A',
                    'remark' => ucfirst($deduction->remark) ?? 'N/A',
                    'actions' => '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route('admin.deductions.destroy', [base64_encode(base64_encode($deduction->id))]) . '" class="dropdown-item remove-item-btn">
                                    <i class="ri-delete-bin-fill align-bottom me-2 text-danger" title="Clear Deduction"></i>
                                </a>'

                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $intTotalData,
                'recordsFiltered' => $intTotalFiltered,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching records.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
