@extends('layout.petugas')

@section('title', isset($book) ? 'Edit Buku' : 'Tambah Buku')

@section('content')
<style>
    .form-container {
        max-width: 800px;
        margin: 20px auto;
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        margin-bottom: 30px;
        border-bottom: 2px solid #F3F4F6;
        padding-bottom: 20px;
    }

    .form-header h2 {
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: #1F2937;
        margin: 0;
    }

    .form-header p {
        color: #6B7280;
        font-size: 14px;
        margin-top: 5px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #D1D5DB;
        border-radius: 10px;
        font-size: 15px;
        color: #1F2937;
        transition: all 0.3s;
        box-sizing: border-box;
    }

    .form-group input:focus {
        outline: none;
        border-color: #3B82F6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    .flex-group {
        display: flex;
        gap: 20px;
    }

    .flex-group .form-group {
        flex: 1;
    }

    .btn-submit {
        background: #3B82F6;
        color: white;
        padding: 14px 28px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .btn-submit:hover {
        background: #2563EB;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .btn-cancel {
        color: #6B7280;
        text-decoration: none;
        font-weight: 600;
        font-size: 15px;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        color: #1F2937;
    }

    .action-area {
        margin-top: 30px;
        display: flex;
        align-items: center;
        gap: 20px;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2>{{ isset($book) ? '✏️ Edit Data Buku' : '📚 Tambah Koleksi Baru' }}</h2>
        <p>{{ isset($book) ? 'Perbarui informasi buku yang sudah ada di database.' : 'Masukkan detail buku untuk menambah koleksi perpustakaan.' }}</p>
    </div>

    <form action="{{ isset($book) ? route('petugas.databuku.update', $book->id) : route('petugas.databuku.store') }}" method="POST">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="{{ old('judul', $book->judul ?? '') }}" placeholder="Masukkan judul lengkap buku..." required>
        </div>

        <div class="form-group">
            <label>Nama Pengarang / Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis', $book->penulis ?? '') }}" placeholder="Contoh: Andrea Hirata" required>
        </div>

        <div class="flex-group">
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit ?? '') }}" placeholder="Contoh: 2024" required>
            </div>

            <div class="form-group">
                <label>Jumlah Stok (Ekspl)</label>
                <input type="number" name="stok_buku" value="{{ old('stok_buku', $book->stok_buku ?? '') }}" placeholder="0" required>
            </div>
        </div>

        <div class="action-area">
            <button type="submit" class="btn-submit">
                {{ isset($book) ? '🔄 Perbarui Data' : '🚀 Simpan Koleksi' }}
            </button>
            <a href="{{ route('petugas.databuku') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection
