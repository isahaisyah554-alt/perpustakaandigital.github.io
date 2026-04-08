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

    // 3. Simpan Pengajuan Pinjam
    public function simpan(Request $request)
    {
        $request->validate([
            'book_id'    => 'required|exists:books,id',
            'tgl_pinjam' => 'required|date',
            'durasi'     => 'required|integer'
        ]);

        try {
            Pinjaman::create([
                'user_id'    => Auth::id(),
                'book_id'    => $request->book_id,
                'tgl_pinjam' => $request->tgl_pinjam,
                'durasi'     => $request->durasi,
                'status'     => 'menunggu', // Status awal
            ]);

            return redirect()->route('peminjaman-saya')
                ->with('success', 'Pengajuan berhasil, menunggu konfirmasi petugas');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // 4. Daftar Pinjaman Aktif (Sedang dipinjam/menunggu)
    public function pinjamanSaya()
    {
        $pinjaman = Pinjaman::with('buku')
                            ->where('user_id', Auth::id())
                            ->whereIn('status', ['menunggu', 'dipinjam', 'pengajuan_kembali']) // Tampilkan yang belum selesai
                            ->latest()
                            ->get();

        return view('peminjaman.pinjamansaya', compact('pinjaman'));
    }

    // app/Http/Controllers/PeminjamanController.php (Sisi Anggota)

    public function kembalikanBuku($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        if ($pinjaman->status !== 'dipinjam') {
            return back()->with('error', 'Buku tidak dalam status bisa dikembalikan.');
        }

        // Pakai update untuk memastikan tersimpan
        $pinjaman->update([
            'status' => 'pengajuan_kembali',
            'tgl_kembali' => now() // Set tanggal lapor sekarang
        ]);

        return redirect()->route('peminjaman-saya')
                        ->with('success', 'Permintaan terkirim! Silakan serahkan buku ke petugas.');
    }

    // app/Http/Controllers/PeminjamanController.php

    public function riwayatpinjaman()
    {
        // Mengambil data yang statusnya sudah FINAL 'dikembalikan'
        $riwayat = Pinjaman::with('buku')
                            ->where('user_id', \Illuminate\Support\Facades\Auth::id())
                            ->where('status', 'dikembalikan')
                            ->latest()
                            ->get();

        return view('peminjaman.riwayatpinjaman', compact('riwayat'));
    }
}
