<?php

namespace App\Http\Controllers\Petugas; // Sesuaikan folder

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class DatabukuController extends Controller
{
    // Tampilkan Tabel
    public function index()
    {
        $books = Book::all();
        return view('backend.buku.index', compact('books'));
    }

    // Halaman Tambah
    public function create()
    {
        return view('backend.buku.create');
    }

    // Simpan Data
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

    // Halaman Edit
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('backend.buku.create', compact('book'));
    }

    // Update Data
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'tahun_terbit' => 'required',
            'stok_buku' => 'required|integer',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $book = Book::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($book->foto && $book->foto !== 'default.jpg') {
                Storage::delete('public/buku/' . $book->foto);
            }

            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/buku', $namaFoto);
            $data['foto'] = $namaFoto;
        }

        $book->update($data);

        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil diperbarui!');
    }

    // Hapus Data
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->foto && $book->foto !== 'default.jpg') {
            Storage::delete('public/buku/' . $book->foto);
        }

        $book->delete();

        return redirect()->route('petugas.databuku')->with('success', 'Buku berhasil dihapus!');
    }
}
