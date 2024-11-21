<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);    
    Route::group(['middleware' => 'auth:sanctum'], function() {
      Route::get('logout', [AuthController::class, 'logout']);
    });
});
Route::group(['middleware' => 'auth:sanctum'], function () {
  Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::post('/', [DashboardController::class, 'store']);
  });
});
