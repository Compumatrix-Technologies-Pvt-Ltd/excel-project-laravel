<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactUsController extends Controller
{
    //
    public function __construct(ContactUs $contactUsModel)
    {

        $this->BaseModel = $contactUsModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.faq.';
    }

    public function index()
    {
        $this->ModuleTitle = __('Contact Us Listing');
        $this->ViewData['modulePath'] = $this->ModulePath;
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ];

            $messages = [
                'name.required' => 'Name is required.',
                'email.required' => 'Email is required.',
            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            // Create new contact record
            $contact = new $this->BaseModel;
            $this->_storeOrUpdate($contact, $request);

            return response()->json([
                'status' => 'success',
                'message' => 'Contact submitted successfully.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    public function _storeOrUpdate($millData, $request)
    {
        $millData->name = $request->name;
        $millData->email = $request->email;
        $millData->subject = $request->subject;
        $millData->message = $request->message;
        $millData->save();
        return $millData;
    }
    //Contact us listing ajax function
    public function getRecords(Request $request)
    {
        $column = $request->order[0]['column'];
        $dir = $request->order[0]['dir'];
        $filter = array(
            0 => 'id',
            1 => 'name',
        );
        $modelQuery = $this->BaseModel;
        $countQuery = clone ($modelQuery);
        $intTotalData = $countQuery->count();
        if (!empty($request->search)) {
            if (!empty($request->search['value'])) {
                $strSearch = $request->search['value'];
                $modelQuery = $modelQuery->where(function ($query) use ($strSearch) {
                    $query->orWhere('person_name', 'LIKE', "%" . $strSearch . "%");
                    $query->orWhere('person_email', 'LIKE', "%" . $strSearch . "%");
                    $query->orWhere('subject', 'LIKE', "%" . $strSearch . "%");
                    $query->orWhere('message', 'LIKE', "%" . $strSearch . "%");
                });
            }
        }
        $strFilteredQuery = clone ($modelQuery);
        $intTotalFiltered = $strFilteredQuery->count();
        $object = $modelQuery->orderBy('created_at', 'Desc')
            ->skip($request->start)
            ->take($request->length)
            ->get();
        $data = [];
        if (!empty($object) && sizeof($object) > 0) {
            $count = $request->start + 1;
            foreach ($object as $key => $row) {
                if ($row->created_at > Carbon::now()->subDays(2) && $row->is_read == 'no') {
                    $strBadge = '<br><span class="badge border border-success text-success" id="badge' . $row->id . '"> ' . __('New') . '</span>';
                } else {
                    $strBadge = "";
                }
                $data[$key]['id'] = $count++;
                $data[$key]['name'] = isset($row->name) ? ucfirst($row->name) . $strBadge : 'N/A';
                $data[$key]['email'] = isset($row->email) ? $row->email : 'N/A';
                if ($row->is_read == 'yes') {
                    $data[$key]['status'] = '<div class="badge border border-success text-success readLabel" id="read' . $row->id . '">' . mb_strimwidth(__('Read'), 0, 7, '...') . '</div>';

                } else {
                    $data[$key]['status'] = '<div class="badge border badge-danger text-danger readLabel" id="read' . $row->id . '">' . mb_strimwidth(__('Unread'), 0, 7, '...') . '</div>';
                }
                $btnView = "";
                $btnDelete = "";

                $btnView = '<a href="javascript:void(0)"  data-id="' . base64_encode(base64_encode($row->id)) . '" class="contact-view-btn btn btn-icon btn-light btn-hover-warning btn-sm mr-2" title="' . __('View') . '">
                    <i class="mdi mdi-eye text-primary mdi-24px"></i></a>';
                $btnDelete = '<a href="javascript:void(0)" onclick="return deleteCollection(this)" data-href="' . route('admin.contact-us.destroy', [base64_encode(base64_encode($row->id))]) . '" class="delete-user action-icon btn btn-icon btn-light btn-sm" title="' . __('Delete') . '" >
                    <i class="mdi mdi-delete-alert-outline mdi-24px text-danger"></i>
                    </a>';
                $data[$key]['actions'] = '<div class="text-center">' . $btnView . ' ' . $btnDelete . '</div>';

            }
        }
        $this->JsonData['draw'] = intval($request->draw);
        $this->JsonData['recordsTotal'] = intval($intTotalData);
        $this->JsonData['recordsFiltered'] = intval($intTotalFiltered);
        $this->JsonData['data'] = $data;

        return response()->json($this->JsonData);
    }


}
