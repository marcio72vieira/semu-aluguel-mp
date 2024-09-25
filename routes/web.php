<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegionalController;

Route::get('/', function () {
    return view('layout.admin');
});


// REGIONAL
Route::get('/create-regional', [RegionalController::class, 'create'])->name('regional.create');
Route::post('/store-regional', [RegionalController::class, 'store'])->name('regional.store');
