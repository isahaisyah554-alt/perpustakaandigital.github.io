<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pinjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
        public function index()
    {
        // Ambil data yang statusnya 'pengajuan_kembali' (baru mau balikin)
        // atau 'dikembalikan' (riwayat yang sudah kelar)
        $pengembalian = Pinjaman::whereHas('buku')
                        ->whereIn('status', ['pengajuan_kembali', 'dikembalikan'])
                        ->with(['user', 'buku'])
                        ->latest()
                        ->get();

        return view('petugas.pengembalian', compact('pengembalian'));
    }

    // SISI PETUGAS - Saat klik tombol Verifikasi (Buku balik)
public function terima($id)
{
    $pinjaman = Pinjaman::with('buku')->findOrFail($id);

    // Mencegah stok nambah berkali-kali kalau tombol diklik ulang
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
    if ($pinjaman->buku) {
        $pinjaman->buku->increment('stok_buku');
    }

    return back()->with('success', 'Buku diterima! Stok nambah 1. Denda: Rp ' . number_format($denda,0,',','.'));
}

}




