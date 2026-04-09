@extends('layout.anggota')

@section('title', 'Riwayat Pinjaman')

@section('page-css')
<style>
    .page-header {
        margin-bottom: 30px;
        padding-bottom: 10px;
        border-bottom: 1px solid var(--border);
    }

    .page-header h2 {
        font-weight: 700;
        font-size: 24px;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .table-area {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table thead tr {
        background: #f8fafc;
    }

    .history-table th {
        color: #64748b;
        font-weight: 600;
        font-size: 13px;
        text-align: left;
        padding: 15px 20px;
        text-transform: uppercase;
    }

    .history-table td {
        padding: 15px 20px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #334155;
    }

    .book-cell {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cover-img {
        width: 35px;
        height: 50px;
        background: #e2e8f0;
        border-radius: 4px;
        overflow: hidden;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        display: inline-block;
    }

    .badge.late {
        background: #fee2e2;
        color: #b91c1c;
    }

    .badge.returned {
        background: #dcfce7;
        color: #15803d;
    }

    .badge.pending {
        background: #fef9c3;
        color: #92400e;
    }

    .text-denda {
        font-weight: 700;
        color: #ef4444;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h2>Riwayat Pinjaman</h2>
    <p style="color: #64748b; font-size: 14px;">
        Daftar buku yang telah selesai Anda pinjam dan dikembalikan.
    </p>
</div>

<section class="table-area">
    <table class="history-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Denda</th>
            </tr>
        </thead>

        <tbody>
    @forelse($riwayat as $key => $r)
    <tr>
        <td>{{ $key + 1 }}</td>

        <td>
            <div class="book-cell">
                <div class="cover-img">
                    {{-- GANTI: $r->buku jadi $r->book --}}
                    @if($r->book && $r->book->foto)
                        <img src="{{ asset('storage/' . $r->book->foto) }}"
                             style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="font-size:10px; text-align:center; padding-top:15px;">No Img</div>
                    @endif
                </div>
                {{-- GANTI: $r->buku jadi $r->book --}}
                <span>{{ $r->book->judul ?? 'Judul Tidak Ditemukan' }}</span>
            </div>
        </td>

        <td>
            {{ \Carbon\Carbon::parse($r->tgl_pinjam)->translatedFormat('d M Y') }}
        </td>

        <td>
            {{ $r->tgl_kembali
                ? \Carbon\Carbon::parse($r->tgl_kembali)->translatedFormat('d M Y')
                : '-' }}
        </td>

        {{-- ... sisanya (status & denda) sudah benar logikanya ... --}}
        <td>
            @php
                $jatuh_tempo = \Carbon\Carbon::parse($r->tgl_pinjam)->addDays($r->durasi);
            @endphp
            @if($r->tgl_kembali)
                @if(\Carbon\Carbon::parse($r->tgl_kembali)->gt($jatuh_tempo))
                    <span class="badge late">Terlambat</span>
                @else
                    <span class="badge returned">Tepat Waktu</span>
                @endif
            @else
                <span class="badge pending">Proses</span>
            @endif
        </td>

        <td>
            @if($r->denda > 0)
                <span class="text-denda">Rp {{ number_format($r->denda, 0, ',', '.') }}</span>
            @else
                <span style="color:#94a3b8;">0</span>
            @endif
        </td>
    </tr>
    @empty
    @endforelse
</tbody>
    </table>
</section>
@endsection
