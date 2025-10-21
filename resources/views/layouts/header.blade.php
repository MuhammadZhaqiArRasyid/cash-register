<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cash Register Restoran')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* BASE STYLE */
        * {
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        body {
            font-family: "Poppins", Arial, sans-serif;
            margin: 0;
            background: #f8f9fa;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* HEADER */
        header {
            background: linear-gradient(90deg, #50589C, #636CCB);
            color: white;
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 200;
            box-shadow: 0 3px 8px rgba(0,0,0,0.2);
        }

        header h2 {
            margin: 0;
            font-weight: 600;
            font-size: 22px;
        }

        /* HAMBURGER BUTTON */
        .menu-toggle {
            position: relative;
            width: 30px;
            height: 22px;
            border: none;
            background: none;
            cursor: pointer;
        }

        .menu-toggle span {
            position: absolute;
            width: 100%;
            height: 3px;
            background: white;
            left: 0;
            border-radius: 5px;
            transition: 0.4s;
        }

        .menu-toggle span:nth-child(1) { top: 0; }
        .menu-toggle span:nth-child(2) { top: 9px; }
        .menu-toggle span:nth-child(3) { top: 18px; }

        .menu-toggle.active span:nth-child(1) {
            transform: rotate(45deg);
            top: 9px;
        }

        .menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active span:nth-child(3) {
            transform: rotate(-45deg);
            top: 9px;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            left: -270px;
            width: 250px;
            height: 100%;
            background: #2c3e50;
            color: white;
            padding-top: 80px;
            transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
            box-shadow: 3px 0 15px rgba(0,0,0,0.4);
            opacity: 0;
            transform: translateX(-50px);
            z-index: 150;
        }

        .sidebar.active {
            left: 0;
            opacity: 1;
            transform: translateX(0);
        }

        .sidebar a, .sidebar form button {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 20px;
            color: white;
            font-weight: 500;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            transition: 0.3s;
        }

        .sidebar a:hover, .sidebar form button:hover {
            background: rgba(255,255,255,0.1);
            transform: translateX(6px);
        }

        /* OVERLAY */
        .overlay {
            display: none;
            position: fixed;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.45);
            z-index: 100;
            opacity: 0;     
            transition: opacity 0.3s ease;
        }

        .overlay.active {
            display: block;
            opacity: 1;
        }

        /* MAIN */
        main {
            padding: 90px 25px 30px;
            transition: margin-left 0.4s;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar { width: 220px; }
            header h2 { font-size: 18px; }
        }

        footer {
            background: #eee;
            text-align: center;
            padding: 15px;
            color: #555;
            font-size: 14px;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<header>
    <button class="menu-toggle" id="menu-toggle">
        <span></span>
        <span></span>
        <span></span>
    </button>
    <h2>🍽️ Cash Register Restoran</h2>
</header>

<div class="sidebar" id="sidebar">
    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>

        <a href="{{ route('produk.index') }}">🍔 Produk</a>

    <a href="{{ route('transaksi.index') }}">🧾 Transaksi</a>
    
    <a href="{{ route('laporan.index') }}">🧾 Laporan</a>

    <form action="{{ route('logout') }}" method="POST" style="margin:0;">
        @csrf
        <button type="submit">🚪 Logout</button>
    </form>
</div>


<div class="overlay" id="overlay"></div>

<main>
    @yield('content')
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    const toggleBtn = document.getElementById('menu-toggle');

    toggleBtn.addEventListener('click', () => {
        toggleBtn.classList.toggle('active');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    });

    overlay.addEventListener('click', () => {
        toggleBtn.classList.remove('active');
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
    });
});
</script>
