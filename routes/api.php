<?php

use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//route api get toàn bộ sản phẩm
Route::get('/getall',[ProductController::class,'getAll']);
//route api get toàn bộ khách hàng

Route::get('/client',[CustomerController::class,'getAll']);

Route::get('/employee',[EmployeeController::class,'getAll']);
Route::post('/employee/insert',[EmployeeController::class,'insert']);
Route::post('/employee/update',[EmployeeController::class,'update']);
Route::post('/employee/delete',[EmployeeController::class,'delete']);
Route::post('/employee/detail',[EmployeeController::class,'detail']);

//route api đăng kí
Route::post('/dangki',[CustomerController::class,'dangki']);
Route::post('/doimatkhau',[CustomerController::class,'doimatkhau']);

Route::prefix('customer')->group(function () {
    Route::post('/insert',[CustomerController::class,'dangki']);
    Route::post('/update',[CustomerController::class,'update']);
    Route::post('/delete',[CustomerController::class,'delete']);
    Route::post('/detail',[CustomerController::class,'detail']);
});

Route::prefix('product')->group(function () {
    Route::get('/{id}',[ProductController::class,'getdetail']);
    Route::post('/insert',[ProductController::class,'insert']);
    Route::post('/update',[ProductController::class,'update']);
    Route::post('/insert_detail',[ProductController::class,'insert_detail']);
    /// tới đây
    Route::post('/update_detail',[ProductController::class,'update_detail']);

    Route::post('/delete',[ProductController::class,'delete']);

});
Route::post('/order',[OrderController::class,'order']);
Route::get('/get_order',[OrderController::class,'getAll']);
Route::post('/getorderbyphone',[OrderController::class,'getorderbysdt']);
Route::post('/getorderbyname',[OrderController::class,'getorderbyname']);

