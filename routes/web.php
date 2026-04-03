<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/books', BookController::class);
// login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('Auth.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('Auth.login');

// register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('Auth.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('Auth.register');
Route::get('/profile.anggota', [AuthController::class, 'anggota']);

Route::get('/dashboard/anggota', function () {
    return view('dashboard.dashboard');
});
Route::get('/dashboard/petugas', function () {
    return view('Auth.books');
});
Route::get('/dashboard/kepala', function () {
    return view('dashboard.kepalaperpustakaan');
});
Route::get('/peminjaman.cari', [PeminjamanController::class, 'caribuku']);
Route::get('/peminjaman.pinjam', [PeminjamanController::class, 'peminjamanbuku']);
Route::get('/peminjaman.sukses', [PeminjamanController::class, 'pinjamansukses']);
Route::get('/peminjaman.saya', [PeminjamanController::class, 'pinjamansaya']);
Route::get('/peminjaman.riwayat', [PeminjamanController::class, 'riwayatpinjaman']);
Route::get('/pengembalian.buku', [PengembalianController::class, 'kembalikanbuku']);
Route::get('/pengembalian.done', [PengembalianController::class, 'pengembaliandone']);
Route::get('/pengembalian.terlambat', [PengembalianController::class, 'pengembalianterlambat']);
Route::get('/pengembalian.doneterlambat', [PengembalianController::class, 'doneterlambat']);

