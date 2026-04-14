@extends('layout.petugas')

@section('title', 'Katalog Buku')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .books-container{
        padding:25px;
        font-family:'Inter',sans-serif;
        background:#f8fafc;
    }

    .books-header{
        margin-bottom:25px;
    }

    .books-header h1{
        font-size:28px;
        font-weight:800;
        color:#1e293b;
        margin:0;
    }

    .books-header p{
        color:#64748b;
        margin-top:5px;
    }

    .action-bar{
        display:flex;
        gap:15px;
        margin-bottom:30px;
        align-items:center;
    }

    .search-box{
        flex:1;
        background:white;
        border:1px solid #e2e8f0;
        border-radius:12px;
        padding:0 15px;
        display:flex;
        align-items:center;
        height:48px;
    }

    .search-box i{
        color:#64748b;
    }

    .search-box input{
        border:none;
        outline:none;
        width:100%;
        padding-left:10px;
        font-size:14px;
    }

    .btn-add{
        background:#3b82f6;
        color:white;
        padding:0 20px;
        height:48px;
        border-radius:12px;
        text-decoration:none;
        display:flex;
        align-items:center;
        font-weight:600;
    }

    .book-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
        gap:25px;
    }

    .book-card{
        background:white;
        border-radius:16px;
        overflow:hidden;
        border:1px solid #e2e8f0;
        transition:.3s;
    }

    .book-card:hover{
        transform:translateY(-6px);
        box-shadow:0 12px 24px rgba(0,0,0,.08);
    }

    .book-cover{
        height:280px;
        background:#f1f5f9;
        position:relative;
    }

    .book-cover img{
        width:100%;
        height:100%;
        object-fit:cover;
    }

    .stok-badge{
        position:absolute;
        top:12px;
        right:12px;
        background:rgba(255,255,255,.95);
        padding:4px 10px;
        border-radius:8px;
        font-size:11px;
        font-weight:700;
    }

    .book-info{
        padding:15px;
    }

    .book-title{
        font-size:15px;
        font-weight:700;
        color:#1e293b;
        margin-bottom:4px;
    }

    .book-author{
        font-size:13px;
        color:#64748b;
        margin-bottom:8px;
    }

    .book-id{
        display:inline-block;
        background:#eff6ff;
        color:#2563eb;
        padding:4px 10px;
        border-radius:20px;
        font-size:11px;
        font-weight:700;
    }

    .card-actions{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:8px;
        padding:15px;
        border-top:1px solid #f1f5f9;
    }

    .btn-edit-card{
        background:#eff6ff;
        color:#2563eb;
        text-decoration:none;
        text-align:center;
        padding:8px;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
    }

    .btn-delete-card{
        background:#fef2f2;
        color:#ef4444;
        border:none;
        width:100%;
        padding:8px;
        border-radius:8px;
        font-size:12px;
        font-weight:600;
        cursor:pointer;
    }
</style>

<div class="books-container">

    <div class="books-header">
        <h1>Katalog Koleksi</h1>
        <p>Manajemen buku dengan tampilan kartu.</p>
    </div>

    {{-- SEARCH SUDAH BERFUNGSI --}}
    <div class="action-bar">

        <form action="{{ route('petugas.databuku') }}" method="GET" class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul / penulis..."
            >
        </form>

        <a href="{{ route('petugas.databuku.create') }}" class="btn-add">
            + Tambah Buku
        </a>

    </div>

    <div class="book-grid">

        @forelse($books as $book)
        <div class="book-card">

            <div class="book-cover">
                <span class="stok-badge">
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
                <div class="book-title">{{ $book->judul }}</div>
                <div class="book-author">{{ $book->penulis }}</div>

                <div class="book-id">
                    ID: B{{ str_pad($book->id,3,'0',STR_PAD_LEFT) }}
                </div>
            </div>

            <div class="card-actions">

                <a href="{{ route('petugas.databuku.edit',$book->id) }}" class="btn-edit-card">
                    Edit
                </a>

                <form action="{{ route('petugas.databuku.destroy',$book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete-card">
                        Hapus
                    </button>
                </form>

            </div>

        </div>
        @empty
            <p>Tidak ada buku ditemukan.</p>
        @endforelse

    </div>

</div>
@endsection
