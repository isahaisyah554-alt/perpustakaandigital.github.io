<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Perpustakaan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f3f4f6;
        }

        .daftar {
            position: relative;
            width: 100%;
            min-height: 100vh; /* Menggunakan min-height agar aman jika konten panjang */
            overflow-x: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        /* background blur */
        .bg {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('{{ asset('storage/bg.jpg') }}') no-repeat center;
            background-size: cover;
            filter: blur(8px);
            z-index: 1;
        }

        .bg::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(234, 244, 255, 0.7);
        }

        /* Card */
        .card {
            position: relative;
            z-index: 3;
            width: 450px;
            padding: 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 25px;
        }

        /* Form styling */
        .input-group {
            margin-bottom: 12px;
            text-align: left;
        }

        .label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 5px;
            margin-left: 5px;
        }

        .input {
            width: 100%;
            height: 45px;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: 0 15px;
            font-size: 14px;
            box-sizing: border-box; /* Sangat penting agar padding tidak meluber */
            transition: all 0.2s;
            outline: none;
        }

        .input:focus {
            border-color: #3B82F6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        /* Button */
        .btn {
            width: 100%;
            height: 50px;
            background: #3B82F6;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #2563EB;
        }

        /* Link Login */
        .login-link {
            margin-top: 20px;
            font-size: 14px;
            color: #6B7280;
        }

        .login-link a {
            color: #3B82F6;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* Dekorasi Gambar */
        .img-decoration {
            position: absolute;
            z-index: 2;
            opacity: 0.6;
        }
        .img-left {
            left: 5%;
            top: 10%;
            width: 150px;
            transform: rotate(-15deg);
        }
        .img-right {
            right: 5%;
            bottom: 10%;
            width: 180px;
            transform: rotate(10deg);
        }
    </style>
</head>
<body>

<div class="daftar">
    <div class="bg"></div>

    <div class="card">
        <div class="title">Buat Akun</div>
        <div class="subtitle">Silahkan isi data diri Anda sebagai anggota</div>

        <form method="POST" action="/register">
            @csrf

            <div class="input-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="nama" placeholder="Masukkan nama lengkap" class="input" required>
            </div>

            <div class="input-group">
                <label class="label">Nomor Telepon</label>
                <input type="text" name="no_hp" placeholder="Contoh: 0812345678" class="input" required>
            </div>

            <div class="input-group">
                <label class="label">Email</label>
                <input type="email" name="email" placeholder="nama@email.com" class="input" required>
            </div>

            <div class="input-group">
                <label class="label">Username</label>
                <input type="text" name="username" placeholder="Buat username unik" class="input" required>
            </div>

            <div class="input-group">
                <label class="label">Password</label>
                <input type="password" name="password" placeholder="Buat password minimal 6 karakter" class="input" required>
            </div>

            <button type="submit" class="btn">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="Auth.login">Masuk di sini</a>
        </div>
    </div>
</div>

</body>
</html>
