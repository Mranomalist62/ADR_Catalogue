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
      <img src="{{ asset('images/logo.png') }}" alt="Logo">
    </div>

    <div class="form-box">
      <h2>Yuk, buat akun kamu dulu...</h2>
      <form action="{{ route('register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" placeholder="No. Handphone" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" class="btn-daftar">Daftar</button>
      </form>

      <p class="login-text">
        sudah punya akun? <a href="{{ route('login') }}">Yuk, masuk</a>
      </p>
    </div>

    <a href="{{ url('/') }}" class="btn-kembali">Kembali</a>
  </div>
</body>
</html>
