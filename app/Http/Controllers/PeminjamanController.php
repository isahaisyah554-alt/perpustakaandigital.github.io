<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    // 1. Cari Buku
    public function caribuku(Request $request)
    {
        $query = $request->q;

        $books = Book::when($query, function ($q) use ($query) {
            return $q->where('judul', 'like', "%$query%")
                    ->orWhere('penulis', 'like', "%$query%");
        })->get();

        // ambil semua book_id yang sedang dipinjam user login
        $pinjamSaya = Pinjaman::where('user_id', Auth::id())
            ->whereIn('status', ['dipinjam', 'menunggu'])
            ->pluck('book_id')
            ->toArray();

        return view('peminjaman.caribuku', compact('books', 'pinjamSaya'));
    }

    // 2. Halaman Form Pinjam
    public function prosesPinjam($id)
    {
        $buku = Book::findOrFail($id);
        return view('peminjaman.peminjamanbuku', compact('buku'));
    }

    // 3. Simpan Pengajuan Pinjam (Sisi Anggota)
    public function simpan(Request $request)
{
    $request->validate([
        'book_id'    => 'required|exists:books,id',
        'tgl_pinjam' => 'required|date',
        'durasi'     => 'required|integer|min:1'
    ]);

    try {
        $userId = Auth::id();

        // 1. CEK LIMIT MAKSIMAL 2 BUKU
        $jumlahPinjam = Pinjaman::where('user_id', $userId)
            ->whereIn('status', ['menunggu', 'dipinjam', 'pengajuan_kembali'])
            ->count();

        if ($jumlahPinjam >= 2) {
            return back()->with('error', 'Gagal! Kamu sudah pinjam 2 buku. Balikin dulu ya!');
        }

        // 2. CEK APAKAH ADA BUKU YANG SEDANG DIPINJAM TAPI SUDAH TELAT (JATUH TEMPO)
        $pinjamanAktif = Pinjaman::where('user_id', $userId)
            ->where('status', 'dipinjam')
            ->get();

        foreach ($pinjamanAktif as $p) {
            $jatuhTempo = \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi);
            if (now()->gt($jatuhTempo)) {
                return back()->with('error', 'Gagal! Kamu punya buku yang terlambat dikembalikan. Balikin dulu baru boleh pinjam lagi!');
            }
        }

        // 3. CEK DENDA YANG BELUM LUNAS (Dari riwayat sebelumnya)
        $adaDenda = Pinjaman::where('user_id', $userId)
            ->where('denda', '>', 0)
            ->exists();

        if ($adaDenda) {
            return back()->with('error', 'Gagal! Kamu masih punya tunggakan denda. Bayar dulu ke petugas ya!');
        }

        // --- LANJUT PROSES SIMPAN SEPERTI BIASA ---
        $buku = Book::findOrFail($request->book_id);
        if ($buku->stok_buku < 1) {
            return back()->with('error', 'Stok buku habis!');
        }

        Pinjaman::create([
            'user_id'    => $userId,
            'book_id'    => $request->book_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'durasi'     => $request->durasi,
            'status'     => 'menunggu',
            'denda'      => 0,
        ]);

        $buku->decrement('stok_buku');

        return redirect()->route('peminjaman-saya')->with('success', 'Berhasil mengajukan pinjaman!');

    } catch (\Exception $e) {
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}

    // 4. Daftar Pinjaman Aktif
    public function pinjamanSaya()
    {
        // Pastikan relasi di model namanya 'book'
        $pinjaman = Pinjaman::with('book')
                            ->where('user_id', Auth::id())
                            ->whereIn('status', ['menunggu', 'dipinjam', 'pengajuan_kembali'])
                            ->latest()
                            ->get();

        return view('peminjaman.pinjamansaya', compact('pinjaman'));
    }

    // 5. Proses Kembalikan Buku (Lapor ke Petugas)
    public function kembalikanBuku($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku tidak dalam status bisa dikembalikan.');
        }

        $pinjaman->update([
            'status' => 'pengajuan_kembali',
            'tgl_kembali' => now()
        ]);

        return redirect()->route('peminjaman-saya')
                        ->with('success', 'Permintaan terkirim! Silakan serahkan buku ke petugas.');
    }

    // 6. Riwayat Pinjaman
    public function riwayatpinjaman()
    {
        $riwayat = Pinjaman::with('book')
                            ->where('user_id', Auth::id())
                            ->where('status', 'dikembalikan')
                            ->latest()
                            ->get();

        return view('peminjaman.riwayatpinjaman', compact('riwayat'));
    }
}
