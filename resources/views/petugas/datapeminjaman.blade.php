@extends('layout.petugas')

@section('title', 'Data Peminjaman')

@section('content')
<style>
    .container-peminjaman {
        padding: 30px;
        background: #F1F5F9;
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

    .card-tabel {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        border: 1px solid #E2E8F0;
        overflow-x: auto;
        width: 100%;
    }

    .tabel-custom {
        width: 100%;
        min-width: 1100px; /* Disesuaikan karena kolom berkurang */
        border-collapse: collapse;
    }

    .tabel-custom thead th {
        background: #3B82F6;
        color: #FFFFFF;
        text-align: left;
        padding: 15px 20px;
        font-size: 13px;
        text-transform: uppercase;
        font-weight: 700;
        white-space: nowrap;
    }

    .tabel-custom tbody td {
        padding: 15px 20px;
        border-bottom: 1px solid #F1F5F9;
        color: #475569;
        font-size: 14px;
        vertical-align: middle;
    }

    .tabel-custom tbody tr:hover {
        background: #F8FAFC;
    }

    .badge {
        padding: 7px 14px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }

    .bg-tunggu { background: #FEF3C7; color: #92400E; border: 1px solid #FDE68A; }
    .bg-pinjam { background: #DBEAFE; color: #1E40AF; border: 1px solid #BFDBFE; }
    .bg-selesai { background: #DCFCE7; color: #15803D; border: 1px solid #BBF7D0; }

    .btn-verifikasi {
        background: #3B82F6;
        color: white;
        padding: 8px 16px;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        font-size: 12px;
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-verifikasi:hover {
        background: #2563EB;
        transform: translateY(-2px);
    }

    .text-muted {
        color: #94A3B8;
        font-size: 12px;
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
                    <th>ID Transaksi</th>
                    <th>Peminjam</th>
                    <th>Informasi Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @foreach($data as $p)
            <tr>
                <td>
                    <code style="font-weight:700; color:#2563EB;">
                    {{ 'PMJ' . str_pad($p->id, 4, '0', STR_PAD_LEFT) }}
                    </code>
                </td>

                <td>
                    <strong>{{ $p->user->name ?? 'User Hilang' }}</strong><br>
                    <small class="text-muted">ID: {{ 'AGT' . str_pad($p->user_id, 4, '0', STR_PAD_LEFT) }}</small>
                </td>

                <td>
                    <strong style="color:#1E293B;">{{ $p->book->judul ?? 'Buku Tidak Ada' }}</strong><br>
                    <small class="text-muted">Kode: {{ 'BK' . str_pad($p->book_id, 4, '0', STR_PAD_LEFT) }}</small>
                </td>

                <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}</td>

                <td style="color:#DC2626; font-weight:700;">
                    {{ \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi)->format('d/m/Y') }}
                </td>

                <td>
                    @if($p->status == 'menunggu')
                        <span class="badge bg-tunggu">Menunggu Verifikasi</span>
                    @elseif($p->status == 'dipinjam')
                        <span class="badge bg-pinjam">Aktif Dipinjam</span>
                    @elseif($p->status == 'dikembalikan')
                        <span class="badge bg-selesai">Selesai</span>
                    @endif
                </td>

                <td style="text-align: center;">
                    @if($p->status == 'menunggu')
                        <form action="{{ route('petugas.peminjaman.terima', $p->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-verifikasi">
                                ✅ Verifikasi Pinjam
                            </button>
                        </form>
                    @else
                        <span style="color:#10B981; font-weight: 700; font-size: 12px;">
                            <i class="fas fa-check-circle"></i> Terverifikasi
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
