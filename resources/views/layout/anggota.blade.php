<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #3B82F6; --bg: #F5F7F4; --sidebar-bg: #FFFFFF; --text-main: #1F2937; --text-muted: #6B7280; --border: #E5E7EB; }
        body { margin: 0; font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-main); }
        .container { display: flex; min-height: 100vh; }

        /* --- SIDEBAR FIXED (Biar kotak putihnya muncul lagi) --- */
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

        .sidebar h2 { margin: 0 0 30px 12px; font-size: 1.25rem; color: var(--primary); font-weight: 700; }

        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
        }

        /* Biar Link (tag a) ngga berwarna biru dan ngga ada garis bawah */
        .sidebar li a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            width: 100%;
            height: 100%;
            padding: 12px 16px; /* Padding di sini biar area klik luas */
        }

        .sidebar li {
            border-radius: 8px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
            font-weight: 500;
            color: var(--text-muted);
        }

        .sidebar li:hover {
            background: #F3F4F6;
            color: var(--text-main);
        }

        .sidebar li.active {
            background: var(--primary);
            color: white !important;
        }

        .sidebar li.active a {
            color: white !important;
        }

        .logout-item {
            color: #EF4444 !important;
            margin-top: auto;
            border-top: 1px solid #F3F4F6;
            padding-top: 10px !important;
        }

        /* MAIN & NAVBAR */
        .main { flex: 1; margin-left: 260px; display: flex; flex-direction: column; }
        .navbar { background: white; padding: 0 32px; height: 70px; display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 90; }
        .navbar h1 { font-size: 1.1rem; margin: 0; font-weight: 600; }

        .profile-area { display: flex; align-items: center; gap: 12px; padding: 6px 12px; background: rgba(255, 255, 255, 0.7); border-radius: 12px; }
        .profile-info .name { display: block; font-weight: 600; font-size: 0.9rem; }
        .profile-info .role { font-size: 0.75rem; color: #16a34a; font-weight: 600; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #F3F4F6; }

        .content-body { padding: 32px; max-width: 1200px; }

        @yield('page-css')
        @yield('page-js')
    </style>
</head>
<body>
<div class="container">
    <nav class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li class="{{ Request::routeIs('dashboard-anggota') ? 'active' : '' }}">
                <a href="{{ route('dashboard-anggota') }}">Dashboard</a>
            </li>

            <li class="{{ Request::is('peminjaman-cari') || Request::is('pinjam-buku/*') ? 'active' : '' }}">
                <a href="{{ route('peminjaman-cari') }}">Cari Buku</a>
            </li>

            <li class="{{ Request::routeIs('peminjaman-saya') ? 'active' : '' }}">
                <a href="{{ route('peminjaman-saya') }}">Pinjaman Saya</a>
            </li>

            <li class="{{ Request::routeIs('peminjaman-riwayat') ? 'active' : '' }}">
                <a href="{{ route('peminjaman-riwayat') }}">Riwayat</a>
            </li>

            <li class="logout-item" onclick="logout()">
                <a href="#">Logout</a>
            </li>
        </ul>
    </nav>

    <div class="main">
        <header class="navbar">
            <h1>Sistem Perpustakaan</h1>
            <div class="profile-area">
                <div class="profile-info">
                    {{-- Mengambil nama dari kolom 'name' di tabel users --}}
                    <span class="name">{{ Auth::user()->name }}</span>
                    <span class="role">Anggota Aktif</span>
                </div>
                {{-- Menggunakan UI-Avatars agar foto profil otomatis sesuai inisial nama user --}}
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff" alt="Avatar" class="avatar">
            </div>
        </header>

        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>

<script>
    function logout() {
        if(confirm("Apakah anda yakin ingin keluar?")) {
            window.location.href = '/login';
        }
    }
</script>
</body>
</html>
