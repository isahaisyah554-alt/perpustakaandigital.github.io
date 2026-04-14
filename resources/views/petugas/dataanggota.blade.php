@extends('layout.petugas')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    .main-container {
        padding: 25px;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    .header-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header-box h2 {
        font-weight: 800;
        color: #2d3436;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .header-box h2 i {
        color: #0984e3;
    }

    .table-card {
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #edf2f7;
        overflow: hidden;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 0;
    }

    .table-custom thead {
        background-color: #f8f9fc;
        border-bottom: 2px solid #edf2f7;
    }

    .table-custom th {
        padding: 18px 20px;
        text-align: left;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #4b5563;
        font-weight: 700;
    }

    .table-custom td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #2d3436;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }

    .table-custom tbody tr:hover {
        background-color: #f9fafb;
        transition: 0.2s ease-in-out;
    }

    .no-badge {
        background: #0984e3;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: bold;
    }

    .name-text {
        font-weight: 700;
        display: block;
        color: #2d3436;
    }

    .email-subtext {
        font-size: 12px;
        color: #636e72;
    }

    .u-badge {
        background: #e1f5fe;
        color: #0288d1;
        padding: 5px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 13px;
    }

    .id-badge {
        display: inline-block;
        background: #ecfdf5;
        color: #059669;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        margin-top: 6px;
    }

    .empty-state {
        text-align: center;
        padding: 50px 0;
        color: #b2bec3;
    }
</style>

<div class="main-container">
    <div class="header-box">
        <h2><i class="fa-solid fa-id-card"></i> Manajemen Anggota</h2>
        <span style="font-size: 14px; color: #636e72;">Total: {{ count($anggota) }} Anggota</span>
    </div>

    <div class="table-card">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="80" style="text-align:center;">No</th>
                        <th>Profil Anggota</th>
                        <th>Username</th>
                        <th>Kontak</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($anggota as $i => $a)
                    <tr>

                        <td style="text-align:center;">
                            <span class="no-badge">{{ $i + 1 }}</span>
                        </td>

                        <td>
                            <span class="name-text">{{ $a->name }}</span>

                            {{-- ID Anggota --}}
                            <span class="id-badge">
                                ID: {{ $a->id_anggota ?? 'AGT-' . str_pad($a->id, 3, '0', STR_PAD_LEFT) }}
                            </span>

                            <br>

                            <span class="email-subtext">
                                Registered: {{ $a->created_at ? $a->created_at->format('d M Y') : '-' }}
                            </span>
                        </td>

                        <td>
                            <span class="u-badge">@ {{ $a->username }}</span>
                        </td>

                        <td>
                            <div style="margin-bottom:4px;">
                                <i class="fa-regular fa-envelope" style="width:15px; color:#0984e3;"></i>
                                {{ $a->email }}
                            </div>

                            <div>
                                <i class="fa-solid fa-phone" style="width:15px; color:#00b894;"></i>
                                {{ $a->no_hp ?? '-' }}
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="fa-solid fa-folder-open fa-3x" style="margin-bottom:15px; display:block; opacity:0.5;"></i>
                            Belum ada data anggota yang tersedia.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
@endsection
