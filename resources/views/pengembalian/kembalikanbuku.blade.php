@extends('layout.full')

@section('title', 'Konfirmasi Pengembalian')

@section('page-css')
<style>
    .breadcrumb { font-size: 14px; color: var(--text-muted); margin-bottom: 20px; }
    .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }

    .btn-back {
        text-decoration: none; color: var(--text-main); font-size: 18px;
        width: 40px; height: 40px; border: 1px solid var(--border);
        display: flex; align-items: center; justify-content: center; border-radius: 8px; background: white;
    }

    .card-detail {
        background: white; border: 1px solid var(--border); border-radius: 16px;
        padding: 30px; display: flex; gap: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .book-cover {
        width: 130px; height: 180px; background: #3B82F6; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;
    }

    .info-row { display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #F3F4F6; }
    .info-row:last-child { border-bottom: none; }
    .label { color: var(--text-muted); font-size: 14px; }
    .value { font-weight: 600; }

    /* ACTION BUTTONS */
    .action-group {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;
    }

    .btn {
        width: 100%; max-width: 400px; height: 50px; border-radius: 10px;
        font-weight: 600; border: none; cursor: pointer; transition: 0.2s;
        display: flex; align-items: center; justify-content: center; text-decoration: none;
    }
    .btn-confirm { background: #34C759; color: white; }
    .btn-cancel { background: #F3F4F6; color: var(--text-muted); }
</style>
@endsection

@section('content')
<div class="breadcrumb">Pinjaman Saya / <strong>Kembalikan Buku</strong></div>

<div class="page-header">
    <a href="{{ route('peminjaman-saya') }}" class="btn-back">←</a>
    <div>
        <h2 style="font-size: 24px; font-weight: 700;">Konfirmasi Pengembalian</h2>
        <p style="color: var(--text-muted); font-size: 14px;">Pastikan kondisi buku masih bagus ya!</p>
    </div>
</div>

<div class="card-detail">
    <div class="book-cover">
        @if($pinjaman->book && $pinjaman->book->cover)
            <img src="{{ asset('storage/' . $pinjaman->book->cover) }}" alt="Cover Buku" style="width:100%; height:100%; border-radius:8px;">
        @else
            BUKU
        @endif
    </div>
    <div style="flex-grow: 1;">
        <div class="info-row"><span class="label">Judul</span> <span class="value">{{ $pinjaman->book->judul ?? 'Judul Buku' }}</span></div>
        <div class="info-row"><span class="label">Peminjam</span> <span class="value">{{ $pinjaman->user->name ?? 'Nama User' }}</span></div>
        <div class="info-row">
            <span class="label">Jatuh Tempo</span>
            <span class="value" style="color: #3B82F6;">
                {{ \Carbon\Carbon::parse($pinjaman->tgl_pinjam)->addDays($pinjaman->durasi)->translatedFormat('d M Y') }}
            </span>
        </div>
        @if($denda > 0)
            <div class="info-row">
                <span class="label">Denda</span>
                <span class="value" style="color: #D97706;">Rp {{ number_format($denda,0,',','.') }}</span>
            </div>
        @endif
    </div>
</div>

<div class="action-group">
    <form action="{{ route('konfirmasi-pengembalian', $pinjaman->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-confirm">Konfirmasi Pengembalian</button>
    </form>
    <a href="{{ route('peminjaman-saya') }}" class="btn btn-cancel">Batal</a>
</div>
@endsection
