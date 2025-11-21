<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo-box">
            <img src="{{ asset('images/asset/logo.png') }}" alt="Logo">
        </div>

        <div class="form-box">
            <h2>Hai, senang ketemu lagi!</h2>
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <input type="text" name="nomor_handphone" placeholder="No. Handphone" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit" class="btn-daftar">Masuk</button>
            </form>

            <p class="login-text">
                belum punya akun? <a href="{{ route('register') }}">Yuk, daftar</a>
            </p>
        </div>

        <a href="{{ url('/') }}" class="btn-kembali">Kembali</a>
    </div>
</body>

</html>