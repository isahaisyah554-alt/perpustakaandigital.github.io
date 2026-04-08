@extends('layout.kepalaperpustakaan')

@section('title', 'Data Petugas')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h2>📋 Daftar Petugas</h2>
        <p style="color: var(--text-muted); margin: 0;">Total terdapat {{ $petugas->count() }} petugas terdaftar.</p>
    </div>
    <a href="{{ route('kepala.petugas.create') }}"
       style="background: var(--primary); color: white; padding: 12px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s;">
       + Tambah Petugas
    </a>
</div>

@if(session('success'))
    <div style="background: #DCFCE7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #BBF7D0;">
        {{ session('success') }}
    </div>
@endif

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                <tr>
                    <td style="font-weight: 600;">{{ $p->name }}</td>
                    <td><span class="badge" style="background: #F3F4F6; color: #374151;">{{ $p->username }}</span></td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->no_hp ?? '-' }}</td>
                    <td style="text-align: center;">
                        <button style="border: none; background: none; color: var(--primary); cursor: pointer; font-weight: 600;">Edit</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 50px; color: var(--text-muted);">
                        Belum ada data petugas. Klik tombol "Tambah Petugas" untuk memulai.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
