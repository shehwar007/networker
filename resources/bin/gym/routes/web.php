<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\View;
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
Route::get('/', [AuthController::class, 'index']);
Route::post('loginSubmit', [AuthController::class, 'validateCredentials'])->name('login.submit');
Route::group(['middleware' => ['LoginCheck']], function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('home')->middleware('LoginCheck');


Route::resource('sales', SaleController::class);
Route::get('/sale/{page?}', [SaleController::class, 'View'])->name('sales.view');
Route::get('/sale_info', [SaleController::class, 'ViewSaleInfo'])->name('sales_info.view');
Route::get('/sale_info_ajax', [SaleController::class, 'ViewSaleInfoAjax'])->name('sale_info_ajax.index');



// Route::get('/sale/view_sales', [SaleController::class, 'View'])->name('sales.view');
Route::get('/addtocart/{id}', [SaleController::class, 'AddToCart']);
Route::get('/removecart/{id}', [SaleController::class, 'RemoveCartItem']);
Route::get('/updatecart/{id}/{value}', [SaleController::class, 'UpdateCartItem']);
Route::get('/clearcart', [SaleController::class, 'ClearCart']);
Route::get('/invoice/{id}', [SaleController::class, 'PrintInvoice'])->name('print.invoice');
Route::post('/add_payment', [SaleController::class, 'StorePartialAmount'])->name('sale.add_payment');
Route::get('/report', [SaleController::class, 'Report'])->name('sales.report');
Route::get('/old_report', [SaleController::class, 'OldReport'])->name('sales.old_report');
Route::get('/old_report_ajax', [SaleController::class, 'OldReportAjax'])->name('old_report.ajax');
//
Route::get('/sale_summary', [SaleController::class, 'SalesSummary'])->name('sales.summary');
Route::get('/sale_summary_ajax', [SaleController::class, 'SalesSummaryAjax'])->name('sales.summary.ajax');

Route::post('/view_summary_ajax_post', [SaleController::class, 'ReportAjax'])->name('summarypost');
Route::get('/payment_info', [SaleController::class, 'PaymentInfoView'])->name('sales.payment.info');
Route::get('/payment_info_ajax', [SaleController::class, 'AjaxPaymentInfoView'])->name('ajax.sales.payment.info');

Route::post('/update_order', [SaleController::class, 'UpdateOrder'])->name('update.order');
Route::get('/recentservices/{id}', [SaleController::class, 'RecentService']);
Route::get('/edit_order/{id}', [SaleController::class, 'EditOrder']);
Route::post('/update_expire_date', [SaleController::class, 'UpdateExpireDate'])->name('update.expire_date');



Route::resource('members', MemberController::class)->except(['index']);
Route::get('/member/{page?}', [MemberController::class, 'index'])->name('members.index');
Route::resource('services', ServiceController::class);
Route::resource('expenses', ExpenseController::class);

Route::resource('settings', SettingController::class);

Route::post('/profile_setting', [SettingController::class, 'UpdateProfile'])->name('setting.profile');
Route::post('/add_user', [SettingController::class, 'StoreUser'])->name('add.users.setting');
Route::get('/delete_user/{id}', [SettingController::class, 'DestroyUser'])->name('user.delete');


// Route::get('/query_run', [SaleController::class, 'QueryRun']);



}); 

Route::get('/logout', function () {
    session()->flush();
    return redirect('/');
})->name('logoutname');