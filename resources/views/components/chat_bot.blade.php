@php
    $user = auth('user')->user();
    $isLoggedIn = !is_null($user);
@endphp

<!-- Chat Bot Component -->
<div class="chat-container minimized" id="chatBotContainer" style="display: none;">
    <!-- Chat Header -->
    <div class="chat-header">
        <div class="chat-header-info">
            <div class="chat-avatar">
                <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue" />
            </div>
            <div class="chat-title">
                <h5>Customer Service</h5>
                <span class="status-indicator online">● Online</span>
            </div>
        </div>
        <div class="chat-actions">
            <button class="btn minimize-btn" id="minimizeChat">
                <i class="fas fa-minus"></i>
            </button>
            <button class="btn close-btn" id="closeChat">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Chat Messages -->
    <div class="chat-messages" id="chatMessages">
        @if($isLoggedIn && isset($chats) && count($chats) > 0)
            @foreach($chats as $chat)
                <div class="message {{ $chat->sender === 'user' ? 'user-message' : 'bot-message' }}">
                    <div class="message-content">
                        <p>{{ $chat->message }}</p>
                        <span class="message-time">{{ $chat->created_at->format('H:i') }}</span>
                    </div>
                </div>
            @endforeach
        @else
            <div class="welcome-message">
                <div class="bot-message">
                    <div class="message-content">
                        <p>Halo! Selamat datang di ADR Catalogue. Ada yang bisa saya bantu?</p>
                        <span class="message-time">{{ now()->format('H:i') }}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Chat Input -->
    <div class="chat-input-container">
        <form id="chatForm" class="chat-form">
            @csrf
            <div class="input-wrapper">
                <input
                    type="text"
                    name="message"
                    id="messageInput"
                    class="form-control chat-input"
                    placeholder="Ketik pesan Anda..."
                    maxlength="1000"
                    required
                    autocomplete="off"
                />
                <button type="submit" class="btn btn-primary send-btn" id="sendBtn" title="Kirim pesan">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
            <div class="input-hints">
                <span class="char-count"><span id="charCount">0</span>/1000</span>
                <span class="hint-text">Tekan Enter untuk kirim</span>
            </div>
        </form>
    </div>

    <!-- Typing Indicator -->
    <div class="typing-indicator" id="typingIndicator" style="display: none;">
        <div class="typing-dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <span class="typing-text">{{ $isLoggedIn ? 'Admin sedang mengetik...' : 'Bot sedang mengetik...' }}</span>
    </div>
</div>

<!-- Chat Toggle Button (always visible) -->
<div class="chat-toggle-btn" id="chatToggleBtn">
    <div class="chat-toggle-content">
        <i class="fas fa-comments"></i>
        <span class="chat-badge" id="unreadBadge" style="display: none;">0</span>
    </div>
</div>

<style>
/* Chat Container Styles */
.chat-container {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 380px;
    height: 520px;
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    flex-direction: column;
    z-index: 1000;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    transform: scale(0.9);
    opacity: 0;
    transition: all 0.3s ease;
}

.chat-container.show {
    transform: scale(1);
    opacity: 1;
}

.chat-container.minimized {
    height: 70px;
}

/* Chat Header */
.chat-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 18px;
    border-radius: 15px 15px 0 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(102, 126, 234, 0.2);
}

.chat-header-info {
    display: flex;
    align-items: center;
}

.chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 12px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-avatar img {
    width: 30px;
    height: 30px;
    object-fit: contain;
}

.chat-title h5 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.status-indicator {
    font-size: 12px;
    color: #4ade80;
}

.chat-actions {
    display: flex;
    gap: 8px;
}

.chat-actions button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
}

.chat-actions button:hover {
    background: rgba(255, 255, 255, 0.3);
}

/* Chat Messages */
.chat-messages {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.chat-container.minimized .chat-messages {
    display: none;
}

.message {
    display: flex;
    max-width: 80%;
    margin-bottom: 5px;
    animation: messageSlide 0.3s ease-out;
}

.user-message {
    align-self: flex-end;
    justify-content: flex-end;
}

.bot-message {
    align-self: flex-start;
    justify-content: flex-start;
}

@keyframes messageSlide {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-content {
    padding: 12px 18px;
    border-radius: 20px;
    position: relative;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.2s ease;
}

.user-message .message-content {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-bottom-right-radius: 6px;
}

.bot-message .message-content {
    background: #f8f9fa;
    color: #1f2937;
    border-bottom-left-radius: 6px;
    border: 1px solid #e5e7eb;
}

.message-content:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
}

.message-content p {
    margin: 0;
    word-wrap: break-word;
    line-height: 1.5;
    font-size: 14px;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
    margin-top: 6px;
    display: block;
    font-weight: 500;
}

.user-message .message-time {
    color: rgba(255, 255, 255, 0.8);
}

.bot-message .message-time {
    color: #6b7280;
}

/* Chat Input */
.chat-input-container {
    padding: 18px;
    border-top: 1px solid #e5e7eb;
    background: #f8f9fa;
}

.chat-container.minimized .chat-input-container {
    display: none;
}

.input-hints {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 18px 8px;
    font-size: 11px;
    color: #9ca3af;
}

.char-count {
    font-weight: 500;
}

.hint-text {
    opacity: 0.8;
}

.chat-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.input-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    width: 100%;
}

