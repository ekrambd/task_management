<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InvoiceController;
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
 
 Route::post('login', [AuthController::class, 'login']);

 Route::middleware('auth:sanctum')->group( function () { 
    //logout
    Route::post('logout', [AuthController::class, 'logout']);
    
    //categories

    Route::apiResource('categories', CategoryController::class);

    //clients

    Route::apiResource('clients', ClientController::class);

   //departments

    Route::apiResource('departments', DepartmentController::class);

   //projects

    Route::apiResource('projects', ProjectController::class);

  //designations

    Route::apiResource('designations', DesignationController::class);

  //users

    Route::resource('users', UserController::class);

  //tasks

    Route::resource('tasks', TaskController::class);

  //invoices

    Route::get('get-invoice-no', [InvoiceController::class, 'getInvoiceNo']);
    Route::post('invoice-info', [InvoiceController::class, 'invoiceInfo']);
    Route::post('save-invoice', [InvoiceController::class, 'saveInvoice']);
    Route::get('/invoice-lists', [InvoiceController::class, 'invoiceLists']);
    Route::post('invoice-details', [InvoiceController::class, 'invoiceDetails']);
 });