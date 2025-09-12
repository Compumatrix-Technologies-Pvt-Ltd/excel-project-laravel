<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\DeductionController;
use App\Http\Controllers\Admin\MillController;
use App\Http\Controllers\Admin\SubSubCategoriesController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\VehicleController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\AlreadyLoggedIn;
use App\Http\Middleware\Admin\AdminMiddleware;

use App\Exports\RentSellBuyExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\HomeController;

#Admin Auth Controllers
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CommonController;
use App\Http\Controllers\Admin\MasterController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\RolesController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Admin Routes

Route::get('/', [HomeController::class, 'home'])->name('/');
Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy.policy');
Route::get('terms-conditions', [HomeController::class, 'termsConditions'])->name('terms.conditions');



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::get('/register', [LoginController::class, 'register'])->name('register')->middleware('guest');
Route::get('/register2', [LoginController::class, 'register2'])->name('register2')->middleware('guest');
Route::get('/email-verification/{id}', [LoginController::class, 'emailVerification'])->name('email.verification')->middleware('guest');
Route::get('/verification-success', [LoginController::class, 'verificationSuccess'])->name('verification.success')->middleware('guest');
Route::post('/set-year-month', [LoginController::class, 'store'])->name('set.year.month');
Route::post('/verify-email', [LoginController::class, 'registerSubmit'])->name('verify.email');
Route::post('/verify-otp/{id}', [LoginController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resend-otp/{id}', [LoginController::class, 'resendOtp'])->name('resend.otp');


Route::post('admin/checkLogin', [LoginController::class, 'checkLogin'])->name('admin.checkLogin');
Route::post('/admin/password/email', [ForgotPasswordController::class, 'forgotPasswordSubmit'])->name('admin.auth.password.submit');
Route::get('/admin/password/reset', [ForgotPasswordController::class, 'show'])->name('admin.auth.password.reset')->middleware('guest');
Route::get('/admin/password-reset/{id?}', [ForgotPasswordController::class, 'showChangePassword'])->name('admin.forgot.password')->middleware('guest');
Route::post('/admin/password-reset/{id}', [ForgotPasswordController::class, 'resetPasswordSubmit'])->name('forgot.password.reset');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::middleware([AdminMiddleware::class])->prefix('admin')->as('admin.')->group(function () {

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('plans', [AdminUserController::class, 'plansIndex'])->name('plans');
    Route::get('plans/users', [AdminUserController::class, 'planUsersIndex'])->name('plans.users');

    Route::resource('users', AdminUserController::class)->names('users');
    Route::put('users/update', [AdminUserController::class, 'update'])->name('user.update');


    # Manage Roles
    Route::get('roles/getRecords', [RolesController::class, 'getRecords']);
    Route::put('roles-update', [RolesController::class, 'updateRole'])->name('roles.updateRole');
    Route::resource('roles', RolesController::class);


    // Mill Routes
    Route::get('mill-management', [MillController::class, 'index'])->name('mill.management');
    Route::post('mill/store', [MillController::class, 'store'])->name('mill.store');
    Route::get('mill/edit/{id}', [MillController::class, 'edit'])->name('mill.edit');
    Route::put('mill/update', [MillController::class, 'update'])->name('mill.update');
    Route::delete('mill/destroy/{id}', [MillController::class, 'destroy'])->name('mill.destroy');


    // Branch Routes
    Route::put('update-branch', [BranchController::class, 'update'])->name('update-branch');
    Route::resource('branch', BranchController::class);


    // Bank Routes
    Route::get('banks', [BankController::class, 'index'])->name('banks.index');
    Route::post('banks/store', [BankController::class, 'store'])->name('banks.store');
    Route::get('banks/edit/{id}', [BankController::class, 'edit'])->name('banks.edit');
    Route::put('banks/update', [BankController::class, 'update'])->name('banks.update');
    Route::delete('banks/destroy/{id}', [BankController::class, 'destroy'])->name('banks.destroy');


    Route::post('transaction-data-entry-form', [MasterController::class, 'index'])->name('transaction.data.entry.form');


    // Suppliers Route
    Route::get('suppliers/getRecords', [SupplierController::class, 'getRecords'])->name('suppliers.getRecords');

    Route::resource('suppliers', SupplierController::class)->names('suppliers');
    Route::post('suppliers/import', [SupplierController::class, 'importSuppliers'])->name('suppliers.import');
    Route::post('suppliers/export', [SupplierController::class, 'exportSuppliers'])->name('suppliers.export');

    Route::get('suppliers-gps-list', [AdminUserController::class, 'suppliersGpsList'])->name('suppliersGps.index');

    // Deduction Routes
    Route::get('deductions/getRecords', [DeductionController::class, 'getRecords'])->name('deductions.getRecords');
    Route::get('deduction-reports/getRcords', [DeductionController::class, 'deductionReporGetRecords'])->name('deductions.report.getRecords');
   
    Route::get('deduction-reports', [DeductionController::class, 'deductionReportIndex'])->name('deductions.report.index');

    Route::resource('deductions', DeductionController::class)->names('deductions');

    // Vehicle Management
    Route::resource('vehicles', VehicleController::class)->names('vehicles');
    Route::put('vehicles/update', [VehicleController::class, 'update'])->name('vehicle.update');

    // Transaction Management
    Route::get('transaction-management', [TransactionController::class, 'hqTransactionIndex'])->name('transaction.management');
    Route::get('transactions/getRecords/hq', [TransactionController::class, 'getRecordsHq'])->name('transactions.getRecordsHq');
    Route::get('transactions/getRecords', [TransactionController::class, 'getRecords'])->name('transactions.getRecords');

    // Generate TRX and Ticket number
    Route::get('generate-trx-number', [TransactionController::class, 'generateTrxNumber'])->name('generate.trx.number');
    Route::get('generate-ticket-number', [TransactionController::class, 'generateTicketNumber'])->name('generate.ticket.number');


    Route::resource('transactions', TransactionController::class)->names('transactions');
    Route::put('transactions/update', [TransactionController::class, 'update'])->name('transaction.update');
    Route::put('transactions/hq/update', [TransactionController::class, 'update'])->name('transactionshq.update');



    // HQ- Suppliers
    Route::get('suppliers-hq', [AdminUserController::class, 'suppliersHqIndex'])->name('suppliersHq.index');


    // Supplies
    Route::get('supplies-details', [AdminUserController::class, 'suppliesDetails'])->name('supplies.details.index');
    Route::get('supplies-summary', [AdminUserController::class, 'suppliesSummary'])->name('supplies.summary.index');
    Route::get('supplies-analysis', [AdminUserController::class, 'suppliesAnalysis'])->name('supplies.analysis.index');


    Route::get('credit-purchases', [AdminUserController::class, 'creditPurchaseIndex'])->name('creditPurchase.index');
    Route::get('credit-purchase-analysis', [AdminUserController::class, 'creditPurchaseAnalysisIndex'])->name('creditPurchaseAnalysis.index');
    Route::get('purchase-analysis', [AdminUserController::class, 'purchaseAnalysisIndex'])->name('purchaseAnalysis.index');

    Route::get('payments', [CommonController::class, 'paymentIndex'])->name('payments.index');
    Route::get('cash-purchase-pdf', [CommonController::class, 'cashPurchasePdf'])->name('cash.purchase.pdf');
    Route::get('cash-purchase-list', [CommonController::class, 'cashPurchaseList'])->name('cash.purchase.list');
    Route::get('cash-purchase-summary', [CommonController::class, 'cashPurchaseSummary'])->name('cash.purchase.summary');
    Route::get('daily-cash-purchase-summary', [CommonController::class, 'dailyCashPurchaseSummary'])->name('daily.cash.purchase.summary');
    Route::get('sales-invoice', [CommonController::class, 'salesInvoice'])->name('sales.invoice');
    Route::get('supplier-cash-bill', [CommonController::class, 'supplierCashBill'])->name('supplier.cash.bill');

    Route::get('subscription-&-billing', [CommonController::class, 'subscriptionAndBilling'])->name('subscription.and.billing');
    Route::get('usages-&-feature-flags', [CommonController::class, 'usagesAndFeatureFlags'])->name('usages.and.feature.flags');
    Route::get('emails-sms', [CommonController::class, 'emailsAndSms'])->name('emails.and.sms');
    Route::get('emails-sms-edit/{id}', [CommonController::class, 'emailsAndSmsEdit'])->name('emails.and.sms.edit');
    Route::get('cms-pages', [CommonController::class, 'cmsPages'])->name('cms.pages');
    Route::get('cms-pages-edit/{id}', [CommonController::class, 'cmsPagesEdit'])->name('cms.pages.edit');
    Route::get('audit-logs', [CommonController::class, 'auditLogs'])->name('audit.logs.index');
    Route::get('impersonation-console', [CommonController::class, 'impersonationConsole'])->name('impersonation.console.index');
    Route::get('security-settings', [CommonController::class, 'securitySettings'])->name('security.settings.index');


    // Consolidated FFB Routes(HQ)
    Route::get('yearly-cash-credit', [AdminUserController::class, 'YearlyCashCredit'])->name('YearlyCashCredit.index');
    Route::get('credit/purchase', [AdminUserController::class, 'creditPurchase'])->name('credit.purchase.index');
    Route::get('cash/purchase', [AdminUserController::class, 'cashPurchase'])->name('cash.purchase.index');
    Route::get('purchase-salse', [AdminUserController::class, 'purchaseSalse'])->name('purchaseSalse.index');

    // Master Module route branch

    Route::get('main', [MasterController::class, 'mainForm'])->name('mainForm.index');


    // Master Module Route HQ
    Route::get('hq-main', [MasterController::class, 'HQmainForm'])->name('hqMainForm.index');
    Route::post('hq-main/getValues', [AdminUserController::class, 'getDropDownValues'])->name('hqMainForm.getValues');
    Route::post('hq-main/getAllDetails', [AdminUserController::class, 'getAllDetails'])->name('hqMainForm.getAllDetails');



    #Update Profile
    Route::get('update-profile', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/{encid}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/company/{encid}', [ProfileController::class, 'companyUpdate'])->name('company.update');
    Route::get('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::put('user-update-password/{encid}', [ProfileController::class, 'storeUpdatedPassword'])->name('storeUpdatePassword');


    Route::post('ffb_transaction', [MasterController::class, 'storeFFBTransaction'])->name('ffb.transaction.store');
    Route::get('get-supplier-details/{supplier_id}/{purchase_type}', [MasterController::class, 'getSupplierDetails'])->name('ffb.transaction.getSupplierDetails');
});