<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArduinoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/modul/data', [ArduinoController::class, 'getAccess']);
Route::get('/modul/data/tap', [ArduinoController::class, 'storeAccessHistory']);
Route::post('/modul/display/data', [ArduinoController::class, 'getUid']);
Route::post('/modul/safetytalk', [ArduinoController::class, 'safetyTalkCheck']);
