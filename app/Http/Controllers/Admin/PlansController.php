<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Plans;
use App\Models\PlanFeatures;
use App\Models\Subscription;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{
    protected $BaseModel;
    protected $ViewData;
    protected $JsonData;
    protected $ModulView;

    public function __construct(Plans $plansModel)
    {
        $this->BaseModel = $plansModel;
        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModulView = 'admin.subscriptions.';
    }

    /**
     * Display all plans
     */
    public function index()
    {
        $this->ViewData['plans'] = $this->BaseModel::with('features')->get();
        $this->ModuleTitle = __('Plans');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModulView . 'plans', $this->ViewData);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        try {
            $validated = Validator::make($request->all(), [
                'plan_name' => 'required|string|max:255',
                'plan_sub_title' => 'required|string|max:255',
                'plan_price' => 'required',
                'status' => 'required|in:active,inactive',
                'features' => 'required|array|min:1',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $plan = new Plans();
            $this->_storeOrUpdate($plan, $request);

            return response()->json([
                'status' => 'success',
                'message' => 'Plan created successfully.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update existing plan
     */
    public function update(Request $request)
    {
        try {
            $validated = Validator::make($request->all(), [
                'plan_name' => 'required|string|max:255',
                'plan_sub_title' => 'required|string|max:255',
                'plan_price' => 'required|numeric',
                'status' => 'required|in:active,inactive',
                'features' => 'required|array|min:1',
            ]);

            if ($validated->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validated->errors(),
                    'message' => 'Validation failed.',
                ], 422);
            }

            $decodedId = base64_decode(base64_decode($request->id));
            $plan = Plans::findOrFail($decodedId);
            $this->_storeOrUpdate($plan, $request);

            return response()->json([
                'status' => 'success',
                'url' => route('admin.plans'),
                'msg' => 'Data has been saved successfully.',
            ]);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Store or Update shared logic
     */
    public function _storeOrUpdate($planData, $request)
    {
        DB::beginTransaction();
        try {
            $planData->plan_name = $request->plan_name;
            $planData->plan_sub_title = $request->plan_sub_title;
            $planData->plan_price = $request->plan_price;
            $planData->plan_duration = $request->plan_duration;
            $planData->status = $request->status;
            $planData->save();

            PlanFeatures::where('plan_id', $planData->id)->delete();

            if (is_array($request->features) && count($request->features) > 0) {
                foreach ($request->features as $feature) {
                    if (!empty($feature)) {
                        PlanFeatures::create([
                            'plan_id' => $planData->id,
                            'features' => $feature,
                        ]);
                    }
                }
            }

            DB::commit();
            return $planData;

        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Edit plan (for modal)
     */
    /**
     * Fetch plan details for edit modal (AJAX)
     */

    // public function edit($encID)
    // {
    //     try {
    //         $intID = base64_decode(base64_decode($encID));
    //         $plan = $this->BaseModel::with('features')->find($intID);

    //         if (!$plan) {
    //             return response()->json([
    //                 'status' => 'error',
    //                 'message' => 'Plan not found.',
    //             ], 404);
    //         }

    //         // Transform feature collection into array for JS population
    //         $features = $plan->features->pluck('feature')->toArray();

    //         $this->JsonData['status'] = 'success';
    //         $this->JsonData['data'] = [
    //             'id' => $plan->id,
    //             'plan_name' => $plan->plan_name,
    //             'plan_sub_title' => $plan->plan_sub_title,
    //             'plan_price' => $plan->plan_price,
    //             'status' => $plan->status,
    //             'features' => $features,
    //         ];

    //         return response()->json($this->JsonData);

    //     } catch (Exception $e) {
    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Failed to fetch plan details.',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }


    public function edit($id)
    {
        try {
            $decodedId = base64_decode(base64_decode($id));

            $plan = Plans::with('features')->find($decodedId);

            if (!$plan) {
                return response()->json(['status' => 'error', 'message' => 'Plan not found']);
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $plan->id,
                    'plan_name' => $plan->plan_name,
                    'sub_title' => $plan->plan_sub_title,
                    'price' => $plan->plan_price,
                    'plan_duration' => $plan->plan_duration,
                    'status' => $plan->status,
                    'features' => $plan->features->pluck('features')->toArray(), // ✅ fixed
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }





    /**
     * Delete plan and its features
     */
    public function destroy($encID)
    {
        try {
            $response = Helper::destroyRecord($this->BaseModel, $encID);
            return response()->json($response);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete plan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function subscriptionsStore(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $user = auth()->user();
        $plan = Plans::findOrFail($request->plan_id);

        // Calculate subscription dates
        $startDate = now();
        switch ($plan->plan_duration) {
            case '3-month':
                $endDate = $startDate->copy()->addMonths(3);
                break;
            case '6-month':
                $endDate = $startDate->copy()->addMonths(6);
                break;
            case 'year':
                $endDate = $startDate->copy()->addYear();
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid plan duration.']);
        }

        // Create subscription
        Subscription::create([
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'subscription_start_date' => $startDate->toDateString(),
            'subscription_exp_date' => $endDate->toDateString(),
            'paid_amount' => $plan->plan_price,
            'subscription_status' => 'active',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Plan purchased successfully!',
        ]);
    }

}
