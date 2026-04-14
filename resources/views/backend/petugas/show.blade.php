@extends('layout.kepalaperpustakaan')

@section('title', 'Detail Petugas')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px;">

    {{-- Header --}}
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">

        <a href="{{ route('kepala.petugas') }}"
           style="text-decoration:none; color:#64748b; font-weight:600;">
            ← Kembali ke Daftar Petugas
        </a>

        <a href="{{ route('kepala.petugas.edit', $petugas->id) }}"
           style="
           background:#f8fafc;
           color:#334155;
           padding:10px 14px;
           border-radius:10px;
           text-decoration:none;
           font-weight:600;
           border:1px solid #e2e8f0;
           ">
            ✏️ Edit
        </a>

    </div>


    {{-- Card --}}
    <div style="
    background:white;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
    border:1px solid #f1f5f9;
    ">

        {{-- Top --}}
        <div style="
        background:linear-gradient(135deg,var(--primary),#4f46e5);
        padding:40px 20px;
        text-align:center;
        ">

            <div style="
            width:80px;
            height:80px;
            border-radius:50%;
            background:rgba(255,255,255,.2);
            display:flex;
            align-items:center;
            justify-content:center;
            margin:auto;
            font-size:35px;
            border:3px solid white;
            ">
                👤
            </div>

            <h3 style="color:white; margin-top:15px;">
                {{ $petugas->name }}
            </h3>

            {{-- ID PETUGAS --}}
            <div style="margin-top:10px;">
                <span style="
                background:white;
                color:#2563EB;
                padding:6px 14px;
                border-radius:20px;
                font-size:12px;
                font-weight:700;
                ">
                    PTG{{ str_pad($petugas->id,3,'0',STR_PAD_LEFT) }}
                </span>
            </div>

            <span style="
            display:inline-block;
            margin-top:10px;
            background:rgba(255,255,255,.15);
            color:white;
            padding:4px 12px;
            border-radius:20px;
            font-size:12px;
            ">
                Petugas Aktif
            </span>

        </div>


        {{-- Isi --}}
        <div style="padding:30px;">

            <div style="margin-bottom:18px;">
                <small style="color:#94a3b8;">Username</small><br>
                <b>{{ $petugas->username }}</b>
            </div>

            <div style="margin-bottom:18px;">
                <small style="color:#94a3b8;">Email</small><br>
                <b>{{ $petugas->email }}</b>
            </div>

            <div style="margin-bottom:18px;">
                <small style="color:#94a3b8;">No Handphone</small><br>
                <b>{{ $petugas->no_hp ?? 'Belum diatur' }}</b>
            </div>

            <div>
                <small style="color:#94a3b8;">Terdaftar Sejak</small><br>
                <b>{{ $petugas->created_at->translatedFormat('d F Y') }}</b>
            </div>

        </div>

    </div>
</div>
@endsection
