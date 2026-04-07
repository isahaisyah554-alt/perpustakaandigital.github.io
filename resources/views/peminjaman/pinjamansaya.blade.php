@extends('layout.anggota')

@section('title', 'Pinjaman Saya')

@section('page-css')
<style>
    .section-title { font-weight: 600; font-size: 22px; color: var(--text-muted); margin-bottom: 20px; }
    .loan-container { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.03); }

    .book-item { display: flex; align-items: center; background: #F9FAFB; border: 1px solid #E5E7EB; border-radius: 10px; padding: 16px; margin-bottom: 16px; position: relative; }
    .book-cover { width: 90px; height: 120px; background: #D1D5DB; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #9CA3AF; font-size: 10px; }
    .book-details { margin-left: 16px; flex-grow: 1; }
    .book-title { font-weight: 600; font-size: 15px; margin: 0 0 4px 0; color: var(--text-main); }
    .book-info { font-size: 13px; color: #4B5563; line-height: 1.6; }

    .status-badge { position: absolute; top: 16px; right: 16px; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .status-late { background: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; }
    .status-active { background: #D1FAE5; color: #059669; border: 1px solid #6EE7B7; }
    .status-menunggu { background: #F3F4F6; color: #6B7280; border: 1px solid #D1D5DB; }

    .btn-return { background: #10B981; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 500; cursor: pointer; margin-top: 8px; transition: 0.2s; text-decoration: none; display: inline-block; }
    .btn-return:hover { background: #059669; }

    .info-box { background: #EFF6FF; border: 1px solid #DBEAFE; border-radius: 12px; padding: 20px; margin-top: 24px; }
    .info-box p { margin: 6px 0; font-size: 14px; color: #1E40AF; }
</style>
@endsection

@section('content')
<h2 class="section-title">Sedang Dipinjam</h2>

<div class="loan-container">
    @forelse($pinjaman as $item)
        <div class="book-item">
            <div class="book-cover">
                @if($item->buku && $item->buku->cover)
                    <img src="{{ asset('storage/' . $item->buku->cover) }}" alt="Cover Buku" style="width:100%; height:100%; border-radius:4px;">
                @else
                    Cover Buku
                @endif
            </div>
            <div class="book-details">
    <p style="color:red;">ID: {{ $item->id }}</p> {{-- TAMBAHKAN INI --}}

    <p class="book-title">{{ $item->buku ? $item->buku->judul : 'Judul Buku' }}</p>
                <p class="book-info">
                    Dipinjam: {{ \Carbon\Carbon::parse($item->tgl_pinjam)->translatedFormat('d M Y') }} <br>
                    Batas Kembali: {{ \Carbon\Carbon::parse($item->tgl_pinjam)->addDays($item->durasi)->translatedFormat('d M Y') }}
                    @if($item->status == 'dipinjam' && \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($item->tgl_pinjam)->addDays($item->durasi)))
                        <br><span style="color: #D97706; font-weight: bold;">(Terlambat {{ \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->tgl_pinjam)->addDays($item->durasi)) }} Hari)</span>
                    @endif
                </p>

                {{-- Tombol Kembalikan hanya muncul kalau status dipinjam --}}
                @if($item->status == 'dipinjam')
                <a href="{{ route('pengembalian-buku', ['id' => $item->id]) }}" class="btn-return">
                    Kembalikan
                </a>
            @endif
            </div>

            {{-- Label status --}}
            <div class="status-badge
                @if($item->status == 'dipinjam')
                    status-active
                @elseif($item->status == 'menunggu')
                    status-menunggu
                @elseif($item->status == 'ditolak')
                    status-late
                @endif
            ">
                @if($item->status == 'dipinjam')
                    Aktif
                @elseif($item->status == 'menunggu')
                    Menunggu
                @elseif($item->status == 'ditolak')
                    Ditolak
                @endif
            </div>
        </div>
    @empty
        <p>Belum ada peminjaman.</p>
    @endforelse
</div>

<h2 class="section-title" style="margin-top: 40px;">Informasi</h2>
<div class="info-box">
    <p>• Durasi peminjaman maksimal 30 hari.</p>
    <p>• Maksimal meminjam 2 buku secara bersamaan.</p>
</div>
@endsection
