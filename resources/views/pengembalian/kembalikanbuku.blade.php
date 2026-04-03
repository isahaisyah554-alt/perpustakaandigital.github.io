<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku - LibManager</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --border: #E5E7EB;
            --text-main: #11142D;
            --text-muted: #6B7280;
            --primary: #3B82F6;
            --success: #34C759;
            --success-bg: rgba(52, 199, 89, 0.08);
            --bg-body: #F9FAFB;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-body);
            font-family: 'DM Sans', sans-serif;
            color: var(--text-main);
            line-height: 1.5;
            padding-bottom: 120px; /* Ruang untuk action bar */
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
            z-index: 1000;
        }

        .navbar h1 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary);
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
            border: 2px solid var(--border);
        }

        /* --- LAYOUT CONTAINER --- */
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 24px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 16px;
        }

        .line-separator {
            height: 1px;
            background-color: var(--border);
            margin-bottom: 32px;
        }

        /* --- HEADER TITLE --- */
        .page-header {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 32px;
        }

        .icon-back {
            width: 40px;
            height: 40px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            color: var(--text-main);
        }

        .icon-back:hover {
            background: var(--bg-body);
            border-color: var(--text-muted);
        }

        .title-group h2 {
            font-size: 24px;
            font-weight: 700;
        }

        .title-group p {
            font-size: 15px;
            color: var(--text-muted);
        }

        /* --- CARD DETAIL --- */
        .card-detail {
            background: white;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            display: flex;
            gap: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .book-cover {
            width: 130px;
            height: 180px;
            background: #E5E7EB;
            border-radius: 8px;
            flex-shrink: 0;
            background-image: url('https://via.placeholder.com/130x180'); /* Placeholder */
            background-size: cover;
        }

        .info-group {
            flex-grow: 1;
        }

        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px dotted var(--border);
        }

        .info-row:last-child { border-bottom: none; }

        .info-label {
            width: 140px;
            color: var(--text-muted);
            font-size: 15px;
        }

        .info-value {
            font-weight: 500;
            font-size: 15px;
        }

        .primary-val {
            color: var(--primary);
            font-weight: 600;
        }

        /* --- STATUS BOX --- */
        .status-box {
            background: var(--success-bg);
            border: 1px solid var(--success);
            border-radius: 12px;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 32px;
        }

        .status-icon-circle {
            width: 48px;
            height: 48px;
            background: var(--success);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .status-text-group .date-info {
            font-weight: 700;
            color: #166534;
            font-size: 16px;
        }

        .status-text-group .denda-info {
            font-size: 14px;
            color: #15803d;
        }

        /* --- ACTION BAR (Sticky Bottom) --- */
        .action-bar-wrapper {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            border-top: 1px solid var(--border);
            padding: 20px;
            z-index: 1000;
        }

        .action-content {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .btn {
            width: 100%;
            max-width: 350px;
            height: 50px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: transform 0.2s, background 0.2s;
        }

        .btn-confirm {
            background: var(--success);
            color: white;
        }

        .btn-confirm:hover {
            background: #28a745;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: #F3F4F6;
            color: var(--text-main);
        }

        .btn-cancel:hover {
            background: #E5E7EB;
        }

    </style>
</head>
<body>

    <header class="navbar">
        <h1>LibManager</h1>
        <div class="profile-area">
            <div class="profile-info">
                <span class="name">Angelica</span>
                <span class="role">Anggota Aktif</span>
            </div>
            <img src="https://ui-avatars.com/api/?name=Angelica&background=3B82F6&color=fff" alt="Avatar" class="avatar">
        </div>
    </header>

    <div class="container">
        <nav class="breadcrumb">Pinjaman Saya &nbsp; / &nbsp; <strong>Kembalikan Buku</strong></nav>
        <div class="line-separator"></div>

        <div class="page-header">
            <a href="#" class="icon-back">←</a>
            <div class="title-group">
                <h2>Kembalikan Buku</h2>
                <p>Pastikan kondisi buku dalam keadaan baik sebelum dikonfirmasi.</p>
            </div>
        </div>

        <div class="card-detail">
            <div class="book-cover"></div>
            <div class="info-group">
                <div class="info-row">
                    <span class="info-label">Judul Buku</span>
                    <span class="info-value">Modul Ajar Matematika (KTSP 2026)</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Penulis</span>
                    <span class="info-value">Andri Wijaya</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Pinjam</span>
                    <span class="info-value">02 Februari 2026</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jatuh Tempo</span>
                    <span class="info-value primary-val">16 Februari 2026</span>
                </div>
            </div>
        </div>

        <div class="status-box">
            <div class="status-icon-circle">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            </div>
            <div class="status-text-group">
                <div class="date-info">Rencana Pengembalian: Hari Ini</div>
                <div class="denda-info">Status: Tepat Waktu (Bebas Denda)</div>
            </div>
        </div>
    </div>

    <div class="action-bar-wrapper">
        <div class="action-content">
            <button class="btn btn-confirm" onclick="location.href='pengembalian.done'" >Konfirmasi Pengembalian</button>
            <button class="btn btn-cancel" onclick="history.back()">Batal dan Kembali</button>
        </div>
    </div>

</body>
</html>
