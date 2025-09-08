<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Sistema de Associações')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Poppins', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item:hover {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
            transform: translateX(4px);
            border-left: 3px solid #22c55e;
        }
        .sidebar-item.active {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2) 0%, rgba(22, 163, 74, 0.2) 100%);
            border-left: 4px solid #22c55e;
            color: #22c55e;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        @media (max-width: 768px) {
            .sidebar-item:hover {
                transform: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    <div class="flex h-screen relative">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed lg:relative w-72 gradient-bg text-white flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out h-full">
            <!-- Logo/Brand -->
            <div class="p-6 border-b border-green-600/30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                            <i data-lucide="zap" class="w-6 h-6 text-white"></i>
                        </div>
                        <div>
                            <h1 class="text-lg font-display font-semibold">AssociaçõesPro</h1>
                            <p class="text-xs text-green-100">{{ auth()->user()->tipo ?? 'Cliente' }}</p>
                        </div>
                    </div>
                    <button id="close-sidebar" class="lg:hidden p-2 text-green-100 hover:text-white hover:bg-white/10 rounded-lg">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('cliente.dashboard') }}" class="sidebar-item {{ request()->is('*dashboard*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="#" class="sidebar-item {{ request()->is('*noticias*') ? 'active' : '' }} flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:text-white">
                    <i data-lucide="newspaper" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Notícias</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:text-white">
                    <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Documentos</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:text-white">
                    <i data-lucide="credit-card" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Financeiro</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:text-white">
                    <i data-lucide="calendar" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Eventos</span>
                </a>
                
                <a href="#" class="sidebar-item flex items-center space-x-3 px-4 py-3 rounded-xl text-sm font-medium text-green-100 hover:text-white">
                    <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Configurações</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 border-t border-green-600/30">
                <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-3 rounded-xl hover:bg-white/10 transition-colors">
                    <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-sm font-semibold text-white">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0 text-left">
                        <p class="text-sm font-medium truncate">{{ auth()->user()->name ?? 'Usuário' }}</p>
                        <p class="text-xs text-green-100 truncate">{{ auth()->user()->email ?? 'email@exemplo.com' }}</p>
                    </div>
                    <i data-lucide="chevron-up" class="w-4 h-4 text-green-100"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white dark:bg-gray-800 shadow-sm border-b border-gray-200 dark:border-gray-700">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <button id="mobile-menu-button" class="lg:hidden p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg">
                                <i data-lucide="menu" class="w-6 h-6"></i>
                            </button>
                            <div>
                                <h1 class="text-2xl font-display font-bold text-gray-900 dark:text-white">@yield('page-title', 'Dashboard')</h1>
                                <p class="text-sm text-gray-500 dark:text-gray-400">@yield('page-subtitle', 'Bem-vindo ao seu painel de controle')</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <button id="theme-toggle" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 rounded-lg">
                                <i data-lucide="sun" class="w-5 h-5 dark:hidden"></i>
                                <i data-lucide="moon" class="w-5 h-5 hidden dark:block"></i>
                            </button>
                            
                            <div class="relative">
                                <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 rounded-lg">
                                    <i data-lucide="bell" class="w-5 h-5"></i>
                                </button>
                                <div class="absolute -top-1 -right-1 w-3 h-3 bg-primary-500 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-gray-900">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
    
    <script>
        lucide.createIcons();

        // Theme Management
        const themeToggle = document.getElementById('theme-toggle');
        const html = document.documentElement;
        const currentTheme = localStorage.getItem('theme') || 'light';
        html.classList.toggle('dark', currentTheme === 'dark');

        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const isDark = html.classList.contains('dark');
                html.classList.toggle('dark', !isDark);
                localStorage.setItem('theme', !isDark ? 'dark' : 'light');
            });
        }

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay');
        const closeSidebar = document.getElementById('close-sidebar');

        function openSidebar() {
            if (sidebar) {
                sidebar.classList.remove('-translate-x-full');
                sidebarOverlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden');
            }
        }

        function closeSidebarFunc() {
            if (sidebar) {
                sidebar.classList.add('-translate-x-full');
                sidebarOverlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        if (mobileMenuButton) mobileMenuButton.addEventListener('click', openSidebar);
        if (closeSidebar) closeSidebar.addEventListener('click', closeSidebarFunc);
        if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebarFunc);

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                closeSidebarFunc();
            }
        });
    </script>
</body>
</html>
