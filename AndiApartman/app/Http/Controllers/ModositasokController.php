<?php

namespace App\Http\Controllers;

use App\Models\Akcio;
use App\Models\ErkezesiCsomag;
use App\Models\Foglalas;
use App\Models\HelyiProgramajanlo;
use Illuminate\Http\Request;

class ModositasokController extends Controller
{
    public function index()
    {


        $ErkezesiCsomag = ErkezesiCsomag::all();
        $Akcio = Akcio::all();
        $HelyiProgramajanlo = HelyiProgramajanlo::all();
        $Foglalasok = Foglalas::all();
        $Akcio = Akcio::all();
        $Csomag = ErkezesiCsomag::all();
        return view('AdminFelulet.Modositasok', compact('ErkezesiCsomag', 'Akcio', 'HelyiProgramajanlo','Foglalasok','Akcio','Csomag'));

    }

    public function showModositasok()
    {
       
        $csomagok = ErkezesiCsomag::all();
        $akciok = Akcio::all();
        $programok = HelyiProgramajanlo::all();


        return view('AdminFelulet.Modositasok', compact('ErkezesiCsomag', 'Akcio', 'HelyiProgramajanlo'));
    }
}
