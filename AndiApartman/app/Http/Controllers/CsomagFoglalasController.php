<?php

namespace App\Http\Controllers;

use App\Models\CsomagFoglalas;
use App\Models\Foglalas;
use Illuminate\Http\Request;

class CsomagFoglalasController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'foglalas_id' => 'required|exists:foglalasok,foglalas_id',
            'csomag_id' => 'required|exists:erkezesi_csomagok,csomag_id'
        ]);

        // Csak a kapcsolatot hozzuk létre, nem csökkentjük az elérhetőséget
        CsomagFoglalas::create($validated);

        return back()->with('success', 'Csomag sikeresen hozzáadva a foglaláshoz!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($foglalas_id, $csomag_id)
    {
        $csomagFoglalas = CsomagFoglalas::where([
            'foglalas_id' => $foglalas_id,
            'csomag_id' => $csomag_id
        ])->first();

        if ($csomagFoglalas) {
            $csomagFoglalas->delete();
            return back()->with('success', 'Csomag eltávolítva a foglalásból!');
        }

        return back()->with('error', 'Csomag nem található a foglalásban!');
    }
}