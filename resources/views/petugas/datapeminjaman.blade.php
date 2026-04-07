@extends('layout.petugas')

@section('title', 'Data Peminjaman')

@section('content')
<style>
    .container-peminjaman {
        padding: 30px;
        background-color: #F1F5F9; /* Warna background abu muda modern */
        min-height: 100vh;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .title-text {
        font-size: 24px;
        font-weight: 800;
        color: #1E293B;
        border-left: 5px solid #3B82F6;
        padding-left: 15px;
    }

    /* Card Putih untuk Tabel */
    .card-tabel {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        overflow: hidden;
    }

    /* Styling Tabel */
    .tabel-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .tabel-custom thead th {
        background: #3B82F6; /* Warna Biru Terang */
        color: #FFFFFF;
        text-align: left;
        padding: 15px 20px;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .tabel-custom tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #F1F5F9;
        color: #475569;
        font-size: 14px;
    }

    .tabel-custom tbody tr:hover {
        background-color: #F8FAFC;
    }

    /* Badge Status Warna-warni */
    .badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
    }
    .bg-tunggu { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
    .bg-pinjam { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }
    .bg-telat { background: #FEE2E2; color: #B91C1C; border: 1px solid #FECACA; }

    /* Tombol Aksi */
    .btn-group {
        display: flex;
        gap: 8px;
        justify-content: center;
    }

    .btn {
        padding: 8px 14px;
        border-radius: 8px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        font-size: 12px;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-terima { background: #10B981; color: white; }
    .btn-terima:hover { background: #059669; }

    .btn-tolak { background: #EF4444; color: white; }
    .btn-tolak:hover { background: #DC2626; }

    .btn-input {
        background: #3B82F6;
        color: white;
        padding: 10px 20px;
    }
</style>

<div class="container-peminjaman">
    <div class="header-flex">
        <h1 class="title-text">Data Peminjaman</h1>
    </div>

    <div class="card-tabel">
        <table class="tabel-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th style="text-align: center;">Konfirmasi Petugas</th>
                </tr>
            </thead>
             <tbody>
@foreach($data as $p)
<tr>
    <td><code>PMJ-{{ $p->id }}</code></td>

    <td>
        <strong>{{ $p->user->name ?? 'User Hilang' }}</strong>
        <br>
        <small class="text-muted">ID: {{ $p->user_id }}</small>
    </td>

    <td>
        <span style="color: #1E293B; font-weight: 600;">
            {{ $p->buku->judul ?? 'Buku Dihapus' }}
        </span>
        <br>
        <small class="text-muted">ID Buku: {{ $p->book_id }}</small>
    </td>

    <td>
        @if($p->status == 'menunggu')
            <span class="badge bg-tunggu">Menunggu Konfirmasi</span>
        @elseif($p->status == 'dipinjam')
            <span class="badge bg-pinjam">Sedang Dipinjam</span>
        @elseif($p->status == 'ditolak')
            <span class="badge bg-telat">Ditolak</span>
        @endif
    </td>

    <td>
        @if($p->status == 'menunggu')
        <div class="btn-group">
            <form action="{{ route('petugas.peminjaman.terima', $p->id) }}" method="POST">
                @csrf
                <button class="btn btn-terima">Terima</button>
            </form>

            <form action="{{ route('petugas.peminjaman.tolak', $p->id) }}" method="POST">
                @csrf
                <button class="btn btn-tolak">Tolak</button>
            </form>
        </div>
        @else
            <span style="color:#94A3B8;">Selesai</span>
        @endif
    </td>
</tr>
@endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
