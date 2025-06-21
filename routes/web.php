<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalesOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::middleware('role:admin')->group(function () {
         Route::resource('products', ProductController::class);
    // });

    // Admin and Salesperson can access sales orders
    Route::middleware('role:admin,salesperson')->group(function () {
        Route::resource('sales_orders', SalesOrderController::class);
        Route::get('sales_orders/{salesOrder}/pdf', [SalesOrderController::class, 'exportPdf'])->name('sales_orders.pdf');
    });
   
   
});

require __DIR__.'/auth.php';
