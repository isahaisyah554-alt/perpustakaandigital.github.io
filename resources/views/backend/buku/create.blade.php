<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku Baru - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">

    <style>
        /* --- Base Setup --- */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #F8FAFC; font-family: 'Inter', sans-serif; overflow-x: hidden; }

        .container {
            position: relative;
            width: 1440px;
            height: 1024px;
            margin: 0 auto;
            background: #F8FAFC;
        }

        /* --- Navbar --- */
        .nav-atas {
            position: absolute;
            width: 1440px;
            height: 87px;
            background: #FFFFFF;
            border-bottom: 1px solid #E5E7EB;
            display: flex;
            align-items: center;
            padding: 0 40px;
            z-index: 10;
        }

        .logo-text { font-style: italic; font-weight: 500; font-size: 32px; color: #6B7280; flex: 1; }
        .user-info { font-weight: 300; font-size: 20px; color: #6B7280; margin-right: 20px; }
        .user-icon { width: 40px; height: 40px; background: #E5E7EB; border-radius: 50%; }

        /* --- Form Card Area --- */
        .scroll-wrapper {
            position: absolute;
            width: 869px;
            height: 850px;
            left: 285px;
            top: 120px;
            overflow-y: auto;
            padding-right: 10px;
        }

        /* Desain Card */
        .form-card {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            padding: 50px;
            min-height: 1100px;
            position: relative;
        }

        .title { font-weight: 700; font-size: 32px; color: #1F2937; text-align: center; margin-bottom: 10px; }
        .subtitle { font-size: 16px; color: #6B7280; text-align: center; margin-bottom: 30px; opacity: 0.8; }

        .line-divider { width: 100%; height: 1px; background: #E5E7EB; margin-bottom: 40px; }

        /* --- Custom Input Styling --- */
        .form-group { margin-bottom: 25px; position: relative; width: 500px; margin-left: auto; margin-right: auto; }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #374151;
            padding-left: 5px;
        }

        .input-control {
            width: 100%;
            height: 65px;
            background: #FFFFFF;
            border: 1px solid #D1D5DB;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.02);
            border-radius: 12px;
            padding: 0 20px;
            font-size: 18px;
            font-family: 'Inter';
            color: #1F2937;
            transition: all 0.3s ease;
        }

        .input-control:focus {
            outline: none;
            border-color: #3B82F6;
            box-shadow: 0px 0px 0px 4px rgba(59, 130, 246, 0.1);
        }

        /* --- Buttons --- */
        .btn-container { text-align: center; margin-top: 40px; }

        .btn {
            width: 500px;
            height: 70px;
            border-radius: 12px;
            font-size: 20px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            border: none;
        }

        .btn-simpan {
            background: #3B82F6;
            color: #FFFFFF;
            box-shadow: 0px 4px 10px rgba(59, 130, 246, 0.3);
        }

        .btn-simpan:hover { background: #2563EB; transform: translateY(-2px); }

        .btn-batal {
            background: transparent;
            color: #6B7280;
            border: 1px solid #E5E7EB;
            text-decoration: none;
        }

        .btn-batal:hover { background: #F9FAFB; color: #111827; }

    </style>
</head>
<body>

    <div class="container">
        <header class="nav-atas">
            <div class="logo-text">LibSys.</div>
            <div class="user-info">Halo, Bapak Muhammad Arif</div>
            <div class="user-icon"></div>
        </header>

        <div class="scroll-wrapper">
            <div class="form-card">
                <h1 class="title">Tambah Buku Baru</h1>
                <p class="subtitle">Silakan lengkapi data di bawah untuk menambah koleksi perpustakaan</p>

                <div class="line-divider"></div>

                <form action="/books" method="POST">
                    @csrf

                    <div class="form-group">
                        <label>Judul Buku</label>
                        <input type="text" name="judul" class="input-control" placeholder="Masukkan judul lengkap..." required>
                    </div>

                    <div class="form-group">
                        <label>Penulis / Pengarang</label>
                        <input type="text" name="penulis" class="input-control" placeholder="Nama penulis..." required>
                    </div>

                    <div class="form-group">
                        <label>Penerbit</label>
                        <input type="text" name="penerbit" class="input-control" placeholder="Nama perusahaan penerbit...">
                    </div>

                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <input type="number" name="tahun" class="input-control" placeholder="Contoh: 2024">
                    </div>

                    <div class="form-group">
                        <label>Jumlah Stok</label>
                        <input type="number" name="stok_buku" class="input-control" placeholder="Jumlah buku tersedia..." required>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-simpan">Simpan Data Buku</button>
                        <a href="/books" class="btn btn-batal">Kembali ke Dashboard</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
