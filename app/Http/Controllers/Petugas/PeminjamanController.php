<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Pinjaman::orderBy('created_at', 'desc')->get();

        return view('petugas.datapeminjaman', compact('data'));
        // Eager loading supaya nggak lemot dan data relasi terbawa
        $data = Pinjaman::with(['user', 'buku'])->orderBy('created_at', 'desc')->get();

        return view('petugas.peminjaman.index', compact('data'));
    }

    public function create()
    {
        return view('petugas.input-pinjaman');
    }

        public function terima($id)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->status = 'dipinjam';
        $pinjam->save();

        return back()->with('success', 'Pinjaman diterima');
    }

    public function tolak($id)
    {
        $pinjam = Pinjaman::findOrFail($id);
        $pinjam->status = 'ditolak';
        $pinjam->save();

        return back()->with('success', 'Pinjaman ditolak');
    }
}
