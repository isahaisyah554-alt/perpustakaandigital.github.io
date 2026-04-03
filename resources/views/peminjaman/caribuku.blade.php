<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Perpustakaan - Cari Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
        }

        /* --- SIDEBAR (Sesuai Permintaan) --- */
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

        /* --- MAIN CONTENT & NAVBAR --- */
        .main {
            flex: 1;
            margin-left: 260px; /* Supaya tidak tertutup sidebar */
            display: flex;
            flex-direction: column;
        }

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

        /* --- KATALOG CONTENT --- */
        .content-body {
            padding: 30px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .search-area {
            margin-bottom: 30px;
        }

        .search-box input {
            width: 100%;
            max-width: 450px;
            padding: 14px 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
            outline: none;
            font-family: inherit;
            transition: 0.3s;
        }

        .search-box input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        /* Books Grid */
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background: white;
            padding: 16px;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 1px solid transparent;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
        }

        .card img {
            width: 130px;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .card .title {
            margin: 0 0 6px 0;
            font-size: 16px;
            font-weight: 700;
            color: var(--text-main);
        }

        .card .info {
            font-size: 13px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .card .status {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .status.ready { color: #10B981; }
        .status.empty { color: #EF4444; }

        .card button {
            margin-top: auto;
            width: 100%;
            padding: 12px;
            border: none;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .card button:hover:not(:disabled) {
            background: #2563EB;
        }

        .card button:disabled {
            background: #D1D5DB;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="container">
    <nav class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li onclick="location.href='dashboard.dashboard'">Dashboard</li>
            <li class="active" onclick="location.href='cari.html'">Cari Buku</li>
            <li onclick="location.href='peminjaman.saya'">Pinjaman Saya</li>
            <li onclick="location.href='peminjaman.riwayat'">Riwayat</li>
            <li class="logout-item" onclick="logout()">Logout</li>
        </ul>
    </nav>

    <div class="main">
        <header class="navbar">
            <h1>Katalog Perpustakaan</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">Angelica</span>
                    <span class="role">Anggota Aktif</span>
                </div>
                <img src="https://ui-avatars.com/api/?name=Angelica&background=3B82F6&color=fff" alt="Avatar" class="avatar">
            </div>
        </header>

        <div class="content-body">
            <div class="breadcrumb">Beranda > <strong>Cari Buku</strong></div>

            <div class="search-area">
                <div class="search-box">
                    <input type="text" placeholder="Cari judul, penulis, atau ISBN...">
                </div>
            </div>

            <div class="books-grid">
                <div class="card">
                    <img src="storage/Rectangle 36 (4).png">
                    <p class="title">Laskar Pelangi</p>
                    <p class="info">Andrea Hirata • 2005</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
                </div>

                 <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Dilan+1990">
                    <p class="title">Dilan 1990</p>
                    <p class="info">Pidi Baiq • 2014</p>
                    <p class="status empty">✘ Stok Kosong</p>
                    <button disabled>Habis</button>
                </div>

                 <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Laskar+Pelangi">
                    <p class="title">Laskar Pelangi</p>
                    <p class="info">Andrea Hirata • 2005</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
                </div>

                 <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Laskar+Pelangi">
                    <p class="title">Laskar Pelangi</p>
                    <p class="info">Andrea Hirata • 2005</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
                </div>

                <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Bumi">
                    <p class="title">Bumi</p>
                    <p class="info">Tere Liye • 2014</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
                </div>

                <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Dilan+1990">
                    <p class="title">Dilan 1990</p>
                    <p class="info">Pidi Baiq • 2014</p>
                    <p class="status empty">✘ Stok Kosong</p>
                    <button disabled>Habis</button>
                </div>

                <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Filosofi+Teras">
                    <p class="title">Filosofi Teras</p>
                    <p class="info">Henry Manampiring • 2018</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
                </div>

                <div class="card">
                    <img src="https://via.placeholder.com/150x240?text=Filosofi+Teras">
                    <p class="title">Filosofi Teras</p>
                    <p class="info">Henry Manampiring • 2018</p>
                    <p class="status ready">✔ Stok Tersedia</p>
                    <button onclick="location.href='peminjaman.pinjam'">+ Pinjam</button>
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
