<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Sukses - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500&family=DM+Sans:wght@400&display=swap" rel="stylesheet">

    <style>
        :root {
            --border: #E5E7EB;
            --bg-light: #F9FAFB;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            color: #11142D;
            min-height: 100vh;

            /* --- BACKGROUND FOTO BLUR --- */
            background: linear-gradient(rgba(249, 250, 251, 0.8), rgba(249, 250, 251, 0.8)),
                        url('storage/bg.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        /* --- NAVBAR --- */
        .navbar {
            background: rgba(255, 255, 255, 0.9); /* Sedikit transparan agar estetik */
            padding: 0 32px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(10px);
        }

        .nav-left {
            display: flex;
            align-items: center;
        }

        .navbar-logo {
            width: 50px;
            height: 50px;
            background: url('WhatsApp_Image_2026-02-15_at_12.47.32-removebg-preview.png') no-repeat center;
            background-size: contain;
        }

        .navbar h1 {
            font-size: 1.3rem;
            margin: 0 0 0 15px;
            font-weight: 600;
            font-style: italic;
            color: #6B7280;
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
            width: 42px;
            height: 42px;
            background: #3B82F6;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* --- CONTENT AREA --- */
        .main-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 60px 20px;
        }

        .success-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .success-icon {
            width: 90px;
            height: 90px;
            background: #34C759;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 45px;
            box-shadow: 0 4px 10px rgba(52, 199, 89, 0.3);
        }

        .success-title {
            font-weight: 700;
            font-size: 28px;
            color: #34C759;
            margin: 0;
        }

        .detail-card {
            width: 100%;
            max-width: 650px;
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid var(--border);
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            padding: 35px;
            box-sizing: border-box;
        }

        .detail-label {
            font-weight: 700;
            font-size: 18px;
            margin-bottom: 25px;
            display: block;
            color: #111827;
        }

        .info-row {
            padding: 16px 0;
            font-size: 16px;
            font-weight: 500;
            border-bottom: 1px solid #F3F4F6;
            display: flex;
            justify-content: space-between;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row span {
            color: #6B7280;
            font-weight: 400;
        }

        .button-group {
            display: flex;
            gap: 16px;
            margin-top: 40px;
        }

        .btn {
            padding: 0 35px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px;
            font-weight: 500;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-primary {
            background: #3B82F6;
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }

        .btn-primary:hover {
            background: #2563EB;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: white;
            color: #374151;
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: #F9FAFB;
            transform: translateY(-2px);
        }

        @media (max-width: 640px) {
            .button-group { flex-direction: column; width: 100%; max-width: 350px; }
            .btn { width: 100%; }
            .profile-info { display: none; }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="nav-left">
            <div class="navbar-logo"></div>
            <h1>Sistem Perpustakaan</h1>
        </div>

        <div class="profile-area">
            <div class="profile-info">
                <span class="name">Angelica</span>
                <span class="role">Anggota Aktif</span>
            </div>
            <div class="avatar">AN</div>
        </div>
    </nav>

    <div class="main-wrapper">
        <div class="success-header">
            <div class="success-icon">✓</div>
            <h2 class="success-title">Peminjaman Berhasil!</h2>
            <p style="color: #6B7280; margin-top: 10px;">Buku telah ditambahkan ke daftar pinjaman Anda.</p>
        </div>

        <div class="detail-card">
            <span class="detail-label">Ringkasan Data:</span>
            <div class="info-row">Judul Buku <span>Laskar Pelangi</span></div>
            <div class="info-row">Tanggal Peminjaman <span>15 Januari 2026</span></div>
            <div class="info-row">Tanggal Jatuh Tempo <span>29 Januari 2026</span></div>
        </div>

        <div class="button-group">
            <a href="peminjaman.saya" class="btn btn-primary">Lihat Pinjaman</a>
            <a href="dashboard.dashboard" class="btn btn-secondary">Ke Dashboard</a>
        </div>
    </div>

</body>
</html>
