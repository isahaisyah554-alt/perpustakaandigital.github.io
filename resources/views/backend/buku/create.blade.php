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

    .form-group { margin-bottom: 20px; }
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
        box-sizing: border-box;
    }

    .flex-group { display: flex; gap: 20px; }
    .flex-group .form-group { flex: 1; }

    .btn-submit {
        background: #3B82F6; color: white; padding: 14px 28px;
        border: none; border-radius: 10px; font-weight: 700;
        cursor: pointer; transition: 0.3s;
    }

    .btn-submit:hover { background: #2563EB; transform: translateY(-2px); }
    .btn-cancel { color: #6B7280; text-decoration: none; font-weight: 600; }

    .alert-danger {
        background: #FEE2E2; color: #991B1B; padding: 15px;
        border-radius: 10px; margin-bottom: 20px; font-size: 14px;
    }
</style>

<div class="form-container">
    <div class="form-header">
        <h2>{{ isset($book) ? '✏️ Edit Data Buku' : '📚 Tambah Koleksi Baru' }}</h2>
        <p>Pastikan semua data terisi dengan benar.</p>
    </div>

    {{-- Alert Error: Untuk melihat kenapa data gagal disimpan --}}
    @if ($errors->any())
        <div class="alert-danger">
            <strong>Ups! Ada masalah:</strong>
            <ul style="margin-top: 5px; margin-bottom: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($book) ? route('petugas.databuku.update', $book->id) : route('petugas.databuku.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($book)) @method('PUT') @endif

        <div class="form-group">
            <label>Judul Buku</label>
            <input type="text" name="judul" value="{{ old('judul', $book->judul ?? '') }}" placeholder="Masukkan judul buku..." required>
        </div>

        <div class="form-group">
            <label>Foto Sampul (JPG/PNG)</label>
            <input type="file" name="foto" accept="image/*" style="border: none; padding: 10px 0;">
            @if(isset($book) && $book->foto)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/buku/' . $book->foto) }}" width="80" style="border-radius: 8px; border: 1px solid #ddd;">
                    <p style="font-size: 12px; color: #6B7280;">Cover saat ini: {{ $book->foto }}</p>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label>Nama Pengarang / Penulis</label>
            <input type="text" name="penulis" value="{{ old('penulis', $book->penulis ?? '') }}" placeholder="Contoh: Andrea Hirata" required>
        </div>

        <div class="flex-group">
            {{-- INPUT TAHUN TERBIT (WAJIB ADA) --}}
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $book->tahun_terbit ?? '') }}" placeholder="Contoh: 2024" required>
            </div>

            <div class="form-group">
                <label>Jumlah Stok</label>
                <input type="number" name="stok_buku" value="{{ old('stok_buku', $book->stok_buku ?? '') }}" placeholder="0" required>
            </div>
        </div>

        <div class="action-area" style="margin-top: 30px; display: flex; align-items: center; gap: 20px;">
            <button type="submit" class="btn-submit">
                {{ isset($book) ? '🔄 Perbarui Data' : '🚀 Simpan Koleksi' }}
            </button>
            <a href="{{ route('petugas.databuku') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection
