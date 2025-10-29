<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Kasir - Cash Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
/* ================================================
   DASHBOARD ONLY STYLE — Clean & Modern
   ================================================ */

/* Hanya untuk body dengan class dashboard */
body.dashboard-page {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
}

/* ================================================
   DASHBOARD CONTAINER
   ================================================ */
.dashboard-container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.dashboard-container > h2 {
    font-size: 1.85rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dashboard-container > p {
    color: #64748b;
    margin-bottom: 2rem;
    font-size: 1.05rem;
}

/* ================================================
   SUMMARY CARDS - Clean Design
   ================================================ */
.dashboard-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}

.dashboard-card {
    background: #ffffff;
    border: none;
    border-radius: 20px;
    padding: 1.75rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.dashboard-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.dashboard-card-icon {
    width: 65px;
    height: 65px;
    margin: 0 auto 1rem;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    color: #fff;
}

.dashboard-card h3 {
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 0.75rem;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.dashboard-card p {
    font-size: 1.9rem;
    font-weight: 700;
    margin: 0;
}

/* Warna khusus untuk tiap card */
.dashboard-card-green::before {
    background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
}

.dashboard-card-green .dashboard-card-icon {
    background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
}

.dashboard-card-green p {
    color: #10b981;
}

.dashboard-card-blue::before {
    background: linear-gradient(90deg, #3b82f6 0%, #60a5fa 100%);
}

.dashboard-card-blue .dashboard-card-icon {
    background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
}

.dashboard-card-blue p {
    color: #3b82f6;
}

.dashboard-card-orange::before {
    background: linear-gradient(90deg, #f59e0b 0%, #fbbf24 100%);
}

.dashboard-card-orange .dashboard-card-icon {
    background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
}

.dashboard-card-orange p {
    color: #f59e0b;
}

.dashboard-card-purple::before {
    background: linear-gradient(90deg, #8b5cf6 0%, #a78bfa 100%);
}

.dashboard-card-purple .dashboard-card-icon {
    background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
}

.dashboard-card-purple p {
    color: #8b5cf6;
}

/* ================================================
   TABLE - Clean Design
   ================================================ */
.dashboard-table-title {
    font-size: 1.35rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 1.25rem;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.dashboard-table-container {
    background: #ffffff;
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    margin: 0 auto;
    width: 95%;
    max-width: 1000px;
}

.dashboard-table-container table {
    width: 100%;
    border-collapse: collapse;
}

.dashboard-table-container thead {
    background: linear-gradient(90deg, #1e293b 0%, #334155 100%);
    color: #fff;
}

.dashboard-table-container th,
.dashboard-table-container td {
    padding: 1.25rem 1rem;
    text-align: center;
    border-bottom: 1px solid #e2e8f0;
    font-size: 1rem;
}

.dashboard-table-container th {
    font-weight: 600;
    letter-spacing: 0.5px;
}

.dashboard-table-container tbody tr:nth-child(even) {
    background-color: #f8fafc;
}

.dashboard-table-container tbody tr:hover {
    background-color: #f1f5f9;
    transition: background-color 0.2s ease;
}

.dashboard-table-container td strong {
    color: #1e293b;
}

.dashboard-table-container .no-data {
    text-align: center;
    padding: 2.5rem 1rem;
    color: #94a3b8;
    font-style: italic;
}

/* ================================================
   RESPONSIVE
   ================================================ */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 0 1rem;
    }
    
    .dashboard-container > h2 {
        font-size: 1.5rem;
    }

    .dashboard-summary {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .dashboard-card {
        padding: 1.5rem;
    }

    .dashboard-card-icon {
        width: 55px;
        height: 55px;
        font-size: 1.5rem;
    }

    .dashboard-table-container {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .dashboard-table-container th,
    .dashboard-table-container td {
        padding: 1rem 0.75rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 480px) {
    .dashboard-container > h2 {
        font-size: 1.3rem;
        text-align: center;
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .dashboard-card h3 {
        font-size: 0.85rem;
    }
    
    .dashboard-card p {
        font-size: 1.6rem;
    }
    
    .dashboard-table-title {
        font-size: 1.1rem;
    }
}
</style>

</head>
<body class="dashboard-page">

@include('layouts.header')
@section('title', 'Dashboard')

<div class="dashboard-container">
    <h2><i class="fas fa-user-circle"></i> Selamat datang, {{ Auth::user()->name }} 👋</h2>
    <p>Berikut ringkasan penjualan hari ini:</p>

    <!-- 🔹 Ringkasan Penjualan -->
    <div class="dashboard-summary">
        <div class="dashboard-card dashboard-card-green">
            <div class="dashboard-card-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <h3>Pendapatan</h3>
            <p>Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>

        <div class="dashboard-card dashboard-card-blue">
            <div class="dashboard-card-icon">
                <i class="fas fa-receipt"></i>
            </div>
            <h3>Transaksi</h3>
            <p>{{ $totalTransaksi }}</p>
        </div>

        <div class="dashboard-card dashboard-card-orange">
            <div class="dashboard-card-icon">
                <i class="fas fa-utensils"></i>
            </div>
            <h3>Menu Terjual</h3>
            <p>{{ $totalMenuTerjual }}</p>
        </div>

        <div class="dashboard-card dashboard-card-purple">
            <div class="dashboard-card-icon">
                <i class="fas fa-file-invoice-dollar"></i>
            </div>
            <h3>Pajak Dipungut</h3>
            <p>Rp {{ number_format($totalPajak, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- 🔹 Tabel Transaksi -->
    <h3 class="dashboard-table-title"><i class="fas fa-clock"></i> Transaksi Terbaru</h3>
    <div class="dashboard-table-container">
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