<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - LibManager</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root{
    --primary:#3B82F6;
    --sidebar-bg:#FFFFFF;
    --bg-main:#F6F8FB;
    --border:#E5E7EB;
    --text-main:#11142D;
    --text-muted:#6B7280;
    --success:#34C759;
    --warning:#FF8D28;
    --danger:#EF4444;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:var(--bg-main);
    display:flex;
    min-height:100vh;
    color:var(--text-main);
}

/* SIDEBAR */
.sidebar{
    width:260px;
    background:var(--sidebar-bg);
    height:100vh;
    position:fixed;
    top:0;
    left:0;
    border-right:1px solid var(--border);
    padding:24px 16px;
    display:flex;
    flex-direction:column;
    z-index:100;
}

.sidebar h2{
    color:var(--primary);
    font-size:24px;
    font-weight:700;
    margin:0 0 30px 12px;
}

.sidebar ul{
    list-style:none;
    flex:1;
}

.sidebar li{
    margin-bottom:6px;
    border-radius:8px;
    overflow:hidden;
    transition:0.2s;
}

.sidebar li a{
    display:block;
    padding:12px 16px;
    text-decoration:none;
    color:var(--text-muted);
    font-weight:500;
}

.sidebar li:hover{
    background:#F3F4F6;
}

.sidebar li:hover a{
    color:var(--text-main);
}

.sidebar li.active{
    background:var(--primary);
}

.sidebar li.active a{
    color:white;
    font-weight:600;
}

.logout-item{
    border-top:1px solid #F3F4F6;
    padding-top:20px;
}

.logout-btn{
    width:100%;
    border:none;
    background:none;
    padding:12px 16px;
    text-align:left;
    color:var(--danger);
    font-weight:600;
    cursor:pointer;
    font-family:inherit;
}

/* MAIN */
.main{
    flex:1;
    margin-left:260px;
    display:flex;
    flex-direction:column;
    min-width:0;
}

/* NAVBAR */
.navbar{
    background:white;
    height:70px;
    padding:0 32px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid var(--border);
}

.navbar h1{
    font-size:18px;
    font-weight:600;
}

.profile-area{
    display:flex;
    align-items:center;
    gap:12px;
}

.profile-info{
    text-align:right;
    line-height:1.2;
}

.profile-info .name{
    display:block;
    font-size:14px;
    font-weight:600;
}

.profile-info .role{
    font-size:12px;
    color:var(--text-muted);
}

.avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    border:1px solid var(--border);
}

/* CONTENT */
.content-body{
    padding:32px;
}

/* PAGE HEADER */
.page-header{
    margin-bottom:24px;
}

.page-header h2{
    font-size:24px;
    font-weight:700;
    margin-bottom:6px;
}

.page-header p{
    font-size:14px;
    color:var(--text-muted);
}

/* STATS */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
    margin-bottom:30px;
}

.stat-card{
    background:white;
    border:1px solid var(--border);
    border-radius:12px;
    padding:20px;
}

.stat-card span{
    font-size:14px;
    color:var(--text-muted);
    font-weight:500;
}

.stat-card h3{
    font-size:28px;
    margin-top:8px;
    font-weight:700;
}

/* CARD */
.card{
    background:white;
    border:1px solid var(--border);
    border-radius:12px;
    overflow:hidden;
    box-shadow:0 2px 5px rgba(0,0,0,0.02);
}

.card-title{
    padding:20px 24px;
    border-bottom:1px solid var(--border);
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.card-title h3{
    font-size:16px;
    font-weight:600;
}

/* TABLE */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th{
    padding:16px 24px;
    text-align:left;
    background:#FAFBFC;
    color:var(--text-muted);
    font-size:13px;
    text-transform:uppercase;
    letter-spacing:.5px;
    border-bottom:1px solid var(--border);
}

td{
    padding:16px 24px;
    font-size:14px;
    border-bottom:1px solid var(--border);
}

tr:hover{
    background:#FAFBFC;
}

/* BADGE */
.badge{
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:600;
}

.bg-success{
    background:#DCFCE7;
    color:#166534;
}

.bg-warning{
    background:#FEF9C3;
    color:#854D0E;
}

.bg-danger{
    background:#FEE2E2;
    color:#991B1B;
}

/* RESPONSIVE */
@media(max-width:900px){
    .sidebar{
        width:220px;
    }

    .main{
        margin-left:220px;
    }

    .content-body{
        padding:20px;
    }

    .navbar{
        padding:0 20px;
    }
}

@media(max-width:768px){
    .sidebar{
        display:none;
    }

    .main{
        margin-left:0;
    }

    .navbar h1{
        font-size:15px;
    }

    .profile-info{
        display:none;
    }

    .content-body{
        padding:16px;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }
}
</style>
</head>

<body>

@php
$user = Auth::user();
@endphp

<aside class="sidebar">
    <h2>LibManager</h2>

    <ul>
        <li class="{{ Route::is('dashboard-kepala') ? 'active' : '' }}">
            <a href="{{ route('dashboard-kepala') }}">Dashboard</a>
        </li>

        <li class="{{ Route::is('kepala.databuku.index') ? 'active' : '' }}">
            <a href="{{ route('kepala.databuku.index') }}">Data Buku</a>
        </li>

        <li class="{{ Route::is('kepala.petugas') ? 'active' : '' }}">
            <a href="{{ route('kepala.petugas') }}">Data Petugas</a>
        </li>
    </ul>

    <div class="logout-item">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</aside>

<div class="main">

<header class="navbar">
    <h1>Selamat Datang, {{ $user?->name ?? 'Kepala Perpustakaan' }}</h1>

    <div class="profile-area">
        <div class="profile-info">

            <span class="name">
                {{ $user?->name ?? 'Guest' }}
            </span>

            <span class="role">
                @if($user?->role == 'kepala')
                    Kepala Perpustakaan
                @elseif($user?->role == 'petugas')
                    Petugas Perpustakaan
                @elseif($user?->role == 'anggota')
                    Anggota
                @else
                    Guest
                @endif
            </span>

        </div>

        <img
            src="https://ui-avatars.com/api/?name={{ urlencode($user?->name ?? 'Guest') }}&background=3B82F6&color=fff"
            class="avatar">
    </div>
</header>

<main class="content-body">
    @yield('content')
</main>

</div>

</body>
</html>
