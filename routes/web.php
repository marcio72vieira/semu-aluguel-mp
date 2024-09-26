<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegionalController;
use App\Http\Controllers\Admin\MunicipioController;

Route::get('/', function () {
    return view('layout.admin');
});


// REGIONAL
Route::get('/index-regional', [RegionalController::class, 'index'])->name('regional.index');
Route::get('/create-regional', [RegionalController::class, 'create'])->name('regional.create');
Route::post('/store-regional', [RegionalController::class, 'store'])->name('regional.store');
Route::get('/edit-regional/{regional}', [RegionalController::class, 'edit'])->name('regional.edit');
Route::put('/update-regional/{regional}', [RegionalController::class, 'update'])->name('regional.update');
Route::delete('/destroy-regional/{regional}', [RegionalController::class, 'destroy'])->name('regional.destroy');

// MUNICIPIO
Route::get('/index-municipio', [MunicipioController::class, 'index'])->name('municipio.index');
Route::get('/create-municipio', [MunicipioController::class, 'create'])->name('municipio.create');
Route::post('/store-municipio', [MunicipioController::class, 'store'])->name('municipio.store');
Route::get('/edit-municipio/{municipio}', [MunicipioController::class, 'edit'])->name('municipio.edit');
Route::put('/update-municipio/{municipio}', [MunicipioController::class, 'update'])->name('municipio.update');
Route::delete('/destroy-municipio/{municipio}', [MunicipioController::class, 'destroy'])->name('municipio.destroy');




// MUNICÍPIO
Route::get('/index-datatables', function(){
    return view('datatables.datatables');
});

