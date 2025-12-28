<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController; 
use App\Http\Controllers\ProductController;  
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// All protected routes go inside this group
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Low Stock Report
    Route::get('/inventory/low-stock', [ProductController::class, 'lowStock'])->name('products.low_stock');
    
    // Categories CRUD
    Route::resource('categories', CategoryController::class);

    // --- PRODUCT ROUTES ---
    
    // 1. Custom Stock Adjustment Route (Must use {product} for Route Model Binding)
    Route::post('/products/{product}/adjust', [ProductController::class, 'adjustStock'])->name('products.adjustStock');

    // 2. Standard Products CRUD
    Route::resource('products', ProductController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';