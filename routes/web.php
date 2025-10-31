<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AnalysisController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\ConsolidatedFFBController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DeductionController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\MillController;
use App\Http\Controllers\Admin\PlansController;
use App\Http\Controllers\Admin\StaticPageController;
use App\Http\Controllers\Admin\SubSubCategoriesController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\SuppliesController;
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
use App\Http\Controllers\Admin\PurchaseInvoiceController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\CashBillController;
use App\Http\Controllers\Admin\PurchaseAnalysisController;



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


// Contact Us


Route::post('contacts/store', [ContactUsController::class, 'store'])->name('contacts.store');

Route::middleware([AdminMiddleware::class])->prefix('admin')->as('admin.')->group(function () {

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('plans/users', action: [AdminUserController::class, 'planUsersIndex'])->name('plans.users');
    Route::get('company/details/{id}', action: [AdminUserController::class, 'getCompanyDetails'])
        ->name('company.details');

    // Plans 
    Route::get('plans', [PlansController::class, 'index'])->name('plans');
    Route::post('plans/store', [PlansController::class, 'store'])->name('plans.store');
    Route::get('plans/edit/{id}', [PlansController::class, 'edit'])->name('plans.edit');
    Route::put('plans/update', [PlansController::class, 'update'])->name('plans.update');
    Route::delete('plans/delete/{id}', [PlansController::class, 'destroy'])->name('plans.delete');

    // FAQ
    Route::resource('faq', FaqController::class)->names('faq');
    Route::put('faqs/update', [FaqController::class, 'updateFaq'])->name('faq.updateFaq');

    Route::get('contacts/getRecords', [ContactUsController::class, 'getRecords'])->name('contact-us-listing.getRecords');
    Route::get('view-contact-us-message/{id}', [ContactUsController::class, 'viewContactUsMessage'])->name('contact-us.message');
    Route::get('contacts', [ContactUsController::class, 'index'])->name('contacts.index');

    Route::delete('contacts/delete/{id}', [ContactUsController::class, 'destroy'])->name('contact-us.destroy');


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
    Route::get('branch-users/{id}', [BranchController::class, 'branchUsers'])->name('branch-users');
    Route::get('branch-users-module/{id}', [BranchController::class, 'usersModule'])->name('branch-users.modules');
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

    // HQ- Suppliers
    Route::get('hq-suppliers', [SupplierController::class, 'hqSuppliers'])->name('hq-suppliers.index');
    Route::get('hq-suppliers/getRecords', [SupplierController::class, 'HQgetRecords']);
    Route::get('edit-hq-supplier/{id}', [SupplierController::class, 'editHqSupplier']);
    Route::put('hq-suppliers.update', [SupplierController::class, 'suppliersUpdate'])->name('hq-suppliers.update');
    Route::post('hq-suppliers/store', [SupplierController::class, 'hqSuppliersStore'])->name('hq-suppliers.store');



    Route::resource('suppliers', SupplierController::class)->names('suppliers');
    Route::post('suppliers/import', [SupplierController::class, 'importSuppliers'])->name('suppliers.import');
    Route::post('suppliers/export', [SupplierController::class, 'exportSuppliers'])->name('suppliers.export');
    Route::get('suppliers-gps-list', [SupplierController::class, 'suppliersGpsList'])->name('suppliersGps.index');
    Route::get('suppliers/gps/getRecords', [SupplierController::class, 'getSupplierGPSRecords']);
    Route::get('/suppliers/pdf/licence-expiry', [SupplierController::class, 'supplierLicenceExpiryPDF'])
        ->name('admin.suppliers.pdf.licenceExpiry');

    Route::get('/suppliers/pdf/gps-coordinates', [SupplierController::class, 'supplierGPSPDF'])
        ->name('admin.suppliers.pdf.gps');

    // Deduction Routes
    Route::get('deductions/getRecords', [DeductionController::class, 'getRecords'])->name('deductions.getRecords');
    Route::get('deduction-reports/getRcords', [DeductionController::class, 'deductionReportGetRecords'])->name('deductions.report.getRecords');

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






    // Supplies
    Route::get('supplies-details', [SuppliesController::class, 'suppliesDetails'])->name('supplies.details.index');
    Route::get('supplies-details/getRecords', [SuppliesController::class, 'getSuppliesRecords'])->name('supplies.details.getSuppliesRecords');
    Route::get('supplies-details/pdf', [SuppliesController::class, 'generateSuppliesPdf'])->name('supplies.details.generatePDF');
    Route::get('supplies-summary', [SuppliesController::class, 'suppliesSummary'])->name('supplies.summary.index');
    Route::get('supplies-summary/getRecords', [SuppliesController::class, 'suppliesSummaryGetRecords'])->name('supplies.summary.getRecords');
    Route::get('supplies-summary/pdf', [SuppliesController::class, 'generateSuppliesSummaryPdf'])->name('supplies.summary.generatePDF');

    // Ananlysis Module Routes

    Route::get('supplies-analysis', [AnalysisController::class, 'suppliesAnalysis'])->name('supplies.analysis.index');
    Route::get('supplies-analysis/getRecords', [AnalysisController::class, 'suppliesAnalysisGetRecords'])->name('supplies.analysis.getRecords');
    Route::get('supplies-analysis/pdf', [AnalysisController::class, 'generateSuppliesAnalysisPDF'])->name('supplies.analysis.generatePDF');


    Route::get('via-bank', [BankController::class, 'viaBank'])->name('via-bank.index');

    Route::get('via-bank-deductions/getRecords', [BankController::class, 'viaBankDeductionGetRecords'])
    ->name('admin.viaBankDeduction.getRecords');


    Route::get('cash-purchase-pdf', [CommonController::class, 'cashPurchasePdf'])->name('cash.purchase.pdf');

    Route::get('subscription-&-billing', [CommonController::class, 'subscriptionAndBilling'])->name('subscription.and.billing');
    Route::get('usages-&-feature-flags', [CommonController::class, 'usagesAndFeatureFlags'])->name('usages.and.feature.flags');
    Route::get('emails-sms', [CommonController::class, 'emailsAndSms'])->name('emails.and.sms');
    Route::get('emails-sms-edit/{id}', [CommonController::class, 'emailsAndSmsEdit'])->name('emails.and.sms.edit');
    // Route::get('cms-pages', [CommonController::class, 'cmsPages'])->name('cms.pages');
    // Route::get('cms-pages-edit/{id}', [CommonController::class, 'cmsPagesEdit'])->name('cms.pages.edit');
    Route::get('audit-logs', [CommonController::class, 'auditLogs'])->name('audit.logs.index');
    Route::get('impersonation-console', [CommonController::class, 'impersonationConsole'])->name('impersonation.console.index');
    Route::get('security-settings', [CommonController::class, 'securitySettings'])->name('security.settings.index');

    Route::get('cms-pages', [StaticPageController::class, 'cmsPages'])->name('cms.pages');
    Route::get('cms-pages-edit/{id}', [StaticPageController::class, 'cmsPagesEdit'])->name('cms.pages.edit');
    Route::put('cms-pages-update/{id}', [StaticPageController::class, 'updateCmsPage'])->name('cmsPage.update');

    // Consolidated FFB Routes(HQ)
    Route::get('yearly-cash-credit', [ConsolidatedFFBController::class, 'YearlyCashCredit'])->name('YearlyCashCredit.index');
    Route::get('yearly-cash-credit/getRecords', [ConsolidatedFFBController::class, 'getYearlyCashCreditRecords'])->name('YearlyCashCredit.getRecords');
    Route::get('consolidated/credit/purchase', [ConsolidatedFFBController::class, 'creditPurchase'])->name('credit.purchase.index');
    Route::get('consolidated/credit/purchase/getRecords', [ConsolidatedFFBController::class, 'getConsolidatedCreditPurchaseAnalysisRecords'])->name('credit.purchase.getRecords');
    Route::get('consolidated/cash/purchase', [ConsolidatedFFBController::class, 'cashPurchase'])->name('cash.purchase.index');
    Route::get('purchase-salse', [ConsolidatedFFBController::class, 'purchaseSalse'])->name('purchaseSalse.index');
    Route::get(
        'purchase-analysis/consolidated/pdf',
        [ConsolidatedFFBController::class, 'exportConsolidatedCreditPurchaseAnalysisPDF']
    )->name('admin.purchaseAnalysis.consolidated.pdf');



    // Master Module route branch

    Route::get('main/{id?}', [MasterController::class, 'mainForm'])->name('mainForm.index');
    Route::get('credit-purchases', [MasterController::class, 'creditPurchaseIndex'])->name('creditPurchase.index');
    Route::get('cash-purchase-list', [MasterController::class, 'cashPurchaseList'])->name('cash.purchase.list');
    Route::get('cash-purchase/getRecords', [MasterController::class, 'cashPurchaseGetRecords']);
    Route::get('cash-purchase-summary', [MasterController::class, 'cashPurchaseSummary'])->name('cash.purchase.summary');
    Route::get('cash-purchase-summary/getRecords', [MasterController::class, 'cashPurchaseSummaryGetRecords']);
    Route::get('daily-cash-purchase-summary', [MasterController::class, 'dailyCashPurchaseSummary'])->name('daily.cash.purchase.summary');
    Route::get('daily-cash-purchase-summary/getRecords', [MasterController::class, 'dailyCashPurchaseSummaryGetRecords']);


    Route::get('sales-invoice-view/{id}', [PurchaseInvoiceController::class, 'salesInvoice'])->name('sales-invoice.view');
    Route::get('sales-invoice', [PurchaseInvoiceController::class, 'salesInvoiceIndex'])->name('sales.invoice.index');
    Route::get('sales-invoices/getRecords', [PurchaseInvoiceController::class, 'salesInvoiceRecords']);
    Route::get('sales-invoice/{id}/preview', [PurchaseInvoiceController::class, 'preview'])->name('sales.invoice.preview');
    Route::get('sales-invoice/{id}/pdf', [PurchaseInvoiceController::class, 'createPdf'])->name('sales.invoice.pdf');



    Route::get('supplier-cash-bill-view/{id}', [CashBillController::class, 'supplierCashBillView'])->name('supplier.cash.bill.view');
    Route::get('scb', [CashBillController::class, 'supplierCashBill'])->name('supplier.cash.bill');
    Route::get('scb/getRecords', [CashBillController::class, 'supplierCashBillGetRecords'])->name('supplier.cash.bill.getRecords');
    Route::get('supplier/cash-bill/details/{invoice_no}', [CashBillController::class, 'getCashBillDetails'])->name('supplier.cash.bill.details');
    Route::get('cash-bill/{id}/preview', [CashBillController::class, 'preview'])->name('cash.bill.preview');
    Route::get('supplier/cash-bill/pdf/{invoice_no}', [CashBillController::class, 'generateCashBillPdf'])
        ->name('admin.supplier.cash.bill.pdf');

    Route::get('payments', [PaymentController::class, 'paymentIndex'])->name('payments.index');
    Route::get('payments/getRecords', [PaymentController::class, 'paymentgetRecords']);
    Route::post('payments/pdf', [PaymentController::class, 'createPaymentListPdf'])->name('payments.pdf');
    Route::get('/payments/pdf-preview', [PaymentController::class, 'previewPaymentListPdf'])->name('payments.pdf.preview');

    // Master Module Route HQ
    Route::get('hq-main', [MasterController::class, 'HQmainForm'])->name('hqMainForm.index');
    Route::post('hq-main/getValues', [MasterController::class, 'getDropDownValues'])->name('hqMainForm.getValues');
    Route::post('hq-main/getAllDetails', [MasterController::class, 'getAllDetails'])->name('hqMainForm.getAllDetails');
    Route::post('supplier/edit/{id}', [MasterController::class, 'editSupplier'])->name('supplier.editSupplier');
    Route::put('suppliers/update/main', [SupplierController::class, 'update1'])->name('supplier.update');



    #Update Profile
    Route::get('update-profile', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/{encid}', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/company/{encid}', [ProfileController::class, 'companyUpdate'])->name('company.update');
    Route::get('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::put('user-update-password/{encid}', [ProfileController::class, 'storeUpdatedPassword'])->name('storeUpdatePassword');


    Route::post('ffb_transaction', [MasterController::class, 'storeFFBTransaction'])->name('ffb.transaction.store');
    Route::get('get-supplier-details/{supplier_id}/{purchase_type}', [MasterController::class, 'getSupplierDetails'])->name('ffb.transaction.getSupplierDetails');
    Route::get('get-supplier-details-main/{supplier_id}/{type}', [MasterController::class, 'getSupplierDetailsMain'])->name('ffb.transaction.getSupplierDetailsMain');
    Route::post('branch-main/getValues', [MasterController::class, 'getBranchSupplierDropDownValues'])->name('branch.main.getValues');

    Route::get('purchase-analysis', [PurchaseAnalysisController::class, 'index'])->name('purchaseAnalysis.index');
    Route::get('purchase-analysis/getRecords', [PurchaseAnalysisController::class, 'supplierCashBillGetRecords'])->name('purchaseAnalysis.index');
    Route::get('purchase-analysis/chart-data', [PurchaseAnalysisController::class, 'getPurchaseChartData'])
        ->name('purchase.analysis.chart.data');
    Route::get('credit-purchase-analysis/getRecords', [PurchaseAnalysisController::class, 'getCreditPurchaseAnalysisRecords'])
        ->name('credit.purchase.analysis.getRecords');
    Route::get('purchase-analysis/pdf', [PurchaseAnalysisController::class, 'purchaseAnalysisPdf'])
        ->name('purchase.analysis.pdf');
    Route::get('credit-purchase-analysis/pdf', [PurchaseAnalysisController::class, 'creditPurchaseAnalysisPdf'])
        ->name('credit.purchase.analysis.pdf');
    Route::get('credit-purchase-analysis', [PurchaseAnalysisController::class, 'creditPurchaseAnalysisIndex'])->name('creditPurchaseAnalysis.index');


});