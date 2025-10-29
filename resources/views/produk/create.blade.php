@extends('layouts.header')
@section('title', 'Tambah Produk')

@section('content')
<style>
    /* ================================================
       TAMBAH PRODUK PAGE — Clean & Modern
       ================================================ */

    body.tambah-produk-page {
        font-family: "Poppins", Arial, sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        margin: 0;
        min-height: 100vh;
    }

    .tambah-produk-container {
        max-width: 550px;
        margin: 3rem auto;
        background: #ffffff;
        padding: 2rem;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .tambah-produk-header {
        text-align: center;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #8b5cf6;
    }

    .tambah-produk-header h2 {
        font-size: 1.8rem;
        color: #1e293b;
        margin: 0;
        font-weight: 700;
    }

    .tambah-produk-header p {
        color: #64748b;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    .tambah-produk-form {
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

    .form-group input::placeholder {
        color: #94a3b8;
    }

    .form-group select {
        cursor: pointer;
    }

    .form-group input[type="file"] {
        padding: 0.6rem;
        background: #ffffff;
        cursor: pointer;
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
        .tambah-produk-container {
            margin: 2rem 1rem;
            padding: 1.5rem;
        }

        .tambah-produk-header h2 {
            font-size: 1.5rem;
        }

        .form-group input,
        .form-group select {
            font-size: 0.9rem;
        }
    }
</style>

<body class="tambah-produk-page">
    <div class="tambah-produk-container">
        <div class="tambah-produk-header">
            <h2>➕ Tambah Produk</h2>
            <p>Tambahkan produk baru ke dalam sistem</p>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="tambah-produk-form">
            @csrf

            <div class="form-group">
                <label for="nama_produk">📦 Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" placeholder="Contoh: Nasi Goreng" required>
            </div>

            <div class="form-group">
                <label for="kategori">🏷️ Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="makanan">🍔 Makanan</option>
                    <option value="minuman">🥤 Minuman</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">💰 Harga</label>
                <input type="number" name="harga" id="harga" placeholder="Contoh: 15000" required>
            </div>

            <div class="form-group">
                <label for="pajak">📊 Pajak (%)</label>
                <input type="number" name="pajak" id="pajak" step="0.01" placeholder="Contoh: 10">
            </div>

            <div class="form-group">
                <label for="gambar">📷 Gambar Produk</label>
                <input type="file" name="gambar" id="gambar" accept="image/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Simpan Produk
                </button>
                <a href="{{ route('produk.index') }}" class="btn-back">
                    ⬅ Kembali ke Daftar Produk
                </a>
            </div>
        </form>
    </div>
</body>
@endsection