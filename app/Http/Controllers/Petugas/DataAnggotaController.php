<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\User;

class DataAnggotaController extends Controller
{
    public function index()
    {
        // ambil hanya user role anggota
        $anggota = User::where('role', 'anggota')->get();

        return view('petugas.dataanggota', compact('anggota'));
    }
}
