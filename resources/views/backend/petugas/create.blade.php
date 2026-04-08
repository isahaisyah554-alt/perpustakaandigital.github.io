@extends('layout.kepalaperpustakaan')

@section('title', 'Tambah Petugas')

@section('content')
<div style="max-width: 600px; margin: 0 auto;">
    <div class="page-header">
        <a href="{{ route('kepala.petugas') }}" style="text-decoration: none; color: var(--primary); font-size: 14px; font-weight: 600;">← Kembali ke Daftar</a>
        <h2 style="margin-top: 10px;">Tambah Petugas Baru</h2>
    </div>

    <div class="card" style="padding: 30px;">
        <form action="{{ route('kepala.petugas.store') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: var(--text-main);">Nama Lengkap</label>
                <input type="text" name="name" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; box-sizing: border-box;" placeholder="Masukkan nama petugas" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">Username</label>
                    <input type="text" name="username" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; box-sizing: border-box;" placeholder="username" required>
                </div>
                <div>
                    <label style="display: block; margin-bottom: 8px; font-weight: 600;">No. HP</label>
                    <input type="text" name="no_hp" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; box-sizing: border-box;" placeholder="0812...">
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email</label>
                <input type="email" name="email" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; box-sizing: border-box;" placeholder="contoh@email.com" required>
            </div>

            <div style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Password</label>
                <input type="password" name="password" style="width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; box-sizing: border-box;" placeholder="Minimal 8 karakter" required>
            </div>

            <button type="submit" style="width: 100%; background: var(--primary); color: white; padding: 14px; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                Simpan Petugas
            </button>
        </form>
    </div>
</div>
@endsection
