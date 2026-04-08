@extends('layout.petugas')

@section('title', 'Data Pengembalian')

@section('content')
<div class="container-pengembalian" style="padding: 20px; background: #f8f9fa;">
    <div style="margin-bottom: 25px;">
        <h2 style="font-weight: 800; color: #1e293b;">📥 Verifikasi Pengembalian</h2>
        <p style="color: #64748b;">Pastikan buku sudah diterima fisik sebelum klik verifikasi.</p>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead style="background: #10B981; color: white;">
                <tr>
                    <th style="padding: 15px; text-align: left;">Peminjam</th>
                    <th style="padding: 15px; text-align: left;">Buku</th>
                    <th style="padding: 15px; text-align: center;">Jatuh Tempo</th>
                    <th style="padding: 15px; text-align: center;">Denda</th>
                    <th style="padding: 15px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengembalian as $p)
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 15px;">
                        <strong>{{ $p->user->name }}</strong><br>
                        <small style="color: #94a3b8;">ID: {{ $p->user_id }}</small>
                    </td>
                    <td style="padding: 15px;">{{ $p->buku->judul ?? 'Buku Dihapus' }}</td>

                    {{-- TANGGAL JATUH TEMPO --}}
                    <td style="padding: 15px; text-align: center;">
                        @php
                            $jatuh_tempo = \Carbon\Carbon::parse($p->tgl_pinjam)->addDays($p->durasi);
                        @endphp
                        {{ $jatuh_tempo->format('d/m/Y') }}
                    </td>

                    {{-- KOLOM DENDA --}}
                    <td style="padding: 15px; text-align: center;">
                        @php
                            $denda_live = 0;
                            // Jika status sudah kembali, ambil dari DB. Jika belum, hitung pakai hari ini (now())
                            if($p->status == 'dikembalikan') {
                                $denda_live = $p->denda;
                            } else {
                                if (now()->gt($jatuh_tempo)) {
                                    $hari = now()->diffInDays($jatuh_tempo);
                                    $denda_live = $hari * 1000;
                                }
                            }
                        @endphp

                        @if($denda_live > 0)
                            <div style="background: #fee2e2; color: #b91c1c; padding: 5px 12px; border-radius: 20px; font-weight: bold; font-size: 12px; display: inline-block;">
                                ⚠️ Rp {{ number_format($denda_live, 0, ',', '.') }}
                            </div>
                        @else
                            <span style="color: #10B981; font-weight: 600;">✅ Rp 0</span>
                        @endif
                    </td>

                    {{-- TOMBOL AKSI --}}
                    <td style="padding: 15px; text-align: center;">
                        @if($p->status == 'pengajuan_kembali')
                            <form action="{{ route('petugas.pengembalian.terima', $p->id) }}" method="POST">
                                @csrf
                                <button type="submit"
                                    style="background: #10B981; color: white; border: none; padding: 8px 16px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s;"
                                    onmouseover="this.style.background='#059669'"
                                    onmouseout="this.style.background='#10B981'"
                                    onclick="return confirm('Konfirmasi pengembalian buku? Stok akan bertambah.')">
                                    Verifikasi
                                </button>
                            </form>
                        @else
                            <span style="color: #64748b; font-weight: bold; background: #f1f5f9; padding: 5px 12px; border-radius: 8px;">
                                Selesai
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                        Tidak ada pengajuan pengembalian hari ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
