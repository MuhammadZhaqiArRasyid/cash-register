<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Transaksi</title>

    <style>
        /* ====== STYLE DASAR ====== */
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        /* ====== TABEL PRODUK ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f9f9f9;
        }

        /* ====== INPUT & BUTTON ====== */
        input[type="number"], input[type="text"] {
            padding: 6px;
            width: 80px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #218838;
        }

        /* ====== TOTAL ====== */
        .summary {
            margin-top: 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        .summary p {
            font-size: 18px;
            margin: 10px 0;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            background: #6c757d;
            color: white;
            padding: 8px 15px;
            border-radius: 6px;
            text-decoration: none;
        }

        .back-link:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>

    {{-- Header --}}
    @include('layouts.header')
    @section('title', 'Buat Transaksi')

    <h2>🧾 Buat Transaksi</h2>

    {{-- Tampilkan pesan error --}}
    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('error')) 
        <p style="color:red;">{{ session('error') }}</p> 
    @endif

    @if(session('success')) 
        <p style="color:green;">{{ session('success') }}</p> 
    @endif

    <!-- ====== FORM TRANSAKSI ====== -->
    <form id="formTransaksi" action="{{ route('transaksi.store') }}" method="POST">
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Pilih</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $p)
                    <tr class="produk-item" data-harga="{{ $p->harga }}">
                        <td><input type="checkbox" name="produk_id[]" value="{{ $p->id_produk }}"></td>
                        <td>{{ $p->nama_produk }}</td>
                        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                        <td>{{ $p->stok }}</td>
                        <td><input type="number" name="qty[{{ $p->id_produk }}]" class="qty" value="0"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <p><strong>Total:</strong> Rp <span id="total">0</span></p>
            <p><strong>Bayar:</strong> <input type="number" id="bayar" name="bayar" placeholder="Masukkan jumlah bayar" required></p>
            <p><strong>Kembalian:</strong> Rp <span id="kembalian">0</span></p>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <button type="submit">💾 Simpan Transaksi</button>
        </div>
    </form>

    <div style="text-align: center;">
        <a href="{{ route('transaksi.index') }}" class="back-link">⬅ Kembali</a>
    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- ====== SCRIPT PERHITUNGAN OTOMATIS ====== -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const qtyInputs = document.querySelectorAll('.qty');
            const checkboxes = document.querySelectorAll('input[name="produk_id[]"]');
            const totalEl = document.getElementById('total');
            const bayarEl = document.getElementById('bayar');
            const kembaliEl = document.getElementById('kembalian');

            function hitungTotal() {
                let total = 0;
                document.querySelectorAll('.produk-item').forEach(row => {
                    const checkbox = row.querySelector('input[type="checkbox"]');
                    const harga = parseFloat(row.dataset.harga);
                    const qty = parseInt(row.querySelector('.qty').value || 0);

                    if (checkbox.checked && qty > 0) {
                        total += harga * qty;
                    }
                });

                totalEl.innerText = total.toLocaleString('id-ID');

                const bayar = parseFloat(bayarEl.value || 0);
                kembaliEl.innerText = (bayar - total).toLocaleString('id-ID');
            }

            qtyInputs.forEach(input => input.addEventListener('input', hitungTotal));
            checkboxes.forEach(cb => cb.addEventListener('change', hitungTotal));
            bayarEl.addEventListener('input', hitungTotal);

            // Cegah kirim tanpa memilih produk
            document.getElementById('formTransaksi').addEventListener('submit', function (e) {
            const checkedBoxes = Array.from(checkboxes).filter(cb => cb.checked);

    // Jika belum ada produk dipilih
    if (checkedBoxes.length === 0) {
        alert('Pilih minimal satu produk!');
        e.preventDefault();
        return false;
    }

    // Hapus semua input qty yang tidak dicentang (biar tidak dikirim ke server)
    document.querySelectorAll('.produk-item').forEach(row => {
        const checkbox = row.querySelector('input[type="checkbox"]');
        const qtyInput = row.querySelector('.qty');
        if (!checkbox.checked) {
            qtyInput.disabled = true;
        }
    });
});

        });
    </script>
</body>
</html>
