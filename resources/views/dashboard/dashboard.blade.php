<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Anggota</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3B82F6;
            --bg: #F5F7F4;
            --sidebar-bg: #FFFFFF;
            --text-main: #1F2937;
            --text-muted: #6B7280;
            --border: #E5E7EB;
        }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-main);
        }

        .container {
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
            position: fixed; /* Tetap di kiri saat scroll */
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
            flex-grow: 1; /* Mengisi ruang agar logout terdorong ke bawah */
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
            margin-top: auto; /* Memastikan logout di paling bawah */
            border-top: 1px solid #F3F4F6;
            padding-top: 20px !important;
        }

        /* --- MAIN CONTENT --- */
        .main {
            flex: 1;
            margin-left: 260px; /* Jarak agar tidak tertutup sidebar fixed */
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
            border: 2px solid #F3F4F6;
        }

        /* --- DASHBOARD CONTENT --- */
        .content-body {
            padding: 32px;
            max-width: 1200px;
        }

        .welcome-card {
            display: flex;
            align-items: center;
            background: white;
            padding: 28px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 24px;
        }

        .welcome-card img {
            width: 70px;
            height: 70px;
            margin-right: 24px;
        }

        .welcome-text h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .welcome-text p {
            margin: 4px 0 0;
            color: var(--text-muted);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid transparent;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            border-color: var(--primary);
        }

        .stat-card h1 {
            margin: 0;
            color: var(--primary);
            font-size: 2.5rem;
        }

        .stat-card p {
            margin: 8px 0 0;
            font-weight: 500;
            color: var(--text-muted);
        }

        /* Section Boxes */
        .box {
            background: white;
            padding: 24px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            margin-bottom: 32px;
        }

        .box h3 {
            margin: 0 0 20px 0;
            font-size: 1.1rem;
        }

        .loan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #F3F4F6;
        }

        .loan-item:last-child {
            border-bottom: none;
        }

        /* Books Horizontal Scroll */
        .books-scroll {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .book-item {
            min-width: 150px;
            text-align: center;
        }

        .book-item img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            margin-bottom: 12px;
        }

        .book-item p {
            font-size: 0.9rem;
            font-weight: 600;
            margin: 0;
        }

        /* Custom Scrollbar */
        .books-scroll::-webkit-scrollbar {
            height: 6px;
        }
        .books-scroll::-webkit-scrollbar-thumb {
            background: #E5E7EB;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <nav class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li class="active" onclick="location.href=''">Dashboard</li>
            <li onclick="location.href='peminjaman.cari'">Cari Buku</li>
            <li onclick="location.href='peminjaman.saya'">Pinjaman Saya</li>
            <li onclick="location.href='peminjam.riwayat'">Riwayat</li>
            <li class="logout-item" onclick="logout()">Logout</li>
        </ul>
    </nav>

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

        <div class="content-body">
            <div class="welcome-card">
                <img src="storage/image 10.png" alt="icon">
                <div class="welcome-text">
                    <h2>Hai, Angelica 👋</h2>
                    <p>Selamat datang kembali di dashboard perpustakaan kamu.</p>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <h1>2</h1>
                    <p>Buku Dipinjam</p>
                </div>
                <div class="stat-card">
                    <h1>0</h1>
                    <p>Jatuh Tempo</p>
                </div>
                <div class="stat-card">
                    <h1>0</h1>
                    <p>Terlambat</p>
                </div>
            </div>

            <div class="box">
                <h3>Buku Yang Sedang Dipinjam</h3>
                <div class="loan-item">
                    <span>📖 Bahasa Indonesia Kelas 12</span>
                    <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Feb 2026</span>
                </div>
                <div class="loan-item">
                    <span>📖 Algoritma & Struktur Data</span>
                    <span style="color: var(--primary); font-weight: 500;">Kembali: 30 Feb 2026</span>
                </div>
            </div>

            <h3>Rekomendasi Buku</h3>
            <div class="books-scroll">
                <div class="book-item">
                    <img src="storage/bukuu.png" alt="Buku">
                    <p>Bandung After Rain</p>
                </div>
                <div class="book-item">
                    <img src="storage/Rectangle 36 (1).png" alt="Buku">
                    <p>Rumah Alie</p>
                </div>
                <div class="book-item">
                    <img src="storage/Rectangle 36 (2).png" alt="Buku">
                    <p>Lost At Sea</p>
                </div>
                <div class="book-item">
                    <img src="storage/Rectangle 36 (3).png" alt="Buku">
                    <p>Modul Ajar Matematika</p>
                </div>
                <div class="book-item">
                    <img src="storage/Rectangle 36 (4).png" alt="Buku">
                    <p>Laskar Pealngi</p>
                </div>
                <div class="book-item">
                    <img src="storage/Children's Book Cover Design - Catherine Nina.jpg" alt="Buku">
                    <p>Timun Mas</p>
                </div>
                <div class="book-item">
                    <img src="storage/Children's Book Cover Design - Catherine Nina.jpg" alt="Buku">
                    <p>Dillan 1990</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function logout() {
        if(confirm("Apakah anda yakin ingin keluar?")) {
            window.location.href = 'login.html';
        }
    }
</script>

</body>
</html>
