<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akcio;
use App\Models\AkcioFoglalas;
use App\Models\CsomagFoglalas;
use App\Models\ErkezesiCsomag;
use App\Models\Vendeg;
use App\Models\Foglalas;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FoglalasController extends Controller
{
    public function index(Request $request)
    {
        $query = Foglalas::query()->with(['csomagok', 'akciok']);

        if ($request->has('year') && $request->year != '') {
            $query->whereYear('erkezes', $request->year);
        }

        if ($request->has('month') && $request->month != '') {
            $query->whereMonth('erkezes', $request->month);
        }

        if ($request->has('adults') && $request->adults != '') {
            $query->where('felnott', $request->adults);
        }

        if ($request->has('children') && $request->children != '') {
            $query->where('gyerek', $request->children);
        }

        if ($request->has('csomag') && $request->csomag != '') {
            $query->whereHas('csomagok', function ($q) use ($request) {
                $q->where('nev', $request->csomag);
            });
        }

        if ($request->has('akcio') && $request->akcio != '') {
            $query->whereHas('akciok', function ($q) use ($request) {
                $q->where('cim', $request->akcio);
            });
        }

        $foglalasok = $query->get();


        $foglalas = Foglalas::with(['csomagok', 'akciok',])->get();
        $csomagok = ErkezesiCsomag::pluck('nev', 'csomag_id');
        $akciok = Akcio::pluck('cim', 'akcio_id');
        $Foglalas = Foglalas::whereYear('erkezes', 2025)
            ->where('tavozas', '<=', Carbon::create(2025, 8, 31))
            ->get();
        return view('AdminFelulet.Foglalasok', compact('Foglalas', 'foglalas', 'foglalasok', 'akciok', 'csomagok'));
    }

    public function adminIndex()
    {
        $Foglalas = Foglalas::all();
        $Admin = Admin::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        return view('AdminFelulet.Admin', compact('Foglalas', 'Admin', 'csomagok', 'akciok', 'akcio_', 'csomag_'));
    }
    public function Mod()
    {
        $Foglalas = Foglalas::all();
        $Admin = Admin::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        return view('AdminFelulet.Modositasok', compact('Foglalas', 'Admin', 'csomagok', 'akciok', 'akcio_', 'csomag_'));
    }
    public function getBookedDates()
    {

        $foglalasok = DB::table('foglalasok')
            ->select('erkezes', 'tavozas')
            ->get();

        $bookedDates = [];


        foreach ($foglalasok as $foglalas) {
            $startDate = Carbon::parse($foglalas->erkezes);
            $endDate = Carbon::parse($foglalas->tavozas);


            while ($startDate <= $endDate) {

                $bookedDates[] = $startDate->format('Y-m-d');
                $startDate->addDay();
            }
        }


        return response()->json($bookedDates);
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
    public function Adminstore(Request $request)
    {
        $validated = $request->validate([
            'checkin' => 'required|date',
            'checkout' => 'required|date|after:checkin',
            'felnott' => 'required|integer|min:1',
            'gyerek' => 'required|integer|min:0',
            'csomag_id' => 'required|exists:csomagok,id',
            'akcio_id' => 'nullable|exists:akciok,id',
            'nev' => 'required|string|max:255',
            'email' => 'required|email',
            'telefon' => 'nullable|string|max:20',
            'iranyitoszam' => 'nullable|string|max:10',
            'lakcim' => 'nullable|string|max:255',
            'specialis_keresek' => 'nullable|string',
        ]);


        $vendeg = new Vendeg();
        $vendeg->nev = $validated['nev'];
        $vendeg->email = $validated['email'];
        $vendeg->telefon = $validated['telefon'] ?? null;
        $vendeg->iranyitoszam = $validated['iranyitoszam'] ?? null;
        $vendeg->lakcim = $validated['lakcim'] ?? null;
        $vendeg->save();


        $csomag = ErkezesiCsomag::find($validated['csomag_id']);
        $akcio = Akcio::find($validated['akcio_id']);

        if (!$csomag) {
            return redirect()->back()->with('error', 'A kiválasztott csomag nem található.');
        }


        $napokSzama = (new \DateTime($validated['checkout']))->diff(new \DateTime($validated['checkin']))->days;
        $total = ($validated['felnott'] * $csomag->ar + $validated['gyerek'] * $csomag->ar * 0.5) * $napokSzama;

        if ($akcio) {
            $total -= $total * ($akcio->kedvezmeny_szazalek / 100);
        }


        $foglalas = new Foglalas();
        $foglalas->vendeg_id = $vendeg->id;
        $foglalas->checkin = $validated['checkin'];
        $foglalas->checkout = $validated['checkout'];
        $foglalas->felnott = $validated['felnott'];
        $foglalas->gyerek = $validated['gyerek'];
        $foglalas->csomag_id = $csomag->id ?? null;
        $foglalas->akcio_id = $akcio->id ?? null;
        $foglalas->specialis_keresek = $validated['specialis_keresek'];
        $foglalas->osszeg = $total;
        $foglalas->save();

        return redirect()->route('AdminFelulet.Modositasok')->with('success', 'Foglalás sikeresen rögzítve!');
    }
}
