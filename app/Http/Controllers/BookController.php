<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA
    public function index()
    {
        $books = Book::all();
        return view('backend.buku.index', compact('books'));
    }

    // 2. TAMPILKAN HALAMAN TAMBAH
    public function create()
    {
        return view('backend.buku.create');
    }

    // 3. SIMPAN DATA BARU
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok_buku' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $namaFoto = 'default.jpg';

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/buku', $namaFoto);
        }

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'tahun_terbit' => $request->tahun_terbit,
            'stok_buku' => $request->stok_buku,
            'foto' => $namaFoto,
        ]);

        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil ditambahkan!');
    }

    // 4. HALAMAN EDIT
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('backend.buku.create', compact('book')); // Pakai view yang sama dengan create
    }

    // 5. UPDATE DATA
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'stok_buku' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $book = Book::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika bukan default.jpg
            if ($book->foto && $book->foto !== 'default.jpg') {
                Storage::delete('public/buku/' . $book->foto);
            }

            // Upload foto baru
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/buku', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $book->update($data);

        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil diperbarui!');
    }

    // 6. HAPUS DATA
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Hapus file foto dari folder storage
        if ($book->foto && $book->foto !== 'default.jpg') {
            Storage::delete('public/buku/' . $book->foto);
        }

        $book->delete();

        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil dihapus!');
    }
}
