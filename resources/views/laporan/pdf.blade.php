<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        /* ================================================
           PDF LAPORAN — Professional & Clean
           ================================================ */
        
        body { 
            font-family: "Poppins", Arial, sans-serif; 
            font-size: 11px; 
            color: #1e293b;
            margin: 20px;
            line-height: 1.6;
        }

        /* Header Section */
        .report-header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1e293b;
        }

        .report-header h2 {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin: 0 0 8px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .report-header .company-info {
            font-size: 10px;
            color: #64748b;
            margin: 5px 0 0 0;
        }

        /* Period Info */
        .period-info {
            text-align: center;
            background: #f8fafc;
            padding: 10px;
            margin: 15px 0 20px 0;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        .period-info strong {
            color: #1e293b;
            font-size: 12px;
        }

        /* Table Styles */
        table { 
            width: 100%; 
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead tr {
            background: #1e293b;
            color: white;
        }

        th { 
            border: 1px solid #1e293b;
            padding: 12px 10px;
            text-align: center;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        td { 
            border: 1px solid #cbd5e1;
            padding: 10px 8px;
            text-align: center;
            font-size: 10px;
        }

        tbody tr:nth-child(odd) {
            background: #ffffff;
        }

        tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        /* Total Row */
        .total-row { 
            font-weight: 700;
            background: #334155 !important;
            color: white;
        }

        .total-row td {
            border: 1px solid #1e293b;
            padding: 12px 10px;
            font-size: 11px;
        }

        .total-row td:first-child {
            text-align: right;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 50px;
            text-align: right;
            padding-right: 40px;
        }

        .signature-section .date {
            margin-bottom: 70px;
            color: #64748b;
            font-size: 11px;
        }

        .signature-section .name {
            font-weight: 700;
            color: #1e293b;
            border-top: 2px solid #1e293b;
            padding-top: 5px;
            display: inline-block;
            min-width: 180px;
            text-align: center;
        }

        /* Summary Stats (optional enhancement) */
        .summary-stats {
            display: table;
            width: 100%;
            margin: 15px 0;
        }

        .summary-item {
            display: table-cell;
            width: 33.33%;
            text-align: center;
            padding: 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .summary-item .label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .summary-item .value {
            font-size: 13px;
            font-weight: 700;
            color: #1e293b;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="report-header">
        <h2>📊 Laporan Transaksi</h2>
        <div class="company-info">
            <strong>RESTORAN NAMA ANDA</strong><br>
            Jl. Contoh No.123, Bukittinggi | Telp: (0752) 123456 | Email: info@restoran.com
        </div>
    </div>

    <!-- Period Info -->
    <div class="period-info">
        <strong>Periode Laporan:</strong>
        {{ \Carbon\Carbon::parse(request('tanggal_awal', now()))->format('d F Y') }}
        s/d
        {{ \Carbon\Carbon::parse(request('tanggal_akhir', now()))->format('d F Y') }}
    </div>

    <!-- Summary Stats (Optional) -->
    @php 
        $grandTotal = 0;
        $totalQty = 0;
        $totalPajak = 0;
        foreach($transaksis as $t) {
            $grandTotal += $t->total;
            $totalQty += $t->qty;
            $totalPajak += $t->pajak;
        }
    @endphp

    <div class="summary-stats">
        <div class="summary-item">
            <div class="label">Total Transaksi</div>
            <div class="value">{{ count($transaksis) }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Qty</div>
            <div class="value">{{ $totalQty }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Pajak</div>
            <div class="value">Rp {{ number_format($totalPajak, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Transaction Table -->
    <table>
        <thead>
            <tr>
                <th style="width: 15%">ID Transaksi</th>
                <th style="width: 20%">Tanggal</th>
                <th style="width: 15%">Qty</th>
                <th style="width: 25%">Pajak</th>
                <th style="width: 25%">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $t)
                <tr>
                    <td>{{ $t->id_transaksi }}</td>
                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $t->qty }}</td>
                    <td>Rp {{ number_format($t->pajak, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($t->total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="4">TOTAL KESELURUHAN</td>
                <td>Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <!-- Signature -->
    <div class="signature-section">
        <div class="date">
            Bukittinggi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
        </div>
        <div class="name">Admin Restoran</div>
    </div>
</body>
</html>