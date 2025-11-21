<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommend Product Page</title>
    <link rel="stylesheet" href="{{ asset('css/rekomendasi.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-left flex items-center space-x-4">
            <div class="logo-box flex items-center">
                <img class="logo-img" src="{{ asset('images/asset/logo.png') }}" alt="Logo"
                    class="logo w-10 h-10 object-contain">
            </div>
            <span class="promo">Promo</span>
        </div>
        <div class="nav-right">
            <button class="kategori" onclick="window.location.href='{{ route('kategori') }}'">
                <i class="fas fa-th"></i> Kategori
            </button>
            <button class="auth-btn" onclick="window.location.href='{{ route('login') }}'">Daftar/Masuk</button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="content">
        <p class="breadcrumb">Beranda / <span>Produk</span></p>
        <h2 class="page-title">Produk</h2>

        <!-- Tabs -->
        <div class="tab-container">
            <button class="tab active">Rekomendasi</button>
            <button class="tab">Terbaru</button>
        </div>

        <!-- Product Grid -->
        <div class="product-grid">
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 1</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 2</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 3</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 4</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 5</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 6</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 7</p>
            </div>
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="">
                <p>Produk 8</p>
            </div>
        </div>
    </main>

    <script>
        // Auth button handler
        document.querySelector('.auth-btn').addEventListener('click', function () {
            window.location.href = '{{ route('login') }}';
        });

        // Kategori button handler (alternative to onclick)
        document.querySelector('.kategori').addEventListener('click', function () {
            window.location.href = '{{ route('kategori') }}';
        });
    </script>
</body>

</html>