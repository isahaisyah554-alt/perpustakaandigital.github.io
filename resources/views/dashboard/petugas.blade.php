@extends('layout.petugas')

@section('title', 'Dashboard Petugas')

@section('page-css')
<style>
    /* Stats Grid Layout */
    .stats-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)) !important;
        gap: 25px !important;
        margin-bottom: 40px !important;
        margin-top: 10px !important;
    }

    .stat-card {
        background: white;
        padding: 30px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        gap: 20px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.02), 0 4px 6px -2px rgba(0, 0, 0, 0.01);
        border: 1px solid #f8fafc;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
    }

    .stat-card .icon {
        font-size: 28px;
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        transition: all 0.3s ease;
    }

    /* Gradient Warna untuk Icon */
    .icon-buku {
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        color: #2563eb;
    }

    .icon-user {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        color: #16a34a;
    }

    .stat-card:hover .icon {
        transform: scale(1.1) rotate(5deg);
    }

    .stat-card .value {
        display: block;
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1;
        margin-top: 4px;
    }

    .stat-card p {
        color: #64748b;
        font-size: 14px;
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Table Section */
    .table-section {
        background: white;
        padding: 35px;
        border-radius: 28px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
    }

    .header-table {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .btn-action {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 4px 14px 0 rgba(37, 99, 235, 0.3);
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(37, 99, 235, 0.4);
        color: white;
    }

    /* Table Styling */
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px; /* Kasih jarak antar baris */
    }

    th {
        text-align: left;
        padding: 16px;
        color: #94a3b8;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    td {
        padding: 20px 16px;
        background: #ffffff;
        border-top: 1px solid #f8fafc;
        border-bottom: 1px solid #f8fafc;
        color: #334155;
        font-size: 15px;
        transition: all 0.2s;
    }

    /* Rounding table rows */
    tr td:first-child { border-left: 1px solid #f8fafc; border-radius: 12px 0 0 12px; }
    tr td:last-child { border-right: 1px solid #f8fafc; border-radius: 0 12px 12px 0; }

    tr:hover td {
        background: #f8fbff;
        border-color: #e2e8f0;
    }

    .badge {
        padding: 6px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .bg-success { background: #f0fdf4; color: #16a34a; border: 1px solid #bbf7d0; }
    .bg-warning { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
    .bg-danger { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
</style>
@endsection

@section('content')
{{-- Statistik Section --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="icon icon-buku">📘</div>
        <div>
            <p>Total Koleksi Buku</p>
            <span class="value">{{ $books->count() }}</span>
        </div>
    </div>

    <div class="stat-card">
        <div class="icon icon-user">👥</div>
        <div>
            <p>Anggota Terdaftar</p>
            <span class="value">{{ $total_users ?? 0 }}</span>
        </div>
    </div>
</div>

{{-- Main Table Section --}}
<section class="table-section">
    <div class="header-table">
        <div>
            <h2 style="font-size: 20px; color: #0f172a; margin: 0; font-weight: 800; letter-spacing: -0.5px;">Daftar Buku Terbaru</h2>
            <p style="color: #94a3b8; margin: 5px 0 0; font-size: 14px;">Kelola stok dan data buku perpustakaan</p>
        </div>
        <a href="{{ route('petugas.databuku.create') }}" class="btn-action">
            <span>+</span> Tambah Buku
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                <tr>
                    <td style="font-weight: 700; color: #1e293b;">
                        {{ $book->judul }}
                    </td>
                    <td style="color: #64748b;">{{ $book->penulis }}</td>
                    <td style="font-weight: 600;">
                        <span style="color: #3b82f6;">{{ $book->stok_buku }}</span> <small style="color: #94a3b8;">Unit</small>
                    </td>
                    <td>
                        @if($book->stok_buku > 5)
                            <span class="badge bg-success">Tersedia</span>
                        @elseif($book->stok_buku > 0)
                            <span class="badge bg-warning">Stok Tipis</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 50px; color: #94a3b8;">
                        <div style="font-size: 40px; margin-bottom: 10px;">📂</div>
                        <p>Belum ada data buku yang tersedia di database.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
