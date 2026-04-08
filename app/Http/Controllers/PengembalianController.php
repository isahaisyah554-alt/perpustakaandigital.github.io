<?php
namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    // Halaman konfirmasi pengembalian
    public function kembalikan($id)
    {
        // GANTI 'book' jadi 'buku'
        $pinjaman = Pinjaman::with('buku', 'user')->findOrFail($id);

        // Hanya user pemilik yang boleh akses
        if ($pinjaman->user_id != Auth::id()) {
            abort(403);
        }

        // Hitung denda jika terlambat
        $jatuh_tempo = Carbon::parse($pinjaman->tgl_pinjam)->addDays($pinjaman->durasi);
        $denda = 0;
        if (Carbon::now()->gt($jatuh_tempo)) {
            $hari_terlambat = Carbon::now()->diffInDays($jatuh_tempo);
            $denda = $hari_terlambat * 2000; // misal Rp2000/hari
        }

        return view('pengembalian.kembalikanbuku', compact('pinjaman', 'denda'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->user_id != Auth::id()) {
            abort(403);
        }

        // JANGAN langsung 'dikembalikan'
        // Ubah ke 'pengajuan_kembali' supaya muncul di dashboard petugas
        $pinjaman->status = 'pengajuan_kembali';
        $pinjaman->tgl_kembali = now();
        $pinjaman->save();

        return redirect()->route('peminjaman-saya')
                        ->with('success', 'Permintaan pengembalian dikirim! Silakan temui petugas.');
    }
}
