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
    --sidebar-bg:#ffffff;
    --bg:#F6F8FB;
    --border:#E5E7EB;
    --text:#111827;
    --muted:#6B7280;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Inter',sans-serif;
    background:var(--bg);
    display:flex;
    min-height:100vh;
}

/* SIDEBAR */
.sidebar{
    width:260px;
    background:var(--sidebar-bg);
    border-right:1px solid var(--border);
    padding:24px 16px;
    position:fixed;
    height:100vh;
    display:flex;
    flex-direction:column;
}

.sidebar h2{
    color:var(--primary);
    font-size:22px;
    font-weight:800;
    margin-bottom:30px;
}

.sidebar ul{
    list-style:none;
    flex:1;
}

.sidebar li{
    margin-bottom:6px;
}

.sidebar a{
    display:block;
    padding:12px 14px;
    text-decoration:none;
    color:var(--muted);
    border-radius:8px;
    font-weight:500;
    transition:0.2s;
}

.sidebar a:hover{
    background:#EFF6FF;
    color:var(--primary);
}

.sidebar li.active a{
    background:var(--primary);
    color:#fff;
}

/* MAIN */
.main{
    margin-left:260px;
    width:100%;
}

/* NAVBAR */
.navbar{
    height:70px;
    background:#fff;
    border-bottom:1px solid var(--border);
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:0 25px;
}

.navbar h1{
    font-size:18px;
    color:var(--text);
}

/* CONTENT */
.content{
    padding:25px;
}

/* CARD */
.card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:12px;
    padding:20px;
}

/* TABLE */
.table-wrapper{
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
    min-width:900px;
}

th{
    background:#F9FAFB;
    text-align:left;
    padding:12px;
    font-size:13px;
    color:var(--muted);
    border-bottom:1px solid var(--border);
}

td{
    padding:12px;
    border-bottom:1px solid var(--border);
    font-size:14px;
}

/* BADGE */
.badge{
    padding:5px 10px;
    border-radius:6px;
    font-size:12px;
    font-weight:600;
}

.badge-success{ background:#DCFCE7; color:#166534; }
.badge-warning{ background:#FEF3C7; color:#92400E; }
.badge-danger{ background:#FEE2E2; color:#991B1B; }

/* RESPONSIVE */
@media(max-width:768px){
    .sidebar{ display:none; }
    .main{ margin-left:0; }
}
</style>
</head>

<body>

@php
$user = Auth::user();
@endphp

<!-- SIDEBAR -->
<aside class="sidebar">

<h2>LibManager</h2>

<ul>

<li class="{{ Route::is('dashboard-kepala') ? 'active' : '' }}">
<a href="{{ route('dashboard-kepala') }}">Dashboard</a>
</li>

<li class="{{ Route::is('kepala.laporan') ? 'active' : '' }}">
<a href="{{ route('kepala.laporan') }}">Laporan</a>
</li>

<li class="{{ Route::is('kepala.databuku.index') ? 'active' : '' }}">
<a href="{{ route('kepala.databuku.index') }}">Data Buku</a>
</li>

<li class="{{ Route::is('kepala.petugas') ? 'active' : '' }}">
<a href="{{ route('kepala.petugas') }}">Data Petugas</a>
</li>

</ul>

<form action="{{ route('logout') }}" method="POST">
@csrf
<button style="
width:100%;
padding:12px;
border:none;
background:#FEE2E2;
color:#991B1B;
border-radius:8px;
font-weight:600;
cursor:pointer;
">
Logout
</button>
</form>

</aside>

<!-- MAIN -->
<div class="main">

<!-- NAVBAR -->
<header class="navbar">
<h1>@yield('title')</h1>

<div style="display:flex;align-items:center;gap:12px;">
<div>
<div style="font-weight:600;">{{ $user->name ?? '-' }}</div>
<div style="font-size:12px;color:var(--muted);">Kepala Perpustakaan</div>
</div>

<img src="https://ui-avatars.com/api/?name={{ urlencode($user->name ?? 'Kepala') }}&background=3B82F6&color=fff"
style="width:40px;height:40px;border-radius:50%;">
</div>

</header>

<!-- CONTENT -->
<main class="content">
@yield('content')
</main>

</div>

</body>
</html>
