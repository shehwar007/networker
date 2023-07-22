<?php
use App\Http\Controllers\ConnectionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {  
    return view('dashboard');
});

Route::resource('connection', ConnectionController::class);
Route::get('parked_connection', [ConnectionController::class, 'indexParkedConnection'])->name('parked_connection.index');
Route::get('dashboard', [ConnectionController::class, 'indexDashboard'])->name('dashboard.index');

Route::get('/shehwar', function () {
    
    return view('active_connection');
    
});
