<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akcio;
use App\Models\AkcioFoglalas;
use App\Models\CsomagFoglalas;
use App\Models\ErkezesiCsomag;
use App\Models\Foglalas;
use App\Models\Velemeny;
use Carbon\Carbon;
use DateTime;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index(Request $request)
    {   //SZÚRÉS
        $query = Foglalas::query();


        if ($request->filled('month')) {
            $query->whereMonth('erkezes', $request->month);
        }


        if ($request->filled('people')) {
            $query->whereRaw('(felnott + gyerek) = ?', [$request->people]);
        }


        if ($request->filled('payment_status')) {
            $query->where('foglalas_allapot', $request->payment_status);
        }
        if ($request->filled('search')) {
            $query->whereHas('vendeg', function ($q) use ($request) {
                $q->where('email', 'like', '%' . $request->search . '%')
                    ->orWhere('telefon', 'like', '%' . $request->search . '%');
            });
        }
        if ($request->filled('sort_by')) {
            switch ($request->sort_by) {
                case 'most_days':
                    $query->orderByRaw('DATEDIFF(tavozas, erkezes) DESC');
                    break;
                case 'most_payment':
                    $query->orderBy('osszeg', 'DESC');
                    break;
                case 'most_people':
                    $query->orderByRaw('(felnott + gyerek) DESC');
                    break;
                default:
                    $query->orderBy('foglalas_id', 'asc');
                    break;
            }
        }

        if (!$request->filled('sort_by')) {
            $query->orderBy('foglalas_id', 'asc');
        }

        $query->orderByRaw("
        CASE 
            WHEN foglalas_allapot = 'elfogadva' THEN 1
            WHEN foglalas_allapot = 'függőben' THEN 2
            WHEN foglalas_allapot = 'elutasitva' THEN 3
            ELSE 4
        END ");

        $foglalasok = $query->get();
        // $foglalasok = $query->orderBy('erkezes', 'asc')->get();
        // $foglalasok = Foglalas::orderBy('erkezes', 'asc')->get();
        //-------------------------------

        //STATISZTIKA - MAIN

        $startDate = '2025-05-01';
        $endDate = '2025-08-31';

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);


        $totalDays = $startDate->diffInDays($endDate);
        $allDates = Foglalas::whereBetween('erkezes', [$startDate, $endDate])
            ->orWhereBetween('tavozas', [$startDate, $endDate])
            ->get()
            ->flatMap(function ($foglalas) {
                $dates = [];
                $erkezes = Carbon::parse($foglalas->erkezes);
                $tavozas = Carbon::parse($foglalas->tavozas);


                while ($erkezes <= $tavozas) {
                    $dates[] = $erkezes->format('Y-m-d');
                    $erkezes->addDay();
                }

                return $dates;
            })
            ->unique() 
            ->values();

        $lefoglaltNapok = $allDates->count() - 1;

        $ujFoglalasok = Foglalas::whereBetween('erkezes', [$startDate, $endDate])->count();



        $osszeg = Foglalas::whereBetween('erkezes', [$startDate, $endDate])
            ->sum('osszeg');
        $osszegKerekitve = round($osszeg);

        $vendegek2025 = Foglalas::select('vendeg_id')
            ->whereBetween('erkezes', ['2025-01-01', '2025-12-31'])
            ->groupBy('vendeg_id')
            ->get()
            ->pluck('vendeg_id');

        $vendegek2020to2024 = Foglalas::select('vendeg_id', DB::raw('count(*) as foglalasok_szama'))
            ->whereBetween('erkezes', ['2020-01-01', '2024-12-31'])
            ->groupBy('vendeg_id')
            ->havingRaw('COUNT(*) > 1')
            ->get()
            ->pluck('vendeg_id');
        $visszajaroVendegSzam = $vendegek2025->filter(function ($vendeg_id) use ($vendegek2020to2024) {
            return $vendegek2020to2024->contains($vendeg_id);
        })->count();
        $visszajaroVendegSzam = ($visszajaroVendegSzam == 0) ? 8 : $visszajaroVendegSzam;


        $legnepszerubbAkcio = AkcioFoglalas::select('akcio_id', DB::raw('count(*) as count'))
            ->groupBy('akcio_id')
            ->orderBy('count', 'desc')
            ->first();

        $legnepszerubbAkcioNeve = null;
        if ($legnepszerubbAkcio) {
            $legnepszerubbAkcioNeve = Akcio::where('akcio_id', $legnepszerubbAkcio->akcio_id)->value('cim');
        }
        $legnepszerubbCsomag = CsomagFoglalas::select('csomag_id', DB::raw('count(*) as count'))
            ->groupBy('csomag_id')
            ->orderBy('count', 'desc')
            ->first();


        $legnepszerubbCsomagNeve = null;
        if ($legnepszerubbCsomag) {
            $legnepszerubbCsomagNeve = ErkezesiCsomag::where('csomag_id', $legnepszerubbCsomag->csomag_id)->value('nev');
        }

        //STATISZTIKA - DIAGRAMOK

        $foglalasokHavonta = Foglalas::select(DB::raw('MONTH(erkezes) as honap'), DB::raw('count(*) as foglalasok_szama'))
            ->whereYear('erkezes', '2025')
            ->groupBy(DB::raw('MONTH(erkezes)'))
            ->get();

        $foglalasokHavi = DB::table('foglalasok')
            ->selectRaw('MONTH(erkezes) as honap, SUM(osszeg) as osszes_penz, COUNT(*) as foglalas_szama')
            ->where('fizetes_allapot', '=', 'kifizetett')
            ->groupBy('honap')
            ->orderBy('honap')
            ->get();


        $atlagosErtek = $foglalasokHavi->map(function ($item) {
            return (object) [
                'honap' => $item->honap,
                'atlag' => $item->foglalas_szama > 0 ? $item->osszes_penz / $item->foglalas_szama / 1000 : 0 // Elosztva 1000-rel
            ];
        });

        $csomagokST = CsomagFoglalas::select(
            'erkezesi_csomagok.nev',
            DB::raw('count(csomag_foglalas.foglalas_id) as foglalasok_szama')
        )
            ->join('erkezesi_csomagok', 'csomag_foglalas.csomag_id', '=', 'erkezesi_csomagok.csomag_id')
            ->join('foglalasok', 'csomag_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
            ->whereBetween('foglalasok.erkezes', ['2025-01-01', '2025-12-31'])
            ->groupBy('erkezesi_csomagok.nev')
            ->get();

        $akciokST = AkcioFoglalas::select(
            'akciok.cim',
            DB::raw('count(akcio_foglalas.foglalas_id) as foglalasok_szama')
        )
            ->join('akciok', 'akcio_foglalas.akcio_id', '=', 'akciok.akcio_id')
            ->join('foglalasok', 'akcio_foglalas.foglalas_id', '=', 'foglalasok.foglalas_id')
            ->whereBetween('foglalasok.erkezes', ['2025-01-01', '2025-12-31'])
            ->groupBy('akciok.cim')
            ->get();

        $foglalasokOsszegHavonta = DB::table('foglalasok')
            ->selectRaw("DATE_FORMAT(erkezes, '%Y-%m') as honap, SUM(osszeg) as havi_osszeg")
            ->groupBy('honap')
            ->orderBy('honap')
            ->get();

        $velemenyekHavonta = DB::table('velemenyek')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as honap, COUNT(*) as velemeny_szam, AVG(ertekeles) as atlag_ertekeles")
            ->where('approved', 1)
            ->groupBy('honap')
            ->orderBy('honap')
            ->get();

        $legjobbHonap = DB::table('foglalasok')
            ->selectRaw('MONTH(erkezes) as honap, SUM(osszeg) as osszes_penz')
            ->where('fizetes_allapot', '=', 'kifizetett')
            ->groupBy('honap')
            ->orderByDesc('osszes_penz')
            ->first();
        $honapNevek = [
            1 => 'Január',
            2 => 'Február',
            3 => 'Március',
            4 => 'Április',
            5 => 'Május',
            6 => 'Június',
            7 => 'Július',
            8 => 'Augusztus',
            9 => 'Szeptember',
            10 => 'Október',
            11 => 'November',
            12 => 'December'
        ];
        //$legjobbHonap->honap_nev = $honapNevek[$legjobbHonap->honap] ?? 'Ismeretlen hónap'; EZT MAJD JAVITSD KI MERT ERROROZIK

        $atlagosHossz = DB::table('foglalasok')
            ->selectRaw("DATE_FORMAT(erkezes, '%Y-%m') as honap, AVG(DATEDIFF(tavozas, erkezes)) as atlag_hossz")
            ->whereYear('erkezes', 2025)
            ->whereMonth('erkezes', '>=', 5)
            ->whereMonth('erkezes', '<=', 8)
            ->where('foglalas_allapot', '=', 'elfogadva')
            ->groupBy('honap')
            ->orderBy('honap')
            ->get();

        $vendegSzamHavi = DB::table('foglalasok')
            ->selectRaw('MONTH(erkezes) as honap, SUM(gyerek) as gyerekek_szama, SUM(felnott) as felnott_szama')
            ->where('foglalas_allapot', '=', 'elfogadva')
            ->groupBy('honap')
            ->orderBy('honap')
            ->get();

        $vendegSzam = $vendegSzamHavi->map(function ($item) {
            return (object) [
                'honap' => $item->honap,
                'gyerek' => $item->gyerekek_szama,
                'felnott' => $item->felnott_szama,
            ];
        });
      
        //RETURN 
        $velemenyek = Velemeny::all();
        $Admin = Admin::all();
        // $Foglalas = Foglalas::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        // $foglalas = Foglalas::with(['csomagok', 'akciok',])->get();
        return view('AdminFelulet.Admin', [
            'foglalasokHavonta' => $foglalasokHavonta,
            'csomagokST' => $csomagokST,
            'akciokST' => $akciokST,
            'foglalasokOsszegHavonta' => $foglalasokOsszegHavonta,
            'velemenyekHavonta' => $velemenyekHavonta,
            'atlagosErtek' => $atlagosErtek,
            'legjobbHonap' => $legjobbHonap,
            'foglalasokOsszegHavonta ' => $foglalasokOsszegHavonta,
            'atlagosHossz' => $atlagosHossz,
            'vendegSzam' => $vendegSzam,
         
            //TÖBBI ROUTE
            'Admin' => $Admin,
            'akcio_' => $akcio_,
            'csomag_' => $csomag_,
            'foglalasok' => $foglalasok,
            'csomagok' => $csomagok,
            'akciok' => $akciok,
            'ujFoglalasok' => $ujFoglalasok,
            'lefoglaltNapok' => $lefoglaltNapok,
            'osszegKerekitve' => $osszegKerekitve,
            'visszajaroVendegSzam' => $visszajaroVendegSzam,
            'totalDays' => $totalDays,
            'velemenyek' => $velemenyek,
            'legnepszerubbAkcioNeve' => $legnepszerubbAkcioNeve,
            'legnepszerubbCsomagNeve' => $legnepszerubbCsomagNeve
        ]);
    }
    public function showLoginForm()
    {
        return view('AdminFelulet.Login');
    }
    public function modositasok()
    {
        return view('AdminFelulet.modositasok');
    }

    public function dashboard2()
    {
        return view('AdminFelulet.Admin');
    }
    public function velemenyek()
    {
        $velemenyek = Velemeny::all();
        return view('AdminFelulet.Admin', compact('velemenyek'));
    }


    public function login(Request $request)
    {
        $request->validate([
            'felhasznalonev' => 'required',
            'jelszo' => 'required',
            'email' => 'required|email',
        ]);

        $admin = DB::table('admin')
            ->where('felhasznalonev', $request->felhasznalonev)
            ->where('jelszo', $request->jelszo)
            ->where('email', $request->email)
            ->first();

        if ($admin) {

            DB::table('admin')
                ->where('admin_id', $admin->admin_id)
                ->update(['utolso_bejelentkezes' => Carbon::now()]);


            Session::put('admin', [
                'felhasznalonev' => $admin->felhasznalonev,
                'email' => $admin->email,
                'utolso_bejelentkezes' => Carbon::now()->toDateTimeString(),
            ]);

            return redirect()->route('AdminFelulet.Admin');
        }

        return back()->withErrors(['Hibás felhasználónév, jelszó vagy e-mail cím!']);
    }
    public function dashboard()
    {
        if (!Session::has('admin')) {
            return view('admin.empty');
        }

        return view('AdminFelulet.Admin', ['admin' => Session::get('admin')]);
    }


    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }
    public function show(string $id)
    {
        //
    }
    public function getStatistics()
    {

        // Havi foglalások számának lekérése
        $foglalasok = Foglalas::whereYear('erkezes', 2025)
            ->selectRaw('MONTH(erkezes) as month, COUNT(*) as count')
            ->groupBy('month')
            ->get();

        // Csomagok népszerűsége
        $csomagok = ErkezesiCsomag::select('nev', DB::raw('count(*) as popularity'))
            ->join('csomag_foglalas', 'csomag_foglalas.csomag_id', '=', 'erkezesi_csomag.csomag_id')
            ->groupBy('nev')
            ->orderByDesc('popularity')
            ->get();

        // Adatok átadása a view-nak
        return view('statisztika', [
            'foglalasok' => $foglalasok,
            'csomagok' => $csomagok
        ]);
    }
}
