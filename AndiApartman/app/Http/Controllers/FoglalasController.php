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


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'erkezes' => 'required|date',
            'tavozas' => 'required|date|after:erkezes',
            'felnott' => 'required|integer|min:0',
            'gyerek' => 'required|integer|min:0',
            'csomag_id' => 'nullable|exists:erkezesi_csomagok,csomag_id',
            'akcio_id' => 'nullable|exists:akciok,akcio_id',
        ]);

        $foglalas = Foglalas::find($id);
        if (!$foglalas) {
            return redirect()->route('AdminFelulet.Modositasok')->with('error', 'Foglalás nem található!');
        }

        $foglalas->update($validated);

        $csomag = $foglalas->csomag;
        $akcio = $foglalas->akcio;

        $days = (new \DateTime($request->tavozas))->diff(new \DateTime($request->erkezes))->days;
        $total = ($foglalas->felnott * $csomag->ar + $foglalas->gyerek * $csomag->ar) * $days;
        if ($akcio) {
            $total = $total - ($total * ($akcio->kedvezmeny_szazalek / 100));
        }

        $foglalas->osszeg = $total;
        $foglalas->save();

        return redirect()->route('AdminFelulet.Admin')->with('success', 'Foglalás frissítve!');
    }
    public function destroy($id)
    {
        $foglalas = Foglalas::find($id);
        if (!$foglalas) {
            return redirect()->route('AdminFelulet.Admin')->with('error', 'Foglalás nem található!');
        }

        $foglalas->delete();
        return redirect()->route('AdminFelulet.Admin')->with('success', 'Foglalás törölve!');
    }
}
