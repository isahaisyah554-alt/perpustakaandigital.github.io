<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;

class PeminjamanController extends Controller
{
   // Menampilkan daftar seluruh data peminjaman
public function index()
{
    // Mengambil semua data pinjaman, diurutkan terbaru
    $data = Pinjaman::orderBy('created_at', 'desc')->get();

    return view('petugas.datapeminjaman', compact('data'));
}

// Menampilkan form input pinjaman baru
public function create()
{
    return view('petugas.input-pinjaman');
}

// Menerima pengajuan pinjaman
public function terima($id)
{
    // Cari data pinjaman berdasarkan ID
    $pinjam = Pinjaman::findOrFail($id);

    // Ubah status menjadi dipinjam
    $pinjam->status = 'dipinjam';
    $pinjam->save();

    return back()->with('success', 'Pinjaman diterima');
}

// Menolak pengajuan pinjaman
public function tolak($id)
{
    // Cari data pinjaman berdasarkan ID
    $pinjam = Pinjaman::findOrFail($id);

    // Ubah status menjadi ditolak
    $pinjam->status = 'ditolak';
    $pinjam->save();

    return back()->with('success', 'Pinjaman ditolak');
}
}
