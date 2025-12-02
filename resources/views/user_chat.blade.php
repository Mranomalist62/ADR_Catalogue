<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Customer Service - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .chat-container {
            height: calc(100vh - 120px);
            max-height: 800px;
        }
        .messages-container {
            height: calc(100% - 80px);
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
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo and Brand -->
                <div class="flex items-center space-x-4">
                    <div class="flex-shrink-0 flex items-center">
                        <img class="h-10 w-auto" src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue">
                        <span class="ml-2 text-xl font-bold text-gray-800">ADR Catalogue</span>
                    </div>
                </div>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-home mr-1"></i> Beranda
                    </a>
                    <a href="{{ route('profile') }}" class="text-gray-700 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        <i class="fas fa-user mr-1"></i> Profil
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Chat Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Chat Header -->
            <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mr-4">
                            <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue" class="w-8 h-8">
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold">Customer Service</h2>
                            <div class="flex items-center text-sm">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-2"></span>
                                <span>Online</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm">
                        <p>{{ $user->name }}</p>
                        <p class="text-xs opacity-75">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="chat-container flex flex-col">
                <div class="messages-container scrollbar-custom p-4 space-y-4" id="messagesContainer">
                    @if($chats->count() > 0)
                        @foreach($chats as $chat)
                            <div class="message {{ $chat->sender === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                                <div class="max-w-xs lg:max-w-md">
                                    <div class="{{ $chat->sender === 'user' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800' } rounded-lg px-4 py-2">
                                        <p class="text-sm">{{ $chat->message }}</p>
                                        <p class="text-xs {{ $chat->sender === 'user' ? 'text-indigo-200' : 'text-gray-500' }} mt-1">
                                            {{ $chat->created_at->format('H:i') }}
                                            @if($chat->sender === 'user')
                                                <span class="ml-2">
                                                    @if($chat->is_read)
                                                        <i class="fas fa-check-double text-indigo-200"></i>
                                                    @else
                                                        <i class="fas fa-check text-indigo-200"></i>
                                                    @endif
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="flex justify-center">
                            <div class="bg-gray-200 text-gray-800 rounded-lg px-4 py-2 max-w-xs lg:max-w-md">
                                <p class="text-sm">Halo! Selamat datang di ADR Catalogue. Ada yang bisa saya bantu?</p>
                                <p class="text-xs text-gray-500 mt-1">{{ now()->format('H:i') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Typing Indicator -->
                <div class="typing-indicator hidden" id="typingIndicator">
                    <div class="typing-dots">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <span class="text-gray-500 text-sm">Admin sedang mengetik...</span>
                </div>

                <!-- Chat Input -->
                <div class="border-t border-gray-200 p-4">
                    <form id="chatForm" class="flex items-center space-x-2">
                        @csrf
                        <input 
                            type="text" 
                            name="message" 
                            id="messageInput" 
                            class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                            placeholder="Ketik pesan Anda..."
                            maxlength="1000"
                            required
                            autocomplete="off"
                        />
                        <button type="submit" class="bg-indigo-500 hover:bg-indigo-600 text-white rounded-full px-4 py-2 transition-colors">
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatForm = document.getElementById('chatForm');
            const messageInput = document.getElementById('messageInput');
            const messagesContainer = document.getElementById('messagesContainer');
            const typingIndicator = document.getElementById('typingIndicator');
            
            // Scroll to bottom
            function scrollToBottom() {
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
            
            // Initial scroll to bottom
            scrollToBottom();
            
            // Send message
            chatForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const message = messageInput.value.trim();
                if (!message) return;

                // Add user message to chat
                addMessage(message, 'user');
                
                // Clear input
                messageInput.value = '';
                
                // Show typing indicator
                showTypingIndicator();
                
                // Send message to server
                fetch('/chat/send', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    hideTypingIndicator();
                    
                    if (data.error) {
                        addMessage('Maaf, terjadi kesalahan. Silakan coba lagi.', 'bot');
                        return;
                    }
                    
                    if (data.status === 'pending_admin_response') {
                        addMessage(data.message, 'bot');
                    } else if (data.bot_response) {
                        addMessage(data.bot_response.message, 'bot');
                    }
                })
                .catch(error => {
                    hideTypingIndicator();
                    addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
                });
            });

            // Add message to chat
            function addMessage(message, sender) {
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender === 'user' ? 'flex justify-end' : 'flex justify-start'}`;
                
                const messageContent = document.createElement('div');
                messageContent.className = 'max-w-xs lg:max-w-md';
                
                const messageBubble = document.createElement('div');
                messageBubble.className = `${sender === 'user' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800'} rounded-lg px-4 py-2`;
                
                const messageText = document.createElement('p');
                messageText.className = 'text-sm';
                messageText.textContent = message;
                
                const messageTime = document.createElement('p');
                messageTime.className = `text-xs ${sender === 'user' ? 'text-indigo-200' : 'text-gray-500'} mt-1`;
                messageTime.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                
                if (sender === 'user') {
                    const checkIcon = document.createElement('span');
                    checkIcon.className = 'ml-2';
                    checkIcon.innerHTML = '<i class="fas fa-check text-indigo-200"></i>';
                    messageTime.appendChild(checkIcon);
                }
                
                messageBubble.appendChild(messageText);
                messageBubble.appendChild(messageTime);
                messageContent.appendChild(messageBubble);
                messageDiv.appendChild(messageContent);
                
                messagesContainer.appendChild(messageDiv);
                
                // Scroll to bottom
                scrollToBottom();
            }

            // Show typing indicator
            function showTypingIndicator() {
                typingIndicator.classList.remove('hidden');
                scrollToBottom();
            }

            // Hide typing indicator
            function hideTypingIndicator() {
                typingIndicator.classList.add('hidden');
            }

            // Periodically check for new messages
            setInterval(function() {
                fetch('/chat/refresh', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.chats && data.chats.length > 0) {
                        // This would need more sophisticated logic to avoid duplicates
                        // For now, we'll just leave it as is
                    }
                })
                .catch(error => {
                    console.error('Error refreshing chat:', error);
                });
            }, 5000);
        });
    </script>
</body>
</html>