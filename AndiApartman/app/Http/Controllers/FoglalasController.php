<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Vendeg;
use App\Models\Foglalas;
use Illuminate\Http\Request;

class FoglalasController extends Controller
{
    public function index()
    {
        $Foglalas = Foglalas::all();
        return view('AdminFelulet.Foglalasok', compact('Foglalas'));
    }

    public function adminIndex()
    {
        $Foglalas = Foglalas::all();
        $Admin = Admin::all();
        return view('AdminFelulet.Admin', compact('Foglalas', 'Admin'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'felnott' => 'required|integer',
            'gyerek' => 'required|integer',
            'nev' => 'required|string',
            'email' => 'required|email',
            'telefon' => 'nullable|string',
            'iranyitoszam' => 'nullable|string',
            'lakcim' => 'nullable|string',
            'specialis_keresek' => 'nullable|string',
        ]);

        // Vendég mentése
        $vendeg = Vendeg::create([
            'nev' => $validated['nev'],
            'email' => $validated['email'],
            'telefon' => $validated['telefon'] ?? null,
            'iranyitoszam' => $validated['iranyitoszam'] ?? null,
            'lakcim' => $validated['lakcim'] ?? null,
        ]);

        // Éjszakák számítása
        $checkin = new \DateTime($validated['checkin']);
        $checkout = new \DateTime($validated['checkout']);
        $ejszakak = $checkin->diff($checkout)->days;

        // Ár kiszámítása (ezeket később finomíthatod)
        $felnottAr = 10000; // pl. 10000 Ft / éj
        $gyerekAr = 5000;   // pl. 5000 Ft / éj
        $osszeg = ($validated['felnott'] * $felnottAr + $validated['gyerek'] * $gyerekAr) * $ejszakak;

        // Foglalás mentése
        Foglalas::create([
            'vendeg_id' => $vendeg->id,
            'erkezes' => $validated['checkin'],
            'tavozas' => $validated['checkout'],
            'felnott' => $validated['felnott'],
            'gyerek' => $validated['gyerek'],
            'osszeg' => $osszeg,
            'specialis_keresek' => $validated['specialis_keresek'] ?? null,
        ]);

        return redirect()->route('foglalas')->with('success', 'Foglalás sikeresen rögzítve!');
    }
}
