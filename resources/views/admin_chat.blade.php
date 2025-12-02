<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat - ADR Catalogue</title>
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
        .status-badge {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .chat-container {
            height: calc(100vh - 240px);
            max-height: 700px;
        }
        .messages-container {
            height: calc(100% - 80px);
            overflow-y: auto;
        }
        .user-list {
            height: calc(100vh - 240px);
            max-height: 700px;
            overflow-y: auto;
        }
        .message {
            animation: fadeIn 0.3s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .typing-indicator {
            display: flex;
            align-items: center;
            padding: 15px;
        }
        .typing-dots {
            display: flex;
            gap: 4px;
            margin-right: 10px;
        }
        .typing-dots span {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #9ca3af;
            animation: typing 1.4s infinite;
        }
        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-10px);
            }
        }
        .scrollbar-custom::-webkit-scrollbar {
            width: 6px;
        }
        .scrollbar-custom::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .scrollbar-custom::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
        .user-item {
            transition: all 0.2s ease;
        }
        .user-item:hover {
            background-color: #f3f4f6;
        }
        .user-item.active {
            background-color: #e0e7ff;
            border-left: 4px solid #6366f1;
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
                
                <a href="{{ route('admin.statistics') }}" class="nav-item group flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->is('admin/statistics') ? 'bg-white/20 text-white' : 'text-gray-300 hover:text-white hover:bg-white/10' }} transition-all duration-300">
                    <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                    <span>Statistik</span>
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
                        <h1 class="text-2xl font-semibold text-gray-800">Admin Chat</h1>
                        <p class="text-sm text-gray-600">Kelola percakapan dengan pelanggan</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-bell"></i>
                            <span class="absolute top-0 right-0 h-2 w-2 bg-red-500 rounded-full"></span>
                        </button>
                        <button class="p-2 text-gray-600 hover:text-gray-800 transition-colors">
                            <i class="fas fa-cog"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Content -->
            <div class="p-6">
                <!-- Chat Section -->
                <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.1s">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                <!-- User List -->
                <div class="md:col-span-1 border-r border-gray-200">
                    <div class="bg-gray-50 p-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Daftar Pengguna</h3>
                        <p class="text-sm text-gray-600">{{ $users->count() }} pengguna aktif</p>
                    </div>
                    <div class="user-list scrollbar-custom">
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <div class="user-item p-4 border-b border-gray-200 cursor-pointer" 
                                     onclick="loadUserChat({{ $user->id }}, '{{ $user->name }}')"
                                     data-user-id="{{ $user->id }}">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center text-white font-semibold mr-3">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-medium text-gray-900">{{ $user->name }}</h4>
                                                @if($user->chats_count > 0)
                                                    <span class="bg-red-500 text-white text-xs rounded-full px-2 py-1">
                                                        {{ $user->chats_count }}
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-gray-500 truncate">
                                                @if($user->chats->count() > 0)
                                                    {{ $user->chats->first()->message }}
                                                @else
                                                    Belum ada pesan
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="p-8 text-center">
                                <i class="fas fa-comments text-gray-400 text-4xl mb-4"></i>
                                <p class="text-gray-500">Belum ada pesan dari pengguna</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Chat Area -->
                <div class="md:col-span-2">
                    <div id="chatArea" class="chat-container flex flex-col">
                        <!-- Chat Header -->
                        <div id="chatHeader" class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-indigo-500"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold">Pilih Pengguna</h2>
                                        <p class="text-sm opacity-75">Klik pada daftar pengguna untuk memulai chat</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Chat Messages -->
                        <div id="messagesContainer" class="messages-container scrollbar-custom p-4 space-y-4">
                            <div class="flex justify-center items-center h-full">
                                <div class="text-center">
                                    <i class="fas fa-comments text-gray-400 text-6xl mb-4"></i>
                                    <p class="text-gray-500 text-lg">Pilih pengguna dari daftar untuk memulai percakapan</p>
                                </div>
                            </div>
                        </div>

                        <!-- Typing Indicator -->
                        <div class="typing-indicator hidden" id="typingIndicator">
                            <div class="typing-dots">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <span class="text-gray-500 text-sm">Pengguna sedang mengetik...</span>
                        </div>

                        <!-- Chat Input -->
                        <div id="chatInput" class="border-t border-gray-200 p-4" style="display: none;">
                            <form id="chatForm" class="flex items-center space-x-2">
                                @csrf
                                <input type="hidden" name="user_id" id="currentUserId" value="">
                                <input 
                                    type="text" 
                                    name="message" 
                                    id="messageInput" 
                                    class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                    placeholder="Ketik pesan Anda..."
                                    maxlength="1000"
                                    required
                                    autocomplete="off"
                                    disabled
                                />
                                <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-4 py-2 transition-colors" disabled>
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                            <div class="flex items-center justify-between mt-2 text-xs text-gray-500">
                                <span>Tekan Enter untuk mengirim</span>
                                <span>Maksimal 1000 karakter</span>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentUserId = null;
        let currentUserName = null;

        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const messagesContainer = document.getElementById('messagesContainer');
            const typingIndicator = document.getElementById('typingIndicator');
            
            // Send message
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const message = messageInput.value.trim();
                if (!message || !currentUserId) return;

                // Add admin message to chat
                addMessage(message, 'admin');
                
                // Clear input
                messageInput.value = '';
                
                // Send message to server
                fetch('/admin/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        user_id: currentUserId,
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
                        return;
                    }
                    
                    // Message sent successfully
                    console.log('Message sent:', data);
                })
                .catch(error => {
                    addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
                    console.error('Error sending message:', error);
                });
            });

            // Load user chat
            window.loadUserChat = function(userId, userName) {
                currentUserId = userId;
                currentUserName = userName;
                
                // Update active user in list
                document.querySelectorAll('.user-item').forEach(item => {
                    item.classList.remove('active');
                });
                document.querySelector(`[data-user-id="${userId}"]`).classList.add('active');
                
                // Update chat header
                document.getElementById('chatHeader').innerHTML = `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-user text-indigo-500"></i>
                            </div>
                            <div>
                                <h2 class="text-lg font-semibold">${userName}</h2>
                                <p class="text-sm opacity-75">Sedang aktif</p>
                            </div>
                        </div>
                    </div>
                `;
                
                // Enable chat input
                document.getElementById('currentUserId').value = userId;
                document.getElementById('messageInput').disabled = false;
                document.querySelector('#chatForm button[type="submit"]').disabled = false;
                document.getElementById('chatInput').style.display = 'block';
                
                // Load chat messages
                fetch(`/admin/chat/messages/${userId}`, {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        messagesContainer.innerHTML = `
                            <div class="flex justify-center items-center h-full">
                                <div class="text-center">
                                    <i class="fas fa-exclamation-triangle text-red-500 text-6xl mb-4"></i>
                                    <p class="text-red-500 text-lg">Gagal memuat pesan</p>
                                </div>
                            </div>
                        `;
                        return;
                    }
                    
                    // Clear messages container
                    messagesContainer.innerHTML = '';
                    
                    // Add messages
                    if (data.chats && data.chats.length > 0) {
                        data.chats.forEach(chat => {
                            addMessage(chat.message, chat.sender, chat.created_at);
                        });
                    } else {
                        messagesContainer.innerHTML = `
                            <div class="flex justify-center items-center h-full">
                                <div class="text-center">
                                    <i class="fas fa-comment text-gray-400 text-6xl mb-4"></i>
                                    <p class="text-gray-500 text-lg">Belum ada pesan dengan ${userName}</p>
                                </div>
                            </div>
                        `;
                    }
                    
                    // Scroll to bottom
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                })
                .catch(error => {
                    console.error('Error loading chat:', error);
                    messagesContainer.innerHTML = `
                        <div class="flex justify-center items-center h-full">
                            <div class="text-center">
                                <i class="fas fa-exclamation-triangle text-red-500 text-6xl mb-4"></i>
                                <p class="text-red-500 text-lg">Gagal memuat pesan</p>
                            </div>
                        </div>
                    `;
                });
            };

            // Add message to chat
            function addMessage(message, sender, timestamp = null) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender === 'admin' ? 'flex justify-end' : 'flex justify-start'}`;
                
                const messageContent = document.createElement('div');
                messageContent.className = 'max-w-xs lg:max-w-md';
                
                const messageBubble = document.createElement('div');
                messageBubble.className = `${sender === 'admin' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800'} rounded-lg px-4 py-2`;
                
                const messageText = document.createElement('p');
                messageText.className = 'text-sm';
                messageText.textContent = message;
                
                const messageTime = document.createElement('p');
                messageTime.className = `text-xs ${sender === 'admin' ? 'text-indigo-200' : 'text-gray-500'} mt-1`;
                messageTime.textContent = timestamp ? 
                    new Date(timestamp).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }) : 
                    new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                
                messageBubble.appendChild(messageText);
                messageBubble.appendChild(messageTime);
                messageContent.appendChild(messageBubble);
                messageDiv.appendChild(messageContent);
                
                messagesContainer.appendChild(messageDiv);
                
                // Scroll to bottom
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }

            // Periodically check for new messages and update user list
            setInterval(function() {
                // Update user list
                fetch('/admin/chat/recent-users', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.users) {
                        // Update user list with new data
                        // This would need more sophisticated logic to avoid UI flicker
                        // For now, we'll just leave it as is
                    }
                })
                .catch(error => {
                    console.error('Error updating user list:', error);
                });
            }, 10000);
        });
    </script>
</body>
</html>