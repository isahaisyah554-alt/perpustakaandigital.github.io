<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan - Konfirmasi Peminjaman</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3B82F6;
            --bg: #F6F8FB;
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
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            color: var(--text-muted);
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
            background: var(--primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        /* --- CONTENT BODY --- */
        .content {
            padding: 40px;
            max-width: 1100px;
        }

        .breadcrumb {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        .header-section h2 {
            font-size: 28px;
            margin: 0;
            font-weight: 700;
            color: #111827;
        }

        /* Card & Forms */
        .card-panel {
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-top: 24px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .book-info-header {
            background: #F9FAFB;
            padding: 24px;
            display: flex;
            gap: 24px;
            border-bottom: 1px solid var(--border);
        }

        .book-cover {
            width: 120px;
            height: 165px;
            border-radius: 6px;
            object-fit: cover;
            background: #E5E7EB;
        }

        .book-details h3 {
            margin: 0 0 8px 0;
            font-size: 20px;
        }

        .book-details p {
            font-size: 15px;
            color: var(--text-muted);
            margin: 4px 0;
        }

        .badge-ready {
            display: inline-block;
            background: #D1FAE5;
            color: #065F46;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            margin-top: 8px;
        }

        .section-box {
            padding: 24px;
        }

        .section-title {
            font-weight: 600;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .info-box {
            border: 1px solid var(--border);
            border-radius: 10px;
            display: flex;
            overflow: hidden;
        }

        .info-label-area {
            width: 220px;
            background: #F9FAFB;
            padding: 16px;
            border-right: 1px solid var(--border);
        }

        .info-content-area {
            flex: 1;
            padding: 16px;
            background: white;
        }

        .info-row {
            font-size: 15px;
            height: 45px;
            display: flex;
            align-items: center;
            color: var(--text-muted);
        }

        .input-field {
            width: 100%;
            max-width: 320px;
            height: 38px;
            padding: 0 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-family: inherit;
            outline: none;
        }

        .input-readonly {
            background: #F3F4F6;
            cursor: not-allowed;
        }

        .footer-action {
            padding: 24px;
            background: #F9FAFB;
            border-top: 1px solid var(--border);
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
        }

        .penalty-text {
            margin-right: auto;
            font-size: 14px;
            color: var(--text-muted);
        }

        .btn {
            padding: 10px 24px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid var(--border);
            transition: 0.2s;
        }

        .btn-confirm {
            background: var(--primary);
            color: white;
            border: none;
            min-width: 180px;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <nav class="sidebar">
        <h2>LibManager</h2>
        <ul>
            <li onclick="location.href='dashboard.dashboard'">Dashboard</li>
            <li class="active" onclick="location.href='peminjaman.cari'">Cari Buku</li>
            <li onclick="location.href='peminjaman.saya'">Pinjaman Saya</li>
            <li onclick="location.href='peminjaman.riwayat'">Riwayat</li>
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

        <main class="content">
            <div class="breadcrumb">Beranda &nbsp;>&nbsp; Cari Buku &nbsp;>&nbsp; <b>Pinjam Buku</b></div>

            <div class="header-section">
                <h2>Konfirmasi Peminjaman</h2>
                <p style="color: var(--text-muted); margin-top: 4px;">Atur detail waktu peminjaman buku Anda.</p>
            </div>

            <div class="card-panel">
                <div class="book-info-header">
                    <img src="storage/Rectangle 36 (4).png" alt="Cover" class="book-cover">
                    <div class="book-details">
                        <h3>Laskar Pelangi</h3>
                        <p>Penulis: Andrea Hirata</p>
                        <p>Kategori: Novel Fiksi</p>
                        <div class="badge-ready">Stok: 3 Buku Tersedia</div>
                    </div>
                </div>

                <div class="section-box">
                    <div class="section-title">Informasi Peminjam</div>
                    <div class="info-box">
                        <div class="info-label-area">
                            <div class="info-row">Nama Lengkap</div>
                            <div class="info-row">ID Anggota</div>
                            <div class="info-row">Status Keanggotaan</div>
                        </div>
                        <div class="info-content-area">
                            <div class="info-row" style="color: var(--text-main); font-weight: 600;">Angelica</div>
                            <div class="info-row">AGT-0011227</div>
                            <div class="info-row" style="color: #10B981; font-weight: 600;">Aktif</div>
                        </div>
                    </div>
                </div>

                <div class="section-box" style="padding-top: 0;">
                    <div class="section-title">Pengaturan Peminjaman</div>
                    <div class="info-box">
                        <div class="info-label-area">
                            <div class="info-row">Tanggal Pinjam</div>
                            <div class="info-row">Durasi Peminjaman</div>
                            <div class="info-row">Batas Pengembalian</div>
                        </div>
                        <div class="info-content-area">
                            <div class="info-row">
                                <input type="date" id="tgl_pinjam" class="input-field" value="2026-04-01">
                            </div>
                            <div class="info-row">
                                <select id="durasi" class="input-field" onchange="hitungTanggalKembali()">
                                    <option value="3">3 Hari</option>
                                    <option value="7">7 Hari (1 Minggu)</option>
                                    <option value="14" selected>14 Hari (2 Minggu)</option>
                                    <option value="30">30 Hari (1 Bulan)</option>
                                </select>
                            </div>
                            <div class="info-row">
                                <input type="text" id="tgl_kembali" class="input-field input-readonly" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer-action">
                    <div class="penalty-text">Denda Keterlambatan: <b>Rp 1.000 / Hari</b></div>
                    <button class="btn btn-cancel" onclick="window.history.back()">Batal</button>
                    <a href="peminjaman.sukses" style="text-decoration: none;">
                        <button class="btn btn-confirm">Konfirmasi Peminjaman</button>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <script>
        function hitungTanggalKembali() {
            const tglPinjamInput = document.getElementById('tgl_pinjam');
            const durasiSelect = document.getElementById('durasi');
            const tglKembaliInput = document.getElementById('tgl_kembali');

            if (tglPinjamInput.value) {
                let tanggal = new Date(tglPinjamInput.value);
                let durasi = parseInt(durasiSelect.value);
                tanggal.setDate(tanggal.getDate() + durasi);

                const opsi = { day: 'numeric', month: 'long', year: 'numeric' };
                tglKembaliInput.value = tanggal.toLocaleDateString('id-ID', opsi);
            }
        }

        window.onload = hitungTanggalKembali;
        document.getElementById('tgl_pinjam').addEventListener('change', hitungTanggalKembali);

        function prosesPinjam() {
            const tgl = document.getElementById('tgl_kembali').value;
            alert('Peminjaman Berhasil! \nBuku harus dikembalikan paling lambat: ' + tgl);
        }

        function logout() {
            if(confirm("Apakah anda yakin ingin keluar?")) {
                window.location.href = 'login.html';
            }
        }
    </script>

</body>
</html>
