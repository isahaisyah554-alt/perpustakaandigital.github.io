@extends('layout.petugas')

@section('title', 'Katalog Buku')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .books-container {
        padding: 25px;
        font-family: 'Inter', sans-serif;
        background: #f8fafc;
        display: block !important;
    }

    .books-header { margin-bottom: 30px; }
    .books-header h1 {
        font-weight: 800;
        font-size: 28px;
        color: #1e293b;
        margin: 0;
    }

    .action-bar {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        align-items: center;
    }

    .search-box {
        flex: 1;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 0 15px;
        display: flex;
        align-items: center;
        height: 48px;
    }

    .search-box input {
        border: none;
        outline: none;
        width: 100%;
        padding-left: 10px;
    }

    .btn-add {
        background: #3b82f6;
        color: white;
        padding: 0 20px;
        height: 48px;
        border-radius: 12px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .book-grid {
        display: grid !important;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 25px;
        width: 100%;
    }

    .book-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        transition: 0.3s;
        display: flex;
        flex-direction: column;
    }

    .book-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.1);
    }

    .book-cover {
        width: 100%;
        height: 280px;
        position: relative;
        background: #f1f5f9;
    }

    .book-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .stok-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255,255,255,0.9);
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 11px;
        font-weight: 700;
        color: #1e293b;
    }

    .book-info {
        padding: 15px;
        flex-grow: 1;
    }

    .book-title {
        font-weight: 700;
        font-size: 15px;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .book-author {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 8px;
    }

    .book-id {
        display: inline-block;
        background: #eff6ff;
        color: #2563eb;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }

    .card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        padding: 15px;
        border-top: 1px solid #f1f5f9;
    }

    .btn-edit-card {
        background: #eff6ff;
        color: #3b82f6;
        text-align: center;
        padding: 8px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 600;
    }

    .btn-delete-card {
        background: #fef2f2;
        color: #ef4444;
        border: none;
        padding: 8px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }
</style>

<div class="books-container">

    <div class="books-header">
        <h1>Katalog Koleksi</h1>
        <p>Manajemen buku dengan tampilan kartu.</p>
    </div>

    <div class="action-bar">
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Cari buku...">
        </div>

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

                @if($book->foto && $book->foto !== 'default.jpg')
                    <img src="{{ asset('storage/buku/' . $book->foto) }}">
                @else
                    <div style="height:100%; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                        No Cover
                    </div>
                @endif
            </div>

            <div class="book-info">
                <div class="book-title">{{ $book->judul }}</div>

                <div class="book-author">{{ $book->penulis }}</div>

                {{-- ID Buku --}}
                <div class="book-id">
                    ID: B{{ str_pad($book->id, 3, '0', STR_PAD_LEFT) }}
                </div>
            </div>

            <div class="card-actions">
                <a href="{{ route('petugas.databuku.edit', $book->id) }}" class="btn-edit-card">
                    Edit
                </a>

                <form action="{{ route('petugas.databuku.destroy', $book->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete-card" style="width:100%">
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @empty
            <p>Kosong</p>
        @endforelse

    </div>
</div>
@endsection
