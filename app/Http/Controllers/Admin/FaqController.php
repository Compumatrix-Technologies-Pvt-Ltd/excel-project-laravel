<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{


    public function __construct(Faq $faqModel)
    {

        $this->BaseModel = $faqModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.faq.';
    }

    public function index()
    {
        $this->ViewData['moduleAction'] = "Faq Management";
        $this->ViewData['faqs'] = $this->BaseModel->all();
        return view('admin.faq.index', $this->ViewData);
    }

    public function store(Request $request)
    {
        try {
            $rules = [
                'question' => 'required',
                'answer' => 'required',
            ];

            $messages = [
                'question.required' => 'Question is is required.',
                'answer.required' => 'Answer is reqired',

            ];

            $validated = Validator::make($request->all(), $rules, $messages);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $response = Helper::storeRecord($this, $this->BaseModel, $request, 'admin.faq.index');
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An unexpected error occurred.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateFaq(Request $request)
    {
        // dd("here");
        // dd($request->all());
        $response = Helper::updateRecord($this, $this->BaseModel, $request, 'admin.faq.index', $request->id);
        return response()->json($response);
    }

    public function _storeOrUpdate($millData, $request)
    {
        $millData->question = $request->question;
        $millData->answer = $request->answer;
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
