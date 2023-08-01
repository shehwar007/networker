<?php
use App\Http\Controllers\{ConnectionController,UserController,AuthController, TeamController};
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

Route::get('/', [AuthController::class,'index']);
Route::post('loginSubmit', [AuthController::class,'validateCredentials']);


Route::group(['middleware' => ['loginCheck']], function () {

Route::resource('connection', ConnectionController::class);
Route::resource('team', TeamController::class);
Route::get('team_delete/{team}', [TeamController::class, 'destroy']);


Route::resource('user', UserController::class);
Route::post('connection_action', [ConnectionController::class, 'ActionConnection'])->name('connection.action');
Route::get('parked_connection', [ConnectionController::class, 'indexParkedConnection'])->name('parked_connection.index');
// Route::get('dashboard', [ConnectionController::class, 'indexDashboard'])->name('dashboard.index');

//logout
Route::get('/logout', function(){
    session()->flush();
    return redirect('/');
})->name('logout');

});