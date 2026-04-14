<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;

class PeminjamanController extends Controller
{
   // Di PeminjamanController Petugas
    public function index()
{
    // Kita ambil semua data (tanpa filter status) supaya riwayatnya tidak hilang
    $data = Pinjaman::with(['user', 'book'])
                ->latest()
                ->get();

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
        // 1. Cari data pinjaman
        $pinjam = Pinjaman::with('book')->findOrFail($id);

        // 2. Pastikan hanya data yang masih 'menunggu' yang bisa ditolak
        // (biar stok ga nambah terus kalau di-klik berkali-kali)
        if ($pinjam->status !== 'menunggu') {
            return back()->with('error', 'Data ini sudah diproses sebelumnya.');
        }

        // 3. Ubah status menjadi ditolak
        $pinjam->status = 'ditolak';
        $pinjam->save();

        // 4. KEMBALIKAN STOK BUKU (+1)
        if ($pinjam->book) {
            $pinjam->book->increment('stok_buku');
        }

        return back()->with('success', 'Pinjaman ditolak dan stok buku telah dikembalikan.');
    }
}
