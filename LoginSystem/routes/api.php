<?php

use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemsController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





//Orders Routing:-)






Route::prefix('Employee')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\EmployeeController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\EmployeeController::class,'GetAll']);
    Route::post('/LogIn',  [\App\Http\Controllers\EmployeeController::class,'GetAllLog']);
    Route::post('/Add',  [\App\Http\Controllers\EmployeeController::class,'AddNew']);
    Route::post('/Update',  [\App\Http\Controllers\EmployeeController::class,'UpdateByID']);
    Route::delete('/Delete',  [\App\Http\Controllers\EmployeeController::class,'DeleteByID']);
    });

Route::prefix('User')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\UserController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\UserController::class,'GetAll']);
    Route::post('/Add',  [\App\Http\Controllers\UserController::class,'AddNew']);
    Route::post('/Update',  [\App\Http\Controllers\UserController::class,'UpdateByID']);
    Route::delete('/Delete',  [\App\Http\Controllers\UserController::class,'DeleteByID']);
});

Route::prefix('Department')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\DepartmentController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\DepartmentController::class,'GetAll']);
    Route::post('/Add',  [\App\Http\Controllers\DepartmentController::class,'AddNew']);
    Route::post('/Update',  [\App\Http\Controllers\DepartmentController::class,'UpdateByID']);
    Route::delete('/Delete',  [\App\Http\Controllers\DepartmentController::class,'DeleteByID']);
});

Route::prefix('Position')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\PositionController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\PositionController::class,'GetAll']);
    Route::post('/Add',  [\App\Http\Controllers\PositionController::class,'AddNew']);
    Route::post('/Update',  [\App\Http\Controllers\PositionController::class,'UpdateByID']);
    Route::delete('/Delete',  [\App\Http\Controllers\PositionController::class,'DeleteByID']);
});

Route::prefix('Log')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\AttendanceLogController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\AttendanceLogController::class,'GetAll']);
    Route::post('/LogIn',  [\App\Http\Controllers\AttendanceLogController::class,'LogIn']);
    Route::post('/LogOut',  [\App\Http\Controllers\AttendanceLogController::class,'LogOut']);
    Route::delete('/Delete',  [\App\Http\Controllers\AttendanceLogController::class,'DeleteByID']);
});

Route::prefix('Leave')->group(function () {
    Route::get('/Find',  [\App\Http\Controllers\LeaveRequestsController::class,'FindByID']);
    Route::get('/All',  [\App\Http\Controllers\LeaveRequestsController::class,'GetAll']);
    Route::post('/Add',  [\App\Http\Controllers\LeaveRequestsController::class,'AddNew']);
    Route::post('/Update',  [\App\Http\Controllers\LeaveRequestsController::class,'UpdateByID']);
    Route::delete('/Delete',  [\App\Http\Controllers\LeaveRequestsController::class,'DeleteByID']);
});
