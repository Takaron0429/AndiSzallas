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
        $query->whereBetween('erkezes', [Carbon::create(2020, 1, 1), Carbon::create(2024, 12, 31)])
            ->whereBetween('tavozas', [Carbon::create(2020, 1, 1), Carbon::create(2024, 12, 31)]);


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
                $q->where('nev', 'like', '%' . $request->csomag . '%');
            });
        }


        if ($request->has('akcio') && $request->akcio != '') {
            $query->whereHas('akciok', function ($q) use ($request) {
                $q->where('cim', 'like', '%' . $request->akcio . '%');
            });
        }

        $foglalasok = $query->get();

        $Foglalas = Foglalas::all();
        $foglalas = Foglalas::with(['csomagok', 'akciok',])->get();
        $csomagok = ErkezesiCsomag::pluck('nev', 'csomag_id');
        $akciok = Akcio::pluck('cim', 'akcio_id');

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

        $Admin = Admin::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        $Foglalas = Foglalas::all();
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
        $foglalas = Foglalas::find($id);
        if (!$foglalas) {
            return redirect()->route('AdminFelulet.Modositasok')->with('error', 'Foglalás nem található!');
        }


        $validated = $request->validate([
            'erkezes' => 'required|date',
            'tavozas' => 'required|date|after:erkezes',
            'felnott' => 'required|integer|min:0',
            'gyerek' => 'required|integer|min:0',
            'csomag_id' => 'nullable|exists:erkezesi_csomagok,csomag_id',
            'akcio_id' => 'nullable|exists:akciok,akcio_id',
            'foglalas_allapot' => 'nullable|in:függőben,elfogadva',
            'fizetes_allapot' => 'nullable|in:függőben,kifizetett',
        ]);

        $foglalas->update($validated);


        $erkezes = Carbon::parse($foglalas->erkezes);
        $tavozas = Carbon::parse($foglalas->tavozas);
        $days = $erkezes->diffInDays($tavozas);

        $total = 0;
        foreach ($foglalas->csomagok as $csomag) {
            $total += ($foglalas->felnott * $csomag->ar + $foglalas->gyerek * $csomag->ar) * $days;
        }

        foreach ($foglalas->akciok as $akcio) {
            $total -= ($total * ($akcio->kedvezmeny / 100));
        }
        if ($request->filled('foglalas_allapot')) {
            $foglalas->foglalas_allapot = $request->input('foglalas_allapot');
        }

        if ($request->filled('fizetes_allapot')) {
            $foglalas->fizetes_allapot = $request->input('fizetes_allapot');
        }
        $foglalas->osszeg = $total;

        DB::beginTransaction();
        try {
            $foglalas->save();
            DB::commit();
            return redirect()->route('AdminFelulet.Admin')->with('success', 'Foglalás sikeresen frissítve!');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Hiba történt a foglalás frissítésekor: ' . $e->getMessage());
            return redirect()->route('AdminFelulet.Modositasok')->with('error', 'Hiba történt a foglalás frissítésekor!');
        }
    }
    public function getFoglaltNapok()
    {
        $foglalasok = Foglalas::all();
        $foglaltNapok = [];

        foreach ($foglalasok as $foglalas) {
            $start = Carbon::parse($foglalas->erkezes);
            $end = Carbon::parse($foglalas->tavozas);


            while ($start->lte($end)) {
                $foglaltNapok[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        return response()->json($foglaltNapok);
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

        DB::beginTransaction();

        try {
            // Vendég mentése
            $vendeg = Vendeg::create([
                'nev' => $validated['nev'],
                'email' => $validated['email'],
                'telefon' => $validated['telefon'] ?? null,
                'iranyitoszam' => $validated['iranyitoszam'] ?? null,
                'lakcim' => $validated['lakcim'] ?? null,
            ]);
        
            if (!$vendeg || !$vendeg->vendeg_id) {
                throw new \Exception("Vendég mentése sikertelen!");
            }
        
            // Éjszakák számítása
            $checkin = new \DateTime($validated['checkin']);
            $checkout = new \DateTime($validated['checkout']);
            $ejszakak = $checkin->diff($checkout)->days;
        
            // Ár kiszámítása
            $felnottAr = 10000;
            $gyerekAr = 5000;
            $osszeg = ($validated['felnott'] * $felnottAr + $validated['gyerek'] * $gyerekAr) * $ejszakak;
        
            // Csak a foglalás táblába mentünk
            $foglalas = Foglalas::create([
                'vendeg_id' => $vendeg->id,
                'erkezes' => $validated['checkin'],
                'tavozas' => $validated['checkout'],
                'felnott' => $validated['felnott'],
                'gyerek' => $validated['gyerek'],
                'osszeg' => $osszeg,
                'akcio_id' => $request->akcio_id ?? null, // Akció ID
                'csomag_id' => $request->csomag_id ?? null, // Csomag ID
                'specialis_keresek' => $validated['specialis_keresek'] ?? null,
            ]);
        
            if (!$foglalas || !$foglalas->id) {
                throw new \Exception("Foglalás mentése sikertelen!");
            }
        
            DB::commit();
            return redirect()->route('foglalas')->with('success', 'Foglalás sikeresen rögzítve!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Hiba: ' . $e->getMessage()]);
        }
    }
}
