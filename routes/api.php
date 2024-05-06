<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::resource('customer',CustomerController::class)->names('cust');
Route::resource('employee',EmployeeController::class)->names('emp');
Route::resource('brand',BrandController::class)->names('brand');
Route::resource('category',CategoryController::class)->names('category');
Route::resource('sub_category',SubCategoryController::class)->names('sub_category');
Route::resource('product',ProductController::class)->names('product');

Route::prefix('minhaj')->group(function(){
    // Route::resource('supplier',supp::class)->names('suppl');
    Route::resource('expensecategory',ExpenseCategoryController::class)->names('expcat');
    Route::resource('expense',ExpenseController::class)->names('expense');
});
