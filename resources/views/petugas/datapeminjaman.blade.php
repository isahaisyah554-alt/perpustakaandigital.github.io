@extends('layout.petugas')

@section('title', 'Data Peminjaman')

@section('content')
<style>
    .container-peminjaman{
        padding:30px;
        background:#F1F5F9;
        min-height:100vh;
        font-family:'Inter','Segoe UI',sans-serif;
    }

    .header-flex{
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:25px;
    }

    .title-text{
        font-size:24px;
        font-weight:800;
        color:#1E293B;
        border-left:5px solid #3B82F6;
        padding-left:15px;
    }

    .card-tabel{
        background:#FFFFFF;
        border-radius:12px;
        box-shadow:0 4px 15px rgba(0,0,0,0.05);
        border:1px solid #E2E8F0;
        overflow-x:auto;   /* penting */
        width:100%;
    }

    .tabel-custom{
        width:100%;
        min-width:1400px; /* tabel dilebarin */
        border-collapse:collapse;
    }

    .tabel-custom thead th{
        background:#3B82F6;
        color:#FFFFFF;
        text-align:left;
        padding:15px 20px;
        font-size:13px;
        text-transform:uppercase;
        font-weight:700;
        white-space:nowrap;
    }

    .tabel-custom tbody td{
        padding:15px 20px;
        border-bottom:1px solid #F1F5F9;
        color:#475569;
        font-size:14px;
        vertical-align:middle;
        white-space:nowrap;
    }

    .tabel-custom tbody tr:hover{
        background:#F8FAFC;
    }

    .badge{
        padding:7px 14px;
        border-radius:50px;
        font-size:11px;
        font-weight:700;
        display:inline-block;
        white-space:nowrap;
    }

    .bg-tunggu{ background:#FEF3C7; color:#92400E; border:1px solid #FDE68A; }
    .bg-pinjam{ background:#DBEAFE; color:#1E40AF; border:1px solid #BFDBFE; }
    .bg-telat{ background:#FEE2E2; color:#B91C1C; border:1px solid #FECACA; }
    .bg-selesai{ background:#DCFCE7; color:#15803D; border:1px solid #BBF7D0; }

    .btn-group{
        display:flex;
        gap:8px;
        justify-content:center;
    }

    .btn{
        padding:8px 14px;
        border:none;
        border-radius:8px;
        font-weight:700;
        cursor:pointer;
        font-size:12px;
    }

    .btn-terima{ background:#10B981; color:white; }
    .btn-terima:hover{ background:#059669; }

    .btn-tolak{ background:#EF4444; color:white; }
    .btn-tolak:hover{ background:#DC2626; }

    .text-muted{
        color:#94A3B8;
        font-size:12px;
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
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Konfirmasi Petugas</th>
                </tr>
            </thead>

            <tbody>
            @foreach($data as $p)
            <tr>

                <td><code>PMJ-{{ $p->id }}</code></td>

                <td>
                    <strong>{{ $p->user->name ?? 'User Hilang' }}</strong><br>
                    <small class="text-muted">ID User: {{ $p->user_id }}</small>
                </td>

                <td>
                    <strong style="color:#1E293B;">
                        {{ $p->book->judul ?? 'Buku Dihapus/Tidak Ada' }}
                    </strong><br>
                    <small class="text-muted">ID Buku: {{ $p->book_id }}</small>
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}
                </td>

                <td style="color:#DC2626; font-weight:700;">
                    {{ \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi)->format('d/m/Y') }}
                </td>

                <td>
                    @if($p->status == 'menunggu')
                        <span class="badge bg-tunggu">Menunggu Konfirmasi</span>

                    @elseif($p->status == 'dipinjam')
                        <span class="badge bg-pinjam">Sedang Dipinjam</span>

                    @elseif($p->status == 'ditolak')
                        <span class="badge bg-telat">Ditolak</span>

                    @elseif($p->status == 'dikembalikan')
                        <span class="badge bg-selesai">Sudah Kembali</span>
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
                        <span style="color:#94A3B8; font-size:12px;">✔️ Terverifikasi</span>
                    @endif
                </td>

            </tr>
            @endforeach
            </tbody>

        </table>

    </div>

</div>
@endsection
