<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkcioController;
use App\Http\Controllers\ErkezesiCsomagController;
use App\Http\Controllers\HelyiProgramajanloController;
use App\Http\Controllers\ModositasokController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FoglalasController;
use App\Http\Controllers\VelemenyController;

// Főoldal útvonala
Route::get('/', [VelemenyController::class, 'index']);

// Vélemény beküldése
Route::post('/velemeny', [VelemenyController::class, 'store'])->name('velemeny.store');

// Foglalás oldal megjelenítése
Route::get('/foglalas', function () {
    return view('foglalas');
})->name('foglalas');

// Foglalás adatok fogadása
Route::post('/foglalas', [FoglalasController::class, 'store'])->name('foglalas.store');

// ADMIN ROUTES
Route::get('/AdminFelulet/Login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/AdminFelulet/Login', [AdminController::class, 'login']);
Route::get('/AdminFelulet/Admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin módosítások
Route::get('/AdminFelulet/Modositasok', [AdminController::class, 'modositasok'])->name('admin.modositasok');
Route::get('/AdminFelulet/Modositasok', [ModositasokController::class, 'index'])->name('AdminFelulet.Modositasok');

// Érkezési csomagok kezelése
Route::post('Erkezesi.store', [ErkezesiCsomagController::class, 'store'])->name('Erkezesi.store');
Route::put('Erkezesi/{id}/update', [ErkezesiCsomagController::class, 'update'])->name('Erkezesi.update');

// Akciók kezelése
Route::post('/admin/akcio/store', [AkcioController::class, 'store'])->name('Akcio.store');
Route::get('/admin/akciok', [AkcioController::class, 'index'])->name('akcio.index');
Route::put('admin/akcio/{id}/update', [AkcioController::class, 'update'])->name('Akcio.update');

// Helyi programajánlók kezelése
Route::post('/admin/helyi/store', [HelyiProgramajanloController::class, 'store'])->name('Helyi.store');
Route::put('admin/helyi/{id}/update', [HelyiProgramajanloController::class, 'update'])->name('Helyi.update');

// Foglalások kezelése
Route::get('AdminFelulet/Foglalasok', [FoglalasController::class, 'index'])->name('AdminFelulet.Foglalasok');
Route::get('AdminFelulet/Admin', [FoglalasController::class, 'adminIndex'])->name('AdminFelulet.Admin');
Route::put('AdminFelulet/Admin/{id}/update', [FoglalasController::class, 'update'])->name('AdminFelulet.FoglalasUpdate');
Route::delete('AdminFelulet/Admin/{id}/delete', [FoglalasController::class, 'destroy'])->name('AdminFelulet.FoglalasDelete');