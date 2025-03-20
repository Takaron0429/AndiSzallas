<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Akcio;
use App\Models\AkcioFoglalas;
use App\Models\CsomagFoglalas;
use App\Models\ErkezesiCsomag;
use App\Models\Foglalas;
use DB;
use Illuminate\Http\Request;
use App\Models\Velemeny;
use Illuminate\Support\Facades\Auth;


class VelemenyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function velemenyek()
    {
        $Admin = Admin::all();
        $Foglalas = Foglalas::all();
        $akcio_ = AkcioFoglalas::all();
        $csomag_ = CsomagFoglalas::all();
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        $velemenyek = Velemeny::all();
        
        return view('AdminFelulet.Admin', compact('velemenyek', 'Admin', 'Foglalas', 'csomagok', 'akciok', 'akcio_', 'csomag_'));
    }

    public function approveVelemeny($id)
    {
        $velemeny = Velemeny::find($id);
        if ($velemeny) {
            $velemeny->approved = 1;
             $velemeny->save();

    
            return redirect()->route('AdminFelulet.Admin')->with('success', 'A vélemény jóváhagyva lett.');
        }
    
        return redirect()->route('AdminFelulet.Admin')->with('error', 'Vélemény nem található.');
    }
    public function deleteVelemeny($email)
    {
        Velemeny::where('email', $email)->delete();
        return redirect()->route('AdminFelulet.Admin')->with('success', 'A vélemény törölve lett.');
    }
    public function store(Request $request)
    {

        // Validálás
        $request->validate([
            'nev' => 'required|string|max:255', // Név validálása
            'email' => 'required|email|max:255', // Email validálása
            'ertekeles' => 'required|integer|between:1,5',
            'komment' => 'required|string|max:1000',
        ]);

        // Vélemény létrehozása
        Velemeny::create([
            'nev' => $request->nev, // Név mentése
            'email' => $request->email, // Email mentése
            'ertekeles' => $request->ertekeles,
            'komment' => $request->komment,
        ]);

        // Visszairányítás üzenettel
        return redirect()->back()->with('success', 'Köszönjük a véleményedet!');
    }
    public function index()
    {

        $velemenyek = Velemeny::latest()->get();


        $atlagErtekeles = $velemenyek->avg('ertekeles');


        return view('welcome', [
            'velemenyek' => $velemenyek,
            'atlagErtekeles' => $atlagErtekeles,
        ]);
    }
}