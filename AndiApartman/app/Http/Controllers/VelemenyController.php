<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Velemeny;
use Illuminate\Support\Facades\Auth;


class VelemenyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
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
        // Vélemények lekérése
        $velemenyek = Velemeny::latest()->get();

        // Értékelések átlagának kiszámítása
        $atlagErtekeles = $velemenyek->avg('ertekeles');

        // Adatok átadása a nézetnek
        return view('welcome', [
            'velemenyek' => $velemenyek,
            'atlagErtekeles' => $atlagErtekeles,
        ]);
    }
}