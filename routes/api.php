<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SubCategoryController;

use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('zahid')->group(function () {
    Route::resource('customer', CustomerController::class)->names('customer');
    Route::resource('employee', EmployeeController::class)->names('employee');
    Route::resource('brand', BrandController::class)->names('brand');
    Route::resource('category', CategoryController::class)->names('category');
    Route::resource('sub_category', SubCategoryController::class)->names('sub_category');
    Route::resource('product', ProductController::class)->names('product');
    Route::resource('purchase', PurchaseController::class)->names('purchase');
});
Route::prefix('minhaj')->group(function () {
    Route::resource('supplier',SupplierController::class)->names('supplier');
    Route::resource('expensecategory', ExpenseCategoryController::class)->names('expcat');
    Route::resource('expense', ExpenseController::class)->names('expense');
});
Route::prefix('rubon')->group(function () {
    Route::resource('unit', UnitController::class)->names('unit');
    Route::resource('payment', PaymentController::class)->names('payment');
    Route::resource('sale', SaleController::class)->names('sale');
});
