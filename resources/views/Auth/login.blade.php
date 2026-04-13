<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Perpustakaan</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f3f4f6;
        }

        .login {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
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
            background: rgba(234, 244, 255, 0.6);
        }

        /* Card */
        .card {
            position: relative;
            z-index: 3;
            width: 400px;
            padding: 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
        }

        .title {
            font-size: 26px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 14px;
            color: #6B7280;
            margin-bottom: 20px;
        }

        .logo {
            width: 80px;
            margin-bottom: 20px;
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

        .input, .select {
            width: 100%;
            height: 48px;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
            padding: 0 15px;
            font-size: 15px;
            box-sizing: border-box;
            transition: border-color 0.2s;
            outline: none;
        }

        .input:focus, .select:focus {
            border-color: #3B82F6;
            ring: 2px rgba(59, 130, 246, 0.2);
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
            margin-top: 10px;
            transition: background 0.2s;
        }

        .btn:hover {
            background: #2563EB;
        }

        .register {
            margin-top: 25px;
            font-size: 14px;
            color: #6B7280;
        }

        .register a {
            color: #3B82F6;
            text-decoration: none;
            font-weight: 600;
        }

        .register a:hover {
            text-decoration: underline;
        }

        /* Image decoration (Optional) */
        .img-decoration {
            position: absolute;
            width: 180px;
            z-index: 2;
            opacity: 0.8;
        }
        .img-left { left: 10%; top: 20%; }
        .img-right { right: 10%; bottom: 20%; }

    </style>
</head>
<body>

<div class="login">
    <div class="bg"></div>

    <div class="card">
        <div class="title">Selamat Datang</div>
        <div class="subtitle">Silahkan login sesuai dengan hak akses Anda</div>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group">
                <label class="label">Email / Username</label>
                <input type="text" name="email" class="input" required>
            </div>

            <div class="input-group">
                <label class="label">Password</label>
                <input type="password" name="password" class="input" required>
            </div>

            <button type="submit" class="btn">Masuk ke Sistem</button>
        </form>
        <div class="register">
            Belum punya akun? <a href="{{ route('register.form') }}">Daftar sebagai Anggota</a>
        </div>
    </div>
</div>

</body>
</html>
