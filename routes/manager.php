<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Manager\ManagerAuthController;
use \App\Http\Controllers\Manager\DepartmentController;
use \App\Http\Controllers\Manager\EmployeeController;
use \App\Http\Controllers\Manager\TaskController;

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
    Route::post("login",[ManagerAuthController::class,"login"]);
});

Route::group(["prefix" => "departments","middleware" => "auth:manager"],function (){
    Route::get("/",[DepartmentController::class,"index"]);
    Route::post("store",[DepartmentController::class,"store"]);
    Route::put("update/{id}",[DepartmentController::class,"update"]);
    Route::delete("delete/{id}",[DepartmentController::class,"destroy"]);
});

Route::group(["prefix" => "employees","middleware" => "auth:manager"],function (){
    Route::get("/",[EmployeeController::class,"index"]);
    Route::post("store",[EmployeeController::class,"store"]);
    Route::put("update/{id}",[EmployeeController::class,"update"]);
    Route::delete("delete/{id}",[EmployeeController::class,"destroy"]);
});

Route::group(["prefix" => "tasks","middleware" => "auth:manager"],function (){
    Route::get("help-data",[TaskController::class,"helpData"]);
    Route::get("/",[TaskController::class,"index"]);
    Route::post("store",[TaskController::class,"store"]);
});
