<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi | Cash Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ================================================
           TRANSAKSI PAGE — Clean & Modern
           ================================================ */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body.transaksi-page {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            color: #1e293b;
            min-height: 100vh;
        }

        .transaksi-container {
            max-width: 1200px;
            margin: 2.5rem auto;
            padding: 0 1.5rem;
        }

        .transaksi-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .transaksi-header h2 {
            font-size: 2rem;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .transaksi-header p {
            color: #64748b;
            font-size: 1.05rem;
        }

        .transaksi-wrapper {
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        /* Alert */
        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
            color: white;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        /* Search Bar */
        .search-bar {
            margin-bottom: 2rem;
        }

        .search-bar input {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: #f8fafc;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #8b5cf6;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .search-bar input::placeholder {
            color: #94a3b8;
        }

        /* Produk Grid */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .produk-card {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 1.25rem;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .produk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .produk-card-content {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .produk-card img {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            object-fit: cover;
            flex-shrink: 0;
            background: #e2e8f0;
        }

        .produk-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .produk-checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .produk-checkbox-label input[type="checkbox"] {
            width: 20px;
            height: 20px;
            cursor: pointer;
            accent-color: #8b5cf6;
        }

        .produk-checkbox-label strong {
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
        }

        .produk-price {
            color: #10b981;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .produk-qty-section {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .produk-qty-section label {
            font-size: 0.9rem;
            color: #64748b;
            font-weight: 500;
        }

        .produk-qty-section input[type="number"] {
            width: 80px;
            padding: 0.5rem;
            text-align: center;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: 'Poppins', sans-serif;
            background: #ffffff;
        }

        .produk-qty-section input[type="number"]:focus {
            outline: none;
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
        }

        .subtotal {
            font-weight: 600;
            font-size: 1rem;
            color: #3b82f6;
            padding: 0.75rem;
            background: #eff6ff;
            border-radius: 10px;
            text-align: center;
        }

        /* Summary */
        .summary {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            border-radius: 16px;
            text-align: center;
            padding: 1rem 1.5rem;
            margin: 2rem 0;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .summary p {
            font-size: 1.2rem;
            font-weight: 700;
            color: white;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Buttons */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .btn-transaksi {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
            font-family: 'Poppins', sans-serif;
        }

        .btn-transaksi:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            background: #f8fafc;
            color: #64748b;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            background: #e2e8f0;
            color: #1e293b;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #94a3b8;
            font-style: italic;
        }

        /* ================================================
           RESPONSIVE
           ================================================ */

        @media (max-width: 768px) {
            .transaksi-container {
                margin: 2rem auto;
                padding: 0 1rem;
            }

            .transaksi-header h2 {
                font-size: 1.6rem;
            }

            .transaksi-wrapper {
                padding: 1.5rem;
            }

            .produk-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .produk-card-content {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .produk-card img {
                width: 100%;
                max-width: 200px;
                height: 150px;
            }

            .produk-qty-section {
                justify-content: center;
            }

            .produk-qty-section input[type="number"] {
                width: 100px;
            }

            .summary p {
                font-size: 1.1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-transaksi {
                width: 100%;
            }
            
            .back-link {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .transaksi-header h2 {
                font-size: 1.4rem;
            }

            .summary p {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body class="transaksi-page">

@include('layouts.header')
@section('title', 'Transaksi')

<div class="transaksi-container">
    <div class="transaksi-header">
        <h2>🧾 Buat Transaksi</h2>
        <p>Pilih produk dan tentukan jumlah pembelian</p>
    </div>

    <div class="transaksi-wrapper">
        @if(session('success'))
            <div class="alert-success">✓ {{ session('success') }}</div>
        @endif

        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="🔍 Cari produk berdasarkan nama...">
        </div>

        <form id="formTransaksi" action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="produk-grid" id="produkGrid">
                @foreach($produk as $p)
                    <div class="produk-card" data-harga="{{ $p->harga }}" data-nama="{{ strtolower($p->nama_produk) }}">
                        <div class="produk-card-content">
                            <img src="{{ asset('uploads/produk/'.($p->gambar ?? 'default.png')) }}" alt="{{ $p->nama_produk }}">
                            <div class="produk-info">
                                <label class="produk-checkbox-label">
                                    <input type="checkbox" name="produk_id[]" value="{{ $p->id_produk }}">
                                    <strong>{{ $p->nama_produk }}</strong>
                                </label>
                                <p class="produk-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                                <div class="produk-qty-section">
                                    <label>Qty:</label>
                                    <input type="number" name="qty[{{ $p->id_produk }}]" class="qty" min="0" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="subtotal">Subtotal: Rp 0</div>
                    </div>
                @endforeach
            </div>

            <div class="summary">
                <p>💰 Total: Rp <span id="total">0</span></p>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-transaksi">💾 Simpan Transaksi</button>
                <a href="{{ route('dashboard') }}" class="back-link">⬅ Kembali ke Dashboard</a>
            </div>
        </form>
    </div>
</div>

@include('layouts.footer')

<script>
document.addEventListener('DOMContentLoaded', () => {
    const qtyInputs = document.querySelectorAll('.qty');
    const checkboxes = document.querySelectorAll('input[name="produk_id[]"]');
    const totalEl = document.getElementById('total');
    const searchInput = document.getElementById('searchInput');
    const produkCards = document.querySelectorAll('.produk-card');

    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.produk-card').forEach(card => {
            const cb = card.querySelector('input[type="checkbox"]');
            const harga = parseFloat(card.dataset.harga);
            const qty = parseInt(card.querySelector('.qty').value || 0);
            const subtotalEl = card.querySelector('.subtotal');

            let subtotal = 0;
            if (cb.checked && qty > 0) subtotal = harga * qty;

            subtotalEl.textContent = 'Subtotal: Rp ' + subtotal.toLocaleString('id-ID');
            total += subtotal;
        });
        totalEl.textContent = total.toLocaleString('id-ID');
    }

    qtyInputs.forEach(i => i.addEventListener('input', hitungTotal));
    checkboxes.forEach(c => c.addEventListener('change', hitungTotal));

    document.getElementById('formTransaksi').addEventListener('submit', e => {
        const ada = Array.from(checkboxes).some(cb => cb.checked);
        if (!ada) {
            alert('⚠️ Pilih minimal satu produk!');
            e.preventDefault();
        }
    });

    searchInput.addEventListener('input', e => {
        const keyword = e.target.value.toLowerCase();
        produkCards.forEach(card => {
            const nama = card.dataset.nama;
            card.style.display = nama.includes(keyword) ? 'flex' : 'none';
        });
    });
});
</script>

</body>
</html>