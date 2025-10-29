<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cash Register</title>

    <style>
        /* --- Style Dasar --- */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #6366f1, #dbdbdbff);
            overflow: hidden;
        }

        .container {
            display: flex;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            overflow: hidden;
            width: 900px;
            max-width: 95%;
            animation: fadeIn 1s ease-in-out;
        }

        /* --- Bagian Kiri (Gambar / Ilustrasi) --- */
        .left {
            background: linear-gradient(135deg, #dbdbdbff, #6366f1);
            color: white;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            text-align: center;
        }

        .left img {
            width: 250px;
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

        /* --- Bagian Kanan (Form Login) --- */
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

        .input-group {
            position: relative;
            margin-bottom: 20px;
            width: 300px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border-radius: 10px;
            border: 1px solid #d1d5db;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 6px rgba(99,102,241,0.3);
        }

        .input-group i {
            position: absolute;
            top: 12px;
            left: 12px;
            color: #9ca3af;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #4f46e5, #6366f1);
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
            background: linear-gradient(135deg, #4338ca, #4f46e5);
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            border-left: 5px solid #ef4444;
            font-size: 14px;
        }

        p {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        p a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
        }

        p a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.95);}
            to {opacity: 1; transform: scale(1);}
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .left {
                display: none;
            }

            .right {
                padding: 40px 30px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Bagian Kiri -->
        <div class="left">
            <img src="https://cdn-icons-png.flaticon.com/512/679/679922.png" alt="Cash   Icon">
            <h1>Selamat Datang</h1>
            <p>Kelola transaksi dan stok produk Anda dengan mudah 💰</p>
        </div>

        <!-- Bagian Kanan -->
        <div class="right">
            <h2>Login Akun</h2>

            @if(session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif

            <form action="{{ route('login.post') }}" method="POST">
                @csrf
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Masukkan Email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>

                <button type="submit">Masuk Sekarang</button>
            </form>
            <p>
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            </p>
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
        </div>
    </div>

</body>
</html>
