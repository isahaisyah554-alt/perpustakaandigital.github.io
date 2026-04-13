@extends('layout.kepalaperpustakaan')

@section('title', 'Detail Petugas')

@section('content')
<div style="max-width: 600px; margin: 0 auto; padding: 20px;">
    <a href="{{ route('kepala.petugas') }}" style="text-decoration: none; color: #64748b; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; margin-bottom: 20px; transition: 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='#64748b'">
        <span>←</span> Kembali ke Daftar Petugas
    </a>

    <div style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
        <div style="background: linear-gradient(135deg, var(--primary) 0%, #4f46e5 100%); padding: 40px 20px; text-align: center;">
            <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-size: 35px; border: 3px solid white; backdrop-filter: blur(5px);">
                👤
            </div>
            <h3 style="color: white; margin: 0; font-size: 22px; letter-spacing: 0.5px;">{{ $petugas->name }}</h3>
            <span style="display: inline-block; background: rgba(255,255,255,0.15); color: white; padding: 4px 12px; border-radius: 20px; font-size: 12px; margin-top: 8px; font-weight: 500;">
                Petugas Aktif
            </span>
        </div>

        <div style="padding: 30px;">
            <div style="display: flex; flex-direction: column; gap: 20px;">

                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 12px; border-bottom: 1px solid #f8fafc;">
                    <div style="display: flex; flex-direction: column;">
                        <span style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Username</span>
                        <span style="color: #1e293b; font-weight: 600; font-size: 15px;">{{ $petugas->username }}</span>
                    </div>
                    <span style="background: #eff6ff; color: #3b82f6; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 700;">ID: #{{ $petugas->id }}</span>
                </div>

                <div style="display: flex; flex-direction: column; padding-bottom: 12px; border-bottom: 1px solid #f8fafc;">
                    <span style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Alamat Email</span>
                    <span style="color: #1e293b; font-weight: 600; font-size: 15px;">{{ $petugas->email }}</span>
                </div>

                <div style="display: flex; flex-direction: column; padding-bottom: 12px; border-bottom: 1px solid #f8fafc;">
                    <span style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">No. Handphone</span>
                    <span style="color: #1e293b; font-weight: 600; font-size: 15px;">{{ $petugas->no_hp ?? 'Belum diatur' }}</span>
                </div>

                <div style="display: flex; flex-direction: column; padding-bottom: 5px;">
                    <span style="color: #94a3b8; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">Terdaftar Sejak</span>
                    <span style="color: #1e293b; font-weight: 600; font-size: 15px;">{{ $petugas->created_at->translatedFormat('d F Y') }}</span>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
