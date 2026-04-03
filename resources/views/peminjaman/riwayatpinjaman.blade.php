<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Riwayat Pinjaman</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:ital,wght@0,500;0,600;1,500&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-blue: #EAF4FF;
            --sidebar-bg: #F9FAFB;
            --primary: #3B82F6;
            --text-main: #11142D;
            --text-muted: #6B7280;
            --border: #E5E7EB;
            --status-green: #34C759;
            --status-yellow: #E1FD66;
        }

        /* Base Resets */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-blue);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            height: 100vh;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid var(--border);
            z-index: 100;
            padding: 24px 16px;
        }

        .sidebar h2 {
            margin: 0 0 30px 12px;
            font-size: 1.25rem;
            color: var(--primary);
            font-weight: 700;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        .sidebar li {
            padding: 12px 16px;
            border-radius: 8px;
            cursor: pointer;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            color: var(--text-muted);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .sidebar li:hover {
            background: #F3F4F6;
            color: var(--text-main);
        }

        .sidebar li.active {
            background: var(--primary);
            color: white;
        }

        .logout-item {
            color: #EF4444 !important;
            margin-top: auto;
            border-top: 1px solid #F3F4F6;
            padding-top: 20px !important;
        }

        /* --- MAIN CONTENT AREA --- */
        .main {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-width: 925px;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: white;
            padding: 0 32px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .navbar h1 {
            font-size: 1.1rem;
            margin: 0;
            font-weight: 600;
        }

      .profile-area {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 12px;
        }

        .profile-info .name {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .profile-info .role {
            font-size: 0.75rem;
            color: #16a34a;
            font-weight: 600;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* --- PAGE CONTENT --- */
        .page-content {
            padding: 30px 40px;
            background: white;
            min-height: calc(100vh - 70px);
        }

        .page-header h2 {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 28px;
            color: var(--text-muted);
        }

        .filter-section {
            background: var(--bg-blue);
            margin: 25px -40px 0 -40px;
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

        .table-area { margin-top: 30px; }
        .history-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--border);
        }
        .history-table thead tr { background: var(--bg-blue); height: 60px; }
        .history-table th {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 16px;
            text-align: left;
            padding: 0 20px;
            border: 1px solid var(--border);
        }
        .history-table td {
            padding: 15px 20px;
            border: 1px solid var(--border);
            font-size: 14px;
        }

        .book-cell { display: flex; align-items: center; gap: 12px; }
        .cover-img { width: 30px; height: 40px; background: #eee; border-radius: 4px; }

        .badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }
        .badge.late { background: var(--status-yellow); color: #444; }
        .badge.returned { background: var(--status-green); color: white; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li onclick="location.href='dashboard.dashboard'">Dashboard</li>
            <li onclick="location.href='peminjaman.cari'">Cari Buku</li>
            <li onclick="location.href='peminjaman.saya'">Pinjaman Saya</li>
            <li class="active">Riwayat Pinjaman</li>
            <li class="logout-item" onclick="logout()">Logout</li>
        </ul>
    </aside>

    <div class="main">
        <header class="navbar">
            <h1>Sistem Perpustakaan</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">Angelica</span>
                    <span class="role">Anggota Aktif</span>
                </div>
                <img src="https://ui-avatars.com/api/?name=Angelica&background=3B82F6&color=fff" alt="Avatar" class="avatar">
            </div>
        </header>

        <main class="page-content">
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
                            <td><div class="book-cell"><div class="cover-img"></div><span>Rumah Alie</span></div></td>
                            <td>04-02-2026</td>
                            <td>18-02-2026</td>
                            <td>21-02-2026</td>
                            <td><span class="badge late">Terlambat</span></td>
                            <td>Rp. 5.000</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><div class="book-cell"><div class="cover-img"></div><span>Laskar Pelangi</span></div></td>
                            <td>02-02-2026</td>
                            <td>16-02-2026</td>
                            <td>21-02-2026</td>
                            <td><span class="badge returned">Dikembalikan</span></td>
                            <td>Rp. 0</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <script>
        function resetFilter() {
            document.getElementById('searchInput').value = '';
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';
        }

        function logout() {
            if(confirm("Apakah anda yakin ingin keluar?")) {
                window.location.href = 'login.html';
            }
        }
    </script>
</body>
</html>
