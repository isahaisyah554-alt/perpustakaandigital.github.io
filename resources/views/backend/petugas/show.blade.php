@extends('layout.kepalaperpustakaan')
@section('title', 'Detail Petugas')
@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <a href="{{ route('kepala.petugas') }}" style="text-decoration: none; color: var(--primary); font-weight: 600;">← Kembali</a>
    <div class="card" style="margin-top: 20px; padding: 25px;">
        <h3>Detail Petugas</h3>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p><strong>Nama:</strong> {{ $petugas->name }}</p>
        <p><strong>Username:</strong> {{ $petugas->username }}</p>
        <p><strong>Email:</strong> {{ $petugas->email }}</p>
        <p><strong>No HP:</strong> {{ $petugas->no_hp ?? '-' }}</p>
        <p><strong>Dibuat pada:</strong> {{ $petugas->created_at->format('d M Y') }}</p>
    </div>
</div>
@endsection