.chat-input {
    border: 2px solid #e5e7eb;
    border-radius: 25px;
    padding: 12px 18px;
    outline: none;
    transition: all 0.3s ease;
    font-size: 14px;
    background: #f9fafb;
    flex: 1;
    min-height: 45px;
    max-height: 100px;
    resize: none;
    width: 100%;
    box-sizing: border-box;
}

.chat-input:focus {
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.chat-input::placeholder {
    color: #9ca3af;
    transition: opacity 0.3s ease;
}

.chat-input:focus::placeholder {
    opacity: 0.7;
}

.send-btn {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    flex-shrink: 0;
}

.send-btn:hover {
    background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    transform: scale(1.05);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.send-btn:active {
    transform: scale(0.95);
}

.send-btn i {
    font-size: 16px;
    transition: transform 0.2s ease;
}

.send-btn:hover i {
    transform: translateX(2px);
}

/* Typing Indicator */
.typing-indicator {
    padding: 10px 20px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    color: #6b7280;
}

.typing-dots {
    display: flex;
    gap: 4px;
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

/* Chat Toggle Button */
.chat-toggle-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 65px;
    height: 65px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 5px 25px rgba(102, 126, 234, 0.3);
    z-index: 999;
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.chat-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.4);
}

.chat-toggle-btn:active {
    transform: scale(0.95);
}

@keyframes pulse {
    0% {
        box-shadow: 0 5px 25px rgba(102, 126, 234, 0.3);
    }
    70% {
        box-shadow: 0 5px 25px rgba(102, 126, 234, 0.5);
    }
    100% {
        box-shadow: 0 5px 25px rgba(102, 126, 234, 0.3);
    }
}

.chat-toggle-content {
    color: white;
    font-size: 28px;
    position: relative;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-5px);
    }
    60% {
        transform: translateY(-3px);
    }
}

.chat-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #ef4444;
    color: white;
    font-size: 12px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/* Responsive Design */
@media (max-width: 768px) {
    .chat-container {
        width: calc(100% - 40px);
        right: 20px;
        left: 20px;
        height: 400px;
    }
    
    .chat-toggle-btn {
        width: 50px;
        height: 50px;
        bottom: 15px;
        right: 15px;
    }
}

/* Scrollbar Styling */
.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 10px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #555;
}

/* Welcome animation */
.chat-toggle-btn.animate-welcome {
    animation: welcomePulse 2s ease-in-out;
}

@keyframes welcomePulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 5px 25px rgba(102, 126, 234, 0.3);
    }
    50% {
        transform: scale(1.2);
        box-shadow: 0 8px 35px rgba(102, 126, 234, 0.5);
    }
}

/* Message typing animation */
.message.typing {
    animation: typingPulse 1.5s infinite;
}

@keyframes typingPulse {
    0%, 100% {
        opacity: 0.7;
    }
    50% {
        opacity: 1;
    }
}

