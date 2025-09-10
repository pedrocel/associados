<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden transition-all duration-300 opacity-0"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed lg:relative w-72 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-out h-full border-r border-slate-700/30 shadow-2xl backdrop-blur-xl">
    
    <!-- Header Section -->
    <div class="relative p-6 border-b border-slate-700/40 bg-gradient-to-br from-emerald-600/15 via-teal-600/10 to-slate-800/50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-32 h-32 bg-emerald-500 rounded-full blur-3xl -translate-x-16 -translate-y-16"></div>
            <div class="absolute bottom-0 right-0 w-24 h-24 bg-teal-500 rounded-full blur-2xl translate-x-12 translate-y-12"></div>
        </div>
        
        <div class="flex items-center justify-between relative z-10">
            <div class="flex items-center space-x-4">
                <!-- Logo Container -->
                <div class="relative group">
                    <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 via-emerald-600 to-teal-600 rounded-2xl flex items-center justify-center shadow-xl ring-2 ring-emerald-500/20 transform transition-all duration-300 group-hover:scale-105 group-hover:rotate-3">
                        <span class="text-white font-bold text-xl tracking-tight">A</span>
                    </div>
                    <!-- Floating particles effect -->
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></div>
                </div>
                
                <!-- Association Info -->
                <div class="space-y-1">
                    <h1 class="text-lg font-bold text-white leading-tight">Associação</h1>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <p class="text-xs text-emerald-400 font-medium">Painel Administrativo</p>
                    </div>
                </div>
            </div>
            
            <!-- Close Button -->
            <button id="close-sidebar" class="lg:hidden p-2.5 text-slate-400 hover:text-white hover:bg-white/10 rounded-xl transition-all duration-200 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-emerald-500/50" aria-label="Fechar menu">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-slate-600/50 scrollbar-track-transparent" role="navigation" aria-label="Menu principal">
        
        <!-- Main Section -->
        <div class="space-y-1 mb-6">
            <div class="px-3 py-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Principal</p>
            </div>
            
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" 
                class="sidebar-item {{ request()->is('*dashboard*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50" 
                aria-current="{{ request()->is('*dashboard*') ? 'page' : '' }}">
                    <div class="flex items-center space-x-3 relative z-10">
                        <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                            <i data-lucide="layout-dashboard" class="w-4.5 h-4.5 flex-shrink-0 transition-colors duration-300"></i>
                        </div>
                        <span class="font-semibold transition-colors duration-300">Dashboard</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
                    @if(request()->is('*dashboard*'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full shadow-lg shadow-emerald-400/50"></div>
                    @endif
                </a>

                            <!-- Triagem -->
                            <!-- Triagem -->
                <a href="{{ route('associacao.documentos.pending') }}" 
                class="sidebar-item {{ request()->is('*documentos*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                    <div class="flex items-center space-x-3 relative z-10">
                        <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                            <i data-lucide="filter" class="w-4.5 h-4.5 flex-shrink-0"></i>
                        </div>
                        <span class="font-medium">Triagem</span>
                        {{-- Badge de exemplo --}}
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
                    @if(request()->is('*documentos*'))
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full shadow-lg shadow-emerald-400/50"></div>
                    @endif
                </a>
        </div>

        <!-- Management Section -->
        <div class="space-y-1 mb-6">
            <div class="px-3 py-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Gestão</p>
            </div>
            
            <!-- Users -->
             <a href="{{ route('associacao.users.index') }}" 
       class="sidebar-item {{ request()->is('*usuarios*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="users" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Usuários</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*users*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

            <!-- News -->
           <a href="{{ route('associacao.news.index') }}" 
       class="sidebar-item {{ request()->is('*noticias*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="newspaper" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Notícias</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*posts*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

            <!-- Products -->
             <a href="{{ route('associacao.products.index') }}" 
       class="sidebar-item {{ request()->is('*products*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="package" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Produtos</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*products*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Planos -->
    <a href="{{ route('associacao.plans.index') }}" 
       class="sidebar-item {{ request()->is('*plans*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="credit-card" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Planos</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*plans*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Banners -->
    <a href="{{ route('associacao.banners.index') }}" 
       class="sidebar-item {{ request()->is('*banners*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="image" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Banners</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*banners*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Vendas -->
    <a href="{{ route('associacao.vendas.index') }}" 
       class="sidebar-item {{ request()->is('*vendas*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Vendas</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*sales*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Financeiro -->
    <a href="{{ route('associacao.financeiro.index') }}" 
       class="sidebar-item {{ request()->is('*financeiro*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="dollar-sign" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Financeiro</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*financial*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Relatórios -->
    <a href="{{ route('associacao.relatorios.index') }}" 
       class="sidebar-item {{ request()->is('*relatorios*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="bar-chart-2" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Relatórios</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*reports*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>

    <!-- Configurações -->
    <a href="{{ route('associacao.configuracoes.edit') }}" 
       class="sidebar-item {{ request()->is('*configuracoes*') ? 'active' : '' }} group flex items-center space-x-3 px-4 py-3.5 rounded-2xl text-sm font-medium transition-all duration-300 hover:bg-white/8 relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
        <div class="flex items-center space-x-3 relative z-10">
            <div class="w-9 h-9 flex items-center justify-center rounded-xl bg-white/10 group-hover:bg-emerald-500/25 transition-all duration-300 group-hover:scale-110">
                <i data-lucide="settings" class="w-4.5 h-4.5"></i>
            </div>
            <span class="font-medium">Configurações</span>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 via-teal-500/15 to-emerald-600/20 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        @if(request()->is('*settings*'))
            <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-emerald-400 rounded-r-full"></div>
        @endif
    </a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-slate-700/40 bg-gradient-to-r from-slate-800/80 via-slate-800/60 to-slate-800/80 backdrop-blur-sm">
        <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-3 rounded-2xl hover:bg-white/10 transition-all duration-300 group relative overflow-hidden focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
            <!-- Profile Avatar -->
            <div class="relative">
                <div class="w-11 h-11 bg-gradient-to-br from-emerald-400 via-emerald-500 to-teal-600 rounded-2xl flex items-center justify-center flex-shrink-0 shadow-lg ring-2 ring-emerald-500/30 group-hover:ring-emerald-400/50 transition-all duration-300">
                    <span class="text-sm font-bold text-white">AD</span>
                </div>
                <!-- Online status -->
                <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-emerald-400 border-2 border-slate-800 rounded-full"></div>
            </div>
            
            <!-- User Info -->
            <div class="flex-1 min-w-0 text-left relative z-10">
                <p class="text-sm font-semibold text-white truncate group-hover:text-emerald-100 transition-colors duration-300">Admin User</p>
                <div class="flex items-center space-x-2">
                    <div class="w-1.5 h-1.5 bg-emerald-400 rounded-full"></div>
                    <p class="text-xs text-emerald-400 truncate font-medium">Administrador</p>
                </div>
            </div>
            
            <!-- Expand Arrow -->
            <div class="relative z-10">
                <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 group-hover:text-emerald-400 transition-all duration-300 group-hover:translate-x-1"></i>
            </div>
            
            <!-- Hover effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 to-teal-600/10 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-2xl"></div>
        </button>
    </div>
</div>

<script>
// Initialize Lucide icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

// Enhanced mobile functionality
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
/* Enhanced Custom Styles */
.scrollbar-thin::-webkit-scrollbar {
    width: 6px;
}

.scrollbar-thin::-webkit-scrollbar-track {
    background: transparent;
}

.scrollbar-thin::-webkit-scrollbar-thumb {
    background: rgba(71, 85, 105, 0.5);
    border-radius: 3px;
}

.scrollbar-thin::-webkit-scrollbar-thumb:hover {
    background: rgba(71, 85, 105, 0.7);
}

/* Active state enhanced styling */
.sidebar-item.active {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.25), rgba(20, 184, 166, 0.15));
    box-shadow: 
        0 0 0 1px rgba(16, 185, 129, 0.2),
        0 4px 12px rgba(16, 185, 129, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.sidebar-item.active .w-9 {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.4), rgba(20, 184, 166, 0.3));
    color: #10b981;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.sidebar-item.active span {
    color: #10b981;
    font-weight: 600;
}

/* Smooth hover animations */
.sidebar-item:hover {
    transform: translateX(3px);
}

.sidebar-item:hover .w-9 {
    transform: scale(1.1) rotate(1deg);
}

/* Focus styles for accessibility */
.sidebar-item:focus-visible {
    outline: none;
    box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.5);
}

/* Mobile optimizations */
@media (max-width: 1024px) {
    .sidebar-item:hover {
        transform: none;
    }
    
    .sidebar-item:hover .w-9 {
        transform: scale(1.05);
    }
}

/* Loading animation for icons */
.w-9 i {
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Badge animations */
.sidebar-item span:last-child {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.8;
    }
}

/* Backdrop blur fallback */
@supports not (backdrop-filter: blur(4px)) {
    #sidebar-overlay {
        background: rgba(0, 0, 0, 0.8);
    }
}
</style>