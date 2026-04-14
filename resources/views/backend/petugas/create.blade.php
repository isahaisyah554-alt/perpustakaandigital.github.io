@extends('layout.kepalaperpustakaan')

@section('title', isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">

<div class="page-header">
    <a href="{{ route('kepala.petugas') }}" style="text-decoration:none; color:var(--primary); font-size:14px; font-weight:600;">
        ← Kembali
    </a>

    <h2 style="margin-top:10px;">
        {{ isset($petugas) ? 'Edit Petugas' : 'Tambah Petugas Baru' }}
    </h2>
</div>

<div class="card" style="padding:30px;">

<form action="{{ isset($petugas) ? route('kepala.petugas.update',$petugas->id) : route('kepala.petugas.store') }}" method="POST">

    @csrf
    @if(isset($petugas))
        @method('PUT')
    @endif

    <div style="margin-bottom:20px;">
        <label>Nama Lengkap</label>
        <input type="text" name="name"
            value="{{ $petugas->name ?? '' }}"
            style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;" required>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:20px;">

        <div>
            <label>Username</label>
            <input type="text" name="username"
                value="{{ $petugas->username ?? '' }}"
                style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;" required>
        </div>

        <div>
            <label>No HP</label>
            <input type="text" name="no_hp"
                value="{{ $petugas->no_hp ?? '' }}"
                style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
        </div>

    </div>

    <div style="margin-bottom:20px;">
        <label>Email</label>
        <input type="email" name="email"
            value="{{ $petugas->email ?? '' }}"
            style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;" required>
    </div>

    @if(!isset($petugas))
    <div style="margin-bottom:25px;">
        <label>Password</label>
        <input type="password" name="password"
            style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;" required>
    </div>
    @endif

    <button type="submit"
        style="width:100%; background:var(--primary); color:white; padding:14px; border:none; border-radius:8px; font-weight:600;">

        {{ isset($petugas) ? 'Update Petugas' : 'Simpan Petugas' }}

    </button>

</form>

</div>
</div>
@endsection
