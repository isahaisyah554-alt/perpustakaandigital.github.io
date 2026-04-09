<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        // 1. Ambil data, pastikan pakai relasi 'book' sesuai di Model Pinjaman
        $pengembalian = Pinjaman::with(['user', 'book'])
                        ->whereIn('status', ['pengajuan_kembali', 'dikembalikan'])
                        ->latest()
                        ->get();

        // 2. Pastikan nama view ini SESUAI dengan folder kamu (petugas/pengembalian/index.blade.php)
        // Kalau file kamu ada di resources/views/petugas/pengembalian.blade.php, pakai 'petugas.pengembalian'
        return view('petugas.pengembalian', compact('pengembalian'));
    }

    // SISI PETUGAS - Saat klik tombol Verifikasi
    public function terima($id)
    {
        $pinjaman = Pinjaman::with('book')->findOrFail($id);

        if ($pinjaman->status == 'dikembalikan') {
            return back()->with('error', 'Data ini sudah diproses sebelumnya.');
        }

        $jatuh_tempo = Carbon::parse($pinjaman->tgl_pinjam)->addDays($pinjaman->durasi);
        $tgl_kembali = Carbon::now();
        $denda = 0;

        if ($tgl_kembali->gt($jatuh_tempo)) {
            $hari_terlambat = $jatuh_tempo->diffInDays($tgl_kembali);
            $denda = $hari_terlambat * 1000;
        }

        // UPDATE DATA PINJAMAN
        $pinjaman->status = 'dikembalikan';
        $pinjaman->tgl_kembali = $tgl_kembali;
        $pinjaman->denda = $denda;
        $pinjaman->save();

        // TAMBAH STOK BUKU (+1)
        // PERBAIKAN: Pakai 'book' (sesuai relasi di model), bukan 'buku'
        // PERBAIKAN: Pakai 'stok_buku' (sesuai nama kolom di database kamu)
        if ($pinjaman->book) {
            $pinjaman->book->increment('stok_buku');
        }

        return back()->with('success', 'Buku diterima! Stok nambah 1. Denda: Rp ' . number_format($denda,0,',','.'));
    }
}
