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

    // PROSES LOGIN
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // 2. Logika: Cek apakah yang diinput itu format Email atau Username biasa
        $loginValue = $request->input('email');
        $loginType = filter_var($loginValue, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $loginValue,
            'password' => $request->password
        ];

        // 3. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 4. Redirect Sesuai Role
            if ($user->role === 'anggota') {
                return redirect()->route('dashboard-anggota');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('dashboard-petugas');
            } elseif ($user->role === 'kepala') {
                return redirect()->route('dashboard-kepala');
            }

            return redirect('/');
        }

        // 5. Jika Gagal
        return back()->withErrors([
            'email' => 'Login gagal! Username/Email atau Password salah.',
        ])->withInput();
    }

    // PROSES REGISTER (Khusus Anggota)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
            'role' => 'anggota',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard-anggota')->with('success', 'Akun berhasil dibuat!');
    }

    // PROSES LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
