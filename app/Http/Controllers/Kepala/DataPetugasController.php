<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DataPetugasController extends Controller
{
    public function index() {
        $petugas = User::where('role', 'petugas')->get();
        return view('backend.petugas.index', compact('petugas'));
    }

    public function create() {
        return view('backend.petugas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('kepala.petugas')->with('success', 'Petugas berhasil ditambah!');
    }

    public function show($id) {
        $petugas = User::findOrFail($id);
        return view('backend.petugas.show', compact('petugas'));
    }

    public function destroy($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('kepala.petugas')->with('success', 'Petugas berhasil dihapus!');
    }
}
