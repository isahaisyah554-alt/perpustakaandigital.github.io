@extends('layout.petugas')

@section('title', 'Daftar Koleksi Buku')

@section('content')

{{-- Statistik Singkat --}}
<div class="stats-grid" style="margin-bottom: 20px;">
    <div class="stat-card" style="display: flex; align-items: center; gap: 15px; background: white; padding: 20px; border-radius: 12px; border: 1px solid #e5e7eb;">
        <span class="icon" style="font-size: 24px;">📘</span>
        <div>
            <p style="color: #6b7280; font-size: 14px; margin: 0;">Total Buku di Katalog</p>
            <span class="value" style="font-size: 20px; font-weight: 700;">{{ $books->count() }}</span>
        </div>
    </div>
</div>

<section class="table-section">
    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div style="background: #D1FAE5; color: #065F46; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="header-table" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="font-size: 18px; color: #111827;">Daftar Buku Terbaru</h2>
        <a href="{{ route('petugas.databuku.create') }}" class="btn-action" style="background: #3B82F6; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">+ Tambah Buku Baru</a>
    </div>

    <div class="table-container" style="background: white; border-radius: 12px; border: 1px solid #e5e7eb; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f9fafb; text-align: left;">
                    <th style="padding: 15px;">Cover</th>
                    <th style="padding: 15px;">Judul Buku</th>
                    <th style="padding: 15px;">Penulis</th>
                    <th style="padding: 15px;">Stok</th>
                    <th style="padding: 15px;">Status</th>
                    <th style="padding: 15px; text-align: center;">Aksi</th> {{-- Kolom Aksi --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr style="border-top: 1px solid #e5e7eb;">
                    <td style="padding: 15px;">
                        @if($book->foto && $book->foto != 'default.jpg')
                            <img src="{{ asset('storage/buku/' . $book->foto) }}"
                                 alt="Cover"
                                 style="width: 50px; height: 70px; object-fit: cover; border-radius: 6px;">
                        @else
                            <div style="width: 50px; height: 70px; background: #f3f4f6; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #9ca3af; text-align: center;">
                                No Image
                            </div>
                        @endif
                    </td>
                    <td style="padding: 15px; font-weight: 600;">{{ $book->judul }}</td>
                    <td style="padding: 15px;">{{ $book->penulis }}</td>
                    <td style="padding: 15px;">{{ $book->stok_buku }} Unit</td>
                    <td style="padding: 15px;">
                        @if($book->stok_buku > 5)
                            <span class="badge" style="background: #D1FAE5; color: #065F46; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Tersedia</span>
                        @elseif($book->stok_buku > 0)
                            <span class="badge" style="background: #FEF3C7; color: #92400E; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Stok Tipis</span>
                        @else
                            <span class="badge" style="background: #FEE2E2; color: #991B1B; padding: 5px 12px; border-radius: 20px; font-size: 12px;">Habis</span>
                        @endif
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            {{-- TOMBOL EDIT --}}
                            <a href="{{ route('petugas.databuku.edit', $book->id) }}"
                               style="background: #FFF7ED; color: #C2410C; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 13px; font-weight: 600; border: 1px solid #FFEDD5;">
                               Edit
                            </a>

                            {{-- FORM HAPUS (WAJIB PAKAI FORM UNTUK DELETE) --}}
                            <form action="{{ route('petugas.databuku.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        style="background: #FEF2F2; color: #B91C1C; padding: 6px 12px; border-radius: 6px; border: 1px solid #FEE2E2; cursor: pointer; font-size: 13px; font-weight: 600;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
