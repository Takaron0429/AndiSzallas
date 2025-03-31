<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AkcioController;
use App\Http\Controllers\ErkezesiCsomagController;
use App\Http\Controllers\HelyiProgramajanloController;
use App\Http\Controllers\ModositasokController;
use App\Http\Controllers\VendegController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoglalasController;
use App\Http\Controllers\VelemenyController;
use App\Http\Controllers\WelcomeController;
use App\Models\HelyiProgramajanlo;
use App\Models\Velemeny;

// Főoldal útvonala - mindkét adatforrást kezeljük
Route::get('/', function() {
    // Programajánlók betöltése
    $programok = HelyiProgramajanlo::where('vege', '>=', now())
        ->orderBy('helyszin')
        ->get()
        ->groupBy('helyszin');
        
    // Vélemények betöltése
    $velemenyek = Velemeny::where('approved', 1)->latest()->get();
    $atlagErtekeles = $velemenyek->avg('ertekeles');
    
    return view('welcome', [
        'programok' => $programok,
        'velemenyek' => $velemenyek,
        'atlagErtekeles' => $atlagErtekeles
    ]);
})->name('home');

// Csomagok kezelése
Route::post('/csomag-foglalas', [CsomagFoglalasController::class, 'store'])->name('csomag-foglalas.store');
Route::delete('/csomag-foglalas/{foglalas_id}/{csomag_id}', [CsomagFoglalasController::class, 'destroy'])->name('csomag-foglalas.destroy');


// Vélemény útvonalak
Route::post('/velemeny', [VelemenyController::class, 'store'])->name('velemeny.store');
Route::get('/velemenyek', [VelemenyController::class, 'approvedVelemenyek'])->name('velemenyek.list');

// Foglalás útvonalak
Route::get('/foglalas', function () {
    return view('foglalas');
})->name('foglalas');
Route::post('/foglalas', [FoglalasController::class, 'store'])->name('foglalas.store');

// Programok oldal
Route::get('/Fooldal/Programok', [HelyiProgramajanloController::class, 'Pindex'])->name('programok.Pindex');

// ADMIN ROUTES
Route::get('/AdminFelulet/Login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/AdminFelulet/Login', [AdminController::class, 'login']);
Route::get('/AdminFelulet/Admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin módosítások
Route::get('/AdminFelulet/Modositasok', [ModositasokController::class, 'index'])->name('AdminFelulet.Modositasok');
Route::post('/AdminFelulet/Modositasok', [FoglalasController::class, 'Mod'])->name('foglalas.Mod');
Route::post('/AdminFelulet/Modositasok', [FoglalasController::class, 'Adminstore'])->name('foglalas.Adminstore');

// Érkezési csomagok kezelése
Route::post('/Erkezesi/store', [ErkezesiCsomagController::class, 'store'])->name('Erkezesi.store');
Route::put('/Erkezesi/{id}/update', [ErkezesiCsomagController::class, 'update'])->name('Erkezesi.update');

// Akciók kezelése
Route::post('/admin/akcio/store', [AkcioController::class, 'store'])->name('Akcio.store');
Route::get('/admin/akciok', [AkcioController::class, 'index'])->name('akcio.index');
Route::put('/admin/akcio/{id}/update', [AkcioController::class, 'update'])->name('Akcio.update');

// Helyi programajánlók kezelése
Route::post('/admin/helyi/store', [HelyiProgramajanloController::class, 'store'])->name('Helyi.store');
Route::put('/admin/helyi/{id}/update', [HelyiProgramajanloController::class, 'update'])->name('Helyi.update');

// Foglalások kezelése
Route::get('/AdminFelulet/Foglalasok', [FoglalasController::class, 'index'])->name('AdminFelulet.Foglalasok');
Route::get('/AdminFelulet/Admin', [FoglalasController::class, 'adminIndex'])->name('AdminFelulet.Admin');
Route::get('/admin', [AdminController::class, 'index'])->name('AdminFelulet.Admin');
Route::put('/AdminFelulet/Admin/{id}/update', [FoglalasController::class, 'update'])->name('AdminFelulet.FoglalasUpdate');
Route::delete('/AdminFelulet/Admin/{id}/delete', [FoglalasController::class, 'destroy'])->name('AdminFelulet.FoglalasDelete');
Route::get('/AdminFelulet/Admin/velemenyek', [VelemenyController::class, 'velemenyek'])->name('AdminFelulet.Velemenyek');
Route::get('/AdminFelulet/Admin/{id}/approve', [VelemenyController::class, 'approveVelemeny'])->name('velemeny.approve');
Route::get('/AdminFelulet/Admin/delete/{email}', [VelemenyController::class, 'deleteVelemeny'])->name('velemeny.delete');
//Statisztika
Route::get('/admin/statistics', [AdminController::class, 'getStatistics']);
Route::get('/admin/statisztika', [AdminController::class, 'index']);




// API végpontok
Route::get('/admin/foglalt-napok', [FoglalasController::class, 'getFoglaltNapok']);
Route::get('/getBookedDates', [FoglalasController::class, 'getBookedDates'])->name('getBookedDates');
