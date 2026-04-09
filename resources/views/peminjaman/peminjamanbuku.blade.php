@extends('layout.anggota')

@section('title', 'Konfirmasi Peminjaman')

@section('page-css')
<style>
    /* --- CONTENT BODY --- */
    .breadcrumb {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 20px;
    }

    .header-section h2 {
        font-size: 28px;
        margin: 0;
        font-weight: 700;
        color: #111827;
    }

    /* Card & Forms */
    .card-panel {
        background: #FFFFFF;
        border: 1px solid var(--border);
        border-radius: 12px;
        margin-top: 24px;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .book-info-header {
        background: #F9FAFB;
        padding: 24px;
        display: flex;
        gap: 24px;
        border-bottom: 1px solid var(--border);
    }

    .book-cover {
        width: 120px;
        height: 165px;
        border-radius: 6px;
        object-fit: cover;
        background: #E5E7EB;
    }

    .book-details h3 {
        margin: 0 0 8px 0;
        font-size: 20px;
    }

    .book-details p {
        font-size: 15px;
        color: var(--text-muted);
        margin: 4px 0;
    }

    .badge-ready {
        display: inline-block;
        background: #D1FAE5;
        color: #065F46;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 600;
        margin-top: 8px;
    }

    .section-box {
        padding: 24px;
    }

    .section-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 16px;
    }

    .info-box {
        border: 1px solid var(--border);
        border-radius: 10px;
        display: flex;
        overflow: hidden;
    }

    .info-label-area {
        width: 220px;
        background: #F9FAFB;
        padding: 16px;
        border-right: 1px solid var(--border);
    }

    .info-content-area {
        flex: 1;
        padding: 16px;
        background: white;
    }

    .info-row {
        font-size: 15px;
        height: 45px;
        display: flex;
        align-items: center;
        color: var(--text-muted);
    }

    .input-field {
        width: 100%;
        max-width: 320px;
        height: 38px;
        padding: 0 12px;
        border: 1px solid var(--border);
        border-radius: 6px;
        font-family: inherit;
        outline: none;
    }

    .input-readonly {
        background: #F3F4F6;
        cursor: not-allowed;
    }

    .footer-action {
        padding: 24px;
        background: #F9FAFB;
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 12px;
    }

    .penalty-text {
        margin-right: auto;
        font-size: 14px;
        color: var(--text-muted);
    }

    .btn {
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid var(--border);
        transition: 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-confirm {
        background: var(--primary, #2563EB);
        color: white;
        border: none;
    }

    .btn-cancel {
        background: white;
        color: #374151;
        border: 1px solid #D1D5DB;
    }

    .btn:hover {
        opacity: 0.9;
    }
</style>
@endsection

@section('content')
<div class="breadcrumb">Beranda &nbsp;>&nbsp; Cari Buku &nbsp;>&nbsp; <b>Pinjam Buku</b></div>

<div class="header-section">
    <h2>Konfirmasi Peminjaman</h2>
    <p style="color: var(--text-muted); margin-top: 4px;">Atur detail waktu peminjaman buku Anda.</p>
</div>

{{-- Tampilkan Pesan Error Jika Ada --}}
@if(session('error'))
    <div style="background: #FEE2E2; color: #991B1B; padding: 15px; border-radius: 8px; margin-top: 20px;">
        {{ session('error') }}
    </div>
@endif

<form action="{{ route('peminjaman-simpan') }}" method="POST">
    @csrf

    {{-- 1. INPUT HIDDEN BOOK ID (WAJIB ADA) --}}
    <input type="hidden" name="book_id" value="{{ $buku->id }}">

    <div class="card-panel">
        <div class="book-info-header">
            {{-- 2. COVER & DATA BUKU DINAMIS --}}
            <img src="{{ asset('storage/' . ($buku->cover ?? 'default.png')) }}" alt="Cover" class="book-cover">
            <div class="book-details">
                <h3>{{ $buku->judul }}</h3>
                <p>Penulis: {{ $buku->penulis }}</p>
                <div class="badge-ready">Stok: {{ $buku->stok_buku }} Buku Tersedia</div>
            </div>
        </div>

        <div class="section-box">
            <div class="section-title">Informasi Peminjam</div>
            <div class="info-box">
                <div class="info-label-area">
                    <div class="info-row">Nama Lengkap</div>
                    <div class="info-row">ID Anggota</div>
                    <div class="info-row">Status Keanggotaan</div>
                </div>
                <div class="info-content-area">
                    {{-- 3. DATA USER LOGIN OTOMATIS --}}
                    <div class="info-row" style="color: var(--text-main); font-weight: 600;">{{ Auth::user()?->name ?? 'Guest' }}</div>
                    <div class="info-row">{{ Auth::user()->id_anggota ?? 'AGT-'.Auth::id() }}</div>
                    <div class="info-row" style="color: #10B981; font-weight: 600;">Aktif</div>
                </div>
            </div>
        </div>

        <div class="section-box" style="padding-top: 0;">
            <div class="section-title">Pengaturan Peminjaman</div>
            <div class="info-box">
                <div class="info-label-area">
                    <div class="info-row">Tanggal Pinjam</div>
                    <div class="info-row">Durasi Peminjaman</div>
                    <div class="info-row">Batas Pengembalian</div>
                </div>
                <div class="info-content-area">
                    <div class="info-row">
                        <input type="date" name="tgl_pinjam" id="tgl_pinjam" class="input-field" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="info-row">
                        <select name="durasi" id="durasi" class="input-field">
                            <option value="3">3 Hari</option>
                            <option value="7">7 Hari (1 Minggu)</option>
                            <option value="14" selected>14 Hari (2 Minggu)</option>
                            <option value="30">30 Hari (1 Bulan)</option>
                        </select>
                    </div>
                    <div class="info-row">
                        <input type="text" id="tgl_kembali" class="input-field input-readonly" readonly placeholder="Menghitung...">
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-action">
            <div class="penalty-text">Denda Keterlambatan: <b>Rp 1.000 / Hari</b></div>
            <a href="{{ route('peminjaman-cari') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-confirm">Ajukan Pinjaman</button>
        </div>
    </div>
</form>
@endsection

@section('page-js')
<script>
    function hitungTanggalKembali() {
        const tglPinjamInput = document.getElementById('tgl_pinjam');
        const durasiSelect = document.getElementById('durasi');
        const tglKembaliInput = document.getElementById('tgl_kembali');

        if (tglPinjamInput.value) {
            let tanggal = new Date(tglPinjamInput.value);
            let durasi = parseInt(durasiSelect.value);

            // Tambah hari
            tanggal.setDate(tanggal.getDate() + durasi);

            // Format ke bahasa Indonesia
            const opsi = { day: 'numeric', month: 'long', year: 'numeric' };
            tglKembaliInput.value = tanggal.toLocaleDateString('id-ID', opsi);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        hitungTanggalKembali();
        document.getElementById('tgl_pinjam').addEventListener('change', hitungTanggalKembali);
        document.getElementById('durasi').addEventListener('change', hitungTanggalKembali);
    });
</script>
@endsection
