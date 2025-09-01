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
    public function millManagement(Request $request)
    {
        $this->ViewData['moduleAction'] = "Mill Management";
        return view('admin.mill.index', $this->ViewData);
    }
    public function hqTransactionIndex(Request $request)
    {
        $this->ViewData['moduleAction'] = "HQ Transactions";
        return view('admin.daily-transactions.hq-index', $this->ViewData);
    }
    public function salesInvoice(Request $request)
    {
        $this->ViewData['moduleAction'] = "Sales Invoice";
        return view('admin.sales-invoice.sales-invoice', $this->ViewData);
    }
    public function supplierCashBill(Request $request)
    {
        $this->ViewData['moduleAction'] = "Supplier Cash Bill";
        return view('admin.supplier-cash-bill.supplier-cash-bill', $this->ViewData);
    }
    public function subscriptionAndBilling(Request $request)
    {
        $this->ViewData['moduleAction'] = "Subscription & Billing";
        return view('admin.subscription-and-billing.subscription-and-billing', $this->ViewData);
    }
    public function usagesAndFeatureFlags(Request $request)
    {
        $this->ViewData['moduleAction'] = "Usages & Feature Flags";
        return view('admin.usages-and-feature-flags.usages-and-feature-flags', $this->ViewData);
    }
   
    
    
}