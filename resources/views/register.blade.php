<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ADR Catalogue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 via-blue-100 to-blue-200 py-12 px-4">
    <!-- Background Pattern -->
    <div class="fixed inset-0 z-0">
        <div class="absolute inset-0 register-gradient opacity-90"></div>
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation"></div>
            <div class="absolute top-40 right-20 w-72 h-72 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-40 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl opacity-70 float-animation" style="animation-delay: 4s;"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 w-full max-w-md">
        <!-- Logo -->
        <div class="text-center mb-8 slide-in">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4">
                <img src="{{ asset('images/asset/logo.png') }}" alt="ADR Catalogue" class="w-16 h-16 object-contain">
            </div>
            <h1 class="text-3xl font-bold text-white mb-2">Buat Akun Baru</h1>
            <p class="text-white opacity-90">Bergabung dengan ADR Catalogue</p>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 slide-in" style="animation-delay: 0.1s">
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                    @foreach ($errors->all() as $error)
                        <p class="text-red-600 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <p class="text-green-600 text-sm">{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Name Input -->
                <div class="slide-in" style="animation-delay: 0.2s">
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user mr-2"></i>Nama Lengkap
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="nama" 
                               name="nama" 
                               placeholder="John Doe" 
                               value="{{ old('nama') }}"
                               required
                               class="form-input w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                    </div>
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="slide-in" style="animation-delay: 0.3s">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email
                    </label>
                    <div class="relative">
                        <input type="email" 
                               id="email" 
                               name="email" 
                               placeholder="john@example.com" 
                               value="{{ old('email') }}"
                               required
                               class="form-input w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div class="slide-in" style="animation-delay: 0.4s">
                    <label for="nomor_handphone" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-phone mr-2"></i>Nomor Handphone
                    </label>
                    <div class="relative">
                        <input type="tel" 
                               id="nomor_handphone" 
                               name="nomor_handphone" 
                               placeholder="0812-3456-7890" 
                               value="{{ old('nomor_handphone') }}"
                               class="form-input w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                    </div>
                    @error('nomor_handphone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Input -->
                <div class="slide-in" style="animation-delay: 0.5s">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               placeholder="Minimal 8 karakter" 
                               required
                               class="form-input w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                onclick="togglePassword('password')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i id="passwordToggle" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    <div class="mt-2">
                        <div class="password-strength-bar" id="passwordStrength"></div>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Input -->
                <div class="slide-in" style="animation-delay: 0.6s">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-lock mr-2"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Ulangi password" 
                               required
                               class="form-input w-full px-4 py-3 pl-12 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i id="passwordConfirmToggle" class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Terms and Conditions -->
                <div class="slide-in" style="animation-delay: 0.7s">
                    <div class="flex items-start">
                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded mt-1">
                        <label for="terms" class="ml-2 block text-sm text-gray-700">
                            Saya setuju dengan <a href="#" class="text-indigo-600 hover:text-indigo-500">Syarat dan Ketentuan</a> serta <a href="#" class="text-indigo-600 hover:text-indigo-500">Kebijakan Privasi</a>
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="slide-in" style="animation-delay: 0.8s">
                    <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <i class="fas fa-user-plus mr-2"></i>
                        Daftar Sekarang
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="relative my-6 slide-in" style="animation-delay: 0.9s">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Atau daftar dengan</span>
                </div>
            </div>

            <!-- Social Register -->
            <div class="grid grid-cols-2 gap-3 slide-in" style="animation-delay: 1.0s">
                <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Google
                </button>
                <button class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <i class="fab fa-facebook text-blue-600 mr-2"></i>
                    Facebook
                </button>
            </div>
        </div>

        <!-- Login Link -->
        <div class="text-center mt-6 slide-in" style="animation-delay: 1.1s">
            <p class="text-white">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="font-medium text-white hover:underline">
                    Masuk di sini
                </a>
                <a href="{{ route('profile') }}" class="font-medium text-white hover:underline ml-4 inline-flex items-center transition-colors">
                    <i class="fas fa-building mr-2"></i>
                    Lihat Profil Perusahaan
                </a>
            </p>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-4 slide-in" style="animation-delay: 1.2s">
            <a href="{{ url('/') }}" class="inline-flex items-center text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const passwordInput = document.getElementById(fieldId);
            const toggleId = fieldId + 'Toggle';
            const passwordToggle = document.getElementById(toggleId);
            
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

        // Format phone number input
        document.getElementById('nomor_handphone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 0) {
                if (value.length <= 4) {
                    value = value;
                } else if (value.length <= 8) {
                    value = value.slice(0, 4) + '-' + value.slice(4);
                } else {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8) + '-' + value.slice(8, 12);
                }
            }
            e.target.value = value;
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function(e) {
            const password = e.target.value;
            const strengthBar = document.getElementById('passwordStrength');
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (password.match(/[a-z]+/)) strength++;
            if (password.match(/[A-Z]+/)) strength++;
            if (password.match(/[0-9]+/)) strength++;
            if (password.match(/[$@#&!]+/)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            if (password.length > 0) {
                if (strength <= 2) {
                    strengthBar.classList.add('strength-weak');
                } else if (strength <= 4) {
                    strengthBar.classList.add('strength-medium');
                } else {
                    strengthBar.classList.add('strength-strong');
                }
            }
        });

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitButton = e.target.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendaftar...';
        });
    </script>
    
    
</body>
</html>