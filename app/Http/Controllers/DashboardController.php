<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DashboardController extends Controller
{
    // 👩 DASHBOARD ANGGOTA
    public function anggota()
    {
        $books = Book::all();
        return view('dashboard.anggota', compact('books'));
    }

    // 👮 DASHBOARD PETUGAS
    public function petugas()
    {
        $books = Book::all();
        return view('dashboard.petugas', compact('books'));
    }
}
