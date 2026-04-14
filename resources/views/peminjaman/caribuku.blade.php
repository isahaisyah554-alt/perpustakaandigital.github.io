@extends('layout.anggota')

@section('title', 'Cari Buku')

@section('page-css')
<style>
    .breadcrumb{
        font-size:14px;
        color:var(--text-muted);
        margin-bottom:20px;
    }

    .search-area{
        margin-bottom:30px;
    }

    .search-box input{
        width:100%;
        max-width:450px;
        padding:14px 20px;
        border-radius:12px;
        border:1px solid var(--border);
        outline:none;
        font-family:inherit;
        transition:.3s;
    }

    .search-box input:focus{
        border-color:var(--primary);
        box-shadow:0 0 0 4px rgba(59,130,246,.1);
    }

    .books-grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(220px,1fr));
        gap:25px;
    }

    .card{
        background:white;
        padding:16px;
        border-radius:16px;
        box-shadow:0 4px 6px -1px rgba(0,0,0,.05);
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align:center;
        transition:.2s;
        border:1px solid transparent;
    }

    .card:hover{
        transform:translateY(-5px);
        box-shadow:0 10px 15px -3px rgba(0,0,0,.1);
        border-color:var(--primary);
    }

    .card img{
        width:130px;
        height:180px;
        object-fit:cover;
        border-radius:10px;
        margin-bottom:15px;
    }

    .title{
        margin:0 0 6px;
        font-size:16px;
        font-weight:700;
        color:var(--text-main);
    }

    .info{
        font-size:13px;
        color:var(--text-muted);
        margin-bottom:8px;
    }

    .book-id{
        font-size:12px;
        font-weight:700;
        color:#2563eb;
        background:#eff6ff;
        padding:4px 10px;
        border-radius:20px;
        margin-bottom:12px;
        display:inline-block;
    }

    .status{
        font-size:13px;
        font-weight:600;
        margin-bottom:15px;
    }

    .ready{ color:#10B981; }
    .empty{ color:#EF4444; }
    .warning{ color:#F59E0B; }

    .card button{
        margin-top:auto;
        width:100%;
        padding:12px;
        border:none;
        background:var(--primary);
        color:white;
        border-radius:10px;
        cursor:pointer;
        font-size:14px;
        font-weight:600;
    }

    .card button:hover:not(:disabled){
        background:#2563EB;
    }

    .card button:disabled{
        background:#D1D5DB;
        cursor:not-allowed;
    }
</style>
@endsection

@section('content')

<div class="breadcrumb">
    Beranda > <strong>Cari Buku</strong>
</div>

<div class="search-area">
    <form action="{{ route('peminjaman-cari') }}" method="GET" class="search-box">
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari judul/Penulis"
        >
    </form>
</div>

<div class="books-grid">

@forelse($books as $item)
<div class="card">

    <img src="{{ $item->foto ? asset('storage/buku/'.$item->foto) : 'https://via.placeholder.com/150x240?text='.$item->judul }}">

    <p class="title">{{ $item->judul }}</p>

    <p class="info">
        {{ $item->penulis }} • {{ $item->tahun_terbit }}
    </p>

    <div class="book-id">
        ID: B{{ str_pad($item->id,3,'0',STR_PAD_LEFT) }}
    </div>

    {{-- JIKA SUDAH DIPINJAM --}}
    @if(in_array($item->id, $pinjamSaya))

        <p class="status warning">
            Sedang Dipinjam
        </p>

        <button disabled style="background:#F59E0B;">
            Sedang Dipinjam
        </button>

    {{-- JIKA STOK ADA --}}
    @elseif($item->stok_buku > 0)

        <p class="status ready">
            ✔ Stok Tersedia ({{ $item->stok_buku }})
        </p>

        <button onclick="location.href='{{ route('halaman-pinjam',$item->id) }}'">
            + Pinjam
        </button>

    {{-- JIKA STOK HABIS --}}
    @else

        <p class="status empty">
            ✘ Stok Kosong
        </p>

        <button disabled>
            Habis
        </button>

    @endif

</div>
@empty

<div style="grid-column:1/-1;text-align:center;color:#94a3b8;padding:40px;">
    Buku tidak ditemukan.
</div>

@endforelse

</div>

@endsection
