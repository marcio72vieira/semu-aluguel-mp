<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Publico\LoginController;
use App\Http\Controllers\Publico\ForgotPasswordController;
use App\Http\Controllers\Admin\RegionalController;
use App\Http\Controllers\Admin\MunicipioController;
use App\Http\Controllers\Admin\TipounidadeController;
use App\Http\Controllers\Admin\UnidadeatendimentoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RequerenteController;



Route::get('/', function () {
    return view('layout.admin');
});

// TESTE DATATABLE
Route::get('/index-datatables', function(){
    return view('datatables.datatables');
});


// Login - Login Primeiro Acesso - Lougout
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'processalogin'])->name('login.processalogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::get('/create-login-primeiroacesso/{user}', [LoginController::class, 'createprimeiroacesso'])->name('login.create-primeiroacesso');
Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');

//Route::get('/create-user-login/{user}', [LoginController::class, 'create'])->name('login.create-user');
//Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');


// Recupear senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])->name('forgot-password.submit');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('reset-password.submit');


// USUÁRIO
Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('/getunidadesatendimentomunicipio',[UserController::class, 'getunidadesatendimentomunicipio'])->name('getunidadesatendimentomunicipio');
Route::get('pdf-user/relpdflistusers', [UserController::class, 'relpdflistusers'])->name('user.pdflistusers');


// REQUERENTE
Route::get('/index-requerente', [RequerenteController::class, 'index'])->name('requerente.index');
Route::get('/create-requerente', [RequerenteController::class, 'create'])->name('requerente.create');
Route::post('/store-requerente', [RequerenteController::class, 'store'])->name('requerente.store');
Route::get('/show-requerente/{requerente}', [RequerenteController::class, 'show'])->name('requerente.show');
Route::get('/edit-requerente/{requerente}', [RequerenteController::class, 'edit'])->name('requerente.edit');
Route::put('/update-requerente/{requerente}', [RequerenteController::class, 'update'])->name('requerente.update');


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

// UNIDADE ATENDIMENTO
Route::get('/index-unidadeatendimento', [UnidadeatendimentoController::class, 'index'])->name('unidadeatendimento.index');
Route::get('/create-unidadeatendimento', [UnidadeatendimentoController::class, 'create'])->name('unidadeatendimento.create');
Route::post('/store-unidadeatendimento', [UnidadeatendimentoController::class, 'store'])->name('unidadeatendimento.store');
Route::get('/show-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'show'])->name('unidadeatendimento.show');
Route::get('/edit-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'edit'])->name('unidadeatendimento.edit');
Route::put('/update-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'update'])->name('unidadeatendimento.update');
Route::delete('/destroy-unidadeatendimento/{unidadeatendimento}', [UnidadeatendimentoController::class, 'destroy'])->name('unidadeatendimento.destroy');



