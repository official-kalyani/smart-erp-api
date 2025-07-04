<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SalesOrderApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group( function () {
                 Route::get('/products', [ProductApiController::class, 'index']);
                Route::post('/sales-orders', [SalesOrderApiController::class, 'store']);
                Route::get('/sales-orders/{id}', [SalesOrderApiController::class, 'show']);
});


