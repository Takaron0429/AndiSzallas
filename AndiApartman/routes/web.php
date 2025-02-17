<?php

use App\Http\Controllers\AdminController;
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
Route::get('/AdminFelulet/Modositasok', [AdminController::class, 'modositasok'])->name('AdminFelulet.Modositasok');
Route::get('/AdminFelulet/Modositasok', [ModositasokController::class, 'index'])->name('AdminFelulet.Modositasok');
Route::get('/admin', [AdminController::class, 'showModositasok'])->name('AdminFelulet.Modositasok');
Route::post('/admin/csomag/store', [AdminController::class, 'storeCsomag'])->name('admin.storeCsomag');
Route::post('/admin/akcio/store', [AdminController::class, 'storeAkcio'])->name('admin.storeAkcio');
Route::post('/admin/program/store', [AdminController::class, 'storeProgram'])->name('admin.storeProgram');

