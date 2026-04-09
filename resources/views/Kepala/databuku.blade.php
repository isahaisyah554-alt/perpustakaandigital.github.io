@extends('layout.kepalaperpustakaan')

@section('title', 'Monitoring Katalog - Kepala')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    /* Container & Header */
    .books-container { padding: 30px; background: #f8fafc; min-height: 100vh; }
    .books-header { margin-bottom: 35px; border-left: 5px solid #3b82f6; padding-left: 20px; }
    .books-header h1 { font-weight: 800; font-size: 30px; color: #0f172a; letter-spacing: -1px; }
    .books-header p { color: #64748b; font-size: 15px; margin-top: 5px; }

    /* Search Bar */
    .action-bar { margin-bottom: 35px; }
    .search-box {
        max-width: 500px; background: white; border: 1px solid #e2e8f0; border-radius: 16px;
        padding: 0 20px; display: flex; align-items: center; height: 54px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        transition: all 0.3s ease;
    }
    .search-box:focus-within { border-color: #3b82f6; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1); }
    .search-box input { border: none; outline: none; width: 100%; padding-left: 15px; font-size: 15px; color: #1e293b; }

    /* Grid Layout */
    .book-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 30px;
    }

    /* Card Styling */
    .book-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .book-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 10px 10px -5px rgba(0, 0, 0, 0.02);
    }

    /* Cover Area */
    .book-cover {
        width: 100%;
        height: 320px;
        position: relative;
        background: #f8fafc;
        overflow: hidden;
    }
    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .book-card:hover .book-cover img { transform: scale(1.08); }

    /* Badges */
    .status-badge {
        position: absolute; top: 15px; left: 15px;
        padding: 6px 12px; border-radius: 10px; font-size: 11px; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.5px; z-index: 10;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .bg-safe { background: #dcfce7; color: #16a34a; }
    .bg-warning { background: #fffbeb; color: #d97706; }
    .bg-danger { background: #fef2f2; color: #dc2626; }

    .stok-tag {
        position: absolute; bottom: 15px; right: 15px;
        background: rgba(15, 23, 42, 0.8); backdrop-filter: blur(4px);
        color: white; padding: 5px 12px; border-radius: 8px; font-size: 12px; font-weight: 600;
    }

    /* Info Area */
    .book-info { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
    .book-title {
        font-weight: 800; font-size: 16px; color: #1e293b;
        margin-bottom: 8px; line-height: 1.4;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        height: 45px;
    }
    .book-author { font-size: 14px; color: #64748b; margin-bottom: 12px; display: flex; align-items: center; gap: 6px; }

    .book-meta {
        margin-top: auto; padding-top: 15px; border-top: 1px solid #f1f5f9;
        display: flex; justify-content: space-between; align-items: center;
    }
    .year-pill { background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700; }
</style>

<div class="books-container">
    <div class="books-header">
        <h1>Monitoring Katalog Buku</h1>
        <p>Pantau ketersediaan dan rincian koleksi perpustakaan secara real-time.</p>
    </div>

    <div class="action-bar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8;"></i>
            <input type="text" placeholder="Cari judul, penulis, atau tahun...">
        </div>
    </div>

    <div class="book-grid">
        @forelse($books as $book)
        <div class="book-card">
            <div class="book-cover">
                {{-- Badge Status Berdasarkan Stok --}}
                @if($book->stok_buku > 10)
                    <span class="status-badge bg-safe">Tersedia</span>
                @elseif($book->stok_buku > 0)
                    <span class="status-badge bg-warning">Stok Terbatas</span>
                @else
                    <span class="status-badge bg-danger">Habis</span>
                @endif

                <span class="stok-tag">Stok: {{ $book->stok_buku }}</span>

                @if($book->foto && $book->foto !== 'default.jpg')
                    <img src="{{ asset('storage/buku/' . $book->foto) }}" alt="{{ $book->judul }}">
                @else
                    <div style="height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; color:#cbd5e1; background:#f8fafc;">
                        <i class="fa-solid fa-book-open fa-3x" style="margin-bottom: 10px;"></i>
                        <span style="font-size: 12px; font-weight: 600;">No Cover Available</span>
                    </div>
                @endif
            </div>

            <div class="book-info">
                <div class="book-title" title="{{ $book->judul }}">{{ $book->judul }}</div>
                <div class="book-author">
                    <i class="fa-solid fa-pen-nib" style="font-size: 12px;"></i>
                    {{ Str::limit($book->penulis, 20) }}
                </div>

                <div class="book-meta">
                    <span class="year-pill">{{ $book->tahun_terbit }}</span>
                    <i class="fa-solid fa-ellipsis" style="color: #cbd5e1;"></i>
                </div>
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 100px 0; background: white; border-radius: 24px; border: 2px dashed #e2e8f0;">
            <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="80" style="opacity: 0.2; margin-bottom: 20px;">
            <p style="color: #64748b; font-weight: 600;">Opps! Belum ada koleksi buku yang terdaftar.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
