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

        $books = Book::when($query, function($q) use ($query) {
            return $q->where('judul', 'like', "%$query%")
                     ->orWhere('penulis', 'like', "%$query%");
        })->get();

        return view('peminjaman.caribuku', compact('books'));
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
            // Ambil data buku terbaru
            $buku = Book::findOrFail($request->book_id);
            $buku->refresh(); // MEMASTIKAN stok yang dibaca adalah yang terbaru di DB

            // CEK STOK (Ganti ke < 1 biar lebih pasti)
            if ((int)$buku->stok_buku< 1) {
                return back()->with('error', 'Waduh, stok bukunya abis ditilep orang! (Stok saat ini: ' . $buku->stok_buku . ')');
            }

            // Simpan data pinjaman
            Pinjaman::create([
                'user_id'    => Auth::id(),
                'book_id'    => $request->book_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'durasi'     => $request->durasi,
                'status'     => 'menunggu',
            ]);

            // KURANGI STOK BUKU
            $buku->decrement('stok_buku');

            return redirect()->route('peminjaman-saya')
                ->with('success', 'Pengajuan berhasil! Stok buku otomatis berkurang.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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
