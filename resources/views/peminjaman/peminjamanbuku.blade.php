@extends('layout.anggota')

@section('title', 'Konfirmasi Peminjaman')

@section('page-css')
<style>
    .breadcrumb { font-size: 14px; color: var(--text-muted); margin-bottom: 20px; }
    .header-section h2 { font-size: 28px; margin: 0; font-weight: 700; color: #111827; }
    .card-panel { background: #FFFFFF; border: 1px solid var(--border); border-radius: 12px; margin-top: 24px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
    .book-info-header { background: #F9FAFB; padding: 24px; display: flex; gap: 24px; border-bottom: 1px solid var(--border); }
    .book-cover { width: 120px; height: 165px; border-radius: 6px; object-fit: cover; background: #E5E7EB; }
    .book-details h3 { margin: 0 0 8px 0; font-size: 20px; }
    .badge-ready { display: inline-block; background: #D1FAE5; color: #065F46; padding: 4px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; margin-top: 8px; }
    .section-box { padding: 24px; }
    .section-title { font-weight: 600; font-size: 18px; margin-bottom: 16px; }
    .info-box { border: 1px solid var(--border); border-radius: 10px; display: flex; overflow: hidden; }
    .info-label-area { width: 220px; background: #F9FAFB; padding: 16px; border-right: 1px solid var(--border); }
    .info-content-area { flex: 1; padding: 16px; background: white; }
    .info-row { font-size: 15px; height: 45px; display: flex; align-items: center; color: var(--text-muted); }
    .input-field { width: 100%; max-width: 320px; height: 38px; padding: 0 12px; border: 1px solid var(--border); border-radius: 6px; font-family: inherit; outline: none; }
    .input-readonly { background: #F3F4F6; cursor: not-allowed; font-weight: 600; color: #1e293b; border: 1px solid #e5e7eb; }
    .footer-action { padding: 24px; background: #F9FAFB; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; align-items: center; gap: 12px; }
    .btn { padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; transition: 0.3s; }
    .btn-confirm { background: var(--primary, #2563EB); color: white; border: none; }
    .btn-cancel { background: white; color: #374151; border: 1px solid #D1D5DB; }
    .btn:hover { opacity: 0.8; transform: translateY(-1px); }
</style>
@endsection

@section('content')
<div class="breadcrumb">Beranda &nbsp;>&nbsp; Cari Buku &nbsp;>&nbsp; <b>Pinjam Buku</b></div>

<div class="header-section">
    <h2>Konfirmasi Peminjaman</h2>
    <p style="color: var(--text-muted); margin-top: 4px;">Periksa kembali detail peminjaman sebelum menekan tombol konfirmasi.</p>
</div>

@if(session('error'))
    <div style="background: #FEE2E2; color: #991B1B; padding: 15px; border-radius: 8px; margin-top: 20px; border: 1px solid #FECACA;">
        ⚠️ {{ session('error') }}
    </div>
@endif

<form action="{{ route('peminjaman-simpan') }}" method="POST">
    @csrf
    <input type="hidden" name="book_id" value="{{ $buku->id }}">

    <div class="card-panel">
        {{-- Header Info Buku --}}
        <div class="book-info-header">
            <img src="{{ $buku->foto ? asset('storage/buku/' . $buku->foto) : 'https://via.placeholder.com/150x240?text=No+Cover' }}" alt="Cover" class="book-cover">
            <div class="book-details">
                <h3>{{ $buku->judul }}</h3>
                <p style="margin: 4px 0; color: var(--text-muted);">Penulis: {{ $buku->penulis }}</p>
                <div class="badge-ready">Stok: {{ $buku->stok_buku }} Tersedia</div>
            </div>
        </div>

        {{-- Info Peminjam --}}
        <div class="section-box">
            <div class="section-title">Informasi Peminjam</div>
            <div class="info-box">
                <div class="info-label-area">
                    <div class="info-row">Nama Lengkap</div>
                    <div class="info-row">ID Anggota</div>
                </div>
                <div class="info-content-area">
                    <div class="info-row" style="color: #111827; font-weight: 600;">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="info-row">
                        {{ Auth::user()->id_anggota ?? '#'.str_pad(Auth::id(),4,'0',STR_PAD_LEFT) }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Pengaturan Tanggal --}}
        <div class="section-box" style="padding-top: 0;">
            <div class="section-title">Pengaturan Waktu</div>
            <div class="info-box">
                <div class="info-label-area">
                    <div class="info-row">Tanggal Pinjam</div>
                    <div class="info-row">Durasi</div>
                    <div class="info-row">Batas Pengembalian</div>
                </div>
                <div class="info-content-area">
                    <div class="info-row">
                        <!-- Tampilan ke user -->
                        <input type="text" class="input-field input-readonly"
                            value="{{ date('d F Y') }}" readonly>

                        <!-- Data dikirim ke database -->
                        <input type="hidden" name="tgl_pinjam" id="tgl_pinjam"
                            value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="info-row">
                        <select name="durasi" id="durasi" class="input-field">
                            <option value="1">1 Hari</option>
                            <option value="2">2 Hari</option>
                            <option value="3">3 Hari</option>
                            <option value="4">4 Hari</option>
                            <option value="5">5 Hari</option>
                            <option value="6">6 Hari</option>
                            <option value="7">7 Hari (1 Minggu)</option>
                        </select>
                    </div>
                    <div class="info-row">
                        {{-- Tampilan untuk User --}}
                        <input type="text" id="tgl_kembali_display" class="input-field input-readonly" readonly>
                        {{-- Data asli untuk Database --}}
                        <input type="hidden" name="tgl_kembali" id="tgl_kembali_hidden">
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-action">
            <div style="margin-right: auto; font-size: 13px; color: #EF4444; font-weight: 600;">
                * Denda keterlambatan Rp 1.000/hari
            </div>
            <a href="{{ route('peminjaman-cari') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-confirm">Konfirmasi Peminjaman</button>
        </div>
    </div>
</form>
@endsection

@section('page-js')
    <script>
    function updateTanggal() {
        const inputPinjam = document.getElementById('tgl_pinjam');
        const selectDurasi = document.getElementById('durasi');
        const displayKembali = document.getElementById('tgl_kembali_display');
        const hiddenKembali = document.getElementById('tgl_kembali_hidden');

        let tgl = new Date(inputPinjam.value);

        let durasi = parseInt(selectDurasi.value);
        tgl.setDate(tgl.getDate() + durasi);

        // Tampilan Indonesia
        const opsi = { day: 'numeric', month: 'long', year: 'numeric' };
        displayKembali.value = tgl.toLocaleDateString('id-ID', opsi);

        // Format DB
        const y = tgl.getFullYear();
        const m = String(tgl.getMonth() + 1).padStart(2, '0');
        const d = String(tgl.getDate()).padStart(2, '0');

        hiddenKembali.value = `${y}-${m}-${d}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        updateTanggal();

        document.getElementById('durasi').addEventListener('change', updateTanggal);
    });
    </script>
@endsection
