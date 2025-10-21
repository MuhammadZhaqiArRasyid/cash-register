@extends('layouts.header')
@section('title', 'Data Produk')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #f4f6f8;
            margin: 0;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-top: 40px;
            font-weight: 600;
        }

        .produk-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .produk-column {
            flex: 1;
            min-width: 320px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .produk-column h3 {
            text-align: center;
            color: #34495e;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .produk-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .produk-card {
            display: flex;
            align-items: center;
            background: #fafafa;
            border-radius: 8px;
            padding: 10px;
            border: 1px solid #e3e6e8;
        }

        .produk-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
            background: #f0f0f0;
        }

        .produk-info {
            flex: 1;
        }

        .produk-info h4 {
            margin: 0;
            font-size: 16px;
            color: #2c3e50;
        }

        .produk-info p {
            margin: 3px 0;
            color: #7f8c8d;
            font-size: 14px;
        }

        .produk-actions a,
        .produk-actions button {
            font-size: 13px;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            margin-right: 8px;
        }

        .produk-actions a {
            color: #2980b9;
        }

        .produk-actions button {
            color: #c0392b;
        }

        .tambah-btn {
            background: #3498db;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-top: 25px;
            transition: background 0.2s ease;
        }

        .tambah-btn:hover {
            background: #2980b9;
        }

        @media (max-width: 768px) {
            .produk-wrapper {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <h2>Data Produk</h2>

    <div class="produk-wrapper">
        <!-- Kolom Makanan -->
        <div class="produk-column">
            <h3>🍔 Makanan</h3>
            <div class="produk-grid">
                @forelse($makanan as $m)
                    <div class="produk-card">
                        <img src="{{ asset('uploads/produk/' . ($m->gambar ?? 'default.png')) }}" class="produk-img" alt="{{ $m->nama_produk }}">
                        <div class="produk-info">
                            <h4>{{ $m->nama_produk }}</h4>
                            <p>Harga: Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                            <div class="produk-actions">
                                <a href="{{ route('produk.edit', $m->id_produk) }}">Edit</a>
                                <form action="{{ route('produk.destroy', $m->id_produk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;">Tidak ada produk makanan.</p>
                @endforelse
            </div>
        </div>

        <!-- Kolom Minuman -->
        <div class="produk-column">
            <h3>🥤 Minuman</h3>
            <div class="produk-grid">
                @forelse($minuman as $m)
                    <div class="produk-card">
                        <img src="{{ asset('uploads/produk/' . ($m->gambar ?? 'default.png')) }}" class="produk-img" alt="{{ $m->nama_produk }}">
                        <div class="produk-info">
                            <h4>{{ $m->nama_produk }}</h4>
                            <p>Harga: Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                            <div class="produk-actions">
                                <a href="{{ route('produk.edit', $m->id_produk) }}">Edit</a>
                                <form action="{{ route('produk.destroy', $m->id_produk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="text-align:center;">Tidak ada produk minuman.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div style="text-align:center;">
        <a href="{{ route('produk.create') }}" class="tambah-btn">➕ Tambah Produk</a>
    </div>

@include('layouts.footer')
</body>
</html>
@endsection
