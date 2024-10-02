<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\BaseLoginController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('fashions', [ProductController::class, 'productList']);
});


Route::get('/logout', [BaseLoginController::class, 'logout']);
Route::post('/login',[BaseLoginController::class,'login']);
Route::post('/register',[BaseLoginController::class,'register']);
Route::post('/checkemail',[CommonController::class,'validatedEmail']);
Route::get('/checklogin', [App\Http\Controllers\HomeController::class, 'checkLogin']);

Route::get('students', [StudentController::class, 'getStudents']);


Route::get('aothun/{prd_id}', [ProductController::class, 'aothun'])->name('product.aothun');


Route::get('fashion', [ProductController::class, 'fashionID']);

Route::get('suggested-list', [ProductController::class, 'suggestedList']);

Route::post('product-search', [ProductController::class, 'productSearch']);

Route::get('product-list', [ProductController::class, 'productList']);
Route::get('product', [ProductController::class, 'productID']);
Route::post('product', [ProductController::class, 'newOrUpdateProduct']);
//Route::post('product/{prd_id}', [ProductController::class, 'updateproduct']);
Route::get('product-id/{id}', [ProductController::class, 'edit']);

Route::get('get_product_type', [ProductController::class, 'getProductType']);

Route::get('getDiscount', [DiscountController::class, 'getDiscount']);

Route::get('get_states/', [StateController::class, 'getState']);
Route::get('get_cities/', [StateController::class, 'getcityState']);
Route::get('get_zips/', [StateController::class, 'getZip']);

Route::post('create_order/', [OrderController::class, 'createOrder']);

Route::post('add_image_library/',[LibraryController::class, 'add_image_library']);
Route::post('libraries/', [LibraryController::class, 'libraries']);

Route::get('orders/', [OrderController::class, 'orderList']);
Route::get('order/', [OrderController::class, 'orderDetail']);

Route::get('testfield1/', [CommonController::class, 'getField']);


