<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{{ asset('css/product.css') }}">
<title>Detail Produk</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
<!-- NAVBAR (simple, versi login dengan profile name & icon) -->
<nav class="topbar">
<div class="container topbar-inner">
<div class="brand">
<img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
<span class="promo">Promo</span>
</div>


<div class="nav-right">
<button class="kategori">Kategori</button>


<!-- Profile (login) -->
<div class="profile">
<img src="/mnt/data/0a96c114-e4be-4b81-8524-867a2697cf3d.png" alt="profile" class="profile-icon">
<span class="profile-name">Sahroni</span>
</div>
</div>
</div>
</nav>


<main>
<div class="container">


<!-- Breadcrumb -->
<div class="breadcrumb">Beranda / Kategori / Perabotan / <span>Item</span></div>


<!-- Detail Wrapper -->
<section class="detail">
<div class="left">
<div class="product-image">
<!-- menggunakan file image lokal (direktori temp) -->
<img src="/mnt/data/0a96c114-e4be-4b81-8524-867a2697cf3d.png" alt="Produk">
</div>
<p class="caption">Lorem Ipsum</p>
</div>


<div class="center">
<h1 class="title">Lorem Ipsum Dolor Amet</h1>
<div class="price">Rp3.000.000 <span class="per">/hari</span></div>


<h3>Deskripsi</h3>
<p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
</div>


<aside class="right">
<div class="card">
<h4>Atur Jumlah</h4>
<div class="counter">
<button class="dec">-</button>
<input type="number" value="1" min="1" class="qty">
<button class="inc">+</button>
</div>
<small>Stok Total: Sisa 99</small>


<div class="subtotal">
<span>Subtotal</span>
<strong class="subtotal-amount">Rp3.000.000</strong>
</div>
</html>