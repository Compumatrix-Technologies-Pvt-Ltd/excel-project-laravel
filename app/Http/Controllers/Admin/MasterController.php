<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Mill;
use Exception;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Suppliers;
use Log;

class MasterController extends Controller
{

    public function __construct(Mill $millModel)
    {

        $this->BaseModel = $millModel;

        $this->ViewData = [];
        $this->JsonData = [];
        $this->ModuleView = 'admin.master.';
    }

    public function mainForm(Request $request)
    {
        $purchaseType = $request->input('purchaseType', 'credit'); // default to credit purchase

        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;

        // Filter suppliers by supplier_type matching purchaseType value
        $this->ViewData['suppliers'] = Suppliers::where([
            'supplier_type' => $purchaseType, 
            'user_id' => auth()->id()
        ])->get();

        $this->ViewData['suppliers_credit'] = Suppliers::where('supplier_type', 'credit')->get();
        $this->ViewData['suppliers_cash'] = Suppliers::where('supplier_type', 'cash')->get();


        return view('admin.masters.masterForm', $this->ViewData);
    }

    public function HQmainForm()
    {
        $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.masters.hq-masterForm', $this->ViewData);
    }

}
