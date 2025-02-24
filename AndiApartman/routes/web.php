<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkcioController;
use App\Http\Controllers\ErkezesiCsomagController;
use App\Http\Controllers\HelyiProgramajanloController;
use App\Http\Controllers\ModositasokController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/AdminFelulet/Login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/AdminFelulet/Login', [AdminController::class, 'login']);
Route::get('/AdminFelulet/Admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//Route::get('/AdminFelulet/Admin', [AdminController::class, 'dashboard'])->name('AdminFelulet.Admin');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout'); 
Route::get('/AdminFelulet/Modositasok', [AdminController::class, 'modositasok'])->name('admin.modositasok');
Route::get('AdminFelulet/Modositasok', [ModositasokController::class, 'index'])->name('AdminFelulet.Modositasok');

//Route::get('AdminFelulet/Modositasok', [AdminController::class, 'showModositasok'])->name('AdminFelulet.Modositasok');

Route::post('Erkezesi.store', [ErkezesiCsomagController::class, 'store'])->name('Erkezesi.store');

Route::post('/admin/akcio/store', [AkcioController::class, 'store'])->name('Akcio.store');
Route::get('/admin/akciok', [AkcioController::class, 'store'])->name('akcio.index');

Route::post('/admin/helyi/store', [HelyiProgramajanloController::class, 'store'])->name('Helyi.store');

