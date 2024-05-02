<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('customer',CustomerController::class)->names('cust');
Route::resource('employee',EmployeeController::class)->names('emp');
Route::resource('category',CategoryController::class)->names('cat');
Route::resource('subcategory',SubCategoryController::class)->names('subcat');
Route::resource('brand',BrandController::class)->names('brand');
