<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Book; // Pastikan Model Book sudah di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function caribuku(Request $request)
    {
        $query = $request->q;

        // Kalau ada pencarian, filter. Kalau nggak, ambil semua.
        $books = \App\Models\Book::when($query, function($q) use ($query) {
            return $q->where('judul', 'like', "%$query%")
                    ->orWhere('penulis', 'like', "%$query%");
        })->get();

        return view('peminjaman.caribuku', compact('books'));
    }

    public function prosesPinjam($id) // Tambahkan parameter $id
    {
        // Cari buku berdasarkan id, kalau gak ada munculin 404 (biar gak timeout)
        $buku = \App\Models\Book::findOrFail($id);

         return view('peminjaman.peminjamanbuku', compact('buku'));
    }

    public function simpan(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'book_id'    => 'required|exists:books,id',
            'tgl_pinjam' => 'required|date',
            'durasi'     => 'required|integer'
        ]);

        try {
            // 2. Simpan ke database
            Pinjaman::create([
                'user_id'    => Auth::id(),
                'book_id'    => $request->book_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'durasi'     => $request->durasi,
                'status'     => 'menunggu',
            ]);

            // 3. Redirect ke route yang benar
            return redirect()->route('peminjaman-saya')
                ->with('success', 'Pengajuan berhasil, menunggu konfirmasi petugas');

        } catch (\Exception $e) {
            // Biar gak timeout kalau database error, munculin pesannya
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function pinjamanSaya()
    {
        // Tambahkan with('buku') biar gak berat (Eager Loading)
        $pinjaman = Pinjaman::with('buku')
                            ->where('user_id', Auth::id())
                            ->latest()
                            ->get();

        return view('peminjaman.pinjamansaya', compact('pinjaman'));
    }

    public function riwayatpinjaman(Request $request)
    {
        return view('peminjaman.riwayatpinjaman');
    }
}
