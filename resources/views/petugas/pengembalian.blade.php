@extends('layout.petugas')

@section('title', 'Data Pengembalian')

@section('content')
<style>
    .container-pengembalian {
        padding: 30px;
        background-color: #F1F5F9;
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
        border-left: 5px solid #10B981; /* Warna hijau untuk pengembalian */
        padding-left: 15px;
    }

    .card-tabel {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
        overflow: hidden;
    }

    .tabel-custom {
        width: 100%;
        border-collapse: collapse;
    }

    .tabel-custom thead th {
        background: #10B981; /* Header Hijau */
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

    /* Badge Status */
    .badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }
    .bg-proses { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; } /* Menunggu Verifikasi */
    .bg-selesai { background: #D1FAE5; color: #065F46; border: 1px solid #A7F3D0; } /* Sudah Kembali */
    .bg-denda { background: #FEE2E2; color: #B91C1C; border: 1px solid #FECACA; } /* Terlambat */

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

    .btn-verifikasi { background: #10B981; color: white; }
    .btn-verifikasi:hover { background: #059669; }

    .text-denda {
        color: #EF4444;
        font-weight: bold;
    }
</style>

<div class="container-pengembalian">
    <div class="header-flex">
        <h1 class="title-text">Data Pengembalian Buku</h1>
    </div>

    <div class="card-tabel">
        <table class="tabel-custom">
            <thead>
                <tr>
                    <th>ID Pinjam</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th style="text-align: center;">Konfirmasi Petugas</th>
                </tr>
            </thead>

            <tbody>
    @foreach($pengembalian as $p) {{-- Diubah dari $data ke $pengembalian --}}
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
        </td>

        <td>
            {{-- Menggunakan tgl_kembali sesuai database atau perkiraan --}}
            {{ $p->tgl_kembali ? \Carbon\Carbon::parse($p->tgl_kembali)->format('d M Y') : '-' }}
        </td>

        <td>
            @if($p->denda > 0)
                <span class="text-denda">Rp {{ number_format($p->denda, 0, ',', '.') }}</span>
            @else
                <span style="color: #64748B;">-</span>
            @endif
        </td>

        <td>
            {{-- Sesuaikan dengan status 'pengajuan_kembali' dari Controller --}}
            @if($p->status == 'pengajuan_kembali')
                <span class="badge bg-proses">Menunggu Verifikasi</span>
            @elseif($p->status == 'dikembalikan')
                <span class="badge bg-selesai">Sudah Kembali</span>
            @endif
        </td>

        <td align="center">
            @if($p->status == 'pengajuan_kembali')
            <div class="btn-group">
                {{-- Sesuaikan route dengan petugas.pengembalian.terima --}}
                <form action="{{ route('petugas.pengembalian.terima', $p->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-verifikasi" onclick="return confirm('Konfirmasi pengembalian buku ini?')">
                        Terima & Verifikasi
                    </button>
                </form>
            </div>
            @else
                <span style="color:#94A3B8;">✔️ Terverifikasi</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
        </table>
    </div>
</div>
@endsection
