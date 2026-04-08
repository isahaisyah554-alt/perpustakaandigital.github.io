<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {

        $pengembalian = Pinjaman::with(['user', 'buku'])->latest()->get();
        return view('petugas.pengembalian', compact('pengembalian'));
    }

    public function terima($id)
{
    try {
        $pinjaman = Pinjaman::with('buku')->findOrFail($id);

        // 1. Hitung denda
        $jatuh_tempo = Carbon::parse($pinjaman->tgl_pinjam)->addDays($pinjaman->durasi);
        $denda = 0;
        if (Carbon::now()->gt($jatuh_tempo)) {
            $hari_terlambat = Carbon::now()->diffInDays($jatuh_tempo);
            $denda = $hari_terlambat * 1000;
        }

        // 2. Update status Pinjaman (Gunakan update agar lebih cepat)
        $pinjaman->update([
            'status' => 'dikembalikan',
            'tgl_kembali' => now(),
            'denda' => $denda
        ]);

        // 3. Update Stok Buku
        if ($pinjaman->buku) {
        }

        return back()->with('success', 'Pengembalian diverifikasi! Data masuk ke riwayat anggota.');

    } catch (\Exception $e) {
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}
