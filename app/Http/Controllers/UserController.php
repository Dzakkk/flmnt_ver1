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

        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->divisi == 'operasional') {
                return redirect('/activity');
            } elseif (Auth::user()->divisi == 'produksi') {
                return redirect('/activity');
            // } elseif (Auth::user()->divisi == 'kepala_sekolah') {
            //     return redirect('kepala/dashboard');
            }
        } else {
            return redirect('/')->withErrors('nama atau Password anda salah')->withInput();
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
        return redirect('/');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect('data/user')->with('error', '404 data not found');
        }
        $user->delete();
        return redirect('data/user');
    }
}
