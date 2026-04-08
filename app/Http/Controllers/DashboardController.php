<?php

namespace App\Http\Controllers;

use App\Models\Book;

class DashboardController extends Controller
{
    // --- DASHBOARD ANGGOTA ---
    public function anggota()
    {
        // Mengambil semua data buku agar bisa tampil di halaman anggota
        $books = Book::all();

        // Pastikan file ini ada di: resources/views/dashboard/anggota.blade.php
        return view('dashboard.anggota', compact('books'));
    }

    // --- DASHBOARD PETUGAS ---
    public function petugas()
    {
        // Petugas juga butuh lihat data buku (untuk edit/hapus)
        $books = Book::all();

        // Pastikan file ini ada di: resources/views/dashboard/petugas.blade.php
        return view('dashboard.petugas', compact('books'));
    }

    // --- DASHBOARD KEPALA PERPUSTAKAAN ---
    public function kepala()
    {
        // Biasanya kepala hanya melihat laporan, kita arahkan ke view-nya
        // Pastikan file ini ada di: resources/views/dashboard/kepalaperpustakaan.blade.php
        return view('dashboard.kepalaperpustakaan');
    }
}
