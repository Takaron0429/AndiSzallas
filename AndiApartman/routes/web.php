<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/AdminFelulet/Login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/AdminFelulet/Login', [AdminController::class, 'login']);
Route::get('/AdminFelulet/Admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout'); 