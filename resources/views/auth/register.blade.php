<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Cash Register</title>

    <!-- Import font modern dari Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        /* --- STYLE DASAR --- */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            /* Gradasi warna hijau lembut */
            background: linear-gradient(135deg, #10b981, #34d399);
            overflow: hidden;
        }

        /* --- CONTAINER UTAMA (membungkus dua sisi: kiri dan kanan) --- */
        .container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            width: 900px;
            max-width: 95%;
            animation: fadeIn 1s ease-in-out; /* animasi muncul */
        }

        /* --- BAGIAN KIRI (ilustrasi dan teks promosi) --- */
        .left {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
            flex: 1; /* Membagi ruang setengah */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            text-align: center;
        }

        .left img {
            width: 260px;
            margin-bottom: 20px;
            filter: drop-shadow(0 5px 10px rgba(0,0,0,0.2));
        }

        .left h1 {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .left p {
            font-size: 15px;
            opacity: 0.9;
        }

        /* --- BAGIAN KANAN (FORM REGISTER) --- */
        .right {
            flex: 1;
            padding: 50px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #1f2937;
            font-size: 26px;
            font-weight: 600;
        }

        /* --- INPUT FIELD (dengan ikon di kiri) --- */
        .input-group {
            position: relative;
            margin-bottom: 18px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px; /* Spasi kiri 40px untuk ikon */
            border-radius: 10px;
            border: 1px solid #d1d5db;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #10b981;
            box-shadow: 0 0 6px rgba(16,185,129,0.3);
        }

        /* --- Ikon di kiri input (menggunakan Font Awesome) --- */
        .input-group i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #9ca3af;
        }

        /* --- TOMBOL REGISTER --- */
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #10b981, #34d399);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #059669, #10b981);
        }

        /* --- PESAN ERROR DAN SUKSES --- */
        .error-list {
            background: #fee2e2;
            color: #b91c1c;
            border-left: 5px solid #ef4444;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }

        .success {
            color: #065f46;
            background: #d1fae5;
            border-left: 5px solid #10b981;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        /* --- LINK KE LOGIN --- */
        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        p a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* --- ANIMASI HALUS SAAT MUNCUL --- */
        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.95);}
            to {opacity: 1; transform: scale(1);}
        }

        /* --- RESPONSIF UNTUK HP --- */
        @media (max-width: 768px) {
            .container {
                flex-direction: column; /* ubah jadi vertikal */
            }

            .left {
                display: none; /* sembunyikan bagian kiri di HP */
            }

            .right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- BAGIAN KIRI: GAMBAR DAN TEKS PROMOSI -->
        <div class="left">
            <img src="https://cdn-icons-png.flaticon.com/512/1180/1180697.png" alt="Register Icon">
            <h1>Daftar Akun Baru</h1>
            <p>Mulailah kelola transaksi dan produkmu hari ini 📦</p>
        </div>

        <!-- BAGIAN KANAN: FORM REGISTER -->
        <div class="right">
            <h2>Register Akun</h2>

            {{-- Tampilkan error validasi jika ada --}}
            @if ($errors->any())
                <div class="error-list">
                    <ul style="margin:0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pesan sukses jika registrasi berhasil --}}
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif

            {{-- FORM REGISTER --}}
            <form action="{{ route('register.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="name" placeholder="Nama Lengkap" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Alamat Email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Kata Sandi" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password_confirmation" placeholder="Konfirmasi Kata Sandi" required>
                </div>

                <button type="submit">Daftar Sekarang</button>
            </form>

            {{-- Link ke halaman login --}}
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
        </div>
    </div>

    <!-- Font Awesome untuk ikon input -->
    <script src="https://kit.fontawesome.com/a2d9b6d66b.js" crossorigin="anonymous"></script>
</body>
</html>
