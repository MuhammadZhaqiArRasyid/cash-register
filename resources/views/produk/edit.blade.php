<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background: #f8f9fa;
            margin: 0;
        }

        .form-container {
            max-width: 500px;
            margin: 80px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #1a202c;
        }

        form label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            color: #333;
        }

        form input, form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        form button {
            background: #27ae60;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: 0.2s;
        }

        form button:hover {
            background: #1e874b;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #e67e22;
            font-weight: bold;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @include('layouts.header')
    @section('title', 'Edit Produk')

    <div class="form-container">
        <h2>✏️ Edit Produk</h2>

        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}" required>

            <label for="kategori">Kategori</label>
            <select name="kategori" id="kategori" required>
                <option value="makanan" {{ $produk->kategori == 'makanan' ? 'selected' : '' }}>🍔 Makanan</option>
                <option value="minuman" {{ $produk->kategori == 'minuman' ? 'selected' : '' }}>🥤 Minuman</option>
            </select>

            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" value="{{ $produk->harga }}" required>

            <label for="pajak" class="form-label">Pajak (%)</label>
            <input type="number" name="pajak" id="pajak" class="form-control" step="0.01" value="{{ $produk->pajak }}">

            <!-- <label for="stok">Stok</label>
            <input type="number" name="stok" id="stok" value="{{ $produk->stok }}" required> -->

            <label for="gambar">Gambar Produk</label>
            <input type="file" name="gambar" id="gambar" accept="image/*">

            @if($produk->gambar)
                <div style="margin-top:10px;">
                    <p>Gambar saat ini:</p>
                    <img src="{{ asset('uploads/produk/'.$produk->gambar) }}" width="150" style="border-radius:8px;">
                </div>
            @endif


            <button type="submit">💾 Update Produk</button>
        </form>

        <a href="{{ route('produk.index') }}" class="back-link">⬅ Kembali ke Daftar Produk</a>
    </div>

    @include('layouts.footer')
</body>
</html>
