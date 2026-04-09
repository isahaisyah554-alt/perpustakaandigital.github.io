<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LibManager</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-blue: #EAF4FF;
            --primary: #3B82F6;
            --text-main: #11142D;
            --text-muted: #6B7280;
            --border: #E5E7EB;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: #F9FAFB;
            color: var(--text-main);
        }

        /* NAVBAR ONLY */
        .navbar {
            background: white;
            padding: 0 10%;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar h1 { font-size: 1.2rem; color: var(--primary); font-weight: 700; }

        .profile-area { display: flex; align-items: center; gap: 12px; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; }

        .content-wrapper {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
    </style>
    @yield('page-css')
</head>
<body>

    <nav class="navbar">
    <h1>LibManager</h1>
    <div class="profile-area">
        <div style="text-align: right;">
            {{-- Manggil Nama dari User yang sedang Login --}}
            <span style="display: block; font-weight: 600; font-size: 0.9rem;">
                {{ Auth::user()->name }}
            </span>

            {{-- Manggil Role secara otomatis (Anggota/Petugas/Kepala) --}}
            <span style="font-size: 0.75rem; color: #16a34a; font-weight: 600;">
                {{ ucfirst(Auth::user()->role) }} Aktif
            </span>
        </div>

        {{-- Avatar juga otomatis berubah inisialnya sesuai nama user --}}
        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff"
             class="avatar" alt="profile">
    </div>
</nav>

    <main class="content-wrapper">
        @yield('content')
    </main>

    @yield('page-js')
</body>
</html>
