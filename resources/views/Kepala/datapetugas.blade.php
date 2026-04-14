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
                    <th>ID Petugas</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
                </thead>

            <tbody>
@forelse($petugas as $p)
<tr>

    <td>
        <span class="badge" style="background:#EFF6FF; color:#2563EB;">
            PTG{{ str_pad($p->id,3,'0',STR_PAD_LEFT) }}
        </span>
    </td>

    <td style="font-weight:600;">
        {{ $p->name }}
    </td>

    <td>{{ $p->username }}</td>

    <td>{{ $p->email }}</td>

    <td>{{ $p->no_hp ?? '-' }}</td>

    <td>
        <button style="border:none; background:none; color:#2563EB; cursor:pointer;">
            Edit
        </button>
    </td>

</tr>

@empty

<tr>
    <td colspan="6" style="text-align:center; padding:40px; color:gray;">
        Belum ada data petugas
    </td>
</tr>

@endforelse
</tbody>
        </table>
    </div>
</div>
@endsection
