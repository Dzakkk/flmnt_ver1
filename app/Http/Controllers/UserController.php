<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function loginform() {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ], [
            'name.required' => 'You are not input your Username',
            'password.required' => 'Please input your Password',
        ]);

        $infologin = [
            'name' => $request->name,
            'password' => $request->password,
        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->divisi == 'operasional') {
                return redirect('/');
            } elseif (Auth::user()->divisi == 'produksi') {
                return redirect('/');
            // } elseif (Auth::user()->divisi == 'kepala_sekolah') {
            //     return redirect('kepala/dashboard');
            }
        } else {
            return redirect('/login')->withErrors('NIP atau Password anda salah')->withInput();
        }
    }

    public function user ()
    {
        return view('user.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'divisi' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'divisi' => $request->divisi,
        ]);

        return redirect('/')->with('success', 'Pegawai created successfully.');
    }

    public function userData()
    {
        $data = User::all();
        return view('user.user', compact('data'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
