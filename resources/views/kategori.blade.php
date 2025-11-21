<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Page</title>
    <link rel="stylesheet" href="{{ asset('css/promo.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left flex items-center space-x-4">
            <div class="logo-box flex items-center">
                <img class="logo-img" src="{{ asset('images/asset/logo.png') }}" alt="Logo"
                    class="logo w-10 h-10 object-contain">
            </div>
            <span class="promo" onclick="window.location.href='{{ route('promo') }}'">Promo</span>
        </div>
        <div class="navbar-right">
            <a href="{{ route('kategori') }}">Kategori</a>
            <a href="{{ route('login') }}" class="btn-login">Daftar/Masuk</a>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <p class="breadcrumb">Beranda / <span>Kategori</span></p>
        <h1>Kategori</h1>
        <h3>Semua Kategori</h3>

        <div class="promo-grid">
            <div class="promo-card">
                <img src="https://via.placeholder.com/200x120" alt="Promo 1">
                <p>Lorem Ipsum</p>
            </div>
            <div class="promo-card">
                <img src="https://via.placeholder.com/200x120" alt="Promo 2">
                <p>Lorem Ipsum</p>
            </div>
            <div class="promo-card">
                <img src="https://via.placeholder.com/200x120" alt="Promo 3">
                <p>Lorem Ipsum</p>
            </div>
            <div class="promo-card">
                <img src="https://via.placeholder.com/200x120" alt="Promo 4">
                <p>Lorem Ipsum</p>
            </div>
        </div>
    </div>
</body>

</html>