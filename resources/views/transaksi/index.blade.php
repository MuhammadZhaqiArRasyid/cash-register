<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi | Cash Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* === TRANSAKSI PAGE — Clean Responsive Design === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f8;
            color: #2d3748;
            min-height: 100vh;
        }

        .wrapper {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 600;
        }

        .alert-success {
            background: #e6fffa;
            color: #065f46;
            border-left: 5px solid #10b981;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        /* === Search Bar === */
        .search-bar {
            text-align: center;
            margin-bottom: 25px;
        }

        .search-bar input {
            width: 100%;
            max-width: 600px;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: 0.2s;
        }

        .search-bar input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        /* === Produk Grid === */
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .produk-card {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            background: #fafafa;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            transition: 0.2s ease;
        }

        .produk-card:hover {
            background: #f0f9ff;
            border-color: #93c5fd;
            transform: translateY(-2px);
        }

        .produk-card img {
            width: 90px;
            height: 90px;
            border-radius: 8px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .produk-info {
            flex: 1;
            min-width: 0;
        }

        .produk-info h4 {
            margin: 0;
            font-size: 16px;
            color: #1e293b;
            font-weight: 600;
            overflow-wrap: break-word;
        }

        .produk-info p {
            margin: 3px 0;
            font-size: 14px;
            color: #475569;
        }

        .produk-info input[type="number"] {
            width: 70px;
            padding: 5px;
            text-align: center;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 14px;
        }

        .subtotal {
            font-weight: 600;
            font-size: 14px;
            color: #2563eb;
            margin-top: 6px;
        }

        /* === Summary === */
        .summary {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            text-align: center;
            padding: 20px;
            margin-top: 15px;
        }

        .summary p {
            font-size: 18px;
            font-weight: 600;
            color: #1e3a8a;
        }

        /* === Buttons === */
        .btn-transaksi {
            display: inline-block;
            background: #3b82f6;
            color: white;
            border: none;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-transaksi:hover {
            background: #2563eb;
        }

        .back-link {
            display: inline-block;
            background: #6b7280;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            transition: 0.2s;
        }

        .back-link:hover {
            background: #374151;
        }

        /* === RESPONSIVE === */
        @media (max-width: 768px) {
            .wrapper {
                margin: 20px;
                padding: 20px;
            }

            .produk-card {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .produk-card img {
                width: 100%;
                height: 160px;
            }

            .produk-info input[type="number"] {
                width: 100%;
            }

            .btn-transaksi {
                width: 100%;
            }
        }
    </style>
</head>
<body>

@include('layouts.header')
@section('title', 'Transaksi')

<div class="wrapper">
    <h2>🧾 Buat Transaksi</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="Cari produk berdasarkan nama...">
    </div>

    <form id="formTransaksi" action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="produk-grid" id="produkGrid">
            @foreach($produk as $p)
                <div class="produk-card" data-harga="{{ $p->harga }}" data-nama="{{ strtolower($p->nama_produk) }}">
                    <img src="{{ asset('uploads/produk/'.$p->gambar ?? 'default.png') }}" alt="{{ $p->nama_produk }}">
                    <div class="produk-info">
                        <label>
                            <input type="checkbox" name="produk_id[]" value="{{ $p->id_produk }}">
                            <strong>{{ $p->nama_produk }}</strong>
                        </label>
                        <p>Harga: Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                        <label>Qty:</label>
                        <input type="number" name="qty[{{ $p->id_produk }}]" class="qty" min="0" value="0">
                        <div class="subtotal">Subtotal: Rp 0</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="summary">
            <p>Total: Rp <span id="total">0</span></p>
        </div>

        <div style="text-align:center; margin-top:20px;">
            <button type="submit" class="btn-transaksi">💾 Simpan Transaksi</button>
        </div>
    </form>

    <div style="text-align:center;">
        <a href="{{ route('dashboard') }}" class="back-link">⬅ Kembali ke Dashboard</a>
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
            alert('Pilih minimal satu produk!');
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
