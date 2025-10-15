<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetsController;
use App\Http\Controllers\BorrowTransactionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::controller(SessionController::class)->group(function () {
    Route::get("/", 'create')->name('login');
    Route::post("/login", 'store');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::resource('departments', DepartmentController::class);
    Route::resource('asset-categories', AssetCategoryController::class);

    // Route::controller(AssetsController::class)->group(function () {
    //     Route::get('/asset', 'index')->name('assets.index');
    //     Route::get('/asset/create', 'create')->name('assets.create');
    // });

    Route::resource('asset', AssetsController::class);
    Route::resource('borrow', BorrowTransactionController::class);
});
