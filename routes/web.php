<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RegionalController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\TipounidadeController;
use App\http\Controllers\Admin\UnidadeatendimentoController;

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

// TIPO UNIDADE
Route::get('/index-tipounidade', [TipounidadeController::class, 'index'])->name('tipounidade.index');
Route::get('/create-tipounidade', [TipounidadeController::class, 'create'])->name('tipounidade.create');
Route::post('/store-tipounidade', [TipounidadeController::class, 'store'])->name('tipounidade.store');
Route::get('/edit-tipounidade/{tipounidade}', [TipounidadeController::class, 'edit'])->name('tipounidade.edit');
Route::put('/update-tipounidade/{tipounidade}', [TipounidadeController::class, 'update'])->name('tipounidade.update');
Route::delete('/destroy-tipounidade/{tipounidade}', [TipounidadeController::class, 'destroy'])->name('tipounidade.destroy');

// UNIDADES ATENDIMENTO
Route::get('/index-unidadeatendimento', [UnidadeatendimentoController::class, 'index'])->name('unidadeatendimento.index');
Route::get('/create-unidadeatendimento', [UnidadeatendimentoController::class, 'create'])->name('unidadeatendimento.create');
Route::post('/store-unidadeatendimento', [UnidadeatendimentoController::class, 'store'])->name('unidadeatendimento.store');
Route::get('/edit-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'edit'])->name('unidadeatendimento.edit');
Route::put('/update-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'update'])->name('unidadeatendimento.update');
Route::delete('/destroy-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'destroy'])->name('unidadeatendimento.destroy');


// MUNICÍPIO
Route::get('/index-datatables', function(){
    return view('datatables.datatables');
});

