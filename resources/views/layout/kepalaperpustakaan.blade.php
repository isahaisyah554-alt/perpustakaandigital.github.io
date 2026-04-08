<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LibManager</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            --danger: #EF4444;
        }

        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--bg-main); display: flex; min-height: 100vh; }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px; background: var(--sidebar-bg); height: 100vh;
            display: flex; flex-direction: column; position: fixed;
            left: 0; top: 0; border-right: 1px solid var(--border);
            z-index: 100; padding: 24px 16px; box-sizing: border-box;
        }

        .sidebar h2 { margin: 0 0 30px 12px; font-size: 1.25rem; color: var(--primary); font-weight: 700; }
        .sidebar ul { list-style: none; padding: 0; margin: 0; flex-grow: 1; }

        .sidebar li {
            border-radius: 8px;
            margin-bottom: 6px;
            transition: all 0.2s;
            overflow: hidden;
        }

        .sidebar li a {
            text-decoration: none;
            color: var(--text-muted);
            display: flex;
            padding: 12px 16px;
            width: 100%;
            box-sizing: border-box;
            font-weight: 500;
        }

        .sidebar li:hover { background: #F3F4F6; }
        .sidebar li:hover a { color: var(--text-main); }

        /* Style saat Menu AKTIF (Biru) */
        .sidebar li.active { background: var(--primary) !important; }
        .sidebar li.active a { color: white !important; font-weight: 600; }

        .logout-item { border-top: 1px solid #F3F4F6; padding-top: 20px; }
        .logout-btn { color: var(--danger); cursor: pointer; background: none; border: none; font-family: inherit; font-weight: 600; width: 100%; text-align: left; padding: 12px 16px; }

        /* --- MAIN CONTENT --- */
        .main { flex: 1; margin-left: 260px; display: flex; flex-direction: column; min-width: 0; }

        /* --- NAVBAR --- */
        .navbar {
            background: white; padding: 0 32px; height: 70px;
            display: flex; align-items: center; justify-content: space-between;
            border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 90;
        }

        .navbar h1 { font-size: 18px; color: var(--text-main); margin: 0; }

        .profile-area { display: flex; align-items: center; gap: 12px; }
        .profile-info { text-align: right; line-height: 1.2; }
        .profile-info .name { display: block; font-weight: 600; font-size: 14px; color: var(--text-main); }
        .profile-info .role { font-size: 12px; color: var(--text-muted); }
        .avatar { width: 38px; height: 38px; border-radius: 50%; border: 1px solid var(--border); }

        /* --- CONTENT BODY --- */
        .content-body { padding: 32px; }
        .page-header { margin-bottom: 24px; }
        .page-header h2 { margin: 0; font-size: 24px; color: var(--text-main); font-weight: 700; }

        /* Stats Grid */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 20px; border-radius: 12px; border: 1px solid var(--border); }
        .stat-card span { color: var(--text-muted); font-size: 14px; font-weight: 500; }
        .stat-card h3 { margin: 8px 0 0; font-size: 28px; color: var(--text-main); }

        /* Card & Table */
        .card { background: white; border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); overflow: hidden; }
        .card-title { padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; }
        .card-title h3 { margin: 0; color: var(--text-main); font-size: 16px; font-weight: 600; }

        .table-wrapper { padding: 0; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 16px 24px; color: var(--text-muted); font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 1px solid var(--border); background: #FAFBFC; }
        td { padding: 16px 24px; color: var(--text-main); font-size: 14px; border-bottom: 1px solid var(--border); }

        .badge { padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; }
        .bg-success { background: #DCFCE7; color: #166534; }
        .bg-warning { background: #FEF9C3; color: #854D0E; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li class="{{ Route::is('dashboard-kepala') ? 'active' : '' }}">
                <a href="{{ route('dashboard-kepala') }}">Dashboard</a>
            </li>

            <li class="{{ Route::is('kepala.databuku.index') ? 'active' : '' }}">
                <a href="{{ route('kepala.databuku.index') }}">Data Buku</a>
            </li>

            <li class="{{ Request::is('kepala/petugas*') ? 'active' : '' }}">
                <a href="{{ route('kepala.petugas') }}">Data Petugas</a>
            </li>
        </ul>
        <div class="logout-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    <div class="main">
        <header class="navbar">
            <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">{{ Auth::user()->name }}</span>

                    <span class="role">
                        @if(Auth::user()->role == 'kepala')
                            Kepala Perpustakaan
                        @elseif(Auth::user()->role == 'petugas')
                            Petugas Perpustakaan
                        @else
                            Anggota
                        @endif
                    </span>
                </div>
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3B82F6&color=fff" class="avatar">
            </div>
        </header>

        <main class="content-body">
            @yield('content')
        </main>
    </div>

</body>
</html>
