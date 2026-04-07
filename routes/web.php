<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Petugas\DatabukuController;
use App\Http\Controllers\Petugas\PeminjamanController as PeminjamanPetugasController;
use Illuminate\Support\Facades\Route;

// --- HALAMAN AWAL ---
Route::get('/', function () {
    return view('welcome');
});

// --- AUTH (LOGIN & REGISTER) ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- DASHBOARD (BEBAS AKSES) ---
Route::get('/dashboard-anggota', function () {
    return view('dashboard.anggota');
})->name('dashboard-anggota');

Route::get('/dashboard-petugas', [DashboardController::class, 'petugas'])->name('dashboard-petugas');

Route::get('/dashboard-kepala', function () {
    return view('dashboard.kepalaperpustakaan');
})->name('dashboard-kepala');

// --- PEMINJAMAN (ANGGOTA) ---
Route::get('/peminjaman-cari', [PeminjamanController::class, 'caribuku'])->name('peminjaman-cari');
Route::get('/pinjam-buku/{id}', [PeminjamanController::class, 'prosesPinjam'])->name('halaman-pinjam');
Route::post('/peminjaman-simpan', [PeminjamanController::class, 'simpan'])->name('peminjaman-simpan');
Route::get('/peminjaman-saya', [PeminjamanController::class, 'pinjamanSaya'])->name('peminjaman-saya');
Route::get('/peminjaman-riwayat', [PeminjamanController::class, 'riwayatpinjaman'])->name('peminjaman-riwayat');

// --- PENGEMBALIAN ---
Route::get('pengembalian-buku/{id}', [PengembalianController::class, 'kembalikan'])->name('pengembalian-buku');
Route::post('pengembalian-buku/{id}', [PengembalianController::class, 'konfirmasi'])->name('konfirmasi-pengembalian');

// --- PETUGAS AREA (BEBAS AKSES) ---
Route::prefix('petugas')->group(function () {
    Route::get('/books', [DatabukuController::class, 'index'])->name('petugas.databuku');
    Route::get('/books/create', [DatabukuController::class, 'create'])->name('petugas.databuku.create');
    Route::post('/books/store', [DatabukuController::class, 'store'])->name('petugas.databuku.store');
    Route::get('/books/edit/{id}', [DatabukuController::class, 'edit'])->name('petugas.databuku.edit');
    Route::put('/books/update/{id}', [DatabukuController::class, 'update'])->name('petugas.databuku.update');
    Route::delete('/books/delete/{id}', [DatabukuController::class, 'destroy'])->name('petugas.databuku.destroy');
    Route::get('/peminjaman', [PeminjamanPetugasController::class, 'index'])->name('petugas.peminjaman.index');
    Route::post('/peminjaman/{id}/terima', [PeminjamanPetugasController::class, 'terima'])->name('petugas.peminjaman.terima');
    Route::post('/peminjaman/{id}/tolak', [PeminjamanPetugasController::class, 'tolak'])->name('petugas.peminjaman.tolak');
});
