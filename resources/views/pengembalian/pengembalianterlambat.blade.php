<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Terlambat - LibManager</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Inter:ital,wght@0,400;0,500;0,600;1,500&display=swap" rel="stylesheet">
    <style>
        :root {
            --border: #E5E7EB;
            --text-main: #11142D;
            --text-muted: #6B7280;
            --primary-orange: #FF8D28;
            --error-bg: rgba(255, 141, 40, 0.1);
            --bg-body: #F9FAFB;
            --success-green: #34C759;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--bg-body);
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            color: var(--text-main);
            padding-bottom: 160px; /* Ruang agar konten tidak tertutup action-bar */
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
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            font-style: italic;
            color: var(--text-muted);
        }

        .profile-area {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .profile-info {
            text-align: right;
            line-height: 1.2;
        }

        .profile-info .name {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .profile-info .role {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* --- CONTAINER --- */
        .container {
            max-width: 1000px; /* Lebih responsif dibanding 1440px statis */
            margin: 40px auto;
            padding: 0 20px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 15px;
        }

        .line-separator {
            width: 100%;
            height: 1px;
            background-color: var(--border);
            margin-bottom: 25px;
        }

        .header-text {
            margin-bottom: 30px;
        }

        .page-title {
            font-family: 'Inter';
            font-weight: 600;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .page-subtitle {
            font-size: 15px;
            color: var(--text-muted);
        }

        /* --- CARD DETAIL --- */
        .card-detail {
            background: #FFFFFF;
            border: 1px solid var(--border);
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            padding: 25px;
            display: flex;
            gap: 30px;
            margin-bottom: 25px;
        }

        .book-cover {
            width: 140px;
            height: 195px;
            background: #E5E7EB;
            border-radius: 6px;
            background-image: url('https://via.placeholder.com/140x195');
            background-size: cover;
            flex-shrink: 0;
        }

        .info-group {
            flex-grow: 1;
        }

        .info-row {
            padding: 12px 0;
            border-bottom: 1px solid #F3F4F6;
            display: flex;
            font-size: 16px;
        }

        .info-row:last-child { border-bottom: none; }
        .info-label { color: var(--text-muted); width: 180px; }
        .info-value { font-weight: 500; }
        .bold-val { font-weight: 700; color: var(--primary-orange); }

        /* --- STATUS BOX --- */
        .status-box-late {
            background: var(--error-bg);
            border: 1px solid var(--primary-orange);
            border-radius: 12px;
            display: flex;
            align-items: center;
            padding: 20px 25px;
            margin-bottom: 25px;
            gap: 20px;
        }

        .warning-icon {
            width: 45px;
            height: 45px;
        }

        .status-text-group h3 {
            color: var(--primary-orange);
            font-size: 18px;
            margin-bottom: 2px;
        }

        /* --- DENDA CARD --- */
        .card-denda {
            background: white;
            border: 1px solid var(--primary-orange);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .denda-header {
            background: var(--error-bg);
            padding: 15px 25px;
            border-bottom: 1px solid var(--border);
            font-weight: 700;
            font-size: 18px;
            color: var(--primary-orange);
        }

        .denda-body {
            padding: 20px 25px;
        }

        .denda-row {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 10px;
        }

        .denda-total {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-orange);
        }

        /* --- PAYMENT --- */
        .payment-section h3 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .payment-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            gap: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.02);
        }

        .radio-custom {
            width: 20px;
            height: 20px;
            border: 2px solid var(--success-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .radio-inner {
            width: 10px;
            height: 10px;
            background: var(--success-green);
            border-radius: 50%;
        }

        .payment-text {
            font-size: 16px;
            font-weight: 600;
        }

        /* --- FIXED ACTION BAR --- */
        .action-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: white;
            border-top: 1px solid var(--border);
            padding: 20px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            z-index: 2000;
            box-shadow: 0px -5px 15px rgba(0, 0, 0, 0.05);
        }

        .btn {
            width: 90%;
            max-width: 400px;
            height: 50px;
            border-radius: 10px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-confirm {
            background: var(--primary-orange);
            color: white;
        }

        .btn-confirm:hover {
            background: #e67e22;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: transparent;
            color: var(--text-muted);
            text-decoration: underline;
            height: auto;
            width: auto;
            font-size: 14px;
        }

        .btn-cancel:hover {
            color: var(--text-main);
        }

        .note {
            font-size: 12px;
            color: var(--text-muted);
        }
    </style>
</head>
<body>

    <header class="navbar">
        <h1>Sistem Perpustakaan</h1>
        <div class="profile-area">
            <div class="profile-info">
                <span class="name">Angelica</span>
                <span class="role">Anggota Aktif</span>
            </div>
            <img src="https://ui-avatars.com/api/?name=Angelica&background=FF8D28&color=fff" alt="Avatar" class="avatar">
        </div>
    </header>

    <div class="container">
        <div class="breadcrumb">Pinjaman Saya &nbsp; > &nbsp; <strong>Kembalikan Buku</strong></div>
        <div class="line-separator"></div>

        <div class="header-text">
            <h2 class="page-title">Kembalikan Buku</h2>
            <p class="page-subtitle">Periksa detail sebelum mengembalikan buku terlambat</p>
        </div>

        <div class="card-detail">
            <div class="book-cover"></div>
            <div class="info-group">
                <div class="info-row">
                    <span class="info-label">Judul Buku</span>
                    <span class="info-value">: Dilan 1990</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Penulis</span>
                    <span class="info-value">: Pidi Baiq</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Pinjam</span>
                    <span class="info-value">: 04 Februari 2026</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Jatuh Tempo</span>
                    <span class="info-value bold-val">: 18 Februari 2026 (Terlambat 3 Hari)</span>
                </div>
            </div>
        </div>

        <div class="status-box-late">
            <img src="https://cdn-icons-png.flaticon.com/512/179/179386.png" class="warning-icon" alt="Warning">
            <div class="status-text-group">
                <h3>Pengembalian: 02 April 2026</h3>
                <p>Denda keterlambatan otomatis ditambahkan ke tagihan Anda.</p>
            </div>
        </div>

        <div class="card-denda">
            <div class="denda-header">Rincian Denda</div>
            <div class="denda-body">
                <div class="denda-row">
                    <span>Denda Per hari</span>
                    <span>Rp 1.000</span>
                </div>
                <div class="denda-row">
                    <span>Total Keterlambatan (3 Hari)</span>
                    <span class="denda-total">Rp 3.000</span>
                </div>
            </div>
        </div>

        <div class="payment-section">
            <h3>Pilih Metode Pembayaran</h3>
            <div class="payment-card">
                <div class="radio-custom"><div class="radio-inner"></div></div>
                <span class="payment-text">Tunai di Perpustakaan</span>
            </div>
        </div>
    </div>

    <div class="action-bar">
        <button class="btn btn-confirm" onclick="location.href='pengembalian.doneterlambat'">Konfirmasi Pengembalian</button>
        <button class="btn btn-cancel" onclick="window.history.back()">Batal</button>
        <p class="note">Denda dibayarkan secara tunai di kasir perpustakaan</p>
    </div>

</body>
</html>
