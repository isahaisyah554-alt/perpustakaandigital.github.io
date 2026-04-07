<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        // Ambil semua data (jamak = books)
        $books = Book::all();

        // Kirim ke view, namanya HARUS SAMA dengan variabel di atas ('books')
        return view('backend.buku.index', compact('books'));
    }

    public function create()
    {
        return view('backend.buku.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDASI
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'stok_buku' => 'required|integer'
        ]);

        // ✅ SIMPAN DATA
        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'stok_buku' => $request->stok_buku,
            'foto' => 'default.jpg'
        ]);

        // ✅ REDIRECT
        return redirect('/books')->with('success', 'Data buku berhasil ditambahkan');
    }
}
