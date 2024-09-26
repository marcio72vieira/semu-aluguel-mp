<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegionalController;

Route::get('/', function () {
    return view('layout.admin');
});


// REGIONAL
Route::get('/index-regional', [RegionalController::class, 'index'])->name('regional.index');
Route::get('/create-regional', [RegionalController::class, 'create'])->name('regional.create');
Route::post('/store-regional', [RegionalController::class, 'store'])->name('regional.store');
Route::get('/edit-regional/{regional}', [RegionalController::class, 'edit'])->name('regional.edit');
Route::put('/update-regional/{regional}', [RegionalController::class, 'update'])->name('regional.update');

