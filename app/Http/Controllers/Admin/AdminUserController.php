<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->ViewData = [];
        $this->ModuleView = 'admin.users.';
    }
    public function index()
    {

        $this->ModuleTitle = __('User Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'index', $this->ViewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->ModuleTitle = __('Create Users');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'create', $this->ViewData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function branchIndex(){
         $this->ModuleTitle = __('Branch Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'branch-index', $this->ViewData);
    }

    // public function suppliersIndex(){
    //     $this->ModuleTitle = __('Suppliers Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.suppliers.index', $this->ViewData);
    // }

    // public function suppliersCreate(){
    //      $this->ModuleTitle = __('Create Supplier');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.suppliers.create', $this->ViewData);
    // }
    public function suppliersedit(){
         $this->ModuleTitle = __('Edit Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.edit', $this->ViewData);
    }
    
    public function suppliersGpsList(){
         $this->ModuleTitle = __('Supplier GPS Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.suppliers-gps-list', $this->ViewData);
    }
    
    public function suppliersHqIndex(){
         $this->ModuleTitle = __('Supplier Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.suppliers-hq', $this->ViewData);
    }
    
    // public function transactionIndex(){
    //      $this->ModuleTitle = __('Transactions');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.daily-transactions.index', $this->ViewData);
    // }

    // public function bankIndex(){
    //      $this->ModuleTitle = __('Bank Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.banks.index', $this->ViewData);
    // }
    // public function deductionIndex(){
    //      $this->ModuleTitle = __('Deduction Listing');
    //     $this->ViewData['moduleAction'] = $this->ModuleTitle;
    //     return view('admin.deductions.deduction-index', $this->ViewData);
    // }
    public function deductionReportIndex(){
         $this->ModuleTitle = __('Deduction Reports');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.deductions.deduction-reports', $this->ViewData);
    }
    public function creditPurchaseIndex(){
         $this->ModuleTitle = __('Credit Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.credit-purchases.credit-purchase', $this->ViewData);
    }

    public function creditPurchaseAnalysisIndex(){
         $this->ModuleTitle = __('Credit Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.credit-purchase-analysis', $this->ViewData);
    }

    public function purchaseAnalysisIndex(){
         $this->ModuleTitle = __('Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.purchase-analysis', $this->ViewData);
    }

    public function suppliesDetails(){
         $this->ModuleTitle = __('Supplies Details');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.supplies.supplies-details', $this->ViewData);
    }
    public function suppliesSummary(){
         $this->ModuleTitle = __('Supplies Summary');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.supplies.supplies-summary', $this->ViewData);
    }
    public function suppliesAnalysis(){
         $this->ModuleTitle = __('Supplies Analysis');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.analysis.supplies-analysis', $this->ViewData);
    }
    public function plansIndex(){
         $this->ModuleTitle = __('Plans');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.subscriptions.plans', $this->ViewData);
    }
    public function planUsersIndex(){
         $this->ModuleTitle = __('Users');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.subscriptions.users', $this->ViewData);
    }

    public function YearlyCashCredit(){
         $this->ModuleTitle = __('Yearly Cash Vs Credit');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.yearly-cash-credit', $this->ViewData);
    }
    public function creditPurchase(){
         $this->ModuleTitle = __('Credit Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.credit-purchase', $this->ViewData);
    }
    public function cashPurchase(){
         $this->ModuleTitle = __('Cash Purchase');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.cash-purchase', $this->ViewData);
    }
    public function purchaseSalse(){
         $this->ModuleTitle = __('Purchase & Salse');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.consolidated-ffb.purchase-salse', $this->ViewData);
    }
    public function mainForm(){
         $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.masters.masterForm', $this->ViewData);
    }
    public function HQmainForm(){
         $this->ModuleTitle = __('Main');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.masters.hq-masterForm', $this->ViewData);
    }
}
