<?php

use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetsController;
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


    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('departments');
        Route::post('/departments/store', 'store')->name('departments.store');
        Route::put('/departments/{department}', 'update')->name('departments.update');
        Route::delete('/departments/{department}', 'destroy')->name('departments.delete');
    });

    Route::resource('departments', DepartmentController::class);
    Route::resource('asset-categories', AssetCategoryController::class);

    Route::controller(AssetsController::class)->group(function () {
        Route::get('/asset', 'index')->name('assets.index');
    });
});
