@extends('layout.kepalaperpustakaan')

@section('title', 'Data Petugas')

@section('content')
<div class="page-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">

    <div>
        <h2>📋 Daftar Petugas</h2>
        <p style="color:var(--text-muted); margin:0;">
            Total terdapat {{ $petugas->count() }} petugas terdaftar.
        </p>
    </div>

    <a href="{{ route('kepala.petugas.create') }}"
       style="
       background:var(--primary);
       color:white;
       padding:12px 20px;
       border-radius:8px;
       text-decoration:none;
       font-weight:600;
       font-size:14px;
       ">
       + Tambah Petugas
    </a>

</div>

@if(session('success'))
<div style="
background:#DCFCE7;
color:#166534;
padding:15px;
border-radius:8px;
margin-bottom:20px;
border:1px solid #BBF7D0;
">
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
    <th style="text-align:center;">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($petugas as $p)
<tr>

    {{-- ID PETUGAS --}}
    <td>
        <span style="
        background:#EFF6FF;
        color:#2563EB;
        padding:6px 12px;
        border-radius:8px;
        font-size:12px;
        font-weight:700;
        ">
            PTG{{ str_pad($p->id,3,'0',STR_PAD_LEFT) }}
        </span>
    </td>

    {{-- NAMA --}}
    <td style="font-weight:600;">
        {{ $p->name }}
    </td>

    {{-- USERNAME --}}
    <td>{{ $p->username }}</td>

    {{-- EMAIL --}}
    <td>{{ $p->email }}</td>

    {{-- HP --}}
    <td>{{ $p->no_hp ?? '-' }}</td>

    {{-- AKSI --}}
    <td style="text-align:center;">

        {{-- DETAIL --}}
        <a href="{{ route('kepala.petugas.show', $p->id) }}"
           style="
           background:#EFF6FF;
           color:#2563EB;
           padding:7px 12px;
           border-radius:8px;
           text-decoration:none;
           font-size:13px;
           font-weight:600;
           margin-right:6px;
           display:inline-block;
           ">
           Detail
        </a>

        {{-- HAPUS --}}
        <form action="{{ route('kepala.petugas.destroy', $p->id) }}"
              method="POST"
              style="display:inline;"
              onsubmit="return confirm('Yakin hapus petugas ini?')">

            @csrf
            @method('DELETE')

            <button type="submit"
                style="
                background:#FEE2E2;
                color:#DC2626;
                border:none;
                padding:7px 12px;
                border-radius:8px;
                font-size:13px;
                font-weight:600;
                cursor:pointer;
                ">
                Hapus
            </button>

        </form>

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
