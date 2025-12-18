<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Promo - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #2d3748 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .nav-item {
            transition: all 0.3s ease;
        }
        .nav-item:hover {
            transform: translateX(4px);
        }
        .promo-card {
            transition: all 0.3s ease;
        }
        .promo-card:hover {
            transform: translateY(-2px) scale(1.02);
        }
        .drag-over {
            background-color: #f0f9ff;
            border-color: #3b82f6;
        }
        .loading-spinner {
            border: 3px solid #f3f4f6;
            border-top: 3px solid #3b82f6;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-64 sidebar-gradient text-white flex flex-col">
            <!-- Logo Section -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center">
                    <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Logo" class="w-10 h-10 object-contain mr-3">
                    <div>
                        <h1 class="text-xl font-bold">ADR Catalogue</h1>
                        <p class="text-xs text-gray-400">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-home w-5 h-5 mr-3"></i>
                    <span>Dashboard</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.orders') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/orders') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-shopping-bag w-5 h-5 mr-3"></i>
                    <span>Pesanan</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.billing') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/billing') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-file-invoice-dollar w-5 h-5 mr-3"></i>
                    <span>Tagihan</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.products') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/products') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-box w-5 h-5 mr-3"></i>
                    <span>Produk</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.promo') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/promo') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-tags w-5 h-5 mr-3"></i>
                    <span>Kelola Promo</span>
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('admin.chat') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/chat') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-comments w-5 h-5 mr-3"></i>
                    <span>Chat</span>
                    @if($unreadCount > 0)
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">{{ $unreadCount }}</span>
                    @endif
                    <div class="absolute inset-y-0 left-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </nav>

            <!-- User Section -->
            <div class="p-4 border-t border-gray-700">
                <a href="#" class="nav-item group relative flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                    <i class="fas fa-user w-5 h-5 mr-3"></i>
                    <span class="flex-1 truncate">{{ $admin->nama ?? 'Admin User' }}</span>
                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100"></div>
                </a>
            </div>

            <!-- Logout Button -->
            <div class="p-4 border-t border-gray-700">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-item group relative w-full flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span>Logout</span>
                        <div class="absolute left-0 top-0 bottom-0 w-1 bg-white rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 transform scale-y-0 group-hover:scale-y-100"></div>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Top Header -->
            <div class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-800">Kelola Promo</h2>
                        <p class="text-sm text-gray-600">Tambah dan kelola promo untuk produk</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button onclick="openAddModal()" class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Promo
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6">
                <!-- Loading State -->
                <div id="loadingState" class="flex justify-center items-center py-12">
                    <div class="loading-spinner"></div>
                </div>

                <!-- Promo Grid -->
                <div id="promoGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 hidden">
                    <!-- Promo cards will be inserted here -->
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="text-center py-12 hidden">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 rounded-full mb-4">
                        <i class="fas fa-tags text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada promo</h3>
                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan promo pertama</p>
                    <button onclick="openAddModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Promo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Promo Modal -->
    <div id="promoModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900" id="modalTitle">Tambah Promo Baru</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="promoForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="promoId" name="id">
                    
                    <!-- Nama Promo -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Promo</label>
                        <input type="text" id="nama" name="nama" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Contoh: Diskon Akhir Tahun">
                    </div>

                    <!-- Potongan Harga -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Potongan Harga (%)</label>
                        <input type="number" id="potongan_harga" name="potongan_harga" required
                               min="0" max="100"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="0-100">
                    </div>

                    <!-- Produk -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                        <select id="product_id" name="product_id"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Semua Produk</option>
                        </select>
                    </div>

                    <!-- Thumbnail Upload -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Thumbnail</label>
                        <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-blue-500 transition-colors">
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="hidden">
                            <div id="uploadPlaceholder">
                                <i class="fas fa-cloud-upload-alt text-gray-400 text-3xl mb-2"></i>
                                <p class="text-sm text-gray-600">Drag & drop gambar atau klik untuk memilih</p>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF hingga 2MB</p>
                            </div>
                            <div id="imagePreview" class="hidden">
                                <img id="previewImg" src="" alt="Preview" class="mx-auto max-h-32 rounded">
                                <p class="text-sm text-gray-600 mt-2">Klik untuk mengganti gambar</p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" onclick="closeModal()" 
                                class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium transition-colors">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-colors">
                            <span id="submitButtonText">Simpan</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span id="toastMessage">Success!</span>
        </div>
    </div>

    <script>
        let currentEditId = null;
        let allProducts = [];

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            loadPromos();
            loadProducts();
            setupDragAndDrop();
        });

        // Load promos
        async function loadPromos() {
            try {
                showLoading();
                const response = await fetch('/public/promo');
                const data = await response.json();
                
                if (data.success) {
                    renderPromos(data.data);
                } else {
                    showError('Gagal memuat promo');
                }
            } catch (error) {
                showError('Terjadi kesalahan saat memuat promo');
                console.error('Error loading promos:', error);
            } finally {
                hideLoading();
            }
        }

        // Load products for dropdown
        async function loadProducts() {
            try {
                const response = await fetch('/public/products');
                const data = await response.json();
                
                if (data.success) {
                    allProducts = data.data;
                    populateProductDropdown();
                }
            } catch (error) {
                console.error('Error loading products:', error);
            }
        }

        // Populate product dropdown
        function populateProductDropdown() {
            const select = document.getElementById('product_id');
            select.innerHTML = '<option value="">Semua Produk</option>';
            
            allProducts.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id;
                option.textContent = product.nama;
                select.appendChild(option);
            });
        }

        // Render promo cards
        function renderPromos(promos) {
            const grid = document.getElementById('promoGrid');
            const emptyState = document.getElementById('emptyState');
            
            if (promos.length === 0) {
                grid.classList.add('hidden');
                emptyState.classList.remove('hidden');
                return;
            }
            
            grid.classList.remove('hidden');
            emptyState.classList.add('hidden');
            
            grid.innerHTML = promos.map(promo => `
                <div class="promo-card bg-white rounded-xl shadow-lg overflow-hidden slide-in">
                    <div class="relative">
                        ${promo.path_thumbnail ? 
                            `<img src="/storage/${promo.path_thumbnail}" alt="${promo.nama}" class="w-full h-48 object-cover">` :
                            `<div class="w-full h-48 bg-gradient-to-br from-blue-100 to-blue-300 flex items-center justify-center">
                                <i class="fas fa-tags text-white text-4xl"></i>
                            </div>`
                        }
                        <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                            ${promo.potongan_harga}% OFF
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">${promo.nama}</h3>
                        ${promo.product ? 
                            `<p class="text-sm text-gray-600 mb-3">Produk: ${promo.product.nama}</p>` :
                            `<p class="text-sm text-gray-600 mb-3">Berlaku untuk semua produk</p>`
                        }
                        <div class="flex justify-between">
                            <button onclick="editPromo(${promo.id})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </button>
                            <button onclick="deletePromo(${promo.id})" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                <i class="fas fa-trash mr-1"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Open add modal
        function openAddModal() {
            currentEditId = null;
            document.getElementById('modalTitle').textContent = 'Tambah Promo Baru';
            document.getElementById('submitButtonText').textContent = 'Simpan';
            document.getElementById('promoForm').reset();
            resetImageUpload();
            document.getElementById('promoModal').classList.remove('hidden');
        }

        // Edit promo
        async function editPromo(id) {
            try {
                const response = await fetch(`/public/promo/${id}`);
                const data = await response.json();
                
                if (data.success) {
                    currentEditId = id;
                    const promo = data.data;
                    
                    document.getElementById('modalTitle').textContent = 'Edit Promo';
                    document.getElementById('submitButtonText').textContent = 'Update';
                    document.getElementById('nama').value = promo.nama;
                    document.getElementById('potongan_harga').value = promo.potongan_harga;
                    document.getElementById('product_id').value = promo.product_id || '';
                    
                    if (promo.path_thumbnail) {
                        showImagePreview(`/storage/${promo.path_thumbnail}`);
                    }
                    
                    document.getElementById('promoModal').classList.remove('hidden');
                } else {
                    showError('Gagal memuat data promo');
                }
            } catch (error) {
                showError('Terjadi kesalahan saat memuat data promo');
                console.error('Error editing promo:', error);
            }
        }

        // Delete promo
        async function deletePromo(id) {
            if (!confirm('Apakah Anda yakin ingin menghapus promo ini?')) {
                return;
            }
            
            try {
                const response = await fetch(`/admin/api/promo/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast('Promo berhasil dihapus');
                    loadPromos();
                } else {
                    showError('Gagal menghapus promo');
                }
            } catch (error) {
                showError('Terjadi kesalahan saat menghapus promo');
                console.error('Error deleting promo:', error);
            }
        }

        // Close modal
        function closeModal() {
            document.getElementById('promoModal').classList.add('hidden');
            document.getElementById('promoForm').reset();
            resetImageUpload();
            currentEditId = null;
        }

        // Setup drag and drop
        function setupDragAndDrop() {
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('thumbnail');
            
            dropZone.addEventListener('click', () => fileInput.click());
            
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('drag-over');
            });
            
            dropZone.addEventListener('dragleave', () => {
                dropZone.classList.remove('drag-over');
            });
            
            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drag-over');
                
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    handleFileSelect(files[0]);
                }
            });
            
            fileInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    handleFileSelect(e.target.files[0]);
                }
            });
        }

        // Handle file selection
        function handleFileSelect(file) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    showImagePreview(e.target.result);
                };
                reader.readAsDataURL(file);
            } else {
                showError('File harus berupa gambar');
            }
        }

        // Show image preview
        function showImagePreview(src) {
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('imagePreview').classList.remove('hidden');
            document.getElementById('previewImg').src = src;
        }

        // Reset image upload
        function resetImageUpload() {
            document.getElementById('uploadPlaceholder').classList.remove('hidden');
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('thumbnail').value = '';
        }

        // Form submission
        document.getElementById('promoForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Menyimpan...';
            submitBtn.disabled = true;
            
            try {
                const url = currentEditId ? `/admin/api/promo/${currentEditId}` : '/admin/api/promo';
                const method = currentEditId ? 'PUT' : 'POST';
                
                // For PUT method, we need to use POST with _method parameter
                const formMethod = method === 'PUT' ? 'POST' : method;
                if (method === 'PUT') {
                    formData.append('_method', 'PUT');
                }
                
                const response = await fetch(url, {
                    method: formMethod,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    showToast(currentEditId ? 'Promo berhasil diperbarui' : 'Promo berhasil ditambahkan');
                    closeModal();
                    loadPromos();
                } else {
                    showError(data.message || 'Gagal menyimpan promo');
                }
            } catch (error) {
                showError('Terjadi kesalahan saat menyimpan promo');
                console.error('Error saving promo:', error);
            } finally {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });

        // Utility functions
        function showLoading() {
            document.getElementById('loadingState').classList.remove('hidden');
            document.getElementById('promoGrid').classList.add('hidden');
            document.getElementById('emptyState').classList.add('hidden');
        }

        function hideLoading() {
            document.getElementById('loadingState').classList.add('hidden');
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-y-full');
            
            setTimeout(() => {
                toast.classList.add('translate-y-full');
            }, 3000);
        }

        function showError(message) {
            const toast = document.getElementById('toast');
            toast.classList.remove('bg-green-500');
            toast.classList.add('bg-red-500');
            document.getElementById('toastMessage').textContent = message;
            toast.classList.remove('translate-y-full');
            
            setTimeout(() => {
                toast.classList.add('translate-y-full');
                toast.classList.remove('bg-red-500');
                toast.classList.add('bg-green-500');
            }, 3000);
        }
    </script>
</body>
</html>