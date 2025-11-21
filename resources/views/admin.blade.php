<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Admin</title>
    <!-- Memuat Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Memuat font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan font Inter sebagai default */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen">
        <!-- Sidebar (Sidenav) -->
        <aside class="w-20 bg-blue-600 p-4 flex flex-col items-center space-y-10 shadow-lg">
            <!-- Logo -->
            <div class="w-12 h-12 bg-white flex items-center justify-center rounded-lg text-blue-600 font-bold text-xl tracking-tighter">
                ADR
            </div>

            <!-- Ikon Navigasi -->
            <nav class="flex flex-col space-y-8">
                <!-- Ikon Dokumen -->
                <a href="#" class="text-white p-2 rounded-lg hover:bg-blue-700">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </a>
                <!-- Ikon Bagan -->
                <a href="#" class="text-white p-2 rounded-lg hover:bg-blue-700">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                </a>
                <!-- Ikon Tambah -->
                <a href="#" class="text-white p-2 rounded-lg hover:bg-blue-700">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </a>
                <!-- Ikon Dolar -->
                <a href="#" class="text-white p-2 rounded-lg hover:bg-blue-700">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.105 0 2.008.895 2.008 2s-.903 2-2.008 2m0 8c-1.105 0-2.008-.895-2.008-2s.903-2 2.008-2m0 0v-8m0 8h.01M12 2a10 10 0 100 20 10 10 0 000-20z"></path>
                    </svg>
                </a>
            </nav>
        </aside>

        <!-- Konten Utama -->
        <main class="flex-1 p-10 overflow-y-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Hai, Admint</h1>

            <!-- Bagian Pesanan -->
            <section>
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-700">Pesanan</h2>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-700 transition duration-300">
                        Lihat Semua
                    </button>
                </div>

                <!-- Kontainer Tabel -->
                <div class="bg-white rounded-xl shadow-md border-2 border-black overflow-hidden">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b-2 border-black">
                                <th class="p-4 font-semibold text-blue-600">Tgl</th>
                                <th class="p-4 font-semibold text-blue-600">Nama</th>
                                <th class="p-4 font-semibold text-blue-600">Alamat</th>
                                <th class="p-4 font-semibold text-blue-600">Produk</th>
                                <th class="p-4 font-semibold text-blue-600">Metode Pembayaran</th>
                                <th class="p-4 font-semibold text-blue-600">Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris 1 -->
                            <tr class="border-b border-gray-200">
                                <td class="p-4">20/9</td>
                                <td class="p-4">Lorem Ipsum</td>
                                <td class="p-4">Lorem ipsum dolor sit amet...</td>
                                <td class="p-4">Lorem Ipsum</td>
                                <td class="p-4">
                                    <span class="border border-gray-400 rounded-md px-4 py-1.5 font-medium text-gray-700">
                                        QRIS
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex items-center space-x-2 text-gray-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l-1.586-1.586a2 2 0 00-2.828 0L6 14m6-6l.01.01"></path></svg>
                                        <span>Scree...</span>
                                    </div>
                                </td>
                            </tr>
                            <!-- Baris 2 -->
                            <tr class="bg-white">
                                <td class="p-4">20/9</td>
                                <td class="p-4">Lorem Ipsum</td>
                                <td class="p-4">Lorem ipsum dolor sit amet...</td>
                                <td class="p-4">Lorem Ipsum</td>
                                <td class="p-4">
                                    <span class="border border-gray-400 rounded-md px-4 py-1.5 font-medium text-gray-700">
                                        COD
                                    </span>
                                </td>
                                <td class="p-4 text-gray-700">Bayar di tempat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Bagian Analisis -->
            <section class="mt-10">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold text-gray-700">Analisis</h2>
                    <button class="bg-blue-600 text-white px-6 py-2 rounded-full font-medium hover:bg-blue-700 transition duration-300">
                        Lihat Semua
                    </button>
                </div>

                <!-- Kontainer Bagan -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-end mb-4">
                        <select class="border border-gray-300 rounded-md p-2">
                            <option>Weekly</option>
                            <option>Monthly</option>
                            <option>Yearly</option>
                        </select>
                    </div>

                    <!-- Mockup Bagan -->
                    <div class="flex">
                        <!-- Label Y-axis -->
                        <div class="flex flex-col justify-between h-64 pr-4 text-right text-sm text-gray-500">
                            <span>100</span>
                            <span>50</span>
                            <span>20</span>
                            <span class="text-white">0</span> <!-- Placeholder for alignment -->
                        </div>
                        <!-- Area Bagan -->
                        <div class="w-full h-64 border-l border-b border-gray-300 flex items-end space-x-2 px-2">
                            <!-- Data bar (tinggi diatur dengan h-[] Tailwind) -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 60%"></div> <!-- Senin -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 15%"></div> <!-- Selasa -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 20%"></div> <!-- Rabu -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 80%"></div> <!-- Kamis -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 45%"></div> <!-- Jumat -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 45%"></div> <!-- Sabtu -->
                            <div class="flex-1 bg-blue-500 rounded-t-md" style="height: 65%"></div> <!-- Minggu -->
                        </div>
                    </div>
                    <!-- Label X-axis -->
                    <div class="flex -ml-2">
                        <div class="w-20"></div> <!-- Spacer for Y-axis labels -->
                        <div class="w-full flex justify-between space-x-2 px-2 mt-2 text-sm text-gray-500">
                            <span class="flex-1 text-center">Senin</span>
                            <span class="flex-1 text-center">Selasa</span>
                            <span class="flex-1 text-center">Rabu</span>
                            <span class="flex-1 text-center">Kamis</span>
                            <span class="flex-1 text-center">Jumat</span>
                            <span class="flex-1 text-center">Sabtu</span>
                            <span class="flex-1 text-center">Minggu</span>
                        </div>
                    </div>

                </div>
            </section>
        </main>
    </div>

</body>
</html>