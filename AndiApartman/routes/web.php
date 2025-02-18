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
//Route::get('/AdminFelulet/Modositasok', [AdminController::class, 'modositasok'])->name('admin.modositasok');
Route::get('/AdminFelulet/Modositasok', [ModositasokController::class, 'index'])->name('modositasok.index');
Route::get('/admin', [AdminController::class, 'showModositasok'])->name('AdminFelulet.Modositasok');
Route::post('/admin/csomag/store', [ErkezesiCsomagController::class, 'storeCsomag'])->name('admin.storeCsomag');
Route::post('/admin/akcio/store', [AkcioController::class, 'storeAkcio'])->name('admin.storeAkcio');
Route::post('/admin/program/store', [HelyiProgramajanloController::class, 'storeProgram'])->name('admin.storeProgram');

