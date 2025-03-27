<?php

namespace App\Http\Controllers;

use App\Models\ErkezesiCsomag;
use App\Models\HelyiProgramajanlo;
use Illuminate\Http\Request;

class HelyiProgramajanloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.modositasok'); 
    }
    public function Pindex()
    {
        $nextEvent = HelyiProgramajanlo::where('kezdet', '>=', \Carbon\Carbon::now())
        ->orderBy('kezdet', 'asc')
        ->first();
        $programok = HelyiProgramajanlo::orderBy('helyszin')->get()->groupBy('helyszin');

        return view('Fooldal.Programok', compact('programok','nextEvent'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validálás
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'helyszin' => 'required|string|max:255',
            'kezdet' => 'required|date',
            'vege' => 'required|date',
            'leiras' => 'nullable|string',
            'link' => 'nullable|string',
            'kep' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $kepPath = $request->file('kep')->store('programok', 'public');
        $program = new HelyiProgramajanlo();
        $program->cim = $request->cim;
        $program->helyszin = $request->helyszin;
        $program->kezdet = $request->kezdet;
        $program->vege = $request->vege;
        $program->leiras = $request->leiras;
        $program->link = $request->link;
        $program->kep = $kepPath;
        $program->save();

        return redirect()->route('AdminFelulet.Modositasok')->with('success', 'Program sikeresen hozzáadva!');
    }

    // Update Program
    public function update(Request $request, $id)
    {
      
        $validated = $request->validate([
            'cim' => 'required|string|max:255',
            'helyszin' => 'required|string|max:255',
            'kezdet' => 'required|date',
            'vege' => 'required|date',
            'leiras' => 'nullable|string',
            'link' => 'nullable|string',
            'kep' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        ]);

        $program = HelyiProgramajanlo::find($id);
        if (!$program) {
            return redirect()->route('AdminFelulet.Modositasok')->with('error', 'Program nem található!');
        }

        if ($request->hasFile('kep')) {
            \Storage::delete('public/' . $program->kep);
            $kepPath = $request->file('kep')->store('programok', 'public');
            $program->kep = $kepPath;
        }

       
        $program->update($validated);

        return redirect()->route('AdminFelulet.Modositasok')->with('success', 'Program frissítve!');
    }

    public function destroy($id)
    {
        $program = HelyiProgramajanlo::find($id);
        if (!$program) {
            return redirect()->route('admin.modositasok')->with('error', 'Program nem található!');
        }

        \Storage::delete('public/' . $program->kep);

        $program->delete();
        return redirect()->route('admin.modositasok')->with('success', 'Program törölve!');
    }
}
