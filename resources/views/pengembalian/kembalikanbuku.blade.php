@extends('layout.full')

@section('title', 'Konfirmasi Pengembalian')

@section('page-css')
<style>
    .breadcrumb { font-size: 14px; color: #6B7280; margin-bottom: 20px; }
    .page-header { display: flex; align-items: center; gap: 15px; margin-bottom: 30px; }

    .btn-back {
        text-decoration: none; color: #374151; font-size: 18px;
        width: 40px; height: 40px; border: 1px solid #E5E7EB;
        display: flex; align-items: center; justify-content: center; border-radius: 8px; background: white;
    }

    .card-detail {
        background: white; border: 1px solid #E5E7EB; border-radius: 16px;
        padding: 30px; display: flex; gap: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }

    .book-cover {
        width: 140px; height: 200px; background: #F3F4F6; border-radius: 8px;
        display: flex; align-items: center; justify-content: center; overflow: hidden;
        border: 1px solid #E5E7EB;
    }

    .info-row { display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #F3F4F6; }
    .info-row:last-child { border-bottom: none; }
    .label { color: #6B7280; font-size: 14px; }
    .value { font-weight: 600; color: #111827; }

    .action-group { margin-top: 40px; display: flex; flex-direction: column; gap: 12px; align-items: center; }
    .btn {
        width: 100%; max-width: 400px; height: 50px; border-radius: 10px;
        font-weight: 600; border: none; cursor: pointer; transition: 0.2s;
        display: flex; align-items: center; justify-content: center; text-decoration: none;
    }
    .btn-confirm { background: #10B981; color: white; }
    .btn-confirm:hover { background: #059669; }
    .btn-cancel { background: #F3F4F6; color: #6B7280; }
</style>
@endsection

@section('content')
<div class="breadcrumb">Pinjaman Saya / <strong>Kembalikan Buku</strong></div>

<div class="page-header">
    <a href="{{ route('peminjaman-saya') }}" class="btn-back">←</a>
    <div>
        <h2 style="font-size: 24px; font-weight: 700;">Konfirmasi Pengembalian</h2>
        <p style="color: #6B7280; font-size: 14px;">Pastikan buku dalam kondisi baik saat dikembalikan.</p>
    </div>
</div>

@if($pinjaman)
    @php
        // SINKRONISASI NAMA RELASI (Gunakan 'buku' sesuai di halaman daftar)
        $buku = $pinjaman->buku;

        // LOGIKA DENDA
        $tglPinjam = \Carbon\Carbon::parse($pinjaman->tgl_pinjam);
        $durasi = (int)$pinjaman->durasi;
        $tglJatuhTempo = $tglPinjam->copy()->addDays($durasi);
        $hariIni = \Carbon\Carbon::now();

        $isTerlambat = $hariIni->gt($tglJatuhTempo);
        $jumlahHariTerlambat = $isTerlambat ? (int)$hariIni->diffInDays($tglJatuhTempo) : 0;
        $totalDenda = $jumlahHariTerlambat * 1000;
    @endphp

<div class="card-detail">
    <div class="book-cover">
        @if($buku && $buku->cover)
            <img src="{{ asset('storage/' . $buku->cover) }}" alt="Cover" style="width:100%; height:100%; object-fit: cover;">
        @else
            <span style="color: #9CA3AF;">NO COVER</span>
        @endif
    </div>

    <div style="flex-grow: 1;">
        <div class="info-row">
            <span class="label">Judul Buku</span>
            <span class="value">{{ $buku->judul ?? 'Judul tidak ditemukan' }}</span>
        </div>

        <div class="info-row">
            <span class="label">Tanggal Pinjam</span>
            <span class="value">{{ $tglPinjam->translatedFormat('d M Y') }}</span>
        </div>

        <div class="info-row">
            <span class="label">Batas Kembali (Jatuh Tempo)</span>
            <span class="value" style="color: #3B82F6;">{{ $tglJatuhTempo->translatedFormat('d M Y') }}</span>
        </div>

        @if($isTerlambat)
            <div class="info-row" style="background: #FFF5F5; margin-top: 10px; padding: 10px; border-radius: 8px;">
                <span class="label" style="color: #DC2626; font-weight: bold;">Keterlambatan</span>
                <span class="value" style="color: #DC2626;">{{ $jumlahHariTerlambat }} Hari</span>
            </div>
            <div class="info-row">
                <span class="label">Denda Terakumulasi (Rp 1.000 / Hari)</span>
                <span class="value" style="color: #D97706; font-size: 18px;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</span>
            </div>
        @else
            <div class="info-row">
                <span class="label">Status</span>
                <span class="value" style="color: #10B981;">Tepat Waktu (Bebas Denda)</span>
            </div>
        @endif
    </div>
</div>

<div class="action-group">
    @if($isTerlambat)
        <p style="color: #DC2626; font-size: 13px; text-align: center; max-width: 400px;">
            ⚠️ Kamu terlambat mengembalikan buku. Total denda <strong>Rp {{ number_format($totalDenda, 0, ',', '.') }}</strong> akan dicatat dalam sistem.
        </p>
    @endif

    {{-- Di halaman Konfirmasi Pengembalian --}}
    <form action="{{ route('konfirmasi-pengembalian', $pinjaman->id) }}" method="POST">
        @csrf
        {{-- PASTIKAN NAME-NYA ADALAH 'denda' SESUAI CONTROLLER --}}
        <input type="hidden" name="denda" value="{{ $totalDenda }}">
        <button type="submit" class="btn btn-confirm">Konfirmasi & Kembalikan</button>
    </form>
    <a href="{{ route('peminjaman-saya') }}" class="btn btn-cancel">Kembali ke Daftar</a>
</div>

@else
<div style="text-align: center; padding: 100px;">
    <p>Data pinjaman tidak ditemukan.</p>
    <a href="{{ route('peminjaman-saya') }}">Kembali</a>
</div>
@endif
@endsection
