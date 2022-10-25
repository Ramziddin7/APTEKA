<?php

use Illuminate\Support\Facades\Route;

Route::resource('branch', BranchController::class);
Route::resource('cart', CartController::class);
Route::resource('customer', CustomerController::class);
Route::resource('debt', DebtController::class);
Route::resource('district', DistrictController::class);
Route::resource('invoice', InvoiceController::class);
Route::resource('manufacturer', ManufacturerController::class);
Route::resource('order', OrderController::class);
Route::resource('organization', OrganizationController::class);
Route::resource('product', ProductController::class);
Route::resource('productjoininvoice', ProductJoinInvoiceController::class);
Route::resource('region', RegionController::class);
Route::resource('role', RoleController::class);
Route::resource('treatmentregimen', TreatmentRegimenController::class);
Route::resource('unit', UnitController::class);
Route::resource('user', UserController::class);
Route::resource('userjoinrole', UserJoinRoleController::class);

Route::post('login', [\App\Http\Controllers\API\V1\AuthController::class,'login']);
Route::post('register',[\App\Http\Controllers\API\V1\AuthController::class,'register']);
Route::post('logout', [\App\Http\Controllers\API\V1\AuthController::class,'logout']);
Route::post('refresh', [\App\Http\Controllers\API\V1\AuthController::class,'refresh']);