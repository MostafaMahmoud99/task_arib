<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Employee\EmployeeAuthController;
use \App\Http\Controllers\Employee\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(["prefix" => "auth"],function (){
    Route::post("login",[EmployeeAuthController::class,"login"]);
});

Route::group(["prefix" => "tasks","middleware" => "auth:api"],function (){
    Route::get("/",[TaskController::class,"index"]);
    Route::put("change-status/{id}",[TaskController::class,"changeStatus"]);
});
