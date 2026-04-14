@extends('layout.kepalaperpustakaan')

@section('title', 'Dashboard Kepala')

@section('content')
<style>
    /* Header Styling */
    .page-header {
        margin-bottom: 30px;
    }

    .page-header h2 {
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 5px;
    }

    /* Grid Layout */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }

    /* Card Styling */
    .stat-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .stat-card span {
        font-size: 0.9rem;
        text-transform: uppercase;
        font-weight: 700;
        color: #b2bec3;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .stat-card h3 {
        font-size: 2rem;
        margin: 0;
        font-weight: 800;
        color: #2d3436;
    }
</style>

<div class="page-header">
    <h2>Dashboard Kepala Perpustakaan</h2>
    <p style="color:#636e72;">Ringkasan data utama sistem hari ini</p>
</div>

<div class="stats-grid">
    <div class="stat-card" style="border-left: 5px solid #4e73df;">
        <span>Total Buku</span>
        <h3>{{ number_format($total_buku) }}</h3>
    </div>

    <div class="stat-card" style="border-left: 5px solid #f6c23e;">
        <span>Sedang Dipinjam</span>
        <h3>{{ number_format($total_pinjam_aktif) }}</h3>
    </div>

    <div class="stat-card" style="border-left: 5px solid #1cc88a;">
        <span>Total Anggota</span>
        <h3>{{ number_format($total_user) }}</h3>
    </div>
</div>
@endsection
