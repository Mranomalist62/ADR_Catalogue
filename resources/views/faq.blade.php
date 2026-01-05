<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/faq.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                <i class="fas fa-home mr-1"></i> Beranda
                            </a>
                            <a href="{{ route('promo') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                <i class="fas fa-tags mr-1"></i> Promo
                            </a>
                            <a href="{{ route('kategori') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                <i class="fas fa-th-large mr-1"></i> Kategori
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('rekomendasi') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-star mr-1"></i> Rekomendasi
                    </a>
                    <a href="{{ route('checkout') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-shopping-cart mr-1"></i> Keranjang
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-building mr-1"></i> Profil
                    </a>
                    <a href="{{ route('login') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-user mr-1"></i> Masuk/Daftar
                    </a>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button onclick="toggleMobileMenu()" class="text-gray-700 hover:text-indigo-600 p-2">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Mobile menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 block px-3 py-2 rounded-md text-base font-medium">Beranda</a>
                <a href="{{ route('checkout') }}" class="text-gray-700 hover:text-indigo-600 block px-3 py-2 rounded-md text-base font-medium">
                    <i class="fas fa-shopping-cart mr-1"></i> Keranjang
                </a>
                <a href="{{ route('profile') }}" class="text-gray-700 hover:text-indigo-600 block px-3 py-2 rounded-md text-base font-medium">
                    <i class="fas fa-building mr-1"></i> Profil
                </a>
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600 block px-3 py-2 rounded-md text-base font-medium">
                    <i class="fas fa-user mr-1"></i> Masuk
                </a>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="faq-gradient text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Frequently Asked Questions</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Temukan jawaban untuk pertanyaan yang sering diajukan
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search FAQ -->
            <div class="mb-8">
                <div class="relative max-w-2xl mx-auto">
                    <input type="text" 
                           id="faqSearch"
                           placeholder="Cari pertanyaan..." 
                           class="w-full px-6 py-4 pr-12 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- FAQ Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- General Questions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-question-circle text-blue-600 mr-3"></i>
                        Pertanyaan Umum
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Apa itu ADR Catalogue?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    ADR Catalogue adalah platform e-commerce terpercaya yang menyediakan berbagai produk berkualitas dengan harga terjangkau. Kami menawarkan katalog lengkap dari berbagai kategori untuk memenuhi kebutuhan belanja sehari-hari Anda.
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Bagaimana cara mendaftar?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Klik tombol "Masuk/Daftar" di bagian atas halaman, lalu pilih "Daftar". Isi formulir pendaftaran dengan data yang lengkap dan valid. Setelah itu, Anda akan menerima email konfirmasi untuk mengaktifkan akun Anda.
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Apakah ada biaya pendaftaran?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Tidak, pendaftaran di ADR Catalogue sepenuhnya gratis. Anda tidak perlu membayar biaya apapun untuk membuat akun dan mulai berbelanja.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Questions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-credit-card text-green-600 mr-3"></i>
                        Pembayaran
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Metode pembayaran apa saja yang tersedia?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Kami menerima berbagai metode pembayaran: Transfer Bank (BCA, Mandiri, BNI, BRI), E-Wallet (GoPay, OVO, Dana, ShopeePay), Kartu Kredit/Debit (Visa, Mastercard), dan COD (Cash on Delivery) untuk beberapa area.
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Apakah pembayaran aman?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Ya, semua transaksi pembayaran di ADR Catalogue dilindungi dengan enkripsi SSL dan sistem keamanan berlapis. Kami juga bekerja sama dengan payment gateway terpercaya untuk memastikan keamanan data pribadi dan finansial Anda.
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Bagaimana cara konfirmasi pembayaran?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Setelah melakukan pembayaran, sistem akan otomatis memverifikasi dan mengirim konfirmasi melalui email dan notifikasi di akun Anda. Proses verifikasi biasanya memakan waktu 1-5 menit tergantung metode pembayaran yang digunakan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping Questions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-truck text-purple-600 mr-3"></i>
                        Pengiriman
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Berapa lama pengiriman?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Waktu pengiriman bervariasi: Jabodetabek (1-3 hari), Jawa (2-4 hari), Sumatera (3-5 hari), Kalimantan & Sulawesi (4-6 hari), Bali & Nusa Tenggara (3-5 hari), Papua & Maluku (5-7 hari).
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Berapa biaya pengiriman?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Biaya pengiriman dihitung berdasarkan berat produk dan jarak pengiriman. Estimasi biaya akan ditampilkan saat Anda melihat detail produk. Kami juga sering menawarkan gratis ongkir untuk minimum pembelian tertentu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Return Questions -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <i class="fas fa-undo text-orange-600 mr-3"></i>
                        Pengembalian
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Bagaimana cara mengembalikan produk?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Hubungi customer service kami melalui email atau live chat dalam 7 hari setelah penerimaan produk. Sertakan foto produk dan alasan pengembalian. Jika disetujui, kami akan memberikan instruksi pengembalian dan proses refund.
                                </p>
                            </div>
                        </div>

                        <div class="border-b border-gray-200 pb-4">
                            <button onclick="toggleAccordion(this)" class="w-full text-left flex justify-between items-center py-2">
                                <span class="font-medium text-gray-800">Kapan refund diproses?</span>
                                <i class="fas fa-chevron-down rotate-icon text-gray-500"></i>
                            </button>
                            <div class="accordion-content">
                                <p class="text-gray-600 pt-3">
                                    Refund akan diproses dalam 3-5 hari kerja setelah kami menerima produk yang dikembalikan. Dana akan dikembalikan ke metode pembayaran yang sama dengan saat pembelian.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="text-center bg-blue-50 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Masih butuh bantuan?</h2>
                <p class="text-gray-600 mb-6">Tim customer service kami siap membantu Anda</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@adrcatalogue.com" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Email Support
                    </a>
                    <a href="tel:+62212345678" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-phone mr-2"></i> Call Center
                    </a>
                    <a href="#" onclick="openLiveChat()" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                        <i class="fas fa-comments mr-2"></i> Live Chat
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-800 via-blue-900 to-indigo-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <img class="h-8 w-auto mr-2" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                        <span class="text-xl font-bold">ADR Catalogue</span>
                    </div>
                    <p class="text-blue-200">Temukan produk terbaik dengan harga terjangkau</p>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Menu</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-blue-200 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="{{ route('promo') }}" class="text-blue-200 hover:text-white transition-colors">Promo</a></li>
                        <li><a href="{{ route('kategori') }}" class="text-blue-200 hover:text-white transition-colors">Kategori</a></li>
                        <li><a href="{{ route('rekomendasi') }}" class="text-blue-200 hover:text-white transition-colors">Rekomendasi</a></li>
                        <li><a href="{{ route('checkout') }}" class="text-blue-200 hover:text-white transition-colors">Keranjang</a></li>
                        <li><a href="{{ route('profile') }}" class="text-blue-200 hover:text-white transition-colors">Profil</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('faq') }}" class="text-blue-200 hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="{{ route('pengiriman') }}" class="text-blue-200 hover:text-white transition-colors">Pengiriman</a></li>
                        <li><a href="{{ route('pengembalian') }}" class="text-blue-200 hover:text-white transition-colors">Pengembalian</a></li>
                        <li><a href="{{ route('kontak') }}" class="text-blue-200 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-blue-200 hover:text-white transition-colors">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-blue-700 mt-8 pt-8 text-center text-blue-200">
                <p>&copy; 2024 ADR Catalogue. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        function toggleAccordion(button) {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.rotate-icon');
            
            // Close all other accordions
            document.querySelectorAll('.accordion-content').forEach(item => {
                if (item !== content) {
                    item.classList.remove('active');
                }
            });
            
            document.querySelectorAll('.rotate-icon').forEach(item => {
                if (item !== icon) {
                    item.classList.remove('active');
                }
            });
            
            // Toggle current accordion
            content.classList.toggle('active');
            icon.classList.toggle('active');
        }
        
        // Search functionality
        document.getElementById('faqSearch').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const faqItems = document.querySelectorAll('.space-y-4 > div');
            
            faqItems.forEach(item => {
                const question = item.querySelector('button span').textContent.toLowerCase();
                const answer = item.querySelector('.accordion-content p').textContent.toLowerCase();
                
                if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
        
        function openLiveChat() {
            // Implement live chat functionality
            alert('Live chat akan segera tersedia. Silakan hubungi customer service melalui email atau telepon.');
        }
    </script>
    
    <!-- Chat Bot -->
    @include('components.chat_bot')
    
</body>
</html>