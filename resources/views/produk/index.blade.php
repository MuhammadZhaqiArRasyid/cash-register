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
        /* ================================================
           PRODUK PAGE ONLY STYLE — Clean & Modern
           ================================================ */

        body.produk-page {
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            margin: 0;
        }

        .produk-header {
            text-align: center;
            margin: 2.5rem 0 1rem;
        }

        .produk-header h2 {
            font-size: 2rem;
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .produk-header p {
            color: #64748b;
            font-size: 1.05rem;
        }

        .produk-wrapper {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1.5rem;
        }

        .produk-column {
            flex: 1;
            min-width: 320px;
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .produk-column-header {
            text-align: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 3px solid;
            position: relative;
        }

        .produk-column-header h3 {
            font-size: 1.4rem;
            margin: 0;
            color: #1e293b;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .produk-column-makanan .produk-column-header {
            border-bottom-color: #f59e0b;
        }

        .produk-column-minuman .produk-column-header {
            border-bottom-color: #3b82f6;
        }

        .produk-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .produk-card {
            display: flex;
            align-items: center;
            background: #f8fafc;
            border-radius: 16px;
            padding: 1rem;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .produk-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-color: #cbd5e1;
        }

        .produk-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 1rem;
            background: #e2e8f0;
            flex-shrink: 0;
        }

        .produk-info {
            flex: 1;
        }

        .produk-info h4 {
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            color: #1e293b;
            font-weight: 600;
        }

        .produk-info .produk-price {
            margin: 0.3rem 0;
            color: #059669;
            font-size: 1.05rem;
            font-weight: 600;
        }

        .produk-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }

        .produk-actions a,
        .produk-actions button {
            font-size: 0.85rem;
            text-decoration: none;
            border: none;
            background: none;
            cursor: pointer;
            padding: 0.4rem 0.9rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .produk-actions a {
            background: #3b82f6;
            color: white;
        }

        .produk-actions a:hover {
            background: #2563eb;
        }

        .produk-actions button {
            background: #ef4444;
            color: white;
        }

        .produk-actions button:hover {
            background: #dc2626;
        }

        .produk-empty {
            text-align: center;
            padding: 2rem 1rem;
            color: #94a3b8;
            font-style: italic;
        }

        .produk-tambah-container {
            text-align: center;
            margin: 2.5rem 0;
        }

        .tambah-btn {
            background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
            color: white;
            padding: 0.9rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        }

        .tambah-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.4);
        }

        /* Badge Count */
        .produk-count {
            display: inline-block;
            background: #f1f5f9;
            color: #64748b;
            font-size: 0.85rem;
            padding: 0.3rem 0.7rem;
            border-radius: 20px;
            margin-left: 0.5rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .produk-wrapper {
                flex-direction: column;
                padding: 0 1rem;
            }

            .produk-header h2 {
                font-size: 1.6rem;
            }

            .produk-column {
                min-width: unset;
            }

            .produk-card {
                flex-direction: column;
                text-align: center;
            }

            .produk-img {
                margin: 0 0 1rem 0;
            }

            .produk-actions {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .produk-header h2 {
                font-size: 1.4rem;
            }

            .produk-column-header h3 {
                font-size: 1.2rem;
            }

            .tambah-btn {
                padding: 0.8rem 1.5rem;
                font-size: 0.95rem;
            }
        }
    </style>
</head>
<body class="produk-page">

    <div class="produk-header">
        <h2>📦 Data Produk</h2>
        <p>Kelola produk makanan dan minuman Anda</p>
    </div>

    <div class="produk-wrapper">
        <!-- Kolom Makanan -->
        <div class="produk-column produk-column-makanan">
            <div class="produk-column-header">
                <h3>
                    🍔 Makanan
                    <span class="produk-count">{{ count($makanan) }}</span>
                </h3>
            </div>
            <div class="produk-grid">
                @forelse($makanan as $m)
                    <div class="produk-card">
                        <img src="{{ asset('uploads/produk/' . ($m->gambar ?? 'default.png')) }}" class="produk-img" alt="{{ $m->nama_produk }}">
                        <div class="produk-info">
                            <h4>{{ $m->nama_produk }}</h4>
                            <p class="produk-price">Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                            <div class="produk-actions">
                                <a href="{{ route('produk.edit', $m->id_produk) }}">✏️ Edit</a>
                                <form action="{{ route('produk.destroy', $m->id_produk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')">🗑️ Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="produk-empty">Tidak ada produk makanan.</p>
                @endforelse
            </div>
        </div>

        <!-- Kolom Minuman -->
        <div class="produk-column produk-column-minuman">
            <div class="produk-column-header">
                <h3>
                    🥤 Minuman
                    <span class="produk-count">{{ count($minuman) }}</span>
                </h3>
            </div>
            <div class="produk-grid">
                @forelse($minuman as $m)
                    <div class="produk-card">
                        <img src="{{ asset('uploads/produk/' . ($m->gambar ?? 'default.png')) }}" class="produk-img" alt="{{ $m->nama_produk }}">
                        <div class="produk-info">
                            <h4>{{ $m->nama_produk }}</h4>
                            <p class="produk-price">Rp {{ number_format($m->harga, 0, ',', '.') }}</p>
                            <div class="produk-actions">
                                <a href="{{ route('produk.edit', $m->id_produk) }}">✏️ Edit</a>
                                <form action="{{ route('produk.destroy', $m->id_produk) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')">🗑️ Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="produk-empty">Tidak ada produk minuman.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="produk-tambah-container">
        <a href="{{ route('produk.create') }}" class="tambah-btn">➕ Tambah Produk</a>
    </div>

@include('layouts.footer')
</body>
</html>
@endsection