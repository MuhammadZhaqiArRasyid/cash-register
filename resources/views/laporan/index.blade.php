<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* 🌐 Tampilan Normal */
        body {
            font-family: "Poppins", Arial, sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        table thead tr {
            background: #2c3e50;
            color: white;
        }

        .card {
            border-radius: 10px;
            border: none;
        }

        /* Responsif tabel di HP */
        @media (max-width: 576px) {
            table {
                font-size: 12px;
            }
            .signature {
                text-align: center !important;
                padding-right: 0 !important;
            }
        }

        /* ===============================
        🖨️ PRINT STYLE - PROFESIONAL
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

            /* Sembunyikan elemen yang tidak perlu */
            nav, header, footer, form, .btn, .card-header, .no-print {
                display: none !important;
            }

            .card {
                border: none !important;
                box-shadow: none !important;
                background: white !important;
            }

            .container {
                width: 100% !important;
                max-width: 100% !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            /* ===============================
               HEADER LAPORAN
            =============================== */
            .print-header {
                display: block !important;
                text-align: center;
                margin-bottom: 20px;
                padding-bottom: 12px;
                border-bottom: 3px solid #000;
            }

            .print-header img {
                display: none !important;
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

            /* ===============================
               INFO PERIODE
            =============================== */
            .period-info {
                text-align: center;
                font-size: 12pt;
                margin: 12px 0 20px 0;
                font-weight: 600;
                color: #000;
                background: #f0f0f0;
                padding: 10px;
                border-radius: 5px;
            }

            /* ===============================
               TABEL
            =============================== */
            table {
                width: 100% !important;
                border-collapse: collapse !important;
                font-size: 10pt;
            }

            thead tr {
                background: #2c3e50 !important;
                color: white !important;
            }

            thead th, tbody td {
                border: 1px solid #000 !important;
                padding: 8px 12px !important;
                text-align: center !important;
            }

            .table-secondary td {
                background: #34495e !important;
                color: white !important;
                font-weight: 700;
            }

            /* ===============================
               TANDA TANGAN
            =============================== */
            .signature {
                margin-top: 50px;
                text-align: right;
                padding-right: 50px;
                page-break-inside: avoid;
            }

            .signature p {
                font-size: 11pt;
                margin-bottom: 80px;
            }

            .signature .signature-name {
                font-weight: 700;
                font-size: 11pt;
                border-top: 2px solid #000;
                padding-top: 5px;
                min-width: 200px;
                display: inline-block;
            }
        }

        .print-header {
            display: none;
        }
    </style>
</head>

<body>
    @include('layouts.header')

    <div class="container mt-5 mb-5">
        <div class="card shadow border-0">
            <div class="card-body">

                <!-- 🔍 Filter -->
                <form action="{{ route('laporan.index') }}" method="GET" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="tanggal_awal" class="form-label fw-semibold">Tanggal Awal</label>
                            <input type="date" name="tanggal_awal" id="tanggal_awal"
                                value="{{ request('tanggal_awal') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="tanggal_akhir" class="form-label fw-semibold">Tanggal Akhir</label>
                            <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                value="{{ request('tanggal_akhir') }}" class="form-control" required>
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-1"></i> Tampilkan
                            </button>

                            @if(request('tanggal_awal') && request('tanggal_akhir'))
                                <a href="{{ route('laporan.export', ['tanggal_awal'=>request('tanggal_awal'), 'tanggal_akhir'=>request('tanggal_akhir')]) }}"
                                   class="btn btn-success w-100">
                                    <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                                </a>
                                <button type="button" onclick="window.print()" class="btn btn-secondary w-100">
                                    <i class="bi bi-printer me-1"></i> Print
                                </button>
                            @endif
                        </div>
                    </div>
                </form>

                @if(request('tanggal_awal') && request('tanggal_akhir'))
                <div class="print-header">
                    <h4>LAPORAN TRANSAKSI RESTORAN</h4>
                    <p>Jl. Contoh No.123, Bukittinggi | Telp: (0752) 123456</p>
                </div>

                <div class="period-info">
                    <strong>Periode:</strong>
                    {{ \Carbon\Carbon::parse(request('tanggal_awal'))->format('d/m/Y') }}
                    -
                    {{ \Carbon\Carbon::parse(request('tanggal_akhir'))->format('d/m/Y') }}
                </div>
                @endif

                @if(!empty($transaksis))
                    <div class="table-responsive">
                        <table class="table table-striped align-middle text-center">
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
                                <tr class="fw-bold table-secondary">
                                    <td colspan="4" class="text-end">TOTAL KESELURUHAN</td>
                                    <td>Rp {{ number_format($grandTotal, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="signature">
                        <p>Bukittinggi, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                        <div class="signature-line">
                            <div class="signature-name">Admin Restoran</div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info text-center mt-3">
                        <i class="bi bi-info-circle me-2"></i> Silakan pilih rentang tanggal untuk menampilkan laporan.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
