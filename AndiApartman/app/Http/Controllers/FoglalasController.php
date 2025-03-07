<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Foglalas;

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
        // Validáld a kötelező mezőket
        $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'felnott' => 'required|integer|min:0',
            'gyerek' => 'required|integer|min:0',
        ]);

        // Számítsd ki az éjszakák számát
        $checkinDate = new \DateTime($request->checkin);
        $checkoutDate = new \DateTime($request->checkout);
        $daysDifference = $checkoutDate->diff($checkinDate)->days;

        // Számítsd ki az összeget
        $felnottAr = 1; // 1 felnőtt ára
        $gyerekAr = 2; // 1 gyerek ára
        $osszeg = ($request->felnott * $felnottAr + $request->gyerek * $gyerekAr) * $daysDifference;

        // Hozz létre egy új foglalást
        $foglalas = new Foglalas();
        $foglalas->vendeg_id = auth()->id(); // Bejelentkezett felhasználó ID-je (opcionális)
        $foglalas->erkezes = $request->checkin;
        $foglalas->tavozas = $request->checkout;
        $foglalas->felnott = $request->felnott;
        $foglalas->gyerek = $request->gyerek;
        $foglalas->osszeg = $osszeg; // Az összeg mentése
        $foglalas->speciális_keresek = $request->speciális_keresek; // Nem kötelező
        $foglalas->csomag_id = $request->csomag_id; // Nem kötelező
        $foglalas->akcio_id = $request->akcio_id; // Nem kötelező
        $foglalas->save();

        return redirect()->back()->with('success', 'Foglalás sikeresen rögzítve!');
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
