@extends('layout.petugas')

@section('title', 'Data Peminjaman')

@section('page-css')
<style>
    /* Styling Dasar Page */
    .page-wrapper {
        padding: 24px;
        background: #F8FAFC;
        min-height: 100vh;
    }

    .page-title {
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 28px;
        color: #6B7280;
        margin-bottom: 24px;
    }

    /* Frame 60 - Filter & Search Bar */
    .filter-container {
        background: #EAF4FF;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.08);
        border-radius: 12px;
        padding: 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 30px;
    }

    .search-box, .status-box {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        padding: 10px 16px;
        height: 49px;
    }

    .search-box { flex: 2; }
    .status-box { flex: 1; justify-content: space-between; cursor: pointer; }

    .search-box input {
        border: none;
        outline: none;
        width: 100%;
        font-size: 16px;
        color: #6B7280;
        margin-left: 10px;
    }

    .btn-input-pinjaman {
        flex: 1;
        background: rgba(59, 130, 246, 0.8);
        border: 1px solid #1153BF;
        border-radius: 12px;
        height: 49px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #1153BF;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-input-pinjaman:hover {
        background: rgba(59, 130, 246, 1);
        color: white;
    }

    /* Frame 90 & 103 - Table Styling */
    .table-container {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1100px;
    }

    thead {
        background: #EAF4FF;
    }

    th {
        padding: 20px;
        text-align: left;
        font-family: 'Inter', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #6B7280;
        border-bottom: 1px solid #E5E7EB;
        border-right: 1px solid #E5E7EB;
    }

    td {
        padding: 18px 20px;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
        font-size: 15px;
        color: #6B7280;
        border-bottom: 1px solid #E5E7EB;
        border-right: 1px solid #E5E7EB;
    }

    /* Status Colors */
    .status-badge {
        font-weight: 600;
    }
    .text-dipinjam { color: #3B82F6; }
    .text-terlambat { color: #EF4444; }
    .text-kembali { color: #10B981; }

    /* Frame 72 - Pagination */
    .pagination-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 30px;
        padding-bottom: 40px;
    }

    .page-item {
        width: 33px;
        height: 33px;
        background: #FFFFFF;
        border: 1px solid #F5F7F4;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
        color: #000000;
        text-decoration: none;
    }

    .page-item.active {
        background: #3B82F6;
        color: #FFFFFF;
    }

    .nav-btn {
        font-weight: 600;
        color: #000000;
        text-decoration: none;
        margin: 0 15px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper">
    <h1 class="page-title">Data Peminjaman</h1>

    <div class="filter-container">
        <div class="search-box">
            <img src="https://cdn-icons-png.flaticon.com/512/622/622669.png" width="20" alt="search">
            <input type="text" placeholder="Cari ID Peminjam / Nama">
        </div>

        <div class="status-box">
            <span>Status</span>
            <span style="transform: rotate(90deg); font-size: 12px;">▶</span>
        </div>

        <a href="#" class="btn-input-pinjaman">
            + Input Pinjaman
        </a>
    </div>

    <div class="table-container">
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Gt-99008</td>
                        <td>Isah Aisyah</td>
                        <td>Laskar Pelangi</td>
                        <td>02-Feb-2026</td>
                        <td>16-Feb-2026</td>
                        <td class="status-badge text-dipinjam">Sedang Dipinjam</td>
                    </tr>
                    <tr>
                        <td>Gt-99008</td>
                        <td>Isah Aisyah</td>
                        <td>Laskar Pelangi</td>
                        <td>02-Feb-2026</td>
                        <td>16-Feb-2026</td>
                        <td class="status-badge text-terlambat">Terlambat</td>
                    </tr>
                    <tr>
                        <td>Gt-99008</td>
                        <td>Isah Aisyah</td>
                        <td>Laskar Pelangi</td>
                        <td>02-Feb-2026</td>
                        <td>16-Feb-2026</td>
                        <td class="status-badge text-kembali">Dikembalikan</td>
                    </tr>
                    </tbody>
            </table>
        </div>
    </div>

    <div class="pagination-wrapper">
        <a href="#" class="nav-btn">&lt; Prev</a>
        <a href="#" class="page-item">1</a>
        <a href="#" class="page-item">2</a>
        <a href="#" class="page-item active">3</a>
        <a href="#" class="page-item">4</a>
        <a href="#" class="nav-btn">Next &gt;</a>
    </div>
</div>
@endsection
