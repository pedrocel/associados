<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/20 backdrop-blur-sm z-40 hidden lg:hidden transition-all duration-300 opacity-0"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed lg:relative w-64 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-out h-full border-r border-gray-200 dark:border-gray-700 shadow-sm">
    
    <!-- Header Section -->
    <div class="p-5 border-b border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between">
            <div class="sidebar-section-title flex items-center space-x-3">
                <!-- Logo -->
                <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center shadow-sm">
                    <span class="text-white font-bold text-lg">A</span>
                </div>
                
                <!-- Association Info -->
                <div>
                    <h1 class="text-base font-semibold text-gray-900 dark:text-white">Associação</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Painel Admin</p>
                </div>
            </div>
            
            <!-- Close Button -->
            <button id="close-sidebar" class="lg:hidden p-2 text-gray-400 dark:text-gray-300 hover:text-gray-600 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors" aria-label="Fechar menu">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
            <button id="toggle-sidebar" class="p-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
    <i data-lucide="panel-left" class="w-5 h-5"></i>
</button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto" role="navigation" aria-label="Menu principal">
        
        <!-- Main Section -->
        <div class="space-y-1 mb-4">
            <div class="sidebar-section-title px-3 py-2">
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wide">Principal</p>
            </div>
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
                class="sidebar-item {{ request()->is('*dashboard*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700" 
                aria-current="{{ request()->is('*dashboard*') ? 'page' : '' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Dashboard</span>
            </a>

            <!-- Triagem -->
            <a href="{{ route('associacao.documentos.pending') }}" 
                class="sidebar-item {{ request()->is('*documentos*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="filter" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Triagem</span>
            </a>
        </div>

        <!-- Management Section -->
        <div class="space-y-1">
            <div class="sidebar-section-title px-3 py-2">
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wide">Gestão</p>
            </div>
            
            <!-- Users -->
            <a href="{{ route('associacao.users.index') }}" 
                class="sidebar-item {{ request()->is('*usuarios*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="users" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Usuários</span>
            </a>

            <!-- News -->
            <a href="{{ route('associacao.news.index') }}" 
                class="sidebar-item {{ request()->is('*noticias*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="newspaper" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Notícias</span>
            </a>

            <!-- Products -->
            <a href="{{ route('associacao.products.index') }}" 
                class="sidebar-item {{ request()->is('*products*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="package" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Produtos</span>
            </a>

            <!-- Planos -->
            <a href="{{ route('associacao.plans.index') }}" 
                class="sidebar-item {{ request()->is('*plans*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="credit-card" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Planos</span>
            </a>

            <!-- Banners -->
            <a href="{{ route('associacao.banners.index') }}" 
                class="sidebar-item {{ request()->is('*banners*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="image" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Banners</span>
            </a>

            <!-- Vendas -->
            <a href="{{ route('associacao.vendas.index') }}" 
                class="sidebar-item {{ request()->is('*vendas*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="shopping-cart" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Vendas</span>
            </a>

            <!-- Financeiro -->
            <a href="{{ route('associacao.financeiro.index') }}" 
                class="sidebar-item {{ request()->is('*financeiro*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="dollar-sign" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Financeiro</span>
            </a>

            <!-- Relatórios -->
            <a href="{{ route('associacao.relatorios.index') }}" 
                class="sidebar-item {{ request()->is('*relatorios*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="bar-chart-2" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Relatórios</span>
            </a>

            <!-- Configurações -->
            <a href="{{ route('associacao.configuracoes.edit') }}" 
                class="sidebar-item {{ request()->is('*configuracoes*') ? 'active' : '' }} group flex items-center space-x-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-colors hover:bg-gray-50 dark:hover:bg-gray-700">
                <i data-lucide="settings" class="w-5 h-5 text-gray-500 dark:text-gray-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-500"></i>
                <span class="text-gray-700 dark:text-gray-300 group-hover:text-gray-900 dark:group-hover:text-white">Configurações</span>
            </a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="p-3 border-t border-gray-200 dark:border-gray-700">
        <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-2.5 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
            <!-- Profile Avatar -->
            <div class="w-9 h-9 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0">
                <span class="text-sm font-semibold text-white">AD</span>
            </div>
            
            <!-- User Info -->
            <div class="flex-1 min-w-0 text-left">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Admin User</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">Administrador</p>
            </div>
            
            <!-- Expand Arrow -->
            <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-colors"></i>
        </button>
    </div>
