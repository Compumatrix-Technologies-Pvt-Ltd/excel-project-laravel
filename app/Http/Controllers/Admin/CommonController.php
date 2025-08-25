<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//models
use App\Models\User;
use App\Models\ProductsOrderModel;
use App\Models\ProductsModel;
use App\Models\ClientCompaniesModel;

//requests
use DB;
use Carbon\Carbon;
use Auth;

class CommonController extends Controller
{
    private $BaseModel;
    private $ViewData;
    private $JsonData;
    private $ModuleTitle;
    private $ModuleView;
    private $ModulePath;


    public function __construct(
        User $UserModel,

    ) {
        // $this->middleware('auth');
        $this->BaseModel = $UserModel;

        $this->ViewData = [];
        $this->JsonData = [];

        $this->ModuleView  = 'admin.';
        $this->ModulePath = 'admin.';

    }
    
    public function suppliers(Request $request)
    {
        $this->ViewData['moduleAction'] = "Suppliers";
        return view('admin.suppliers', $this->ViewData);
    }
    public function paymentIndex(Request $request)
    {
        $this->ViewData['moduleAction'] = "Payments";
        return view('admin.payments.index', $this->ViewData);
    }
    public function cashPurchaseList(Request $request)
    {
        $this->ViewData['moduleAction'] = "Cash Purchases";
        return view('admin.cash-purchase.cash-purchase-index', $this->ViewData);
    }
    public function cashPurchaseSummary(Request $request)
    {
        $this->ViewData['moduleAction'] = "Cash Summary";
        return view('admin.cash-purchase.cash-purchase-summary', $this->ViewData);
    }
    public function dailyCashPurchaseSummary(Request $request)
    {
        $this->ViewData['moduleAction'] = "Daily Cash Purchase Summary";
        return view('admin.cash-purchase.daily-cash-purchase-summary', $this->ViewData);
    }
   
    
    
}