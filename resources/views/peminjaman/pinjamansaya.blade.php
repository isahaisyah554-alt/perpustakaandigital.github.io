@extends('layout.anggota')

@section('title', 'Pinjaman Saya')

@section('page-css')
<style>
    .section-title{
        font-weight:600;
        font-size:22px;
        color:var(--text-muted);
        margin-bottom:20px;
    }

    .loan-container{
        background:white;
        border:1px solid var(--border);
        border-radius:12px;
        padding:24px;
        box-shadow:0px 4px 10px rgba(0,0,0,0.03);
    }

    .book-item{
        display:flex;
        align-items:center;
        background:#F9FAFB;
        border:1px solid #E5E7EB;
        border-radius:10px;
        padding:16px;
        margin-bottom:16px;
        position:relative;
    }

    .book-cover{
        width:90px;
        height:120px;
        background:#D1D5DB;
        border-radius:4px;
        overflow:hidden;
    }

    .book-details{
        margin-left:16px;
        flex-grow:1;
    }

    .book-title{
        font-weight:600;
        font-size:15px;
        margin:0 0 6px 0;
    }

    .book-info{
        font-size:13px;
        color:#4B5563;
        line-height:1.6;
    }

    .id-badge{
        display:inline-block;
        background:#EFF6FF;
        color:#2563EB;
        font-size:11px;
        font-weight:700;
        padding:4px 10px;
        border-radius:20px;
        margin-bottom:8px;
        margin-right:6px;
    }

    .status-badge{
        position:absolute;
        top:16px;
        right:16px;
        padding:4px 12px;
        border-radius:20px;
        font-size:11px;
        font-weight:600;
    }

    .status-late{
        background:#FEF3C7;
        color:#D97706;
        border:1px solid #FCD34D;
    }

    .status-active{
        background:#D1FAE5;
        color:#059669;
        border:1px solid #6EE7B7;
    }

    .status-menunggu{
        background:#F3F4F6;
        color:#6B7280;
        border:1px solid #D1D5DB;
    }

    .btn-return{
        background:#10B981;
        color:white;
        border:none;
        padding:8px 16px;
        border-radius:6px;
        text-decoration:none;
        display:inline-block;
        margin-top:10px;
    }
</style>
@endsection

@section('content')

<h2 class="section-title">Sedang Dipinjam</h2>

<div class="loan-container">

@forelse($pinjaman as $item)

    @php
        $jatuhTempo = \Carbon\Carbon::parse($item->tgl_pinjam)->addDays($item->durasi);
        $hariIni = now();
        $terlambat = $jatuhTempo->startOfDay()->diffInDays($hariIni->startOfDay(), false);
    @endphp

    <div class="book-item">

        <div class="book-cover">
            @if($item->book && $item->book->foto)
                <img src="{{ asset('storage/buku/' . $item->book->foto) }}"
                     style="width:100%;height:100%;object-fit:cover;">
            @else
                No Cover
            @endif
        </div>

        <div class="book-details">

            {{-- ID Pinjam + ID Buku --}}
            <div>
                <span class="id-badge">
                    ID Pinjam: P{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}
                </span>
            </div>

            <p class="book-title">
                {{ $item->book ? $item->book->judul : 'Judul Tidak Ditemukan' }}
            </p>

            <p class="book-info">
                Dipinjam:
                {{ \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d M Y') }}
                <br>

                Batas Kembali:
                {{ $jatuhTempo->translatedFormat('d M Y') }}

                @if($item->status == 'dipinjam' && $terlambat > 0)
                    <br>
                    <span style="color:#D97706; font-weight:bold;">
                        (Terlambat {{ $terlambat }} Hari)
                    </span>
                @endif
            </p>

            @if($item->status == 'dipinjam')
                <a href="{{ route('pengembalian-buku', ['id' => $item->id]) }}"
                   class="btn-return">
                    Kembalikan Buku
                </a>
            @endif

        </div>

        <div class="status-badge
            @if($item->status == 'dipinjam')
                status-active
            @elseif($item->status == 'menunggu')
                status-menunggu
            @else
                status-late
            @endif
        ">
            @if($item->status == 'dipinjam')
                Aktif
            @elseif($item->status == 'menunggu')
                Menunggu
            @else
                Ditolak
            @endif
        </div>

    </div>

@empty

<p style="text-align:center;">Tidak ada pinjaman aktif.</p>

@endforelse

</div>

@endsection
