<?php

use App\DailyCheckUp;
use App\Department;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\ArduinoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DailyCheckUpsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

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
Route::post('/modul/display/data', [ArduinoController::class, 'getUid']);
Route::post('/modul/safetytalk', [DailyCheckUpsController::class, 'safetyTalkCheck']);

//JQUERY CONTROLLER
Route::get('/data/dcu/employee', [EmployeesController::class, 'checkEmployee']);


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PagesController::class, 'dashboard']);

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

    Route::get('/logout', [AuthController::class, 'logout']);
});
