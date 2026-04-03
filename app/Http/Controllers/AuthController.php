<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // 🔥 WAJIB ADA
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // 🔥 WAJIB ADA
    public function showRegisterForm()
    {
        return view('Auth.register');
    }

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'anggota') {
                return redirect('/dashboard.dashboard');
            } elseif ($user->role === 'petugas') {
                return redirect('/dashboard/petugas');
            } elseif ($user->role === 'kepala') {
                return redirect('/dashboard/kepala');
            }

            return "Role tidak dikenali";
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // REGISTER
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota'
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar!');
    }
}
