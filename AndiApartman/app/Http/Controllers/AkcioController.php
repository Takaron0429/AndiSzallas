<?php

namespace App\Http\Controllers;

use App\Models\Akcio;
use Illuminate\Http\Request;

class AkcioController extends Controller
{
    
    public function store(Request $request)
    {
     
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'kedvezmeny' => 'required|numeric|min:0|max:100',
            'leiras' => 'nullable|string',
            'kezdete' => 'required|date',
            'vege' => 'required|date',
        ]);

     
        $akcio = new Akcio();
        $akcio->nev = $request->nev;
        $akcio->kedvezmeny = $request->kedvezmeny;
        $akcio->leiras = $request->leiras;
        $akcio->kezdete = $request->kezdete;
        $akcio->vege = $request->vege;
        $akcio->save();

        return redirect()->route('admin.modositasok')->with('success', 'Akció sikeresen hozzáadva!');
    }


    public function update(Request $request, $id)
    {
      
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'kedvezmeny' => 'required|numeric|min:0|max:100',
            'leiras' => 'nullable|string',
            'kezdete' => 'required|date',
            'vege' => 'required|date',
        ]);

    
        $akcio = Akcio::find($id);
        if (!$akcio) {
            return redirect()->route('admin.modositasok')->with('error', 'Akció nem található!');
        }

        $akcio->update($validated);

        return redirect()->route('admin.modositasok')->with('success', 'Akció frissítve!');
    }

    public function destroy($id)
    {
        $akcio = Akcio::find($id);
        if (!$akcio) {
            return redirect()->route('admin.modositasok')->with('error', 'Akció nem található!');
        }

        $akcio->delete();
        return redirect()->route('admin.modositasok')->with('success', 'Akció törölve!');
    }
}
