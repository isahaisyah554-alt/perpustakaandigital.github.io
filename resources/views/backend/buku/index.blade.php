@extends('layout.petugas')

@section('title', 'Daftar Koleksi Buku')

@section('content')

{{-- 1. Bagian Statistik Singkat (Opsional tapi biar keren) --}}
<div class="stats-grid">
    <div class="stat-card">
        <span class="icon">📘</span>
        <div>
            <p style="color: var(--text-muted); font-size: 14px;">Total Buku di Katalog</p>
            <span class="value">{{ $books->count() }}</span>
        </div>
    </div>
</div>

{{-- 2. Bagian Tabel yang Sudah Ganteng --}}
<section class="table-section">
    <div class="header-table">
        <h2 style="font-size: 18px; color: var(--text-main);">Daftar Buku Terbaru</h2>
        <a href="/books/create" class="btn-action">+ Tambah Buku Baru</a>
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
                    <td>{{ $book->stok_buku }} Unit</td>
                    <td>
                        {{-- Logika Badge Status --}}
                        @if($book->stok_buku > 5)
                            <span class="badge bg-success">Tersedia</span>
                        @elseif($book->stok_buku > 0)
                            <span class="badge bg-warning">Stok Tipis</span>
                        @else
                            <span class="badge" style="background: #FEE2E2; color: #991B1B;">Habis</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
