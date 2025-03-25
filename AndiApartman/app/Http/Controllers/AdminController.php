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
        //STATISZTIKA
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
            ->unique() // Eltávolítja a duplikált napokat mert nem voltunk képesek megcsinálni
            ->values(); // Átalakítja az egyedi napokat listává

        $lefoglaltNapok = $allDates->count()-1;
        
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
        //RETURN 
        $velemenyek = Velemeny::all();
        $Admin = Admin::all();
        // $Foglalas = Foglalas::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        // $foglalas = Foglalas::with(['csomagok', 'akciok',])->get();
        return view('AdminFelulet.Admin', compact(
            'Admin',
            'akcio_',
            'csomag_',
            'foglalasok',
            'csomagok',
            'akciok',
            'ujFoglalasok',
            'lefoglaltNapok',
            'osszegKerekitve',
            'visszajaroVendegSzam',
            'totalDays',
            'velemenyek',
            'legnepszerubbAkcioNeve',
            'legnepszerubbCsomagNeve'
        ));
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
}
