<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="container">
        <div class="logo-box">
            <img src="{{ asset('images/asset/logo.png') }}" alt="Logo">
        </div>

        <div class="form-box">
            <h2>Yuk, buat akun kamu dulu...</h2>
            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <!-- Change 'name' to 'nama' to match your User model -->
                <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>
                @error('nama')
                    <span class="error">{{ $message }}</span>
                @enderror

                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <!-- Phone field - optional since your User model doesn't have it yet -->
                <input type="text" name="nomor_handphone" placeholder="No. Handphone"
                    value="{{ old('nomor_handphone') }}">

                <input type="password" name="password" placeholder="Password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                <!-- Add password confirmation -->
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

                <button type="submit" class="btn-daftar">Daftar</button>
            </form>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <p class="login-text">
                sudah punya akun? <a href="{{ route('login') }}">Yuk, masuk</a>
            </p>
        </div>

        <a href="{{ url('/') }}" class="btn-kembali">Kembali</a>
    </div>
</body>

</html>