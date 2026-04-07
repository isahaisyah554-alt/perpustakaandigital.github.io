@extends('layout.anggota')

@section('title', 'Riwayat Pinjaman')

@section('page-css')
<style>
    /* --- KHUSUS RIWAYAT --- */
    .page-header h2 {
        font-family: 'Inter';
        font-weight: 600;
        font-size: 28px;
        color: var(--text-muted);
    }

    .filter-section {
        background: #EAF4FF; /* Biru muda sesuai desain asli kamu */
        margin: 25px -32px 0 -32px;
        padding: 30px 40px;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.05);
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
    }

    .filter-item {
        background: white;
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0 12px;
        height: 45px;
        display: flex;
        align-items: center;
    }

    .search-input { width: 350px; }
    .search-input input, .date-input input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 14px;
        color: var(--text-muted);
        font-family: inherit;
    }

    .date-input { width: 200px; }
    .filter-label { font-size: 13px; color: var(--text-muted); margin-right: 8px; }

    .btn-reset {
        background: var(--primary);
        color: white;
        padding: 0 20px;
        height: 45px;
        border-radius: 10px;
        border: none;
        font-weight: 500;
        cursor: pointer;
    }

    .table-area {
        margin-top: 30px;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .history-table thead tr { background: #f8fafc; height: 60px; }
    .history-table th {
        color: var(--text-muted);
        font-weight: 600;
        font-size: 14px;
        text-align: left;
        padding: 0 20px;
        border-bottom: 2px solid var(--border);
    }

    .history-table td {
        padding: 15px 20px;
        border-bottom: 1px solid var(--border);
        font-size: 14px;
    }

    .book-cell { display: flex; align-items: center; gap: 12px; }
    .cover-img { width: 30px; height: 40px; background: #eee; border-radius: 4px; }

    .badge {
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }
    .badge.late { background: #FFECC7; color: #D97706; }
    .badge.returned { background: #D1FAE5; color: #059669; }
</style>
@endsection

@section('content')
    <div class="page-header">
        <h2>Riwayat Pinjaman</h2>
        <p style="color: #999; font-size: 14px;">Daftar semua buku yang pernah Anda pinjam</p>
    </div>

    <section class="filter-section">
        <div class="filter-item search-input">
            <span style="margin-right:8px;">🔍</span>
            <input type="text" id="searchInput" placeholder="Cari judul buku / penulis">
        </div>
        <div class="filter-item date-input">
            <span class="filter-label">Dari:</span>
            <input type="date" id="startDate">
        </div>
        <div class="filter-item date-input">
            <span class="filter-label">Sampai:</span>
            <input type="date" id="endDate">
        </div>
        <button class="btn-reset" onclick="resetFilter()">Reset Filter</button>
    </section>

    <section class="table-area">
        <table class="history-table">
            <thead>
                <tr>
                    <th style="width: 50px;">NO</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <div class="book-cell">
                            <div class="cover-img"></div>
                            <span>Rumah Alie</span>
                        </div>
                    </td>
                    <td>04-02-2026</td>
                    <td>18-02-2026</td>
                    <td>21-02-2026</td>
                    <td><span class="badge late">Terlambat</span></td>
                    <td><strong style="color: #EF4444;">Rp. 5.000</strong></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div class="book-cell">
                            <div class="cover-img"></div>
                            <span>Laskar Pelangi</span>
                        </div>
                    </td>
                    <td>02-02-2026</td>
                    <td>16-02-2026</td>
                    <td>21-02-2026</td>
                    <td><span class="badge returned">Dikembalikan</span></td>
                    <td>Rp. 0</td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection

@section('page-js')
<script>
    function resetFilter() {
        document.getElementById('searchInput').value = '';
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';
    }
</script>
@endsection
