<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Pengembalian Berhasil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* --- VARIABLES --- */
        :root {
            --primary: #3B82F6;
            --border: #E5E7EB;
            --text-main: #111827;
            --text-muted: #6B7280;
            --bg-overlay: rgba(249, 250, 251, 0.85); /* Overlay agar teks tetap terbaca */
        }

        /* --- RESET & BASE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            line-height: 1.5;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* --- BACKGROUND PHOTO BLUR --- */
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* Ganti URL di bawah dengan link foto perpustakaan kamu */
            background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000');
            background-size: cover;
            background-position: center;
            filter: blur(8px); /* Atur tingkat keburaman di sini */
            transform: scale(1.1); /* Menghilangkan garis putih di pinggir akibat blur */
            z-index: -1;
        }

        /* Overlay transparan agar konten lebih menonjol */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-overlay);
            z-index: -1;
        }

        /* --- NAVBAR --- */
        .navbar {
            background: white;
            padding: 0 5%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo-text {
            font-size: 1.4rem;
            color: var(--primary);
            font-weight: 800;
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
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid white;
        }

        /* --- CONTENT --- */
        .container {
            padding: 50px 20px;
            max-width: 800px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .card-success, .card-buku {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border);
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .card-success {
            padding: 50px 20px;
            text-align: center;
        }

        .icon-check {
            width: 80px;
            height: 80px;
            background: #D1FAE5;
            color: #34C759;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin: 0 auto 20px;
        }

        .success-title {
            font-size: 28px;
            font-weight: 700;
            color: #34C759;
            margin-bottom: 12px;
        }

        .success-desc {
            font-size: 15px;
            color: var(--text-muted);
            max-width: 480px;
            margin: 0 auto;
        }

        .alert-denda {
            background: #D9FFD9;
            border: 1px solid #1EA741;
            border-radius: 14px;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .denda-text {
            font-size: 20px;
            font-weight: 700;
            color: #34C759;
        }

        .card-buku {
            padding: 30px;
            display: flex;
            gap: 30px;
        }

        .buku-cover {
            width: 120px;
            height: 170px;
            background: #F3F4F6;
            border-radius: 10px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #D1D5DB;
        }

        .buku-info {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 12px;
        }

        .info-row {
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            color: #4B5563;
            border-bottom: 1px solid #F3F4F6;
            padding-bottom: 8px;
        }

        .info-row strong { color: var(--text-main); }

        .footer-actions {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
        }

        .btn {
            width: 100%;
            max-width: 340px;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            text-decoration: none;
            transition: 0.2s;
        }

        .btn-primary { background: var(--primary); color: white; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
        .btn-secondary { background: white; color: var(--text-main); border: 1px solid var(--border); }

        @media (max-width: 650px) {
            .card-buku { flex-direction: column; align-items: center; text-align: center; }
        }
    </style>
</head>
<body>

    <header class="navbar">
        <div class="nav-left">
            <div class="logo-text">LibManager</div>
        </div>

        <div class="profile-area">
            <div class="profile-info">
                <span class="name">Angelica</span>
                <span class="role">Anggota Aktif</span>
            </div>
            <img src="https://ui-avatars.com/api/?name=Angelica&background=3B82F6&color=fff" alt="Avatar" class="avatar">
        </div>
    </header>

    <main class="container">
        <section class="card-success">
            <div class="icon-check">✓</div>
            <h1 class="success-title">Pengembalian Berhasil</h1>
            <p class="success-desc">
                Buku telah dikembalikan tepat waktu. Terima kasih telah menjaga kedisiplinan dan merawat buku dengan baik.
            </p>
        </section>

        <div class="alert-denda">
            <span style="font-size: 24px;">🛡️</span>
            <span class="denda-text">Bebas Denda</span>
        </div>

        <section class="card-buku">
            <div class="buku-cover">Cover Buku</div>
            <div class="buku-info">
                <div class="info-row">Judul Buku : <strong>Modul Ajar Matematika</strong></div>
                <div class="info-row">Penulis : <strong>Andri Wijaya</strong></div>
                <div class="info-row">Tanggal Pinjam : <strong>2 Februari 2026</strong></div>
                <div class="info-row">Batas Kembali : <strong>16 Februari 2026</strong></div>
            </div>
        </section>

        <footer class="footer-actions">
            <a href="peminjaman.saya" class="btn btn-primary">Lihat Pinjaman Lainnya</a>
            <a href="dashboard.dashboard" class="btn btn-secondary">Kembali ke Beranda</a>
        </footer>
    </main>

</body>
</html>
