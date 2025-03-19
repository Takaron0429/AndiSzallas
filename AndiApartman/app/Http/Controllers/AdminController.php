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
    {
        $query = Foglalas::query();

        // Hónap szűrés
        if ($request->filled('month')) {
            $query->whereMonth('erkezes', $request->month);
        }

        // Emberek száma szűrés (Felnőttek + Gyerekek)
        if ($request->filled('people')) {
            $query->whereRaw('(felnott + gyerek) = ?', [$request->people]);
        }

        // Legtöbb napot tartó foglalás
        if ($request->filled('most_days') && $request->most_days == '1') {
            $query->orderByRaw('DATEDIFF(tavozas, erkezes) DESC');
        }

        // Fizetés állapota szűrés
        if ($request->filled('payment_status')) {
            $query->where('fizetes_allapot', $request->payment_status);
        }

        // Email címre vagy telefonszámra keresés
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('vendeg->email', 'like', '%' . $request->search . '%')
                    ->orWhere('vendeg->telefon', 'like', '%' . $request->search . '%');
            });
        }

      
        $foglalasok = $query->get();

      

        $startDate = '2025-05-01';
        $endDate = '2025-08-31';

        $ujFoglalasok = Foglalas::whereBetween('erkezes', [$startDate, $endDate])->count();

        $lefoglaltNapok = Foglalas::whereBetween('erkezes', [$startDate, $endDate])
            ->sum(DB::raw('DATEDIFF(tavozas, erkezes)'));

        $osszeg = Foglalas::whereBetween('erkezes', [$startDate, $endDate])
            ->sum('osszeg');
        $osszegKerekitve = round($osszeg);


        $visszajaroVendegSzam = Foglalas::select('vendeg_id')
            ->whereBetween('erkezes', [$startDate, $endDate])
            ->groupBy('vendeg_id')
            ->havingRaw('COUNT(vendeg_id) > 1')
            ->count();


        $totalDays = (new \DateTime($endDate))->diff(new \DateTime($startDate))->days;

        $Admin = Admin::all();
        $Foglalas = Foglalas::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
       // $foglalas = Foglalas::with(['csomagok', 'akciok',])->get();
        return view('AdminFelulet.Admin', compact('Admin', 'Foglalas','akcio_','csomag_',  'foglalasok','csomagok', 'akciok', 'ujFoglalasok', 'lefoglaltNapok', 'osszegKerekitve', 'visszajaroVendegSzam', 'totalDays'));

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
