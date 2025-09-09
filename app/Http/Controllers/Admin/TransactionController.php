<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transactionrequest;
use App\Models\Mill;
use App\Models\Suppliers;
use App\Models\Transaction;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(Transaction $TransactionModel)
    {
        $this->BaseModel = $TransactionModel;
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.daily-transactions.';
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $this->ModuleTitle = __('Transactions');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Suppliers'] = Suppliers::with('user')
            ->where('user_id', $userId)
            ->get();
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    public function hqTransactionIndex(Request $request)
    {
        $userId = auth()->user()->id;
        $this->ViewData['moduleAction'] = "HQ Transactions";
        $this->ViewData['Vehicles'] = Vehicle::all();
        $this->ViewData['Mills'] = Mill::all();
        $this->ViewData['Suppliers'] = Suppliers::with('user')
            ->where('user_id', $userId)
            ->get();
        return view($this->ModuleView . 'hq-index', $this->ViewData);
    }


    public function create()
    {

    }


    public function store(Transactionrequest $request)
    {
        // dd($request->all());
        try {
            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.transactions.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function _storeOrUpdate($TransctionData, $request)
    {
        $TransctionData->user_id = auth()->user()->id;
        $TransctionData->trx_date = $request->trx_date;
        $TransctionData->ticket_no = $request->ticket_no;
        $TransctionData->trx_no = $request->trx_no;
        $TransctionData->vehicle_id = $request->vehicle_id;
        $TransctionData->supplier_id = $request->supplier_id;
        $TransctionData->mill_id = $request->mill_id;
        $TransctionData->weight = $request->weight;

        $TransctionData->save();

        return $TransctionData;

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


    public function update(Transactionrequest $request, string $id)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.transactions.index', $id);
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
                0 => 'trx_date',
                1 => 'trx_no',
                2 => 'ticket_no',
                3 => 'supplier_id',
                4 => 'weight',
            ];

            $sortColumn = $filter[$column] ?? 'trx_no';

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
                    'supplier_id' => $deduction->supplier->supplier_id ?? 'N/A',
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

        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching records.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

}
