@extends('layout.kepalaperpustakaan')

@section('title', 'Laporan Transaksi')

@section('content')
<style>
    .report-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }
    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    .table th {
        background-color: #f8f9fa;
        color: #2d3436;
        font-weight: 700;
    }
    .badge {
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        font-weight: bold;
    }
    .bg-success  { background: #d1e7dd; color: #0f5132; }
    .bg-warning  { background: #fff3cd; color: #664d03; }
    .bg-danger   { background: #f8d7da; color: #842029; }
    .bg-info     { background: #cff4fc; color: #055160; }
    .bg-secondary{ background: #e2e3e5; color: #41464b; }
</style>

<div class="page-header">
    <h2>Laporan Transaksi Perpustakaan</h2>
    <p style="color:#636e72;">Riwayat lengkap peminjaman dan pengembalian buku.</p>
</div>

<div style="display:flex; gap:20px; margin-bottom:20px;">
    <div style="flex:1; border-left:5px solid #4e73df; padding:15px; background:#fff; border-radius:8px;">
        <small>TOTAL BUKU</small>
        <h4 style="margin:0;">{{ $total_buku }}</h4>
    </div>
    <div style="flex:1; border-left:5px solid #f6c23e; padding:15px; background:#fff; border-radius:8px;">
        <small>PINJAMAN AKTIF</small>
        <h4 style="margin:0;">{{ $total_pinjam_aktif }}</h4>
    </div>
</div>

<div class="report-card">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anggota</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semua_pinjaman as $index => $pinjam)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pinjam->user->name ?? 'User Dihapus' }}</td>
                <td>{{ $pinjam->book->judul ?? 'Buku Dihapus' }}</td>
                <td>{{ $pinjam->tgl_pinjam ? \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d/m/Y') : '-' }}</td>
                <td>{{ $pinjam->tgl_kembali ? \Carbon\Carbon::parse($pinjam->tgl_kembali)->format('d/m/Y') : '-' }}</td>
                <td>{{ $pinjam->denda > 0 ? 'Rp ' . number_format($pinjam->denda, 0, ',', '.') : '-' }}</td>
                <td>
                    @php
                        $badgeClass = match($pinjam->status) {
                            'dikembalikan'      => 'bg-success',
                            'menunggu'          => 'bg-warning',
                            'ditolak'           => 'bg-danger',
                            'pengajuan_kembali' => 'bg-info',
                            default             => 'bg-secondary',
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">
                        {{ ucfirst(str_replace('_', ' ', $pinjam->status)) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;">Belum ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
