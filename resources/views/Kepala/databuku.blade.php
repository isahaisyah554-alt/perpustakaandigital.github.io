@extends('layout.kepalaperpustakaan')

@section('title', 'Monitoring Katalog - Kepala')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .books-container{
        padding:30px;
        background:#f8fafc;
        min-height:100vh;
    }

    .books-header{
        margin-bottom:35px;
        border-left:5px solid #3b82f6;
        padding-left:20px;
    }

    .books-header h1{
        font-weight:800;
        font-size:30px;
        color:#0f172a;
    }

    .books-header p{
        color:#64748b;
        font-size:15px;
        margin-top:5px;
    }

    .action-bar{
        margin-bottom:35px;
    }

    .search-box{
        max-width:500px;
        background:white;
        border:1px solid #e2e8f0;
        border-radius:16px;
        padding:0 20px;
        display:flex;
        align-items:center;
        height:54px;
    }

    .search-box input{
        border:none;
        outline:none;
        width:100%;
        padding-left:15px;
        font-size:15px;
    }

    .book-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(240px,1fr));
        gap:30px;
    }

    .book-card{
        background:white;
        border-radius:20px;
        overflow:hidden;
        border:1px solid #f1f5f9;
        transition:.3s;
    }

    .book-card:hover{
        transform:translateY(-8px);
        box-shadow:0 20px 25px -5px rgba(0,0,0,.05);
    }

    .book-cover{
        width:100%;
        height:320px;
        position:relative;
        background:#f8fafc;
    }

    .book-cover img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .status-badge{
        position:absolute;
        top:15px;
        left:15px;
        padding:6px 12px;
        border-radius:10px;
        font-size:11px;
        font-weight:800;
    }

    .bg-safe{ background:#dcfce7; color:#16a34a; }
    .bg-warning{ background:#fffbeb; color:#d97706; }
    .bg-danger{ background:#fef2f2; color:#dc2626; }

    .stok-tag{
        position:absolute;
        bottom:15px;
        right:15px;
        background:rgba(15,23,42,.8);
        color:white;
        padding:5px 12px;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
    }

    .book-info{
        padding:20px;
    }

    .book-title{
        font-weight:800;
        font-size:16px;
        color:#1e293b;
        margin-bottom:8px;
    }

    .book-author{
        font-size:14px;
        color:#64748b;
        margin-bottom:10px;
    }

    .book-id{
        display:inline-block;
        background:#eff6ff;
        color:#2563eb;
        font-size:11px;
        font-weight:700;
        padding:4px 10px;
        border-radius:20px;
        margin-bottom:12px;
    }

    .book-meta{
        margin-top:10px;
        padding-top:15px;
        border-top:1px solid #f1f5f9;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .year-pill{
        background:#f1f5f9;
        color:#475569;
        padding:4px 10px;
        border-radius:6px;
        font-size:11px;
        font-weight:700;
    }
</style>

<div class="books-container">

    <div class="books-header">
        <h1>Monitoring Katalog Buku</h1>
        <p>Pantau ketersediaan dan rincian koleksi perpustakaan.</p>
    </div>

    {{-- SEARCH --}}
    <div class="action-bar">
        <form method="GET" action="" class="search-box">
            <i class="fa-solid fa-magnifying-glass" style="color:#94a3b8;"></i>

            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari judul / penulis..."
            >
        </form>
    </div>

    <div class="book-grid">

        @forelse($books as $book)
        <div class="book-card">

            <div class="book-cover">

                @if($book->stok_buku > 10)
                    <span class="status-badge bg-safe">Tersedia</span>
                @elseif($book->stok_buku > 0)
                    <span class="status-badge bg-warning">Terbatas</span>
                @else
                    <span class="status-badge bg-danger">Habis</span>
                @endif

                <span class="stok-tag">
                    Stok: {{ $book->stok_buku }}
                </span>

                @if($book->foto && $book->foto != 'default.jpg')
                    <img src="{{ asset('storage/buku/'.$book->foto) }}">
                @else
                    <div style="height:100%;display:flex;align-items:center;justify-content:center;color:#94a3b8;">
                        No Cover
                    </div>
                @endif

            </div>

            <div class="book-info">

                <div class="book-title">
                    {{ $book->judul }}
                </div>

                <div class="book-author">
                    {{ $book->penulis }}
                </div>

                {{-- ID BUKU --}}
                <div class="book-id">
                    ID Buku: B{{ str_pad($book->id,3,'0',STR_PAD_LEFT) }}
                </div>

                <div class="book-meta">
                    <span class="year-pill">
                        {{ $book->tahun_terbit }}
                    </span>

                    <span style="font-size:12px;color:#94a3b8;">
                        Data Buku
                    </span>
                </div>

            </div>

        </div>
        @empty

        <div style="grid-column:1/-1;text-align:center;padding:80px;background:white;border-radius:20px;">
            Tidak ada buku ditemukan.
        </div>

        @endforelse

    </div>

</div>
@endsection
