@extends('layout.anggota')

@section('title', 'Dashboard Anggota')

@section('content')
<div class="content-body">
    {{-- Card Selamat Datang --}}
    <div class="welcome-card">
        {{-- Memanggil icon selamat datang --}}
        <img src="{{ asset('storage/image 10.png') }}" alt="icon">
        <div class="welcome-text">
            <h2>Hai, {{ Auth::user()->name }} 👋</h2>
            <p>Selamat datang kembali di dashboard perpustakaan kamu.</p>
        </div>
    </div>

    {{-- Statistik Ringkas --}}
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

    {{-- Daftar Pinjaman Aktif (Rekomendasi di bawah ini sudah DIHAPUS) --}}
    <div class="box">
        <h3>Buku Yang Sedang Dipinjam</h3>
        <div class="loan-item">
            <span>📖 Bahasa Indonesia Kelas 12</span>
            <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Apr 2026</span>
        </div>
        <div class="loan-item">
            <span>📖 Algoritma & Struktur Data</span>
            <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Apr 2026</span>
        </div>
    </div>
</div>
@endsection

@section('page-js')
<script>
    function logout() {
        if(confirm("Apakah anda yakin ingin keluar?")) {
            // Arahkan ke route logout Laravel kamu
            window.location.href = "{{ route('logout') }}";
        }
    }
</script>
@endsection
