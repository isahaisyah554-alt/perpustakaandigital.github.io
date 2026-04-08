<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Pinjaman;

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
        $semua_pinjaman = Pinjaman::with(['user', 'buku'])->latest()->get();

        // Tambahin data statistik ringkas
        $total_buku = Book::count();
        $total_pinjam_aktif = Pinjaman::where('status', 'dipinjam')->count();
        $total_user = \App\Models\User::where('role', 'anggota')->count();

        return view('dashboard.kepalaperpustakaan', compact(
            'semua_pinjaman',
            'total_buku',
            'total_pinjam_aktif',
            'total_user'
        ));
    }
}