/* Enhanced focus states */
.chat-input:focus,
.send-btn:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* Mobile optimizations */
@media (max-width: 480px) {
    .input-hints {
        flex-direction: column;
        align-items: flex-start;
        gap: 4px;
    }
    
    .message {
        max-width: 90%;
    }
    
    .message-content {
        font-size: 13px;
        padding: 10px 14px;
    }
    
    .input-wrapper {
        gap: 8px;
    }
    
    .send-btn {
        width: 40px;
        height: 40px;
    }
    
    .chat-input {
        padding: 10px 14px;
        font-size: 13px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatContainer = document.getElementById('chatBotContainer');
    const chatToggleBtn = document.getElementById('chatToggleBtn');
    const minimizeBtn = document.getElementById('minimizeChat');
    const closeBtn = document.getElementById('closeChat');
    const chatForm = document.getElementById('chatForm');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const chatMessages = document.getElementById('chatMessages');
    const typingIndicator = document.getElementById('typingIndicator');
    const unreadBadge = document.getElementById('unreadBadge');
    
    let unreadCount = 0;
    let isMinimized = true; // Start minimized
    const isLoggedIn = {{ $isLoggedIn ? 'true' : 'false' }};
    
    // Minimize chat
    minimizeBtn.addEventListener('click', function() {
        chatContainer.classList.remove('show');
        setTimeout(() => {
            chatContainer.classList.add('minimized');
            chatToggleBtn.style.display = 'flex';
        }, 300);
        isMinimized = true;
    });

    // Close chat
    closeBtn.addEventListener('click', function() {
        chatContainer.classList.remove('show');
        setTimeout(() => {
            chatContainer.style.display = 'none';
            chatToggleBtn.style.display = 'flex';
        }, 300);
        isMinimized = true;
    });

    // Open chat from toggle button
    chatToggleBtn.addEventListener('click', function() {
        chatContainer.style.display = 'flex';
        setTimeout(() => {
            chatContainer.classList.add('show');
        }, 10);
        chatContainer.classList.remove('minimized');
        chatToggleBtn.style.display = 'none';
        isMinimized = false;
        unreadCount = 0;
        updateUnreadBadge();
        
        // Focus on input when chat opens
        setTimeout(() => {
            messageInput.focus();
        }, 300);
    });

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
        
        // Add visual feedback to send button
        sendBtn.style.transform = 'scale(0.9)';
        setTimeout(() => {
            sendBtn.style.transform = 'scale(1)';
        }, 200);
        
        if (isLoggedIn) {
            // Send message to server for logged-in users
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
        } else {
            // Use bot response for non-logged-in users
            fetch('/chat/bot', {
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
                
                if (data.bot_response) {
                    addMessage(data.bot_response, 'bot');
                }
            })
            .catch(error => {
                hideTypingIndicator();
                addMessage('Maaf, terjadi kesalahan koneksi. Silakan coba lagi.', 'bot');
            });
        }
    });

    // Add message to chat
    function addMessage(message, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        messageDiv.style.opacity = '0';
        messageDiv.style.transform = 'translateY(10px)';
        
        const messageContent = document.createElement('div');
        messageContent.className = 'message-content';
        
        const messageText = document.createElement('p');
        messageText.textContent = message;
        
        const messageTime = document.createElement('span');
        messageTime.className = 'message-time';
        messageTime.textContent = new Date().toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
        
        messageContent.appendChild(messageText);
        messageContent.appendChild(messageTime);
        messageDiv.appendChild(messageContent);
        
        chatMessages.appendChild(messageDiv);
        
        // Animate message appearance
        setTimeout(() => {
            messageDiv.style.transition = 'all 0.3s ease';
            messageDiv.style.opacity = '1';
            messageDiv.style.transform = 'translateY(0)';
            
            // Scroll to bottom after animation
            setTimeout(() => {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }, 100);
        }, 50);
        
        // Update unread count if chat is minimized
        if (isMinimized && sender === 'bot') {
            unreadCount++;
            updateUnreadBadge();
            
            // Animate badge
            unreadBadge.style.transform = 'scale(1.2)';
            setTimeout(() => {
                unreadBadge.style.transform = 'scale(1)';
            }, 200);
        }
    }

    // Update unread badge
    function updateUnreadBadge() {
        if (unreadCount > 0) {
            unreadBadge.textContent = unreadCount;
            unreadBadge.style.display = 'flex';
        } else {
            unreadBadge.style.display = 'none';
        }
    }

    // Show typing indicator
    function showTypingIndicator() {
        typingIndicator.style.display = 'flex';
        typingIndicator.style.opacity = '0';
        typingIndicator.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
            typingIndicator.style.transition = 'all 0.3s ease';
            typingIndicator.style.opacity = '1';
            typingIndicator.style.transform = 'translateY(0)';
        }, 50);
        
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Hide typing indicator
    function hideTypingIndicator() {
        typingIndicator.style.opacity = '0';
        typingIndicator.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            typingIndicator.style.display = 'none';
            typingIndicator.style.opacity = '1';
            typingIndicator.style.transform = 'translateY(0)';
        }, 300);
    }

    // Periodically check for new messages (only for logged-in users)
    if (isLoggedIn) {
        setInterval(function() {
            if (!isMinimized) {
                fetch('/chat/refresh', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.chats) {
                        // Update chat with new messages
                        // This would need more sophisticated logic to avoid duplicates
                    }
                })
                .catch(error => {
                    console.error('Error refreshing chat:', error);
                });
            }
        }, 5000);
    }
    
    // Character counter
    messageInput.addEventListener('input', function() {
        const charCount = this.value.length;
        document.getElementById('charCount').textContent = charCount;
        
        // Change color when approaching limit
        if (charCount > 900) {
            document.getElementById('charCount').style.color = '#ef4444';
        } else if (charCount > 800) {
            document.getElementById('charCount').style.color = '#f59e0b';
        } else {
            document.getElementById('charCount').style.color = '#9ca3af';
        }
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            if (document.activeElement === messageInput && messageInput.value.trim()) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        }
        
        // Escape to minimize chat
        if (e.key === 'Escape' && !isMinimized) {
            e.preventDefault();
            minimizeBtn.click();
        }
    });
    
    // Auto-resize input based on content
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });
    
    // Welcome animation for first-time users
    if (!localStorage.getItem('chatBotVisited')) {
        setTimeout(() => {
            chatToggleBtn.classList.add('animate-welcome');
            setTimeout(() => {
                chatToggleBtn.classList.remove('animate-welcome');
            }, 2000);
        }, 2000);
        localStorage.setItem('chatBotVisited', 'true');
    }
});
</script>