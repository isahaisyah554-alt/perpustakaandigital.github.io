@extends('layout.anggota')

@section('title', 'Dashboard Anggota')

@section('page-css')
<style>
    /* 1. WELCOME CARD - Jarak ke bawah ditambah drastis */
    .welcome-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8fbff 100%) !important;
        padding: 40px !important;
        border-radius: 20px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 10px 25px -5px rgba(59, 130, 246, 0.05) !important;

        /* Paksa jarak pakai margin DAN padding luar */
        margin-bottom: 60px !important;
        display: block !important;
    }

    .welcome-text h2 {
        margin: 0;
        font-size: 2rem;
        color: #1e293b;
        font-weight: 800;
    }

    .welcome-text p {
        margin: 12px 0 0;
        color: #64748b;
        font-size: 1.1rem;
    }

    /* 2. STATS GRID - Kasih jarak atas biar makin renggang */
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
        gap: 25px !important;
        margin-top: 20px !important; /* Tambahan jarak atas */
        margin-bottom: 45px !important;
    }

    .stat-card {
        background: white;
        padding: 35px;
        border-radius: 22px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.05);
        border-color: #3B82F6;
    }

    .stat-card .label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #94a3b8;
        font-weight: 800;
        margin-bottom: 10px;
        display: block;
    }

    .stat-card h1 {
        margin: 0;
        color: #3B82F6;
        font-size: 3.5rem;
        font-weight: 800;
        line-height: 1;
    }

    .status-badge {
        background: #ecfdf5;
        color: #059669;
        padding: 8px 16px;
        border-radius: 99px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 15px;
    }

    /* 3. BOX PINJAMAN */
    .box {
        background: white;
        padding: 35px;
        border-radius: 24px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
    }

    .box h3 {
        font-size: 1.25rem;
        color: #1e293b;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
    }

    .loan-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px 0;
        border-bottom: 1px dashed #e2e8f0;
    }

    .loan-item:last-child { border-bottom: none; }

    .book-title { font-weight: 600; color: #334155; font-size: 1.05rem; }

    .loan-date {
        background: #f0f9ff;
        color: #0369a1;
        padding: 10px 18px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
    }
</style>
@endsection

@section('content')
    {{-- Section Welcome --}}
    <div class="welcome-card">
        <div class="welcome-text">
            <h2>Hai, {{ Auth::user()->name }} 👋</h2>
            <p>Selamat datang kembali. Yuk, cek aktivitas literasi kamu hari ini.</p>
        </div>
    </div>

    {{-- Section Statistik --}}
    <div class="stats-grid">
        <div class="stat-card">
            <span class="label">Total Pinjaman</span>
            <h1>{{ $jumlahDipinjam ?? 0 }}</h1>
            <p>Buku aktif di tangan Anda</p>
        </div>

        <div class="stat-card">
            <span class="label">Status Akun</span>
            <div class="status-badge">
                <span style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                AKTIF & TERVERIFIKASI
            </div>
            <p style="margin-top: 15px; font-weight: 600;">Member ID: #{{ str_pad(Auth::user()->id, 4, '0', STR_PAD_LEFT) }}</p>
        </div>
    </div>

    {{-- Section List Buku --}}
    <div class="box">
        <h3>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color: #3B82F6;"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
            Daftar Pinjaman Saat Ini
        </h3>

        @forelse($pinjamanAktif ?? [] as $pinjam)
            <div class="loan-item">
                <div class="book-title">
                    📖 {{ $pinjam->book->judul ?? 'Judul Tidak Diketahui' }}
                </div>
                <div class="loan-date">
                    📅 {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->translatedFormat('d F Y') }}
                </div>
            </div>
        @empty
            <div style="text-align: center; padding: 40px 0; color: #94a3b8;">
                <p>Wah, rak buku kamu masih kosong nih. Pinjam buku yuk!</p>
            </div>
        @endforelse
    </div>
@endsection
