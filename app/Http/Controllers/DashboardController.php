<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Pinjaman;

class DashboardController extends Controller
{
    // --- DASHBOARD ANGGOTA ---
    public function anggota()
    {
        // Ambil data pinjaman aktif saja
        $pinjamanAktif = \App\Models\Pinjaman::where('user_id', auth()->id())
                            ->where('status', 'dipinjam')
                            ->with('book')
                            ->get();

        $jumlahDipinjam = $pinjamanAktif->count();
        return view('dashboard.anggota', compact('pinjamanAktif', 'jumlahDipinjam'));
    }
    // --- DASHBOARD PETUGAS ---
    public function petugas()
    {
        // Ambil semua data buku
        $books = \App\Models\Book::all();

        // Ambil jumlah user dengan role anggota biar card-nya isi data real
        $total_users = \App\Models\User::where('role', 'anggota')->count();

        // Kirim kedua datanya ke view
        return view('dashboard.petugas', compact('books', 'total_users'));
    }
    // --- DASHBOARD KEPALA PERPUSTAKAAN ---
public function kepala()
{
    return view('dashboard.kepalaperpustakaan', [
        'total_buku'         => Book::count(),
        'total_pinjam_aktif' => Pinjaman::where('status','menunggu')->count(),
        'total_user'         => User::count(),
    ]);
}

public function laporan()
{
    return view('kepala.laporan', [
        'semua_pinjaman'     => Pinjaman::with(['user','book'])->get(),
        'total_buku'         => Book::count(),
        'total_pinjam_aktif' => Pinjaman::where('status','menunggu')->count(),
        'total_user'         => User::count(),
    ]);
}
}
