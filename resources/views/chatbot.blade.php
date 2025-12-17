<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BotChat</title>
    <link rel="stylesheet" href="{{ asset('css/chatbot.css') }}">
</head>

<body>

    <div class="header">
        <a href="{{ url()->previous() }}" class="back-btn">Kembali</a>
        <h1>ChatBot</h1>
    </div>

    <div class="chat-wrapper">

        <div id="chatbox" class="chatbox"></div>

        <div class="quick-reply">
            <button class="chip">Hai, Produk apa saja yang dimiliki ADRCatalog?</button>
            <button class="chip">Hai, Apakah ada promo?</button>
            <button class="chip">Hai, Kategori apa saja yang ada?</button>
            <button class="chip">Hai, Berikan informasi harga produk ADRCatalog</button>
        </div>

        <div class="chat-input-wrapper">
            <input type="text" id="userInput" placeholder="Tulis Pesan...">
            <button id="sendBtn" class="send-btn">➤</button>
        </div>

    </div>

    <script>
        document.getElementById('sendBtn').addEventListener('click', sendMessage);
        document.getElementById('userInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') sendMessage();
        });

        document.querySelectorAll(".chip").forEach(btn => {
            btn.onclick = () => {
                document.getElementById("userInput").value = btn.innerText;
                sendMessage();
            };
        });

        async function sendMessage() {
            const input = document.getElementById('userInput');
            const message = input.value.trim();
            if (!message) return;

            const chatbox = document.getElementById('chatbox');

            chatbox.innerHTML += `
                <div class="bubble user-bubble">
                    <span class="user-name">You</span>
                    <p>${message}</p>
                </div>
            `;

            chatbox.scrollTop = chatbox.scrollHeight;
            input.value = '';

            const response = await fetch('{{ route("chat.bot") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();

            chatbox.innerHTML += `
                <div class="bubble bot-bubble">
                    <span class="bot-name">Mr. ADR</span>
                    <p>${data.reply}</p>
                </div>
            `;

            chatbox.scrollTop = chatbox.scrollHeight;
        }
    </script>

</body>
</html>
