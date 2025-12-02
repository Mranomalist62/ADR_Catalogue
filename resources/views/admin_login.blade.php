<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .login-gradient {
            background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #2563eb 100%);
        }
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .slide-in {
            animation: slideIn 0.5s ease-out;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50">
    <!-- Background Pattern -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 login-gradient opacity-90"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 4s;"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md px-4">
        <!-- Logo and Title -->
        <div class="text-center mb-8 slide-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Admin Login</h1>
            <p class="text-white/80">Masuk ke dashboard administrator</p>
        </div>

        <!-- Login Form -->
        <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 slide-in" style="animation-delay: 0.1s">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-600 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-600 text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email Input -->
                <div class="slide-in" style="animation-delay: 0.2s">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Admin
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               placeholder="admin@adr-catalogue.com" 
                               value="{{ old('email') }}"
                               required
                               class="form-input w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Password Input -->
                <div class="slide-in" style="animation-delay: 0.3s">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Masukkan password admin" 
                               required
                               class="form-input w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i id="passwordToggle" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between slide-in" style="animation-delay: 0.4s">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500 transition-colors">
                        Lupa password?
                    </a>
                </div>

                <!-- Submit Button -->
                <div class="slide-in" style="animation-delay: 0.5s">
                    <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Masuk ke Dashboard
                    </button>
                </div>
            </form>

            <!-- Security Notice -->
            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg slide-in" style="animation-delay: 0.6s">
                <div class="flex items-start">
                    <i class="fas fa-shield-alt text-blue-600 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm font-medium text-blue-800">Keamanan Admin</p>
                        <p class="text-xs text-blue-600 mt-1">Halaman login ini dilindungi dengan enkripsi SSL. Pastikan Anda berada di URL yang benar.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="text-center mt-6 slide-in" style="animation-delay: 0.7s">
            <a href="{{ route('home') }}" class="inline-flex items-center text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitButton = e.target.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Masuk...';
        });

        // Auto-focus on email field
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('email').focus();
        });
    </script>
</body>
</html>