<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Kepala\DataBukuController as DatabukuKepala;
use App\Http\Controllers\Kepala\DataPetugasController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\Petugas\DataAnggotaController;
use App\Http\Controllers\Petugas\DatabukuController as DatabukuPetugas;
use App\Http\Controllers\Petugas\PeminjamanController as PeminjamanPetugasController;
use App\Http\Controllers\Petugas\PengembalianController as PengembalianPetugasController;
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

// --- DASHBOARD ---
Route::get('/dashboard-anggota', [DashboardController::class, 'anggota'])->name('dashboard-anggota');
Route::get('/dashboard-petugas', [DashboardController::class, 'petugas'])->name('dashboard-petugas');
Route::get('/dashboard-kepala', [DashboardController::class, 'kepala'])->name('dashboard-kepala');

// --- PEMINJAMAN (ANGGOTA) ---
Route::get('/peminjaman-cari', [PeminjamanController::class, 'caribuku'])->name('peminjaman-cari');
Route::get('/pinjam-buku/{id}', [PeminjamanController::class, 'prosesPinjam'])->name('halaman-pinjam');
Route::post('/peminjaman-simpan', [PeminjamanController::class, 'simpan'])->name('peminjaman-simpan');
Route::get('/peminjaman-saya', [PeminjamanController::class, 'pinjamanSaya'])->name('peminjaman-saya');
Route::get('/peminjaman-riwayat', [PeminjamanController::class, 'riwayatpinjaman'])->name('peminjaman-riwayat');

// --- PENGEMBALIAN (SISI ANGGOTA) ---
// Halaman untuk melihat detail sebelum konfirmasi
Route::get('pengembalian-buku/{id}', [PengembalianController::class, 'kembalikan'])->name('pengembalian-buku');
// Tombol konfirmasi yang mengubah status jadi 'pengajuan_kembali'
Route::post('pengembalian-konfirmasi/{id}', [PengembalianController::class, 'konfirmasi'])->name('konfirmasi-pengembalian');

// --- PETUGAS AREA ---
Route::prefix('petugas')->group(function () {

    // DATA BUKU
    Route::get('/books', [DatabukuPetugas::class, 'index'])->name('petugas.databuku');
    Route::get('/books/create', [DatabukuPetugas::class, 'create'])->name('petugas.databuku.create');
    Route::post('/books/store', [DatabukuPetugas::class, 'store'])->name('petugas.databuku.store');
    Route::get('/books/edit/{id}', [DatabukuPetugas::class, 'edit'])->name('petugas.databuku.edit');
    Route::put('/books/update/{id}', [DatabukuPetugas::class, 'update'])->name('petugas.databuku.update');
    Route::delete('/books/delete/{id}', [DatabukuPetugas::class, 'destroy'])->name('petugas.databuku.destroy');
    // Data Anggota
    Route::get('/anggota', [DataAnggotaController::class, 'index'])
        ->name('petugas.anggota');

    // PEMINJAMAN (KONFIRMASI PINJAM BARU)
    Route::get('/peminjaman', [PeminjamanPetugasController::class, 'index'])->name('petugas.peminjaman.index');
    Route::post('/peminjaman/{id}/terima', [PeminjamanPetugasController::class, 'terima'])->name('petugas.peminjaman.terima');
    Route::post('/peminjaman/{id}/tolak', [PeminjamanPetugasController::class, 'tolak'])->name('petugas.peminjaman.tolak');

    // PENGEMBALIAN (VERIFIKASI BUKU KEMBALI)
    Route::get('/pengembalian', [PengembalianPetugasController::class, 'index'])->name('petugas.pengembalian.index');

    // 🔥 TAMBAHKAN INI: Route untuk tombol "Terima & Verifikasi" di tabel petugas
    Route::post('/pengembalian/{id}/terima', [PengembalianPetugasController::class, 'terima'])->name('petugas.pengembalian.terima');
});


// --- KEPALA PERPUSTAKAAN AREA ---
Route::prefix('kepala')->group(function () {
    Route::get('/books', [DatabukuKepala::class, 'index'])->name('kepala.databuku.index');

    // --- BAGIAN PETUGAS ---
    Route::get('/petugas', [DataPetugasController::class, 'index'])->name('kepala.petugas');

    // 1. DAFTARKAN 'CREATE' DULU (Sebelum yang ada {id})
    Route::get('/petugas/create', [DataPetugasController::class, 'create'])->name('kepala.petugas.create');
    Route::post('/petugas', [DataPetugasController::class, 'store'])->name('kepala.petugas.store');

    // 2. BARU DAFTARKAN YANG PAKAI {id}
    Route::get('/petugas/{id}', [DataPetugasController::class, 'show'])->name('kepala.petugas.show');
    Route::delete('/petugas/{id}', [DataPetugasController::class, 'destroy'])->name('kepala.petugas.destroy');
});

