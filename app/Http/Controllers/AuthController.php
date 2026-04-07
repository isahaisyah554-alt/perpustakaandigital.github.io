<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

    // PROSES LOGIN (Untuk Anggota, Petugas, Kepala)
    public function login(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => 'required', // Bisa email atau username tergantung setting, tapi di sini kita pakai email
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        // 2. Coba Login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // 3. Redirect Sesuai Role (Gunakan Route Name yang ada di web.php kamu)
            if ($user->role === 'anggota') {
                return redirect()->route('dashboard-anggota');
            } elseif ($user->role === 'petugas') {
                return redirect()->route('dashboard-petugas');
            } elseif ($user->role === 'kepala') {
                return redirect()->route('dashboard-kepala');
            }

            // Jika role tidak dikenali
            Auth::logout();
            return back()->withErrors(['email' => 'Role user tidak dikenali!']);
        }

        // 4. Jika Gagal
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    // PROSES REGISTER (Hanya untuk Anggota)
    public function register(Request $request)
    {
        // 1. Validasi semua input dari form register kamu
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:6',
        ]);

        // 2. Simpan ke Database
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password), // Password WAJIB di-hash!
            'role' => 'anggota', // Default saat register adalah anggota
        ]);

        // 3. Langsung Login setelah register
        Auth::login($user);

        // 4. Lempar ke dashboard anggota
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
