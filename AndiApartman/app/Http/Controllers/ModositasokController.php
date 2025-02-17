<?php

namespace App\Http\Controllers;

use App\Models\Akcio;
use App\Models\ErkezesiCsomag;
use App\Models\HelyiProgramajanlo;
use Illuminate\Http\Request;

class ModositasokController extends Controller
{
    public function index()
    {
       

        $ErkezesiCsomag = ErkezesiCsomag::all(); 
        $Akcio = Akcio::all(); 
        $HelyiProgramajanlo = HelyiProgramajanlo::all();
    
        return view('admin.dashboard', compact('ErkezesiCsomag', 'Akcio', 'HelyiProgramajanlo'));
    }

  public function showModositasok()
{
    // Lekérjük az adatokat a modellekből
    $csomagok = ErkezesiCsomag::all();
    $akciok = Akcio::all();
    $programok = HelyiProgramajanlo::all();

    
    return view('admin.modositasok', compact('csomagok', 'akciok', 'programok'));
}
}
