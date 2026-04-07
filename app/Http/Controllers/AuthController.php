<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Tampilkan Form Login
    public function showLoginForm()
    {
        return view('Auth.login');
    }

    // Tampilkan Form Register
    public function showRegisterForm()
    {
        return view('Auth.register');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // Cek Role dan Arahkan (Gunakan route name agar lebih aman)
            if ($user->role === 'anggota') {
                return redirect()->route('dashboard-anggota');
            } elseif ($user->role === 'petugas') {
                return redirect('/dashboard-petugas');
            } elseif ($user->role === 'kepala') {
                return redirect('/dashboard-kepala');
            }

            return "Role [ " . $user->role . " ] tidak terdaftar di sistem!";
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

   public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
            // 'username' => $request->username, // MATIKAN DULU
            // 'no_hp' => $request->no_hp,      // MATIKAN DULU
        ]);

        Auth::login($user);
        return redirect('/dashboard-anggota');
    }
}
