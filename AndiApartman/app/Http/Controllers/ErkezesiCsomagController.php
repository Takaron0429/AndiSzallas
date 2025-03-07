<?php

namespace App\Http\Controllers;

use App\Models\ErkezesiCsomag;
use Illuminate\Http\Request;

class ErkezesiCsomagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modositasok'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'ar' => 'required|numeric|min:0',
            'leiras' => 'nullable|string',
            'elerheto' =>'required|numeric|min:0|max:10'
        ]);


        $csomag = new ErkezesiCsomag();
        $csomag->nev = $request->nev;
        $csomag->ar = $request->ar;
        $csomag->leiras = $request->leiras;
        $csomag->elerheto = $request->elerheto;
        $csomag->save();

       return redirect()->route('AdminFelulet.Modositasok')->with('success', 'Csomag sikeresen hozzáadva!');
    }

   
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'ar' => 'required|numeric|min:0',
            'leiras' => 'nullable|string',
            'elerheto' => 'required|numeric|min:0|max:0'
        ]);

        $csomag = ErkezesiCsomag::find($id);
        if (!$csomag) {
            return redirect()->route('AdminFelulet.Modositasok')->with('error', 'Csomag nem található!');
        }

        $csomag->update($validated);

        return redirect()->route('AdminFelulet.Modositasok')->with('success', 'Csomag frissítve!');
    }

    // Törlés
    public function destroy($id)
    {
        $csomag = ErkezesiCsomag::find($id);
        if (!$csomag) {
            return redirect()->route('admin.modositasok')->with('error', 'Csomag nem található!');
        }

        $csomag->delete();
        return redirect()->route('admin.modositasok')->with('success', 'Csomag törölve!');
    }
}
