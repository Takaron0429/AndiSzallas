<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foglalas;

class FoglalasController extends Controller
{
    public function store(Request $request)
    {
        // Validáld a kötelező mezőket
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'felnott' => 'required|integer|min:0',
            'gyerek' => 'required|integer|min:0',
        ]);
    
        // Hozz létre egy új foglalást
        $foglalas = new Foglalas();
        $foglalas->vendeg_id = auth()->id(); // Bejelentkezett felhasználó ID-je (opcionális)
        $foglalas->erkezes = $request->checkin;
        $foglalas->tavozas = $request->checkout;
        $foglalas->felnott = $request->felnott;
        $foglalas->gyerek = $request->gyerek;
        $foglalas->osszeg = 0; // Ide jöhet egy számítási logika
        $foglalas->speciális_keresek = $request->speciális_keresek; // Nem kötelező
        $foglalas->csomag_id = $request->csomag_id; // Nem kötelező
        $foglalas->akcio_id = $request->akcio_id; // Nem kötelező
        $foglalas->save();
    
        return redirect()->back()->with('success', 'Foglalás sikeresen rögzítve!');
    }
}
