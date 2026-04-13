<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataPetugasController extends Controller
{
        // Menampilkan daftar petugas
    public function index() {
        $petugas = User::where('role', 'petugas')->get();
        return view('backend.petugas.index', compact('petugas'));
    }

    // Menampilkan form tambah petugas
    public function create() {
        return view('backend.petugas.create');
    }

    // Menyimpan data petugas baru
    public function store(Request $request) {

        // Validasi input
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        // Simpan ke database
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
            'role' => 'petugas'
        ]);

        // Kembali ke halaman petugas
        return redirect()->route('kepala.petugas')->with('success', 'Petugas berhasil ditambah!');
    }

    // Menampilkan detail petugas
    public function show($id) {
        $petugas = User::findOrFail($id);
        return view('backend.petugas.show', compact('petugas'));
    }

    // Menghapus data petugas
    public function destroy($id) {
        User::findOrFail($id)->delete();

        return redirect()->route('kepala.petugas')->with('success', 'Petugas berhasil dihapus!');
    }
}
