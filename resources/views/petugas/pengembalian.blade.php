@extends('layout.petugas')

@section('title', 'Data Pengembalian')

@section('content')
<div class="container-pengembalian" style="padding:20px; background:#f8f9fa;">

    <div style="margin-bottom:25px;">
        <h2 style="font-weight:800; color:#1e293b;">📥 Verifikasi Pengembalian</h2>
        <p style="color:#64748b;">
            Pastikan buku sudah diterima fisik sebelum klik verifikasi.
        </p>
    </div>

    <div style="background:white; border-radius:12px; box-shadow:0 4px 6px rgba(0,0,0,0.05); overflow:hidden;">

        <table style="width:100%; border-collapse:collapse;">

            <thead style="background:#10B981; color:white;">
                <tr>
                    <th style="padding:15px; text-align:left;">Peminjam</th>
                    <th style="padding:15px; text-align:left;">Buku</th>
                    <th style="padding:15px; text-align:center;">Tgl Pinjam</th>
                    <th style="padding:15px; text-align:center;">Jatuh Tempo</th>
                    <th style="padding:15px; text-align:center;">Tgl Kembali</th>
                    <th style="padding:15px; text-align:center;">Denda</th>
                    <th style="padding:15px; text-align:center;">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($pengembalian as $p)
            <tr style="border-bottom:1px solid #edf2f7;">

                {{-- PEMINJAM --}}
                <td style="padding:15px;">
                    <strong>{{ $p->user->name ?? 'User Hilang' }}</strong><br>

                    <small style="color:#94a3b8; font-weight:600;">
                        {{ 'AGT' . str_pad($p->user_id, 4, '0', STR_PAD_LEFT) }}
                    </small>
                </td>

                {{-- BUKU --}}
                <td style="padding:15px;">
                    <strong style="color:#1e293b;">
                        {{ $p->book->judul ?? 'Buku Dihapus' }}
                    </strong><br>

                    <small style="color:#94a3b8; font-weight:600;">
                        {{ 'BK' . str_pad($p->book_id, 4, '0', STR_PAD_LEFT) }}
                    </small>
                </td>

                {{-- TGL PINJAM --}}
                <td style="padding:15px; text-align:center;">
                    <span style="font-weight:600; color:#2563eb;">
                        {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d/m/Y') }}
                    </span>
                </td>

                {{-- JATUH TEMPO --}}
                <td style="padding:15px; text-align:center;">
                    @php
                        $jatuh_tempo = \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi);
                    @endphp

                    <span style="font-weight:600; color:#dc2626;">
                        {{ $jatuh_tempo->format('d/m/Y') }}
                    </span>
                </td>

                {{-- TGL KEMBALI --}}
                <td style="padding:15px; text-align:center;">

                    @if($p->tgl_kembali)
                        <span style="font-weight:600; color:#16a34a;">
                            {{ \Carbon\Carbon::parse($p->tgl_kembali)->format('d/m/Y') }}
                        </span>
                    @else
                        <span style="color:#64748b;">
                            {{ now()->format('d/m/Y') }}
                        </span>
                    @endif

                </td>

                {{-- DENDA --}}
                <td style="padding:15px; text-align:center;">
                    @php
                        $denda_live = 0;

                        if($p->status == 'dikembalikan'){
                            $denda_live = $p->denda;
                        } else {
                            if(now()->gt($jatuh_tempo)){
                                $hari = now()->diffInDays($jatuh_tempo);
                                $denda_live = $hari * 1000;
                            }
                        }
                    @endphp

                    @if($denda_live > 0)
                        <div style="
                            background:#fee2e2;
                            color:#b91c1c;
                            padding:5px 12px;
                            border-radius:20px;
                            font-weight:bold;
                            font-size:12px;
                            display:inline-block;
                        ">
                            ⚠️ Rp {{ number_format($denda_live,0,',','.') }}
                        </div>
                    @else
                        <span style="color:#10B981; font-weight:600;">
                            ✅ Rp 0
                        </span>
                    @endif
                </td>

                {{-- AKSI --}}
                <td style="padding:15px; text-align:center;">

    @if($p->status == 'pengajuan_kembali')

        {{-- Tombol Verifikasi --}}
        <form action="{{ route('petugas.pengembalian.terima', $p->id) }}" method="POST">
            @csrf
            <button type="submit"
                style="
                    background:#10B981;
                    color:white;
                    border:none;
                    padding:8px 16px;
                    border-radius:8px;
                    font-weight:bold;
                    cursor:pointer;
                "
                onclick="return confirm('Konfirmasi pengembalian buku? Stok akan bertambah.')">
                Verifikasi
            </button>
        </form>

        {{-- Tombol Struk Denda --}}
        @if($denda_live > 0)
            <a href="{{ route('petugas.struk', $p->id) }}"
               target="_blank"
               style="
                    display:inline-block;
                    margin-top:8px;
                    background:#dc2626;
                    color:white;
                    padding:6px 12px;
                    border-radius:6px;
                    font-size:12px;
                    font-weight:bold;
                    text-decoration:none;
               ">
                🧾 Struk Denda
            </a>
        @endif

    @else

        <span style="
            color:#64748b;
            font-weight:bold;
            background:#f1f5f9;
            padding:5px 12px;
            border-radius:8px;
        ">
            Selesai
        </span>

    @endif

</td>

            </tr>

            @empty

            <tr>
                <td colspan="7"
                    style="padding:40px; text-align:center; color:#94a3b8;">
                    Tidak ada pengajuan pengembalian hari ini.
                </td>
            </tr>

            @endforelse
            </tbody>

        </table>

    </div>
</div>
@endsection
