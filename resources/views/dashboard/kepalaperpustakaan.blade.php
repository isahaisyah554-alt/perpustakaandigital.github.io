@extends('layout.kepalaperpustakaan')

@section('title', 'Dashboard Kepala')

@section('content')
<div class="page-header">
    <h2>Laporan Transaksi Anggota</h2>
    <p style="color: var(--text-muted); font-size: 14px;">
        Memantau aktivitas peminjaman, pengembalian, dan denda anggota.
    </p>
</div>

<div class="stats-grid">
    <div class="stat-card" style="border-left:4px solid var(--primary);">
        <span>Total Buku</span>
        <h3>{{ $total_buku ?? 0 }}</h3>
    </div>

    <div class="stat-card" style="border-left:4px solid var(--warning);">
        <span>Sedang Dipinjam</span>
        <h3>{{ $total_pinjam_aktif ?? 0 }}</h3>
    </div>

    <div class="stat-card" style="border-left:4px solid var(--success);">
        <span>Total Anggota</span>
        <h3>{{ $total_user ?? 0 }}</h3>
    </div>
</div>

<div class="card">
    <div class="card-title">
        <h3>Daftar Peminjaman & Pengembalian</h3>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Denda</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
            @forelse($semua_pinjaman as $p)
            <tr>

                {{-- NAMA --}}
                <td>
                    <div style="font-weight:600; color:var(--text-main);">
                        {{ $p->user->name ?? 'User Dihapus' }}
                    </div>

                    <small style="color:var(--text-muted);">
                        ID: #{{ $p->user->id ?? '-' }}
                    </small>
                </td>

                {{-- BUKU --}}
                <td>
                    {{ $p->book->judul ?? 'Buku Dihapus' }}
                </td>

                {{-- TGL PINJAM --}}
                <td>
                    {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}
                </td>

                {{-- TGL KEMBALI / JATUH TEMPO --}}
                <td>
                    @if($p->status == 'dikembalikan')

                        <span style="color:var(--success);">
                            {{ $p->tgl_kembali
                                ? \Carbon\Carbon::parse($p->tgl_kembali)->format('d/m/Y')
                                : '-' }}
                        </span>

                    @else

                        <span style="color:var(--danger);">
                            {{ \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi)->format('d/m/Y') }}
                        </span>

                    @endif
                </td>

                {{-- DENDA --}}
                <td>
                    @php
                        $tglPinjam = \Carbon\Carbon::parse($p->tgl_pinjam);
                        $jatuhTempo = $tglPinjam->copy()->addDays($p->durasi);
                        $dendaPerHari = 1000;
                        $telat = 0;

                        if($p->status == 'dikembalikan' && $p->tgl_kembali){
                            $tglKembali = \Carbon\Carbon::parse($p->tgl_kembali);

                            if($tglKembali->gt($jatuhTempo)){
                                $telat = $jatuhTempo->diffInDays($tglKembali);
                            }
                        }

                        if($p->status == 'dipinjam'){
                            if(now()->gt($jatuhTempo)){
                                $telat = $jatuhTempo->diffInDays(now());
                            }
                        }

                        $totalDenda = $telat * $dendaPerHari;
                    @endphp

                    @if($totalDenda > 0)
                        <span style="color:var(--danger); font-weight:600;">
                            Rp {{ number_format($totalDenda,0,',','.') }}
                        </span>
                    @else
                        <span style="color:var(--success); font-weight:600;">
                            Rp 0
                        </span>
                    @endif
                </td>

                {{-- STATUS --}}
                <td>
                    @if($p->status == 'dikembalikan')
                        <span class="badge bg-success">
                            Sudah Dikembalikan
                        </span>
                    @else
                        <span class="badge bg-warning">
                            Masih Dipinjam
                        </span>
                    @endif
                </td>

            </tr>
            @empty

            <tr>
                <td colspan="6" style="text-align:center; color:var(--text-muted);">
                    Belum ada data transaksi.
                </td>
            </tr>

            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
