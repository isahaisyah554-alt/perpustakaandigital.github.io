<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('backend.buku.index', compact('books'));
    }

    public function create()
    {
        return view('backend.buku.create');
    }

    public function store(Request $request)
    {
        // ✅ VALIDASI (penting biar ga error)
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
            'foto' => 'default.jpg' // sementara
        ]);

        // ✅ REDIRECT + PESAN
        return redirect('/books')->with('success', 'Data buku berhasil ditambahkan');
    }
}
