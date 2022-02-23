<?php

use App\Access_history;
use App\DailyCheckUp;
use App\Department;
use App\Exports\DailyCheckUpsExport;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ArduinoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyCheckUpsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Access_user;
use App\Http\Controllers\VendorPermitController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;


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

Route::get('/', function(){
    return redirect(URL::to('/dashboard'));
});

Route::get('/storagelink', function(){
    return Artisan::call('storage:link');
});

Route::get('/deleteAccess', function(Request $request) {
    if($request){
        if($request->_token == "bqbunilybun"){
            // return "ok";
            $delete = Access_user::where('created_at', '>=',Carbon::now()->subHours(8))->delete();
            return $delete;
        }else{
            return "not ok";
        }
    }else{
        return URL::to('/');
    }
});

Route::middleware(['guest'])->group(function(){

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, '__login'])->name('login-post');

});

// DISPLAY CONTROLLER
Route::get('/display', [AccessController::class, 'display']);
Route::get('/display/access', [AccessController::class, 'access']);
Route::get('/data/display/container', [ArduinoController::class, 'uidContainer']);

// Route::get('/data/dcu/employee', [DailyCheckUpsController::class, 'checkDataDcu']);

//MODULE/ARDUINO CONTROLLER
Route::get('/modul/data', [ArduinoController::class, 'getAccess']);
Route::get('/modul/data/tap', [ArduinoController::class, 'storeAccessHistory']);
Route::post('/modul/display/data', [ArduinoController::class, 'getUid']);
Route::post('/modul/safetytalk', [ArduinoController::class, 'safetyTalkCheck']);

//JQUERY CONTROLLER
Route::get('/data/dcu/employee', [EmployeesController::class, 'checkEmployee']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard']);

    Route::get('/dashboard/add-user', [AuthController::class, 'addUser']);
    Route::post('/dashboard/add-user', [AuthController::class, '_addUser'])->name('addUser');

    Route::get('/dashboard/input-dcu', [DailyCheckUpsController::class, 'create']);
    Route::post('/dashboard/input-dcu', [DailyCheckUpsController::class, 'store'])->name('input-dcu');
    Route::get('/dashboard/history/dcu', [DailyCheckUpsController::class, 'index']);
    Route::get('/dashboard/history/dcu/download/', [DailyCheckUpsController::class, 'exportDCU']);

    Route::get('/dashboard/employee', [EmployeesController::class, 'index']);
    Route::get('/dashboard/employee/add', [EmployeesController::class, 'create']);
    Route::post('/dashboard/employee/add', [EmployeesController::class, 'store'])->name('add-employee');
    Route::get('/dashboard/employee/delete/{id}', [EmployeesController::class, 'destroy']);

    Route::get('/dashboard/department', [DepartmentsController::class, 'index']);
    Route::get('/dashboard/department/edit/{id}', [DepartmentsController::class, 'edit']);
    Route::post('/dashboard/department/edit/', [DepartmentsController::class, 'update'])->name('update-department');
    Route::get('/dashboard/department/add', [DepartmentsController::class, 'create']);
    Route::post('/dashboard/department/add', [DepartmentsController::class, 'store'])->name('add-department');

    Route::get('/dashboard/safetytalk', [DailyCheckUpsController::class, 'safetytalk']);
    Route::post('/dashboard/safetytalk', [DailyCheckUpsController::class, 'submitSafetytalk'])->name('SafetytalkCheck');

    Route::get('/dashboard/master-access-card', [AccessController::class, 'masterCard']);
    Route::get('/dashboard/master-access-card/add', [AccessController::class, 'addMasterCard']);
    Route::post('/dashboard/master-access-card/add', [AccessController::class, '_addMasterCard'])->name('addMasterCard');
    Route::get('/dashboard/master-access/card/{id}', [AccessController::class, 'removeMasterCard']);
    Route::get('/dashboarad/history/access', [AccessController::class, 'index']);
    Route::get('/dashboarad/history/access/download', [AccessController::class, 'exportAccess']);

    Route::get('/dashboard/vendor/permit', [VendorPermitController::class, 'index']);
    Route::get('/dashboard/vendor/detail/{id}', [VendorPermitController::class, 'show']);

    Route::get('/dashboard/monitor/segel', [PagesController::class, 'monitorSegel']);

    Route::get('/logout', [AuthController::class, 'logout']);
});
