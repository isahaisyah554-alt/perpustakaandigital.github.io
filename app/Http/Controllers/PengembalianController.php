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
    $pinjaman = Pinjaman::findOrFail($id);

    // Ambil nilai denda yang dihitung di halaman Konfirmasi (dari <input name="denda">)
    $dendaInput = $request->input('denda', 0);

    // Simpan ke database
    $pinjaman->update([
        'status' => 'pengajuan_kembali',
        'tgl_kembali' => now(),
        'denda' => $dendaInput, // <--- INI KUNCINYA supaya denda tersimpan!
    ]);

    return redirect()->route('peminjaman-saya')->with('success', 'Berhasil diajukan!');
}
}
