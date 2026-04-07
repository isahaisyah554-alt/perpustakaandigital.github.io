<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class DatabukuController extends Controller
{
    /**
     * Menampilkan daftar semua buku
     */
    public function index()
    {
        $books = \App\Models\Book::all();
        // Alamat View tetap ke folder petugas
        return view('petugas.databuku', compact('books'));
    }

    /**
     * Menampilkan form tambah buku (Create)
     */
    public function create()
    {
        // ALAMAT VIEW DIUBAH: Sesuai folder yang kamu sebutkan tadi
        return view('backend.buku.create');
    }

    /**
     * Menyimpan buku baru ke database (Store)
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required',
            'penulis'      => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok_buku'    => 'required|numeric',
        ]);

        Book::create([
            'judul'        => $request->judul,
            'penulis'      => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku'    => $request->stok_buku,
            'foto'         => '',
        ]);

        // ALAMAT REDIRECT DIUBAH: Pakai route name agar otomatis jadi /petugas/books
        return redirect()->route('petugas.databuku')->with('success', 'Buku baru berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit buku
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        // ALAMAT VIEW DIUBAH: Sesuai folder backend/buku
        return view('backend.buku.create', compact('book'));
    }

    /**
     * Memperbarui data buku di database (Update)
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'judul'        => 'required',
            'penulis'      => 'required',
            'tahun_terbit' => 'required|numeric',
            'stok_buku'    => 'required|numeric',
        ]);

        $book->update([
            'judul'        => $request->judul,
            'penulis'      => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku'    => $request->stok_buku,
            'foto'         => $book->foto ?? '',
        ]);

        // ALAMAT REDIRECT DIUBAH: Pakai route name
        return redirect()->route('petugas.databuku')->with('success', 'Data buku berhasil diperbarui!');
    }

    /**
     * Menghapus buku (Delete)
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        // ALAMAT REDIRECT DIUBAH: Pakai route name
        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil dihapus!');
    }
}
