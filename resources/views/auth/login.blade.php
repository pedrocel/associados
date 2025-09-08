<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - AssociaMe</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gray: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                        },
                        green: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        },
                        blue: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        red: {
                            50: '#fef2f2',
                            500: '#ef4444',
                            600: '#dc2626',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(34, 197, 94, 0.05), rgba(59, 130, 246, 0.05));
            animation: float 8s ease-in-out infinite;
        }
        
        .floating-shape:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-shape:nth-child(2) {
            width: 180px;
            height: 180px;
            top: 20%;
            right: 10%;
            animation-delay: 3s;
        }
        
        .floating-shape:nth-child(3) {
            width: 100px;
            height: 100px;
            bottom: 20%;
            left: 20%;
            animation-delay: 6s;
        }
        
        .floating-shape:nth-child(4) {
            width: 140px;
            height: 140px;
            bottom: 30%;
            right: 20%;
            animation-delay: 9s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-group input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-group input:focus {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.15);
        }
        
        .form-group.error input {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-group.success input {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }
        
        .error-message.show {
            opacity: 1;
            transform: translateY(0);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(34, 197, 94, 0.4);
        }
        
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-secondary {
            background: #f4f4f5;
            color: #52525b;
            border: 1px solid #e4e4e7;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #e4e4e7;
            transform: translateY(-1px);
        }
        
        .fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        .notification {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
            transform: translateX(100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .social-btn {
            transition: all 0.3s ease;
        }
        
        .social-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 relative overflow-x-hidden">
    
    <!-- Floating Shapes -->
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    
    <!-- Header -->
    <header class="relative z-10 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                
            </div>
            
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="relative z-10 flex items-center justify-center min-h-[calc(100vh-120px)] p-4">
        <div class="glass-effect rounded-3xl shadow-2xl p-8 lg:p-12 w-full max-w-md fade-in">
            
            <!-- Logo/Brand -->
            <div class="text-center mb-10">
                <div class="w-54 h-54 rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-lg">
                    <img src="img/associameb.png" class="text-2xl font-bold text-white mb-2">
                </div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Bem-vindo de volta!</h2>
                <p class="text-lg text-gray-600">Entre na sua conta para continuar</p>
            </div>
            
            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 rounded-xl p-6 fade-in">
                <div class="flex items-center mb-3">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <h3 class="text-red-800 font-semibold">Erro no login</h3>
                </div>
                <ul class="text-red-700 space-y-2">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <i class="fas fa-circle text-red-400 text-xs mr-2"></i>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Success Message -->
            @if (session('success'))
            <div class="mb-8 bg-green-50 border-l-4 border-green-500 rounded-xl p-6 fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                    <p class="text-green-800 font-medium">{{ session('success') }}</p>
                </div>
            </div>
            @endif
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" id="login-form" novalidate>
                @csrf
                
                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                        E-mail *
                    </label>
                    <div class="relative">
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               class="w-full px-4 py-4 pl-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                               placeholder="seu@email.com">
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <div class="error-message" id="email-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>
                
                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="block text-sm font-semibold text-gray-900 mb-2">
                        Senha *
                    </label>
                    <div class="relative">
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-4 pl-12 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                               placeholder="••••••••">
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button type="button" 
                                onclick="togglePassword()" 
                                class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                            <i class="fas fa-eye" id="password-icon"></i>
                        </button>
                    </div>
                    <div class="error-message" id="password-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <span></span>
                    </div>
                </div>
                
                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center">
                        <input id="remember" 
                               name="remember" 
                               type="checkbox" 
                               {{ old('remember') ? 'checked' : '' }}
                               class="h-5 w-5 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember" class="ml-3 block text-sm text-gray-700 font-medium">
                            Lembrar de mim
                        </label>
                    </div>
                    
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" 
                       class="text-sm text-green-600 hover:text-green-700 font-medium transition-colors">
                        Esqueceu a senha?
                    </a>
                    @endif
                </div>
                
                <!-- Login Button -->
                <button type="submit" 
                        class="btn-primary w-full text-white font-semibold py-4 px-6 rounded-xl text-lg mb-6" 
                        id="login-btn">
                    <span id="login-text">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Entrar
                    </span>
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500 font-medium">ou</span>
                </div>
            </div>
            
            <!-- Social Login (Optional) -->
            {{-- <div class="grid grid-cols-2 gap-4 mb-8">
                <button type="button" class="social-btn flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50">
                    <i class="fab fa-google text-red-500 mr-2"></i>
                    Google
                </button>
                <button type="button" class="social-btn flex items-center justify-center px-4 py-3 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50">
                    <i class="fab fa-microsoft text-blue-500 mr-2"></i>
                    Microsoft
                </button>
            </div> --}}
            
            <!-- Register Link -->
            <div class="text-center">
                <p class="text-gray-600">
                    Não tem uma associação?
                    <a href="{{ route('association.register.form') }}" 
                       class="text-green-600 hover:text-green-700 font-semibold transition-colors ml-1">
                        Criar agora
                    </a>
                </p>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="relative z-10 text-center py-6">
        <p class="text-gray-500">
            © {{ date('Y') }} AssociaMe. Todos os direitos reservados.
        </p>
    </footer>
    
    <script>
        class LoginForm {
            constructor() {
                this.form = document.getElementById('login-form');
                this.emailField = document.getElementById('email');
                this.passwordField = document.getElementById('password');
                this.loginBtn = document.getElementById('login-btn');
                this.loginText = document.getElementById('login-text');
                
                this.init();
            }
            
            init() {
                this.setupEventListeners();
                this.setupValidation();
                
                // Auto-focus email field
                this.emailField.focus();
            }
            
            setupEventListeners() {
                // Form submission
                this.form.addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.handleSubmit();
                });
                
                // Real-time validation
                this.emailField.addEventListener('blur', () => {
                    this.validateField(this.emailField, 'email');
                });
                
                this.passwordField.addEventListener('blur', () => {
                    this.validateField(this.passwordField, 'password');
                });
                
                // Clear errors on input
                this.emailField.addEventListener('input', () => {
                    this.clearFieldError(this.emailField);
                });
                
                this.passwordField.addEventListener('input', () => {
                    this.clearFieldError(this.passwordField);
                });
            }
            
            setupValidation() {
                // Add validation styles on focus/blur
                [this.emailField, this.passwordField].forEach(field => {
                    field.addEventListener('focus', () => {
                        field.parentElement.parentElement.classList.remove('error');
                    });
                });
            }
            
            validateField(field, type) {
                const formGroup = field.closest('.form-group');
                const errorElement = formGroup.querySelector('.error-message');
                const errorSpan = errorElement.querySelector('span');
                let isValid = true;
                let message = '';
                
                // Required validation
                if (!field.value.trim()) {
                    isValid = false;
                    message = 'Este campo é obrigatório';
                }
                
                // Email validation
                if (type === 'email' && field.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        isValid = false;
                        message = 'E-mail inválido';
                    }
                }
                
                // Password validation
                if (type === 'password' && field.value) {
                    if (field.value.length < 6) {
                        isValid = false;
                        message = 'A senha deve ter pelo menos 6 caracteres';
                    }
                }
                
                if (isValid) {
                    formGroup.classList.remove('error');
                    formGroup.classList.add('success');
                    errorElement.classList.remove('show');
                } else {
                    formGroup.classList.add('error');
                    formGroup.classList.remove('success');
                    errorSpan.textContent = message;
                    errorElement.classList.add('show');
                }
                
                return isValid;
            }
            
            clearFieldError(field) {
                const formGroup = field.closest('.form-group');
                const errorElement = formGroup.querySelector('.error-message');
                
                formGroup.classList.remove('error');
                errorElement.classList.remove('show');
            }
            
            validateForm() {
                const emailValid = this.validateField(this.emailField, 'email');
                const passwordValid = this.validateField(this.passwordField, 'password');
                
                return emailValid && passwordValid;
            }
            
            handleSubmit() {
                if (this.validateForm()) {
                    this.showLoading();
                    
                    // Submit form
                    setTimeout(() => {
                        this.form.submit();
                    }, 500);
                } else {
                    this.showNotification('Por favor, corrija os erros no formulário.', 'error');
                }
            }
            
            showLoading() {
                this.loginBtn.disabled = true;
                this.loginText.innerHTML = '<div class="loading-spinner mr-2"></div> Entrando...';
            }
            
            showNotification(message, type = 'success') {
                const notification = document.createElement('div');
                const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
                const icon = type === 'success' ? 'check-circle' : 'exclamation-triangle';
                
                notification.className = `notification ${bgColor} text-white px-6 py-4 rounded-xl shadow-lg`;
                notification.innerHTML = `
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-${icon}"></i>
                        <span>${message}</span>
                        <button onclick="this.parentElement.parentElement.remove()" class="ml-2 hover:text-gray-200">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
                
                document.body.appendChild(notification);
                
                // Show notification
                setTimeout(() => {
                    notification.classList.add('show');
                }, 100);
                
                // Auto remove
                setTimeout(() => {
                    notification.classList.remove('show');
                    setTimeout(() => notification.remove(), 300);
                }, 5000);
            }
        }
        
        // Global functions
        function togglePassword() {
            const passwordField = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordIcon.className = 'fas fa-eye-slash';
            } else {
                passwordField.type = 'password';
                passwordIcon.className = 'fas fa-eye';
            }
        }
        
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new LoginForm();
        });
        
        // Handle browser back button
        window.addEventListener('pageshow', (event) => {
            if (event.persisted) {
                // Reset form if page was cached
                document.getElementById('login-form').reset();
                document.getElementById('email').focus();
            }
        });
    </script>
</body>
</html>
