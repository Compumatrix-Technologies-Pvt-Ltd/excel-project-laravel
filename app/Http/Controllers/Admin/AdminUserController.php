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

    public function suppliersIndex(){
         $this->ModuleTitle = __('Suppliers Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.index', $this->ViewData);
    }

    public function suppliersCreate(){
         $this->ModuleTitle = __('Create Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.create', $this->ViewData);
    }
    public function suppliersedit(){
         $this->ModuleTitle = __('Edit Supplier');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.suppliers.edit', $this->ViewData);
    }
    
    public function transactionIndex(){
         $this->ModuleTitle = __('Transactions');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.daily-transactions.index', $this->ViewData);
    }

    public function bankIndex(){
         $this->ModuleTitle = __('Bank Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.banks.index', $this->ViewData);
    }
    public function deductionIndex(){
         $this->ModuleTitle = __('Deduction Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.banks.deduction-index', $this->ViewData);
    }
    public function deductionReportIndex(){
         $this->ModuleTitle = __('Deduction Reports');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.banks.deduction-reports', $this->ViewData);
    }
    public function creditPurchaseIndex(){
         $this->ModuleTitle = __('Credit Purches Listing');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view('admin.banks.credit-purchase', $this->ViewData);
    }
}
