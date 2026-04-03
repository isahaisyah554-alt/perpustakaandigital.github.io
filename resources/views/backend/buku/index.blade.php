<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petugas - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- ROOT & VARIABLES --- */
        :root {
            --primary: #3B82F6;
            --sidebar-bg: #FFFFFF;
            --border: #E5E7EB;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --bg-body: #F8FAFC;
        }

        /* --- RESET --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-body);
            font-family: 'Inter', sans-serif;
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
        }

        .sidebar h2 {
            margin: 0 0 30px 12px;
            font-size: 1.5rem;
            color: var(--primary);
            font-weight: 700;
            font-style: italic;
        }

        .sidebar ul {
            list-style: none;
            flex-grow: 1; /* PENTING: Ini mendorong apapun di bawahnya ke dasar */
        }

        .sidebar li a {
            text-decoration: none;
            color: var(--text-muted);
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            font-weight: 500;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .sidebar li a:hover {
            background: #F3F4F6;
            color: var(--text-main);
        }

        .sidebar li.active a {
            background: var(--primary);
            color: white;
        }

        /* --- LOGOUT SECTION (BAWAH) --- */
        .logout-form {
            margin-top: auto; /* Memastikan nempel di bawah */
            border-top: 1px solid #F3F4F6;
            padding-top: 20px;
            margin-bottom: 10px;
        }

        .logout-btn {
            color: #EF4444;
            cursor: pointer;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            font-family: 'Inter';
            font-size: 16px;
            font-weight: 500;
            padding: 12px 16px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: background 0.2s;
        }

        .logout-btn:hover {
            background: #FEF2F2;
        }

        /* --- MAIN CONTENT --- */
        .main {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: white;
            padding: 0 32px;
            height: 87px;
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
            font-weight: 600;
            color: var(--text-main);
        }

        .profile-area {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            border-radius: 10px;
            transition: background 0.2s;
            cursor: pointer;
        }

        .profile-area:hover { background: #F9FAFB; }

        .profile-info { text-align: right; line-height: 1.2; }
        .profile-info .name { display: block; font-weight: 600; font-size: 14px; color: var(--text-main); }
        .profile-info .role { font-size: 12px; color: var(--text-muted); }

        /* --- CONTENT BODY --- */
        .content-body { padding: 40px; max-width: 1100px; }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 15px;
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .stat-card .icon { font-size: 40px; }
        .stat-card .value { display: block; font-size: 24px; font-weight: 700; color: var(--text-main); }

        .table-section {
            background: white;
            padding: 24px;
            border-radius: 15px;
            border: 1px solid var(--border);
        }

        .header-table {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .btn-action {
            background: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 12px; border-bottom: 2px solid var(--bg-body); color: var(--text-muted); font-size: 13px; text-transform: uppercase; }
        td { padding: 16px 12px; border-bottom: 1px solid var(--bg-body); font-size: 14px; }

        .badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .bg-success { background: #DCFCE7; color: #166534; }
        .bg-warning { background: #FEF3C7; color: #92400E; }

    </style>
</head>
<body>

    <aside class="sidebar">
         <h2>LibManager</h2>
        <ul>
            <li class="active"><a href="#">Dashboard</a></li>
            <li><a href="#">Data Buku</a></li>
            <li><a href="#">Data Anggota</a></li>
            <li><a href="#">Peminjaman</a></li>
        </ul>

        <form action="/logout" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <span style="margin-right: 10px;">🚪</span> Logout
            </button>
        </form>
    </aside>

    <main class="main">
        <header class="navbar">
            <h1>Dashboard Overview</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">Bapak Muhammad Arif</span>
                    <span class="role">Petugas Perpustakaan</span>
                </div>
                <div style="width: 40px; height: 40px; background: #E5E7EB; border-radius: 50%;"></div>
            </div>
        </header>

        <div class="content-body">
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="icon">📘</span>
                    <div>
                        <p style="color: var(--text-muted); font-size: 14px;">Total Koleksi Buku</p>
                        <span class="value">{{ $books->count() }}</span>
                    </div>
                </div>
                <div class="stat-card">
                    <span class="icon">⏳</span>
                    <div>
                        <p style="color: var(--text-muted); font-size: 14px;">Pinjaman Aktif</p>
                        <span class="value">2,891</span>
                    </div>
                </div>
            </div>

            <section class="table-section">
                <div class="header-table">
                    <h2 style="font-size: 18px; color: var(--text-main);">Daftar Buku Terbaru</h2>
                    <a href="/books/create" class="btn-action">+ Tambah Buku Baru</a>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Stok</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <td style="font-weight: 600;">{{ $book->judul }}</td>
                                <td>{{ $book->penulis }}</td>
                                <td>{{ $book->stok_buku }} unit</td>
                                <td>
                                    @if($book->stok_buku > 5)
                                        <span class="badge bg-success">Tersedia</span>
                                    @else
                                        <span class="badge bg-warning">Stok Tipis</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>

</body>
</html>
