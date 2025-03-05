<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Foglalas;
use DB;
use Hash;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index()
    {
        $Admin = Admin::all();
        $Foglalas = Foglalas::all();

        return view('AdminFelulet.Admin', compact('Admin', 'Foglalas'));
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

    public function login(Request $request)
    {
        $request->validate([
            'felhasznalonev' => 'required',
            'jelszo' => 'required',
            'email' => 'required|email',
        ]);
    
        $admin = DB::table('admin')
            ->where('felhasznalonev', $request->felhasznalonev)
            ->where('jelszo', $request->jelszo) // Ezt jobb lenne hash-elni!
            ->where('email', $request->email)
            ->first();
    
        if ($admin) {
            // Beállítjuk a session-ben a bejelentkezett admin adatait
            Session::put('admin', [
                'felhasznalonev' => $admin->felhasznalonev,
                'email' => $admin->email,
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
