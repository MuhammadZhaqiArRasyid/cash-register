<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================================================
           LAPORAN PAGE — Clean & Modern
           ================================================ */

        body.laporan-page {
            font-family: "Poppins", Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #333;
            min-height: 100vh;
        }

        .laporan-container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        .laporan-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .laporan-header h2 {
            font-size: 2rem;
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .laporan-header p {
            color: #64748b;
            font-size: 1.05rem;
        }

        .laporan-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            border: none;
        }

        /* Filter Section */
        .filter-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: #f8fafc;
            border-radius: 16px;
        }

        .filter-section label {
            font-weight: 600;
            color: #1e293b;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }

        .filter-section input {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #ffffff;
        }

        .filter-section input:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .btn-custom {
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 0.95rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-success-custom {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-success-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
        }

        .btn-danger-custom {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
        }

        .btn-danger-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
        }

        /* Period Info */
        .period-info {
            text-align: center;
            font-size: 1.1rem;
            margin: 1.5rem 0;
            padding: 1rem;
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            color: white;
            border-radius: 12px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        /* Table */
        .laporan-table-container {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-top: 1.5rem;
        }

        .laporan-table {
            width: 100%;
            margin: 0;
        }

        .laporan-table thead tr {
            background: linear-gradient(90deg, #1e293b 0%, #334155 100%);
            color: white;
        }

        .laporan-table thead th {
            padding: 1rem;
            font-weight: 600;
            text-align: center;
            border: none;
        }

        .laporan-table tbody td {
            padding: 0.9rem;
            text-align: center;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .laporan-table tbody tr:hover {
            background-color: #f8fafc;
        }

        .laporan-table tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .laporan-table .total-row {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%) !important;
            color: white;
            font-weight: 700;
        }

        .laporan-table .total-row td {
            border: none;
            padding: 1.2rem;
        }

        /* Signature */
        .signature-section {
            margin-top: 3rem;
            text-align: right;
            padding-right: 3rem;
        }

        .signature-section p {
            color: #64748b;
            font-size: 0.95rem;
            margin-bottom: 4rem;
        }

        .signature-name {
            font-weight: 700;
            color: #1e293b;
            border-top: 2px solid #1e293b;
            padding-top: 0.5rem;
            display: inline-block;
            min-width: 200px;
        }

        /* Alert */
        .alert-info-custom {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            color: #1e40af;
            border-radius: 12px;
            padding: 1.2rem;
            text-align: center;
        }

        /* Print Header (hidden on screen) */
        .print-header {
            display: none;
        }

        /* ===============================
           🖨️ PRINT STYLE
           =============================== */
        @media print {
            @page {
                size: A4 portrait;
                margin: 5mm 10mm;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body {
                background: white !important;
                color: #000 !important;
                font-family: Arial, Helvetica, sans-serif !important;
                margin: 0;
                padding: 10px 20px;
            }

            nav, header, footer, form, .btn-custom, .filter-section, .no-print {
                display: none !important;
            }

            .laporan-card {
                border: none !important;
                box-shadow: none !important;
                background: white !important;
                padding: 0 !important;
            }

            .laporan-container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 3px solid #000;
            }

            .print-header h4 {
                font-size: 20pt;
                font-weight: 900;
                margin: 0 0 8px 0;
                text-transform: uppercase;
                color: #000;
            }

            .print-header p {
                font-size: 11pt;
                margin: 4px 0 0 0;
                color: #333;
            }

            .period-info {
                text-align: center;
                font-size: 12pt;
                margin: 12px 0 20px 0;
                font-weight: 600;
                color: #000;
                background: #f0f0f0 !important;
                padding: 10px;
                border-radius: 5px;
                box-shadow: none !important;
            }

            .laporan-table thead tr {
                background: #2c3e50 !important;
                color: white !important;
            }

            .laporan-table thead th,
            .laporan-table tbody td {
                border: 1px solid #000 !important;
                padding: 8px 12px !important;
            }

            .laporan-table .total-row {
                background: #34495e !important;
                color: white !important;
            }

            .signature-section {
                margin-top: 50px;
                text-align: right;
                padding-right: 50px;
                page-break-inside: avoid;
            }

            .signature-section p {
                font-size: 11pt;
                margin-bottom: 80px;
                color: #000;
            }

            .signature-name {
                font-weight: 700;
                font-size: 11pt;
                border-top: 2px solid #000;
                color: #000;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .laporan-header h2 {
                font-size: 1.6rem;
            }

            .laporan-card {
                padding: 1.5rem;
            }

            .filter-section {
                padding: 1rem;
            }

            .signature-section {
                text-align: center;
                padding-right: 0;
            }

            .laporan-table {
                font-size: 0.85rem;
            }

            .laporan-table thead th,
            .laporan-table tbody td {
                padding: 0.7rem 0.5rem;
            }
        }

        @media (max-width: 576px) {
            .btn-custom {
                font-size: 0.85rem;
                padding: 0.65rem 1rem;
            }
        }
    </style>
</head>

<body class="laporan-page">
    @include('layouts.header')

    <div class="laporan-container">
        <div class="laporan-header">
            <h2>📊 Laporan Transaksi</h2>
            <p>Kelola dan export laporan transaksi Anda</p>
        </div>

        <div class="laporan-card">
            <!-- 🔍 Filter -->
            <div class="filter-section">
                <form action="{{ route('laporan.index') }}" method="GET">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="tanggal_awal" class="form-label">📅 Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal"
                                value="{{ request('tanggal_awal') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_akhir" class="form-label">📅 Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                value="{{ request('tanggal_akhir') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-custom btn-primary-custom w-100">
                                <i class="bi bi-search me-1"></i> Tampilkan
                            </button>
                        </div>
                    </div>

                    @if(request('tanggal_awal') && request('tanggal_akhir'))
                    <div class="row g-2 mt-2">
                        <div class="col-md-6">
                            <a href="{{ route('laporan.export', ['tanggal_awal'=>request('tanggal_awal'), 'tanggal_akhir'=>request('tanggal_akhir')]) }}"
                               class="btn btn-custom btn-success-custom w-100">
                                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a href="{{ route('laporan.exportPDF', ['tanggal_awal'=>request('tanggal_awal'), 'tanggal_akhir'=>request('tanggal_akhir')]) }}"
                               class="btn btn-custom btn-danger-custom w-100">
                                <i class="bi bi-file-earmark-pdf me-1"></i> Export PDF
                            </a>
                        </div>
                    </div>
                    @endif
                </form>
            </div>

            @if(request('tanggal_awal') && request('tanggal_akhir'))
            <div class="print-header">
                <h4>LAPORAN TRANSAKSI RESTORAN</h4>
                <p>Jl. Contoh No.123, Bukittinggi | Telp: (0752) 123456</p>
            </div>

            <div class="period-info">
                <strong>📆 Periode:</strong>
                {{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d/m/Y') }}
                -
                {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') }}
            </div>
            @endif

            @if(!empty($transaksis))
                <div class="laporan-table-container">
                    <table class="laporan-table">
                        <thead>
                            <tr>
                                <th>ID Transaksi</th>
                                <th>Tanggal</th>
                                <th>Qty</th>
                                <th>Pajak</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $grandTotal = 0; @endphp
                            @foreach($transaksis as $t)
                                <tr>
                                    <td>{{ $t->id_transaksi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('d-m-Y') }}</td>
                                    <td>{{ $t->qty }}</td>
                                    <td>Rp {{ number_format($t->pajak, 2, ',', '.') }}</td>
                                    <td>Rp {{ number_format($t->total, 2, ',', '.') }}</td>
                                </tr>
                                @php $grandTotal += $t->total; @endphp
                            @endforeach
                            <tr class="total-row">
                                <td colspan="4" style="text-align: right;">TOTAL KESELURUHAN</td>
                                <td>Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="signature-section">
                    <p>Bukittinggi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                    <div class="signature-name">Admin Restoran</div>
                </div>
            @else
                <div class="alert-info-custom">
                    <i class="bi bi-info-circle me-2"></i> Silakan pilih rentang tanggal untuk menampilkan laporan.
                </div>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>