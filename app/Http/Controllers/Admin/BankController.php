<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FFBTransactionsModel;

class BankController extends Controller
{

    public function __construct(Bank $bankModel)
    {
        $this->BaseModel = $bankModel;
        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.banks.';
    }



    public function index(Request $request)
    {
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId));
        $this->ViewData['moduleAction'] = 'Bank Listing';
        $this->ViewData['banks'] = $this->BaseModel->where('user_id', $userId)->get();
        return view('admin.banks.index', $this->ViewData);
    }
    public function ViaBank(Request $request)
    {
        $this->ModuleTitle = __('Via Bank Listing');
        $encodedId = $request->query('encodedId');
        $userId = Helper::decodeUserId($encodedId) ?? auth()->id();
        $this->ViewData['userId'] = base64_encode(base64_encode($userId));
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['banks'] = $this->BaseModel->where('user_id', $userId)->get();
        return view('admin.via_bank.index', $this->ViewData);
    }

    public function store(Request $request)
    {
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

    public function update(Request $request)
    {
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.banks.index', $request->id);
        if (!empty($request->hidden_user_id)) {
            $response['url'] .= '?encodedId=' . urlencode($request->hidden_user_id);
        }
        return response()->json($response);
    }

    public function _storeOrUpdate($bankData, $request)
    {
        $bankData->user_id =  $request->hidden_user_id ? base64_decode(base64_decode($request->hidden_user_id)) : auth()->user()->id;
        $bankData->bank_id = $request->bank_id;
        $bankData->name = $request->name;
        $bankData->bic_code = $request->bic_code;
        $bankData->pay_type = $request->pay_type;
        $bankData->save();
        return $bankData;
    }

    public function edit($encID)
    {
        $intID = base64_decode(base64_decode($encID));
        $data = $this->BaseModel->find($intID);
        $this->JsonData['status'] = __('success');
        $this->JsonData['data'] = $data;
        return response()->json($this->JsonData);
    }

    public function destroy($encID)
    {
        $response = Helper::destroyRecord($this->BaseModel, $encID);
        return response()->json($response);

    }


    public function viaBankDeductionGetRecords(Request $request)
    {
        try {
            $period = Helper::getPeriod(); // current period helper
            $query = FFBTransactionsModel::with('supplier')
                //->where('pay_by', 'bank')
                ->where('period', $period);

            if ($request->hidden_user_id) {
                $decodedUserId = base64_decode(base64_decode($request->hidden_user_id));
                dd($decodedUserId);
                $query->where('user_id', $decodedUserId);
            } else {
                $query->where('user_id', auth()->id());
            }
            $totalData = $query->count();

            // ✅ Search
            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $query->where(function ($q) use ($search) {
                    $q->where('invoice_no', 'LIKE', "%{$search}%")
                        ->orWhere('bank_bic', 'LIKE', "%{$search}%")
                        ->orWhere('bene_name', 'LIKE', "%{$search}%")
                        ->orWhere('bene_id_no', 'LIKE', "%{$search}%")
                        ->orWhere('recipient_reference', 'LIKE', "%{$search}%");
                });
            }

            // ✅ Sorting and Pagination
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $records = $query
                ->offset($start)
                ->limit($length)
                ->orderBy('id', 'desc')
                ->get();
                dd($records);

            $data = [];
            $count = $start + 1;

            foreach ($records as $r) {
                $data[] = [
                    'checkbox' => '<div class="form-check"><input class="form-check-input fs-15" type="checkbox"></div>',
                    'sr_no' => $count++,
                    'payment_type' => $r->bank_name ?? 'N/A',
                    'bene_account_no' => $r->bank_account ?? 'N/A',
                    'bic' => $r->bank_bic ?? 'N/A',
                    'bene_full_name' => $r->bene_name ?? 'N/A',
                    'id_type' => $r->bene_id_type ?? '-',
                    'bene_id_no' => $r->bene_id_no ?? '-',
                    'amount' => number_format($r->net_pay, 2),
                    'recipient_reference' => $r->recipient_reference ?? '-',
                    'bene_email1' => $r->bene_email_1 ?? '-',
                    'bene_email2' => $r->bene_email_2 ?? '-',
                    'bene_mobile1' => $r->bene_mobile_1 ?? '-',
                    'bene_mobile2' => $r->bene_mobile_2 ?? '-',
                    'joint_bene_name' => $r->joint_bene_name ?? '-',
                    'joint_bene_id' => $r->joint_bene_id ?? '-',
                    'email_line1' => $r->email_line_1 ?? '-',
                    'email_line2' => $r->email_line_2 ?? '-',
                    'email_line3' => $r->email_line_3 ?? '-',
                    'email_line4' => $r->email_line_4 ?? '-',
                    'email_line5' => $r->email_line_5 ?? '-',
                    'action' => '
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#paymentModal">
                            <i class="ri-eye-line align-middle"></i>
                        </button>'
                ];
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalData,
                'data' => $data,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
