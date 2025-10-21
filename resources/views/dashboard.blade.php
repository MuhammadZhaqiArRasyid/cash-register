<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Kasir - Cash Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
/* ================================================
   DASHBOARD STYLE — Clean & Professional
   ================================================ */

/* Reset dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: "Poppins", Arial, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
    min-height: 100vh;
}

/* ================================================
   NAVBAR
   ================================================ */
.navbar {
    background-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: sticky;
    top: 0;
    z-index: 10;
}

.navbar h2 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1d4ed8;
}

/* ================================================
   CONTAINER
   ================================================ */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.container > h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: #222;
    margin-bottom: 0.25rem;
}

.container > p {
    color: #555;
    margin-bottom: 2rem;
}

/* ================================================
   SUMMARY CARDS
   ================================================ */
.summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.25rem;
    margin-bottom: 2rem;
}

.card {
    background-color: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    text-align: center;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.card h3 {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.card p {
    font-size: 1.75rem;
    font-weight: 700;
    color: #1d4ed8;
    margin: 0;
}

/* Warna netral tiap card */
.card-green p {
    color: #059669;
}
.card-blue p {
    color: #2563eb;
}
.card-yellow p {
    color: #d97706;
}

/* ================================================
   TABLE
   ================================================ */
h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #222;
    margin-bottom: 1rem;
    text-align: center; /* ✅ Judul tabel di tengah */
}

.table-container {
    background-color: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    overflow-x: auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin: 0 auto;
    width: 95%; /* ✅ Table sedikit lebih besar dan tengah */
    max-width: 1000px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #2563eb;
    color: #fff;
}

th, td {
    padding: 1rem;
    text-align: center; /* ✅ Konten tengah */
    border-bottom: 1px solid #e5e7eb;
    font-size: 1rem;
}

tbody tr:nth-child(even) {
    background-color: #f9fafb;
}

tbody tr:hover {
    background-color: #eef2ff;
}

td strong {
    color: #111;
}

.no-data {
    text-align: center;
    padding: 2rem 1rem;
    color: #777;
    font-style: italic;
}

/* ================================================
   FOOTER
   ================================================ */
.footer {
    text-align: center;
    padding: 2rem;
    font-size: 0.9rem;
    color: #666;
    border-top: 1px solid #e5e7eb;
    margin-top: 2rem;
}

/* ================================================
   RESPONSIVE
   ================================================ */
@media (max-width: 768px) {
    .navbar {
        padding: 0.75rem 1rem;
    }

    .container {
        padding: 0 1rem;
    }

    .summary {
        grid-template-columns: 1fr;
    }

    .card {
        text-align: center;
    }

    .table-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    th, td {
        padding: 0.8rem;
        font-size: 0.9rem;
    }

    h2 {
        font-size: 1.3rem;
        text-align: center;
    }

    h3 {
        font-size: 1rem;
    }
}
</style>

</head>
<body>

@include('layouts.header')
@section('title', 'Dashboard')

<div class="container">
    <h2>Selamat datang, {{ Auth::user()->name }} 👋</h2>
    <p>Berikut ringkasan penjualan hari ini:</p>

    <!-- 🔹 Ringkasan Penjualan -->
    <div class="summary">
        <div class="card card-green">
            <h3>💰 Pendapatan</h3>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>

        <div class="card card-blue">
            <h3>🧾 Transaksi</h3>
            <p>{{ $totalTransaksi }}</p>
        </div>

        <div class="card card-yellow">
            <h3>🍽️ Menu Terjual</h3>
            <p>{{ $totalMenuTerjual }}</p>
        </div>
    </div>

    <!-- 🔹 Tabel Transaksi -->
    <h3>🕓 Transaksi Terbaru</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksiTerbaru as $t)
                <tr>
                    <td>#{{ $t->id_transaksi }}</td>
                    <td>{{ $t->tanggal }}</td>
                    <td><strong>Rp {{ number_format($t->total, 0, ',', '.') }}</strong></td>
                </tr>
                @empty
                <tr><td colspan="3" class="no-data">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('layouts.footer')

</body>
</html>
