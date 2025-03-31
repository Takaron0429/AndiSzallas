<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akcio;
use App\Models\AkcioFoglalas;
use App\Models\CsomagFoglalas;
use App\Models\ErkezesiCsomag;
use App\Models\Fizetes;
use App\Models\Velemeny;
use App\Models\Vendeg;
use App\Models\Foglalas;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class FoglalasController extends Controller
{
    public function index(Request $request)
    {
        $query = Foglalas::query()->with('vendeg', 'csomagok', 'akciok');
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
        //STATISZTIKÁK

        $year = $request->input('year', date('Y'));
        $month = $request->input('month', null);
        $year = $request->input('year');
        $nowYear = now()->year;
        $isYearSelected = $year ? true : false;

        if (!$year) {

            $foglalasokEvonta = Foglalas::select(DB::raw('YEAR(erkezes) as ev'), DB::raw('SUM(osszeg) as osszeg'))
                ->whereBetween(DB::raw('YEAR(erkezes)'), [2020, $nowYear - 1])
                ->groupBy(DB::raw('YEAR(erkezes)'))
                ->orderBy('ev')
                ->get();
        } else {

            $foglalasokEvonta = Foglalas::select(DB::raw('MONTH(erkezes) as honap'), DB::raw('SUM(osszeg) as osszeg'))
                ->whereYear('erkezes', $year)
                ->groupBy(DB::raw('MONTH(erkezes)'))
                ->orderBy('honap')
                ->get();
        }



        if (!$year) {

            $vendegSzamEvonta = DB::table('foglalasok')
                ->selectRaw('YEAR(erkezes) as ev, SUM(gyerek) as gyerekek_szama, SUM(felnott) as felnott_szama')
                ->whereBetween(DB::raw('YEAR(erkezes)'), [2020, $nowYear - 1])
                ->groupBy('ev')
                ->orderBy('ev')
                ->get();
        } else {
            $vendegSzamEvonta = DB::table('foglalasok')
                ->selectRaw('MONTH(erkezes) as honap, SUM(gyerek) as gyerekek_szama, SUM(felnott) as felnott_szama')
                ->whereYear('erkezes', $year)
                ->groupBy('honap')
                ->orderBy('honap')
                ->get();
        }

        if (!$year) {
            // Éves átlagos foglalási hossz (2020-2024)
            $atlagosHosszEvonta = DB::table('foglalasok')
                ->selectRaw('YEAR(erkezes) as ev, AVG(DATEDIFF(tavozas, erkezes)) as atlag_hossz')
                ->whereBetween(DB::raw('YEAR(erkezes)'), [2020, $nowYear - 1])
                ->groupBy('ev')
                ->orderBy('ev')
                ->get();
        } else {
            // Ha van választott év, akkor havi bontás
            $atlagosHosszEvonta = DB::table('foglalasok')
                ->selectRaw("MONTH(erkezes) as honap, AVG(DATEDIFF(tavozas, erkezes)) as atlag_hossz")
                ->whereYear('erkezes', $year)
                ->groupBy('honap')
                ->orderBy('honap')
                ->get();
        }

        if (!$year) {
            $csomagokST = CsomagFoglalas::select(
                'erkezesi_csomagok.nev',
                DB::raw('count(csomag_foglalas.foglalas_id) as foglalasok_szama')
            )
                ->join('erkezesi_csomagok', 'csomag_foglalas.csomag_id', '=', 'erkezesi_csomagok.csomag_id')
                ->join('foglalasok', 'csomag_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
                ->whereBetween('foglalasok.erkezes', ['2020-01-01', '2024-12-31']) //ITT
                ->groupBy('erkezesi_csomagok.nev')
                ->get();

            $akciokST = AkcioFoglalas::select(
                'akciok.cim',
                DB::raw('count(akcio_foglalas.foglalas_id) as foglalasok_szama')
            )
                ->join('akciok', 'akcio_foglalas.akcio_id', '=', 'akciok.akcio_id')
                ->join('foglalasok', 'akcio_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
                ->whereBetween('foglalasok.erkezes', ['2020-01-01', '2024-12-31'])
                ->groupBy('akciok.cim')
                ->get();

        } else {

            $csomagokST = CsomagFoglalas::select(
                'erkezesi_csomagok.nev',
                DB::raw('count(csomag_foglalas.foglalas_id) as foglalasok_szama')
            )
                ->join('erkezesi_csomagok', 'csomag_foglalas.csomag_id', '=', 'erkezesi_csomagok.csomag_id')
                ->join('foglalasok', 'csomag_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
                ->whereYear('foglalasok.erkezes', $year)
                ->groupBy('erkezesi_csomagok.nev')
                ->get();

            $akciokST = AkcioFoglalas::select(
                'akciok.cim',
                DB::raw('count(akcio_foglalas.foglalas_id) as foglalasok_szama')
            )
                ->join('akciok', 'akcio_foglalas.akcio_id', '=', 'akciok.akcio_id')
                ->join('foglalasok', 'akcio_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
                ->whereYear('foglalasok.erkezes', $year)
                ->groupBy('akciok.cim')
                ->get();
        }
        
        if ($year) {
          
            $bankkartyasOsszeg = Fizetes::where('fizetesi_mod', 'bankkártya')
                ->whereYear('tranzakcio_datuma', $year)
                ->sum('osszeg');
        
            $utalasOsszeg = Fizetes::where('fizetesi_mod', 'utalás')
                ->whereYear('tranzakcio_datuma', $year)
                ->sum('osszeg');
        } else {
          
            $bankkartyasOsszeg = Fizetes::where('fizetesi_mod', 'bankkártya')
                ->whereBetween('created_at', ['2020-01-01', '2025-12-31'])
                ->sum('osszeg');
        
            $utalasOsszeg = Fizetes::where('fizetesi_mod', 'utalás')
                ->whereBetween('created_at', ['2020-01-01', '2025-12-31'])
                ->sum('osszeg');
        }


        // NOT WORKING
        $velemenyekErtekeles = DB::table('velemenyek')
            ->select('ertekeles', DB::raw('COUNT(*) as db'))
            ->whereBetween('created_at', ['2020-01-01', '2025-12-31'])
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('created_at', $year);
            })
            ->groupBy('ertekeles')
            ->orderBy('ertekeles', 'ASC')
            ->get();

        $osszesVendeg = DB::table('foglalasok')->distinct()->count('vendeg_id');

        $visszateroVendegSzama = DB::table('foglalasok')
            ->select('vendeg_id')
            ->groupBy('vendeg_id')
            ->havingRaw('COUNT(*) > 1')
            ->whereBetween('erkezes', ['2020-01-01', '2025-12-31'])
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('erkezes', $year);
            })
            ->count();

        $visszateroVendegSzama = $visszateroVendegSzama ?? 0;
        $visszateroArany = $osszesVendeg > 0 ? ($visszateroVendegSzama / $osszesVendeg) * 100 : 0;


        $foglalasok = $query->get();
        $csomagok = ErkezesiCsomag::pluck('nev', 'csomag_id');
        $akciok = Akcio::pluck('cim', 'akcio_id');
        $velemenyek = Velemeny::all();
        $foglalas = Foglalas::all();


        $maxEv = date('Y') - 1;
        $evek = range(2020, $maxEv);

        return view('AdminFelulet.Foglalasok', [

            'evek' => $evek,
            'year' => $year,
            'month' => $month,
            'isYearSelected' => $isYearSelected,
            'foglalasokEvonta' => $foglalasokEvonta,
            //'foglalasokHavonta' => $foglalasokHavonta,
            //'foglalasokOsszegHavonta' => $foglalasokOsszegHavonta,
            'vendegSzamEvonta' => $vendegSzamEvonta,
            'atlagosHosszEvonta' => $atlagosHosszEvonta,
            'csomagokST' => $csomagokST,
            'akciokST' => $akciokST,
            // 'velemenyekHavonta' => $velemenyekHavonta,
            'visszateroArany' => $visszateroArany,
            'visszateroVendegSzama' => $visszateroVendegSzama,
            'velemenyekErtekeles' => $velemenyekErtekeles,
            'osszesVendeg' => $osszesVendeg,
            'foglalasok' => $foglalasok,
            //
            'bankkartyasOsszeg' => $bankkartyasOsszeg,
            'utalasOsszeg' => $utalasOsszeg,
            // 'bankkartyasDb' => $bankkartyasDb,
            // 'utalasDb' => $utalasDb,

            'akciok' => $akciok,
            'csomagok' => $csomagok,
            'velemenyek' => $velemenyek,  // Hozzáadtam
            'foglalas' => $foglalas  // Hozzáadtam
        ]);
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
            'felnott' => 'required|integer|min:1',
            'gyerek' => 'required|integer|min:0',
            'nev' => 'required|string|max:255',
            'email' => 'required|email',
            'telefon' => 'nullable|string|max:20',
            'iranyitoszam' => 'nullable|string|max:10',
            'lakcim' => 'nullable|string|max:255',
            'specialis_keresek' => 'nullable|string',
            'csomagok' => 'nullable|array',
            'csomagok.*' => 'exists:erkezesi_csomagok,csomag_id'
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

            if (!$vendeg) {
                throw new \Exception("Vendég létrehozása sikertelen");
            }

            // Éjszakák számítása
            $checkin = Carbon::parse($validated['checkin']);
            $checkout = Carbon::parse($validated['checkout']);
            $ejszakak = $checkin->diffInDays($checkout);

            // Alapár számítása
            $felnottAr = 10000;
            $gyerekAr = 5000;
            $szallasOsszeg = ($validated['felnott'] * $felnottAr + $validated['gyerek'] * $gyerekAr) * $ejszakak;

            // Csomagok kezelése
            $csomagId = null;
            $csomagOsszeg = 0;

            if (!empty($validated['csomagok'])) {
                // Csomagok árainak lekérdezése
                $csomagok = ErkezesiCsomag::whereIn('csomag_id', $validated['csomagok'])->get();

                // Összes csomag ára
                $csomagOsszeg = $csomagok->sum('ar');

                // Az első csomag ID-ja
                $csomagId = $validated['csomagok'][0];
            }

            // Végső összeg
            $vegosszeg = $szallasOsszeg + $csomagOsszeg;

            // Foglalás létrehozása
            $foglalas = Foglalas::create([
                'vendeg_id' => $vendeg->vendeg_id,
                'erkezes' => $validated['checkin'],
                'tavozas' => $validated['checkout'],
                'felnott' => $validated['felnott'],
                'gyerek' => $validated['gyerek'],
                'osszeg' => $vegosszeg,
                'specialis_keresek' => $validated['specialis_keresek'] ?? null,
                'csomag_id' => $csomagId,
            ]);

            // További csomagok hozzárendelése (ha több van)
            if (!empty($validated['csomagok']) && count($validated['csomagok']) > 1) {
                $foglalas->csomagok()->attach(array_slice($validated['csomagok'], 1));
            }

            DB::commit();

            // Debug információk
            \Log::info('Foglalás létrehozva', [
                'foglalas_id' => $foglalas->foglalas_id,
                'osszeg' => $vegosszeg,
                'csomag_osszeg' => $csomagOsszeg,
                'csomag_id' => $csomagId,
                'tobb_csomag' => !empty($validated['csomagok']) ? count($validated['csomagok']) : 0
            ]);

            return redirect()->route('foglalas')->with('success', 'Foglalás sikeresen rögzítve! Összeg: ' . $vegosszeg . ' Ft');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Foglalási hiba', ['error' => $e->getMessage()]);
            return back()->with('error', 'Hiba történt: ' . $e->getMessage())->withInput();
        }
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

        // Csak a szállás alapárát számoljuk
        $felnottAr = 10000;
        $gyerekAr = 5000;
        $total = ($foglalas->felnott * $felnottAr + $foglalas->gyerek * $gyerekAr) * $days;

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
            'csomag_id' => 'nullable|exists:erkezesi_csomagok,csomag_id',
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

            $checkin = new \DateTime($validated['checkin']);
            $checkout = new \DateTime($validated['checkout']);
            $ejszakak = $checkin->diff($checkout)->days;

            $felnottAr = 10000;
            $gyerekAr = 5000;
            $osszeg = ($validated['felnott'] * $felnottAr + $validated['gyerek'] * $gyerekAr) * $ejszakak;

            $foglalas = Foglalas::create([
                'vendeg_id' => $vendeg->vendeg_id,
                'erkezes' => $validated['checkin'],
                'tavozas' => $validated['checkout'],
                'felnott' => $validated['felnott'],
                'gyerek' => $validated['gyerek'],
                'osszeg' => $osszeg,
                'akcio_id' => $request->akcio_id ?? null,
                'csomag_id' => $request->csomag_id ?? null,
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