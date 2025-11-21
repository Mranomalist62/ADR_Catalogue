    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-left">
      <div class="logo-box"></div>
      <span class="promo">Promo</span>
    </div>
    <div class="nav-right">
      <button class="kategori"><i class="fa fa-th"></i> Kategori</button>
      <button class="auth-btn">Daftar/masuk</button>
    </div>
  </nav>

  <!-- Main Section -->
  <main>
    <div class="main-container">
    <h2 class="tagline">Tag Line</h2>
    
    <!-- Search -->
    <div class="search-box">
      <input type="text" placeholder="Cari">
    </div>

    <!-- Banner -->
    <div class="banner-container">
      <div class="banner"></div>
      <div class="banner"></div>
    </div>

    <!-- Category -->
    <div class="category-container">
      <button class="arrow">&lt;</button>
      <div class="categories">
        <button class="cat-btn">Lifestyle</button>
        <button class="cat-btn">Perabotan</button>
        <button class="cat-btn">Dapur</button>
        <button class="cat-btn">Kosmetik</button>
      </div>
      <button class="arrow">&gt;</button>
    </div>

    <!-- Rekomendasi -->
    <div class="recommend-section">
      <div class="recommend-header">
        <h3>Produk Rekomendasi</h3>
        <button class="lihat-semua">Lihat Semua</button>
      </div>
      <div class="product-list">
        <div class="product-card">Lorem Ipsum</div>
        <div class="product-card">Lorem Ipsum</div>
        <div class="product-card">Lorem Ipsum</div>
        <div class="product-card">Lorem Ipsum</div>
      </div>
    </div>
    </div>
  </main>
</body>
</html>
