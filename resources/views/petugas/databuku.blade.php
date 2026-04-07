@extends('layout.petugas')

@section('title', 'Data Buku')

@section('content')
<style>
    /* Container & Header */
    .books-container { padding: 20px; }
    .books-header { margin-bottom: 30px; display: flex; justify-content: space-between; align-items: center; }
    .books-header h1 { font-family: 'Inter', sans-serif; font-weight: 700; font-size: 28px; color: #1F2937; margin: 0; }
    .books-header p { font-size: 14px; color: #6B7280; margin-top: 5px; }

    /* Alert Success */
    .alert-success {
        background: #D1FAE5; border-left: 4px solid #059669; color: #065F46;
        padding: 15px; border-radius: 12px; margin-bottom: 25px; font-weight: 600;
        display: flex; align-items: center; gap: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    /* Filter & Search Bar */
    .filter-box {
        background: #FFFFFF; border: 1px solid #E5E7EB;
        border-radius: 16px; padding: 20px;
        display: flex; gap: 15px; align-items: center; margin-bottom: 30px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .search-wrapper {
        background: #F9FAFB; border: 1px solid #D1D5DB; border-radius: 12px;
        display: flex; align-items: center; padding: 0 16px; height: 45px; flex: 1;
    }

    .search-wrapper input { border: none; background: transparent; outline: none; width: 100%; margin-left: 10px; color: #374151; font-size: 14px; }

    .btn-input-buku {
        background: #3B82F6 !important; color: white !important; padding: 0 24px; height: 45px;
        border-radius: 12px; text-decoration: none; font-weight: 600;
        display: flex; align-items: center; gap: 8px; transition: all 0.3s ease;
    }
    .btn-input-buku:hover { background: #2563EB !important; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }

    /* Table Styling */
    .table-wrapper {
        background: #FFFFFF; border: 1px solid #E5E7EB;
        box-shadow: 0px 10px 15px -3px rgba(0, 0, 0, 0.1); border-radius: 16px; overflow: hidden;
    }

    .custom-table { width: 100%; border-collapse: collapse; }
    .custom-table thead { background: #F3F4F6; }
    .custom-table th { padding: 16px 20px; text-align: left; color: #4B5563; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
    .custom-table td { padding: 16px 20px; color: #4B5563; border-bottom: 1px solid #F3F4F6; font-size: 14px; vertical-align: middle; }

    /* Action Buttons */
    .action-group { display: flex; gap: 10px; align-items: center; }
    .btn-edit { background: #FFF7ED; color: #C2410C; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600; border: 1px solid #FFEDD5; transition: 0.2s; }
    .btn-delete { background: #FEF2F2; color: #B91C1C; padding: 8px 16px; border-radius: 8px; border: 1px solid #FEE2E2; cursor: pointer; font-size: 13px; font-weight: 600; transition: 0.2s; }
    .btn-edit:hover { background: #FFEDD5; }
    .btn-delete:hover { background: #FEE2E2; }
</style>

<div class="books-container">
    <div class="books-header">
        <div>
            <h1>Daftar Koleksi Buku</h1>
            <p>Manajemen data buku perpustakaan secara real-time.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <span>✅</span> {{ session('success') }}
        </div>
    @endif

    <div class="filter-box">
        <div class="search-wrapper">
            <span>🔍</span>
            <input type="text" placeholder="Cari judul buku, penulis, atau tahun...">
        </div>
        {{-- TOMBOL INPUT - Harus ada class btn-input-buku --}}
        <a href="{{ route('petugas.databuku.create') }}" class="btn-input-buku">
            <span>+</span> Input Buku Baru
        </a>
    </div>

    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>ID Buku</th>
                    <th>Informasi Buku</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr>
                    <td>
                        <div class="book-img" style="width: 50px; height: 70px; background: #f3f4f6; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #9ca3af;">No Cover</div>
                    </td>
                    <td>BK-{{ str_pad($book->id, 4, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div style="font-weight: 700; color: #111827;">{{ $book->judul }}</div>
                    </td>
                    <td>{{ $book->penulis }}</td>
                    <td>{{ $book->tahun_terbit }}</td>
                    <td>{{ $book->stok_buku }} unit</td>
                    <td>
                        <div class="action-group">
                            {{-- TOMBOL EDIT --}}
                            <a href="{{ route('petugas.databuku.edit', $book->id) }}" class="btn-edit">Edit</a>

                            {{-- FORM DELETE - Harus Method POST & ada @method('DELETE') --}}
                            <form action="{{ route('petugas.databuku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align: center; padding: 40px;">Data Kosong</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
