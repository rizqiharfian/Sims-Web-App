<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function proses(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'Email tidak boleh kosong!',
            'email.email' => 'Format Email tidak benar!',
            'password.required' => 'Password tidak boleh kosong!',
        ]);
        if (Auth::attempt($credential)) {
            $request->session()->regenerate();

            return redirect()->route('produk');
        }
        return back()->withErrors([
            'email' => 'Autentikasi Gagal!', 
        ])->onlyInput('email');
    }

    public function keluar(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
