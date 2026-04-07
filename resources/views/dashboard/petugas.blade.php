@extends('layout.petugas')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <span class="icon">📘</span>
        <div>
            <p style="color: var(--text-muted); font-size: 14px;">Total Koleksi Buku</p>
            <span class="value">{{ $books->count() }}</span>
        </div>
    </div>
    <div class="stat-card">
        <span class="icon">⏳</span>
        <div>
            <p style="color: var(--text-muted); font-size: 14px;">Pinjaman Aktif</p>
            <span class="value">2,891</span>
        </div>
    </div>
</div>

<section class="table-section">
    <div class="header-table">
        <h2 style="font-size: 18px; color: var(--text-main);">Daftar Buku Terbaru</h2>
        <a href="{{ route('petugas.databuku.create') }}" class="btn-action">+ Tambah Buku Baru</a>
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
                @foreach ($books as $book)
                <tr>
                    <td style="font-weight: 600;">{{ $book->judul }}</td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->stok_buku }} unit</td>
                    <td>
                        @if($book->stok_buku > 5)
                            <span class="badge bg-success">Tersedia</span>
                        @else
                            <span class="badge bg-warning">Stok Tipis</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
