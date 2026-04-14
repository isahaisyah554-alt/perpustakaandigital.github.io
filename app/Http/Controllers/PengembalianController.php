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
        $pinjaman = Pinjaman::with('book', 'user')->findOrFail($id);

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
        // 1. Cari data pinjaman
        $pinjaman = Pinjaman::findOrFail($id);

        // 2. Update data ke status pengajuan
        $pinjaman->update([
            'status' => 'pengajuan_kembali',
            'tgl_kembali' => Carbon::now(), // Catat tanggal pengembalian hari ini
            'denda' => $request->denda ?? 0, // Ambil nilai denda dari input hidden di view
        ]);

        // 3. Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->route('peminjaman-saya')
                         ->with('success', 'Permintaan pengembalian berhasil dikirim. Silahkan temui petugas untuk verifikasi buku.');
    }
}
