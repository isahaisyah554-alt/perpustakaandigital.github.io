<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Perpustakaan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }

        .daftar {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
            overflow: hidden;
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
            width: 100%;
            max-width: 450px;
            padding: 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            margin: 0 20px;
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
            margin-bottom: 15px;
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
            height: 48px;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: 0 15px;
            font-size: 14px;
            box-sizing: border-box;
            transition: all 0.2s;
            outline: none;
            background: #F9FAFB;
        }

        .input:focus {
            border-color: #3B82F6;
            background: white;
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

        .btn:hover { background: #2563EB; }

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
    </style>
</head>
<body>

<div class="daftar">
    <div class="bg"></div>

    <div class="card">
        <div class="title">Buat Akun</div>
        <div class="subtitle">Silahkan isi data diri Anda sebagai anggota</div>

        @if ($errors->any())
            <div style="background: #fee2e2; color: #dc2626; padding: 15px; border-radius: 12px; margin-bottom: 20px; text-align: left; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="input-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="name" class="input" placeholder="Masukkan nama" required>
            </div>

            <div class="input-group">
                <label class="label">No. HP</label>
                <input type="text" name="no_hp" class="input" placeholder="0812..." required>
            </div>

            <div class="input-group">
                <label class="label">Email</label>
                <input type="email" name="email" class="input" placeholder="contoh@mail.com" required>
            </div>

            <div class="input-group">
                <label class="label">Username</label>
                <input type="text" name="username" class="input" placeholder="Username" required>
            </div>

            <div class="input-group">
                <label class="label">Password</label>
                <input type="password" name="password" class="input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">Daftar Sekarang</button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
        </div>
    </div>
</div>

</body>
</html>
