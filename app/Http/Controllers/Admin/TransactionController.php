<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Transactionrequest;
use App\Models\Mill;
use App\Models\Suppliers;
use App\Models\Transaction;
use App\Models\Vehicle;
use DB;
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
            $user = auth()->user();
            if ($user->hasRole('branch')) {
                $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.transactions.index');
                return response()->json($response);
            } elseif ($user->hasRole('hq')) {
                $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.transaction.management');
                return response()->json($response);
            }

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
        // dd($intID);
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }


    public function update(Request $request)
    {
        // dd("here");
        $user = auth()->user();
        // $id = base64_decode(base64_decode($request->id));
        if ($user->hasRole('branch')) {
            $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.transactions.index', $request->id);
            return response()->json($response);
        } elseif ($user->hasRole('hq')) {

            // dd($request->all());
            $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.transaction.management', $request->id);
            return response()->json($response);
        }
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

            if (!$loggedInUser->hasRole('branch')) {
                return response()->json([
                    'error' => 'Unauthorized: User does not have the required role.',
                ], 403);
            }

            $baseQuery = $this->BaseModel::with(['supplier'])
                ->where('user_id', $loggedInUser->id);

            $intTotalData = $baseQuery->count();

            $modelQuery = clone $baseQuery;

            if (!empty($request->search['value'])) {
                $strSearch = $request->search['value'];

                $modelQuery->where(function ($query) use ($strSearch) {
                    $query->where('trx_no', 'LIKE', "%{$strSearch}%")
                        ->orWhere('supplier_id', 'LIKE', "%{$strSearch}%")
                        ->orWhere('ticket_no', 'LIKE', "%{$strSearch}%")
                        ->orWhere('weight', 'LIKE', "%{$strSearch}%");
                });
            }

            $intTotalFiltered = $modelQuery->count();

            // Retrieve the actual records with pagination
            $objects = $modelQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            // Prepare the data for the response
            $data = [];
            $count = $start + 1;

            foreach ($objects as $transaction) {
                $data[] = [
                    'sr.no' => $count,
                    'trx_no' => $transaction->trx_no ?? 'N/A',
                    'trx_date' => $transaction->trx_date ?? 'N/A',
                    'supplier_id' => $transaction->supplier->supplier_id . ' ' . $transaction->supplier->supplier_name ?? 'N/A',
                    'ticket_no' => $transaction->ticket_no ?? 'N/A',
                    'weight' => $transaction->weight ?? 'N/A',
                    'actions' => '
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">                                                   
                        <li>
                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                            data-id="' . base64_encode(base64_encode($transaction->id)) . '"
                                            id="edit-transaction-btn">
                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            Edit
                                        </a>
                                    </li>
                            <li>
                                <a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route('admin.transactions.destroy', [base64_encode(base64_encode($transaction->id))]) . '" class="dropdown-item remove-item-btn">
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

        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching records.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function getRecordshq(Request $request)
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

            if (!$loggedInUser->hasRole('hq')) {
                return response()->json([
                    'error' => 'Unauthorized: User does not have the required role.',
                ], 403);
            }

            $baseQuery = $this->BaseModel::with(['supplier', 'vehicle', 'mill'])
                ->where('user_id', $loggedInUser->id);

            $intTotalData = $baseQuery->count();

            $modelQuery = clone $baseQuery;

            if (!empty($request->search['value'])) {
                $strSearch = $request->search['value'];

                $modelQuery->where(function ($query) use ($strSearch) {
                    $query->where('ticket_no', 'LIKE', "%{$strSearch}%")
                        ->orWhere('supplier_id', 'LIKE', "%{$strSearch}%")
                        ->orWhere('vehicle', 'LIKE', "%{$strSearch}%")
                        ->orWhere('weight', 'LIKE', "%{$strSearch}%");
                });
            }

            $intTotalFiltered = $modelQuery->count();

            // Retrieve the actual records with pagination
            $objects = $modelQuery->orderBy($sortColumn, $dir)
                ->skip($start)
                ->take($length)
                ->get();

            // Prepare the data for the response
            $data = [];
            $count = $start + 1;

            foreach ($objects as $transaction) {
                $data[] = [
                    'sr.no' => $count,
                    'ticket_no' => $transaction->ticket_no ?? 'N/A',
                    'trx_date' => $transaction->trx_date ?? 'N/A',
                    'supplier_id' => $transaction->supplier->supplier_id . ' ' . $transaction->supplier->supplier_name ?? 'N/A',
                    'vehicle_id' => $transaction->vehicle->name ?? 'N/A',
                    'mill_id' => $transaction->mill->name ?? 'N/A',
                    'weight' => $transaction->weight ?? 'N/A',
                    'actions' => '
                    <div class="dropdown d-inline-block">
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                           <li>
                        <a class="dropdown-item edit-item-btn" href="javascript:void(0);"
                                            data-id="' . base64_encode(base64_encode($transaction->id)) . '"
                                            id="edit-transactionhq-btn">
                                            <i class="ri-pencil-fill align-bottom me-2 text-muted"></i>
                                            Edit
                                        </a>
                                    </li>
                            <li>
                            <li>
                                <a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route('admin.suppliers.destroy', [base64_encode(base64_encode($transaction->id))]) . '" class="dropdown-item remove-item-btn">
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

        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred while fetching records.',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function generateTrxNumber(Request $request)
    {
        $yearMonth = session('yearMonth') ?? date('Ym');
        $prefix = 'T' . substr($yearMonth, 2);

        $lastTrx = DB::table('transactions')
            ->where('trx_no', 'like', $prefix . '%')
            ->orderBy('trx_no', 'desc')
            ->value('trx_no');

        if ($lastTrx) {
            $lastSeq = (int) substr($lastTrx, -4);
            $nextSeq = str_pad($lastSeq + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $nextSeq = '0001';
        }

        $nextTrx = $prefix . $nextSeq;

        return response()->json(['trx_no' => $nextTrx]);
    }
    public function generateTicketNumber()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->hasRole('hq')) {

            $prefix = 'T';

            // dd($prefix);

            $lastTicketNo = DB::table('transactions')
                ->where('ticket_no', 'like', $prefix . '%')
                ->orderBy('id', 'desc')
                ->value('ticket_no');

            if ($lastTicketNo) {
                $lastSeq = (int) substr($lastTicketNo, 1);
                $nextSeq = str_pad($lastSeq + 1, 5, '0', STR_PAD_LEFT);
            } else {
                $nextSeq = '00001';
            }

            $nextTicketNo = $prefix . $nextSeq;

        } else {
            $lastTicketNo = DB::table('transactions')
                ->where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->value('ticket_no');

            if ($lastTicketNo) {
                $nextSeq = str_pad((int) $lastTicketNo + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $nextSeq = '000001';
            }

            $nextTicketNo = $nextSeq;
        }
        return response()->json(['ticket_no' => $nextTicketNo]);
    }

   
}
