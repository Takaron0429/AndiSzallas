<?php

namespace App\Http\Controllers;

use App\Models\HelyiProgramajanlo;

class WelcomeController extends Controller
{
    public function index()
    {
        // CSAK programajánlók betöltése
        $programok = HelyiProgramajanlo::where('vege', '>=', now())
            ->orderBy('helyszin')
            ->get()
            ->groupBy('helyszin');
            
        return view('welcome', [
            'programok' => $programok
        ]);
    }
}