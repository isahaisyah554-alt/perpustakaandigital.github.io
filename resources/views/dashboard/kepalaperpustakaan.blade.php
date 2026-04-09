@extends('layout.kepalaperpustakaan')

@section('title', 'Dashboard Kepala')

@section('content')
<div class="page-header">
    <h2>Laporan Transaksi Anggota</h2>
    <p style="color: var(--text-muted); font-size: 14px;">Memantau aktivitas peminjaman dan pengembalian buku.</p>
</div>

<div class="stats-grid">
    <div class="stat-card" style="border-left: 4px solid var(--primary);">
        <span>Total Buku</span>
        <h3>{{ $total_buku ?? 0 }}</h3>
    </div>
    <div class="stat-card" style="border-left: 4px solid var(--warning);">
        <span>Sedang Dipinjam</span>
        <h3>{{ $total_pinjam_aktif ?? 0 }}</h3>
    </div>
    <div class="stat-card" style="border-left: 4px solid var(--success);">
        <span>Total Anggota</span>
        <h3>{{ $total_user ?? 0 }}</h3>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <h3>Daftar Peminjaman & Pengembalian</h3>
        </div>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali / Deadline</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
    @forelse($semua_pinjaman as $p)
    <tr>
        <td>
            <div style="font-weight: 600; color: var(--text-main);">
                {{ $p->user->name ?? 'User Dihapus' }}
            </div>
            <small style="color: var(--text-muted);">ID: #{{ $p->user->id ?? '-' }}</small>
        </td>

        {{-- PERBAIKAN 1: Ganti 'buku' jadi 'book' --}}
        <td>{{ $p->book->judul ?? 'Buku Dihapus' }}</td>

        <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>

        <td>
            @if($p->status == 'dikembalikan')
                <span style="color: var(--success);">
                    {{-- Pakai tgl_kembali yang asli dari DB --}}
                    {{ $p->tgl_kembali ? \Carbon\Carbon::parse($p->tgl_kembali)->format('d/m/Y') : '-' }}
                </span>
            @else
                {{-- Hitung jatuh tempo: tgl_pinjam + durasi --}}
                <span style="color: var(--danger);">
                    {{ \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi)->format('d/m/Y') }}
                </span>
            @endif
        </td>

        <td>
            @if($p->status == 'dikembalikan')
                <span class="badge bg-success" style="background: #dcfce7; color: #15803d; padding: 5px 10px; border-radius: 6px;">Sudah Dikembalikan</span>
            @else
                <span class="badge bg-warning" style="background: #fef9c3; color: #92400e; padding: 5px 10px; border-radius: 6px;">Masih Dipinjam</span>
            @endif
        </td>
    </tr>
    @empty
    {{-- ... empty state ... --}}
    @endforelse
</tbody>
        </table>
    </div>
</div>
@endsection
