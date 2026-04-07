@extends('layout.anggota')

@section('title', 'Dashboard Anggota')

@section('page-css')
<style>
    
    .welcome-card {
        display: flex !important;
        align-items: center !important;
        background: white !important;
        padding: 28px !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05) !important;
        margin-bottom: 24px !important;
    }
    .welcome-card img { width: 70px; height: 70px; margin-right: 24px; object-fit: contain; }

    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
        gap: 20px !important;
        margin-bottom: 32px !important;
    }
    .stat-card {
        background: white;
        padding: 24px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid transparent;
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-4px); border-color: var(--primary); }
    .stat-card h1 { margin: 0; color: var(--primary); font-size: 2.5rem; }
    .stat-card p { margin: 8px 0 0; font-weight: 500; color: var(--text-muted); }

    .box { background: white; padding: 24px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); margin-bottom: 32px; }
    .loan-item { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px solid #F3F4F6; }

    .books-scroll { display: flex; gap: 20px; overflow-x: auto; padding-bottom: 15px; }
    .book-item { min-width: 150px; text-align: center; }
    .book-item img { width: 100%; height: 210px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-bottom: 12px; }
    .book-item p { font-size: 0.9rem; font-weight: 600; margin: 0; color: var(--text-main); }
</style>
@endsection

@section('content')
    <div class="welcome-card">
    {{-- PENTING: Cek apakah file ini beneran ada di public/storage/image 10.png --}}
    <img src="{{ asset('') }}" alt="icon">
    <div class="welcome-text">
        <h2>Hai, Angelica 👋</h2>
        <p>Selamat datang kembali di dashboard perpustakaan kamu.</p>
    </div>
</div>

    <div class="stats-grid">
        <div class="stat-card">
            <h1>2</h1>
            <p>Buku Dipinjam</p>
        </div>
        <div class="stat-card">
            <h1>0</h1>
            <p>Jatuh Tempo</p>
        </div>
        <div class="stat-card">
            <h1>0</h1>
            <p>Terlambat</p>
        </div>
    </div>

    <div class="box">
        <h3 style="margin-top: 0;">Buku Yang Sedang Dipinjam</h3>
        <div class="loan-item">
            <span>📖 Bahasa Indonesia Kelas 12</span>
            <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Feb 2026</span>
        </div>
        <div class="loan-item">
            <span>📖 Algoritma & Struktur Data</span>
            <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Feb 2026</span>
        </div>
    </div>

    <h3 style="margin-bottom: 20px;">Rekomendasi Buku</h3>
    <div class="books-scroll">
        <div class="book-item">
            <img src="{{ asset('storage/bukuu.png') }}" alt="Buku">
            <p>Bandung After Rain</p>
        </div>
        <div class="book-item">
            <img src="{{ asset('storage/Rectangle 36 (1).png') }}" alt="Buku">
            <p>Rumah Alie</p>
        </div>
        <div class="book-item">
            <img src="{{ asset('storage/Rectangle 36 (2).png') }}" alt="Buku">
            <p>Lost At Sea</p>
        </div>
        <div class="book-item">
            <img src="{{ asset('storage/Rectangle 36 (3).png') }}" alt="Buku">
            <p>Modul Ajar Matematika</p>
        </div>
    </div>
@endsection
