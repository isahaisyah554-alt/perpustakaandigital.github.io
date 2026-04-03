<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjaman Saya - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --border: #E5E7EB;
            --primary: #3B82F6;
            --sidebar-bg: #FFFFFF;
            --bg-light: #F9FAFB;
            --text-main: #11142D;
            --text-muted: #6B7280;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(249, 250, 251, 0.9), rgba(249, 250, 251, 0.9)),
                        url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000');
            background-size: cover;
            background-attachment: fixed;
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

        /* --- MAIN AREA --- */
        .main {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            width: calc(100% - 260px);
        }

        /* --- NAVBAR BARU (SESUAI REQUEST) --- */
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
            color: var(--text-main);
        }

        .profile-area {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 12px;
            background: rgba(249, 250, 251, 0.7);
            border-radius: 12px;
        }

        .profile-info .name {
            display: block;
            font-weight: 600;
            font-size: 0.9rem;
            color: var(--text-main);
        }

        .profile-info .role {
            font-size: 0.75rem;
            color: #16a34a; /* Hijau Sesuai Request */
            font-weight: 600;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #F3F4F6;
        }

        /* --- PAGE CONTENT --- */
        .content-padding {
            padding: 40px;
        }

        .section-title {
            font-weight: 600;
            font-size: 22px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .loan-container {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 24px;
            max-width: 800px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.03);
        }

        .book-item {
            display: flex;
            align-items: center;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            position: relative;
        }

        .book-cover {
            width: 90px;
            height: 120px;
            background: #D1D5DB;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9CA3AF;
            font-size: 10px;
        }

        .book-details {
            margin-left: 16px;
            flex-grow: 1;
        }

        .book-title {
            font-weight: 600;
            font-size: 15px;
            margin: 0 0 4px 0;
            color: var(--text-main);
        }

        .book-info {
            font-size: 13px;
            color: #4B5563;
            line-height: 1.6;
        }

        .status-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-late { background: #FEF3C7; color: #D97706; border: 1px solid #FCD34D; }
        .status-active { background: #D1FAE5; color: #059669; border: 1px solid #6EE7B7; }

        .btn-return {
            background: #10B981;
            color: white;
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.2s;
        }

        .btn-return:hover { background: #059669; }

        .info-box {
            background: #EFF6FF;
            border: 1px solid #DBEAFE;
            border-radius: 12px;
            padding: 20px;
            margin-top: 24px;
            max-width: 800px;
        }

        .info-box p {
            margin: 6px 0;
            font-size: 14px;
            color: #1E40AF;
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li onclick="location.href='dashboard.dashboard'">Dashboard</li>
            <li onclick="location.href='peminjaman.cari'">Cari Buku</li>
            <li class="active">Pinjaman Saya</li>
            <li onclick="location.href='peminjaman.riwayat'">Riwayat Pinjaman</li>
            <li class="logout-item" onclick="logout()">Logout</li>
        </ul>
    </aside>

    <div class="main">
        <nav class="navbar">
            <h1>Sistem Perpustakaan</h1>
            <div class="profile-area">
                <div class="profile-info">
                    <span class="name">Angelica</span>
                    <span class="role">Anggota Aktif</span>
                </div>
                <img src="https://ui-avatars.com/api/?name=Angelica&background=3B82F6&color=fff" alt="Avatar" class="avatar">
            </div>
        </nav>

        <div class="content-padding">
            <h2 class="section-title">Sedang Dipinjam</h2>

            <div class="loan-container">
                <div class="book-item">
                    <div class="book-cover">Cover Buku</div>
                    <div class="book-details">
                        <p class="book-title">Dilan 1990</p>
                        <p class="book-info">
                            Dipinjam: 4 Feb 2026 <br>
                            Batas Kembali: 18 Feb 2026 <br>
                            <span style="color: #D97706; font-weight: bold;">(Terlambat 3 Hari)</span>
                        </p>
                        <button class="btn-return" onclick="location.href='pengembalian.terlambat'">Kembalikan</button>
                    </div>
                    <div class="status-badge status-late">Terlambat</div>
                </div>

                <div class="book-item">
                    <div class="book-cover">Cover Buku</div>
                    <div class="book-details">
                        <p class="book-title">Modul Ajar Matematika</p>
                        <p class="book-info">
                            Dipinjam: 2 Feb 2026 <br>
                            Batas Kembali: 16 Feb 2026
                        </p>
                        <button class="btn-return" onclick="location.href='pengembalian.buku'">Kembalikan</button>
                    </div>
                    <div class="status-badge status-active">Aktif</div>
                </div>
            </div>

            <h2 class="section-title" style="margin-top: 40px;">Informasi</h2>
            <div class="info-box">
                <p>• Durasi peminjaman maksimal 30 hari.</p>
                <p>• Maksimal meminjam 2 buku secara bersamaan.</p>
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
