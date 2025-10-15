<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BorrowTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SessionController;
use App\Models\Assets;
use App\Models\BorrowTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::controller(SessionController::class)->group(function () {
    Route::get("/", 'create')->name('login');
    Route::post("/login", 'store');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::resource('departments', DepartmentController::class);

    Route::resource('asset-categories', AssetCategoryController::class);

    Route::resource('asset', AssetsController::class);

    Route::resource('borrow', BorrowTransactionController::class);
});
