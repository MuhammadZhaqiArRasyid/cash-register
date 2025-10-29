@extends('layouts.header')
@section('title', 'Edit Produk')

@section('content')
<style>
    /* ================================================
       EDIT PRODUK PAGE — Clean & Modern
       ================================================ */

    body.edit-produk-page {
        font-family: "Poppins", Arial, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        margin: 0;
        min-height: 100vh;
    }

    .edit-produk-container {
        max-width: 550px;
        margin: 3rem auto;
        background: #ffffff;
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .edit-produk-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #8b5cf6;
    }

    .edit-produk-header h2 {
        font-size: 1.8rem;
        color: #1e293b;
        margin: 0;
        font-weight: 700;
    }

    .edit-produk-header p {
        color: #64748b;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .edit-produk-form {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: "Poppins", Arial, sans-serif;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #8b5cf6;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }

    .form-group input[type="file"] {
        padding: 0.6rem;
        background: #ffffff;
        cursor: pointer;
    }

    .current-image {
        margin-top: 0.75rem;
        padding: 1rem;
        background: #f8fafc;
        border-radius: 12px;
        text-align: center;
    }

    .current-image p {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 0.75rem;
    }

    .current-image img {
        max-width: 180px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .form-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, #8b5cf6 0%, #a78bfa 100%);
        color: white;
        border: none;
        padding: 0.9rem 1.5rem;
        border-radius: 12px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        color: #64748b;
        font-weight: 500;
        padding: 0.75rem;
        border-radius: 12px;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    /* Responsif */
    @media (max-width: 600px) {
        .edit-produk-container {
            margin: 2rem 1rem;
            padding: 1.5rem;
        }

        .edit-produk-header h2 {
            font-size: 1.5rem;
        }

        .form-group input,
        .form-group select {
            font-size: 0.9rem;
        }

        .current-image img {
            max-width: 150px;
        }
    }
</style>

<body class="edit-produk-page">
    <div class="edit-produk-container">
        <div class="edit-produk-header">
            <h2>✏️ Edit Produk</h2>
            <p>Perbarui informasi produk Anda</p>
        </div>

        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data" class="edit-produk-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_produk">📦 Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" value="{{ $produk->nama_produk }}" required placeholder="Masukkan nama produk">
            </div>

            <div class="form-group">
                <label for="kategori">🏷️ Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="makanan" {{ $produk->kategori == 'makanan' ? 'selected' : '' }}>🍔 Makanan</option>
                    <option value="minuman" {{ $produk->kategori == 'minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">💰 Harga</label>
                <input type="number" name="harga" id="harga" value="{{ $produk->harga }}" required placeholder="Masukkan harga">
            </div>

            <div class="form-group">
                <label for="pajak">📊 Pajak (%)</label>
                <input type="number" name="pajak" id="pajak" step="0.01" value="{{ $produk->pajak }}" placeholder="Masukkan persentase pajak">
            </div>

            <div class="form-group">
                <label for="gambar">📷 Gambar Produk</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">

                @if($produk->gambar)
                    <div class="current-image">
                        <p>Gambar saat ini:</p>
                        <img src="{{ asset('uploads/produk/'.$produk->gambar) }}" alt="{{ $produk->nama_produk }}">
                    </div>
                @endif
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Update Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn-back">
                    ⬅ Kembali ke Daftar Produk
                </a>
            </div>
        </form>
    </div>
</body>
@endsection