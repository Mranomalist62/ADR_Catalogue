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
        .chat-container { height: calc(100vh - 120px); max-height: 800px; }
        .messages-container { height: calc(100% - 80px); overflow-y: auto; }
        .message { animation: fadeIn .2s ease-in; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body class="bg-gray-50">

<!-- NAVBAR -->
<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 h-16 flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('images/asset/logo.png') }}" class="h-10 mr-2">
            <span class="font-bold text-lg">ADR Catalogue</span>
        </div>
        <div class="flex gap-4 text-sm">
            <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
            <a href="{{ route('profile') }}" class="hover:text-indigo-600">Profil</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-red-600 hover:text-red-800">Keluar</button>
            </form>
        </div>
    </div>
</nav>

<!-- CHAT -->
<div class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded shadow overflow-hidden">

        <!-- HEADER -->
        <div class="bg-indigo-600 text-white p-4 flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-lg">Customer Service</h2>
                <p class="text-sm opacity-80">Online</p>
            </div>
            <div class="text-sm text-right">
                <p>{{ $user->name }}</p>
                <p class="text-xs">{{ now()->format('d M Y') }}</p>
            </div>
        </div>

        <!-- MESSAGES -->
        <div class="chat-container flex flex-col">
            <div id="messagesContainer" class="messages-container p-4 space-y-3">
                @foreach($chats as $chat)
                    <div class="message {{ $chat->sender === 'user' ? 'flex justify-end' : 'flex justify-start' }}">
                        <div class="max-w-md">
                            <div class="{{ $chat->sender === 'user' ? 'bg-indigo-500 text-white' : 'bg-gray-200 text-gray-800' }} px-4 py-2 rounded-lg">
                                <p class="text-sm">{{ $chat->message }}</p>
                                <p class="text-xs mt-1 {{ $chat->sender === 'user' ? 'text-indigo-200' : 'text-gray-500' }}">
                                    {{ $chat->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- INPUT -->
            <div class="border-t p-4">
                <form id="chatForm" class="flex gap-2">
                    <input id="messageInput" type="text" class="flex-1 border rounded-full px-4 py-2"
                           placeholder="Ketik pesan..." required>
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-full">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const messagesContainer = document.getElementById('messagesContainer');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');

    function scrollBottom() {
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
    scrollBottom();

    chatForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const message = messageInput.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        messageInput.value = '';

        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: message })
        });
    });

    function addMessage(text, sender) {
        const wrap = document.createElement('div');
        wrap.className = 'message ' + (sender === 'user'
            ? 'flex justify-end'
            : 'flex justify-start');

        const bubble = document.createElement('div');
        bubble.className = (sender === 'user'
            ? 'bg-indigo-500 text-white'
            : 'bg-gray-200 text-gray-800') + ' px-4 py-2 rounded-lg max-w-md';

        const p = document.createElement('p');
        p.className = 'text-sm';
        p.textContent = text;

        const time = document.createElement('p');
        time.className = 'text-xs mt-1 opacity-70';
        time.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

        bubble.appendChild(p);
        bubble.appendChild(time);
        wrap.appendChild(bubble);
        messagesContainer.appendChild(wrap);
        scrollBottom();
    }

    function refreshChat() {
        fetch('/chat/refresh')
            .then(res => res.json())
            .then(data => {
                if (!data.chats) return;

                messagesContainer.innerHTML = '';
                data.chats.forEach(chat => {
                    addMessage(chat.message, chat.sender);
                });
            });
    }

    setInterval(refreshChat, 5000);
});
</script>

</body>
</html>