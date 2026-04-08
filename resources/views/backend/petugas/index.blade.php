@extends('layout.kepalaperpustakaan')

@section('title', 'Data Petugas')

@section('content')
<div class="page-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
    <div>
        <h2>📋 Daftar Petugas</h2>
        <p style="color: var(--text-muted); margin: 0;">Total: {{ $petugas->count() }} orang.</p>
    </div>
    <a href="{{ route('kepala.petugas.create') }}" style="background: var(--primary); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600;">+ Tambah Petugas</a>
</div>

@if(session('success'))
    <div style="background: #DCFCE7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 20px;">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $p)
                <tr>
                    <td><strong>{{ $p->name }}</strong></td>
                    <td>{{ $p->username }}</td>
                    <td>{{ $p->email }}</td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 15px; justify-content: center;">
                            <a href="{{ route('kepala.petugas.show', $p->id) }}" style="text-decoration: none; color: var(--primary); font-weight: 600;">Detail</a>

                            <form action="{{ route('kepala.petugas.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="border: none; background: none; color: #EF4444; cursor: pointer; font-weight: 600; padding: 0;">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align: center; padding: 30px;">Data Kosong</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
