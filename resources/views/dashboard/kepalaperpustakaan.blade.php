<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kepala Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3B82F6;
            --sidebar-bg: #FFFFFF;
            --bg-main: #F6F8FB;
            --border: #E5E7EB;
            --text-main: #11142D;
            --text-muted: #6B7280;
            --success: #34C759;
            --warning: #FF8D28;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-main);
            display: flex;
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
            box-sizing: border-box;
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

        /* --- MAIN CONTENT --- */
        .main {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
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
            color: var(--text-muted);
        }

        .profile-area {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            border-radius: 10px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .profile-area:hover {
            background: #F9FAFB;
        }

        .profile-info {
            text-align: right;
            line-height: 1.2;
        }

        .profile-info .name {
            display: block;
            font-weight: 600;
            font-size: 14px;
            color: var(--text-main);
        }

        .profile-info .role {
            font-size: 12px;
            color: var(--text-muted);
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 1px solid var(--border);
        }

        /* --- CONTENT BODY --- */
        .content-body {
            padding: 32px;
        }

        .page-header {
            margin-bottom: 24px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 24px;
            color: var(--text-muted);
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin-top: 15px;
        }

        .card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            overflow: hidden;
        }

        .card-title {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
        }

        .card-title h3 {
            margin: 0;
            color: var(--primary);
            font-size: 1.2rem;
        }

        .table-wrapper {
            padding: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #F9FAFB;
            border: 1px solid var(--border);
            border-radius: 8px;
        }

        th {
            text-align: left;
            padding: 16px;
            color: var(--text-muted);
            font-weight: 600;
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 14px 16px;
            color: var(--text-muted);
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }

        .badge {
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            color: white;
            display: inline-block;
        }
        .bg-success { background: var(--success); }
        .bg-warning { background: var(--warning); }

    </style>
</head>
<body>

    <aside class="sidebar">
       <h2>LibManager</h2>
        <ul>
            <li class="active">Dashboard</li>
            <li>Cari Buku</li>
            <li>Data Buku</li>
            <li>Profile</li>
        </ul>
        <div class="logout-item" onclick="alert('Logout?')">
            <li>Logout</li>
        </div>
    </aside>

    <div class="main">
        <header class="navbar">
            <h1>Sistem Perpustakaan</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">Muhammad Sofyan</span>
                    <span class="role">Kepala Perpustakaan</span>
                </div>
                <img src="https://ui-avatars.com/api/?name=MS&background=3B82F6&color=fff" alt="Avatar" class="avatar">
            </div>
        </header>

        <main class="content-body">
            <div class="page-header">
                <h2>Dashboard Kepala Perpustakaan</h2>
                <div class="divider"></div>
            </div>

            <div class="card">
                <div class="card-title">
                    <h3>Laporan Peminjaman & Pengembalian</h3>
                </div>
                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Isah Aisyah</td>
                                <td>Laskar Pelangi</td>
                                <td>16-Feb-2026</td>
                                <td><span class="badge bg-success">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>Isah Aisyah</td>
                                <td>Laskar Pelangi</td>
                                <td>16-Feb-2026</td>
                                <td><span class="badge bg-success">Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>Isah Aisyah</td>
                                <td>Laskar Pelangi</td>
                                <td>16-Feb-2026</td>
                                <td><span class="badge bg-warning">Dipinjam</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
