<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\SubSubCategoriesController;
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
Route::post('admin/checkLogin', [LoginController::class, 'checkLogin'])->name('admin.checkLogin');
Route::post('/admin/password/email', [ForgotPasswordController::class, 'forgotPasswordSubmit'])->name('admin.auth.password.submit');
Route::get('/admin/password/reset', [ForgotPasswordController::class, 'show'])->name('admin.auth.password.reset')->middleware('guest');
Route::get('/admin/password-reset/{id?}', [ForgotPasswordController::class, 'showChangePassword'])->name('admin.forgot.password')->middleware('guest');
Route::post('/admin/password-reset/{id}', [ForgotPasswordController::class, 'resetPasswordSubmit'])->name('forgot.password.reset');
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');


Route::middleware([AdminMiddleware::class])->prefix('admin')->as('admin.')->group(function () {

    # Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class)->names('users');


    #Update Profile
    Route::get('update-profile', [ProfileController::class, 'editProfile'])->name('editProfile');
    Route::put('/profile/{encid}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/update-password', [ProfileController::class, 'updatePassword'])->name('updatePassword');
    Route::put('user-update-password/{encid}', [ProfileController::class, 'storeUpdatedPassword'])->name('storeUpdatePassword');

});