</div>

<script>
    // --- Ocultar/Mostrar Sidebar ---
    const toggleSidebarBtn = document.getElementById('toggle-sidebar');
    const sidebar = document.getElementById('sidebar');

    // Carregar estado salvo
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        sidebar.classList.add('sidebar-collapsed');
    }

    if (toggleSidebarBtn && sidebar) {
        toggleSidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-collapsed');
            const isCollapsed = sidebar.classList.contains('sidebar-collapsed');
            localStorage.setItem('sidebar-collapsed', isCollapsed);
            // Recria os ícones Lucide após a animação
            setTimeout(() => lucide.createIcons(), 200);
        });
    }

// Initialize Lucide icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

// Mobile functionality
function initializeSidebar() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const closeSidebar = document.getElementById('close-sidebar');

    function openSidebar() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.remove('-translate-x-full');
            sidebarOverlay.classList.remove('hidden');
            sidebarOverlay.classList.add('opacity-100');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeSidebarFunc() {
        if (sidebar && sidebarOverlay) {
            sidebar.classList.add('-translate-x-full');
            sidebarOverlay.classList.remove('opacity-100');
            sidebarOverlay.classList.add('opacity-0');
            setTimeout(() => {
                sidebarOverlay.classList.add('hidden');
            }, 300);
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Event listeners
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', openSidebar);
    }
    
    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeSidebarFunc);
    }
    
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebarFunc);
    }

    // Close sidebar when clicking on menu items on mobile
    const sidebarItems = document.querySelectorAll('.sidebar-item');
    sidebarItems.forEach(item => {
        item.addEventListener('click', () => {
            if (window.innerWidth < 1024) {
                closeSidebarFunc();
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            closeSidebarFunc();
        }
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !sidebar.classList.contains('-translate-x-full')) {
            closeSidebarFunc();
        }
    });
}

// Initialize when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeSidebar);
} else {
    initializeSidebar();
}
</script>

<style>
/* Active state styling */
.sidebar-item.active {
    background-color: #f0fdf4;
    color: #059669;
    font-weight: 600;
}

.dark .sidebar-item.active {
    background-color: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.sidebar-item.active i {
    color: #059669;
}

.dark .sidebar-item.active i {
    color: #10b981;
}

/* Smooth transitions */
.sidebar-item {
    transition: all 0.2s ease;
}

.sidebar-item:hover {
    background-color: #f9fafb;
}

.dark .sidebar-item:hover {
    background-color: #374151;
}

/* Focus styles for accessibility */
.sidebar-item:focus-visible {
    outline: 2px solid #10b981;
    outline-offset: 2px;
}

/* Custom scrollbar */
nav::-webkit-scrollbar {
    width: 6px;
}

nav::-webkit-scrollbar-track {
    background: transparent;
}

nav::-webkit-scrollbar-thumb {
    background: #e5e7eb;
    border-radius: 3px;
}

.dark nav::-webkit-scrollbar-thumb {
    background: #4b5563;
}

nav::-webkit-scrollbar-thumb:hover {
    background: #d1d5db;
}

.dark nav::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
}

/* Sidebar colapsada no desktop */
.sidebar-collapsed {
    width: 5rem !important;
}

.sidebar-collapsed .sidebar-item span,
.sidebar-collapsed .sidebar-section-title,
.sidebar-collapsed #user-profile-btn div.flex-1,
.sidebar-collapsed #user-profile-btn i[data-lucide="chevron-right"] {
    display: none !important;
}

.sidebar-collapsed nav {
    overflow-x: hidden;
}

.sidebar-collapsed .sidebar-item {
    justify-content: center;
}

.sidebar-collapsed .sidebar-item i {
    margin-right: 0 !important;
}
.sidebar-collapsed .sidebar-section-title,
.sidebar-collapsed .sidebar-section-title p {
    display: none !important;
}
</style>
