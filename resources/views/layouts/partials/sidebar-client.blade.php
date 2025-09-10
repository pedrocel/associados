<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 hidden lg:hidden transition-all duration-300 opacity-0"></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed lg:relative w-72 bg-gray-900 text-white flex flex-col z-50 transform -translate-x-full lg:translate-x-0 transition-all duration-300 ease-out h-full border-r border-gray-800 shadow-2xl" data-theme="green">
    
    <!-- Header Section -->
    <div class="relative p-6 border-b border-gray-800">
        <div class="flex items-center justify-between relative z-10">
            <div class="flex items-center space-x-4">
                <!-- Logo Container -->
                <div class="relative group">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg transition-all duration-300 group-hover:scale-105 theme-accent">
                        <i data-lucide="zap" class="w-6 h-6 text-white"></i>
                    </div>
                </div>
                
                <!-- Brand Info -->
                <div>
                    <h1 class="text-lg font-bold text-white">AssociaçõesPro</h1>
                    <p class="text-xs text-gray-400">Portal do Membro</p>
                </div>
            </div>
            
            <!-- Close Button -->
            <button id="close-sidebar" class="lg:hidden p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all duration-200" aria-label="Fechar menu">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto" role="navigation">
        
        <!-- Dashboard -->
        <a href="#" class="sidebar-item active group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200 hover:bg-gray-800" aria-current="page">
            <i data-lucide="home" class="w-5 h-5 flex-shrink-0"></i>
            <span>Início</span>
        </a>

        <!-- News -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="newspaper" class="w-5 h-5 flex-shrink-0"></i>
            <span>Notícias</span>
            <span class="ml-auto bg-red-500 text-white text-xs px-2 py-1 rounded-full">3</span>
        </a>

        <!-- Events -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="calendar" class="w-5 h-5 flex-shrink-0"></i>
            <span>Eventos</span>
        </a>

        <!-- Documents -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0"></i>
            <span>Meus Documentos</span>
        </a>

        <!-- Financial -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="credit-card" class="w-5 h-5 flex-shrink-0"></i>
            <span>Financeiro</span>
        </a>

        <!-- Benefits -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="gift" class="w-5 h-5 flex-shrink-0"></i>
            <span>Benefícios</span>
        </a>

        <!-- Support -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="headphones" class="w-5 h-5 flex-shrink-0"></i>
            <span>Suporte</span>
        </a>

        <!-- Settings -->
        <a href="#" class="sidebar-item group flex items-center space-x-3 px-4 py-3 rounded-lg text-sm font-medium text-gray-300 hover:text-white hover:bg-gray-800 transition-all duration-200">
            <i data-lucide="settings" class="w-5 h-5 flex-shrink-0"></i>
            <span>Configurações</span>
        </a>
    </nav>

    <!-- User Profile Section -->
    <div class="p-4 border-t border-gray-800">
        <button id="user-profile-btn" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 transition-all duration-200 group">
            <!-- Profile Avatar -->
            <div class="relative">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-lg flex items-center justify-center shadow-lg theme-accent">
                    <span class="text-sm font-bold text-white">JS</span>
                </div>
                <!-- Online status -->
                <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-400 border-2 border-gray-900 rounded-full"></div>
            </div>
            
            <!-- User Info -->
            <div class="flex-1 min-w-0 text-left">
                <p class="text-sm font-medium text-white truncate">João Silva</p>
                <p class="text-xs text-gray-400 truncate">Membro Ativo</p>
            </div>
            
            <!-- Expand Arrow -->
            <i data-lucide="chevron-up" class="w-4 h-4 text-gray-400 group-hover:text-white transition-colors"></i>
        </button>
    </div>
</div>

<!-- User Profile Modal -->
<div id="user-profile-modal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl max-w-md w-full p-6 shadow-2xl transform transition-all">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Perfil do Usuário</h3>
                <button id="close-user-profile-modal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>
            
            <div class="text-center mb-6">
                <div class="w-20 h-20 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg theme-accent-modal">
                    <span class="text-2xl font-bold text-white">JS</span>
                </div>
                <h4 class="text-xl font-bold text-gray-900 dark:text-white">João Silva</h4>
                <p class="text-gray-500 dark:text-gray-400">Membro Ativo</p>
            </div>

            <!-- Theme Color Selection -->
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-gray-900 dark:text-white mb-3">Personalizar Cor do Tema</h4>
                <div class="grid grid-cols-5 gap-3">
                    <!-- Green -->
                    <button class="theme-color-btn w-12 h-12 rounded-xl shadow-lg transition-all duration-200 hover:scale-110 focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 bg-gradient-to-br from-emerald-500 to-emerald-600 active-theme" 
                            data-theme="green" title="Verde">
                        <i data-lucide="check" class="w-5 h-5 text-white mx-auto theme-check"></i>
                    </button>
                    
                    <!-- Blue -->
                    <button class="theme-color-btn w-12 h-12 rounded-xl shadow-lg transition-all duration-200 hover:scale-110 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 bg-gradient-to-br from-blue-500 to-blue-600" 
                            data-theme="blue" title="Azul">
                        <i data-lucide="check" class="w-5 h-5 text-white mx-auto theme-check hidden"></i>
                    </button>
                    
                    <!-- Purple -->
                    <button class="theme-color-btn w-12 h-12 rounded-xl shadow-lg transition-all duration-200 hover:scale-110 focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 bg-gradient-to-br from-purple-500 to-purple-600" 
                            data-theme="purple" title="Roxo">
                        <i data-lucide="check" class="w-5 h-5 text-white mx-auto theme-check hidden"></i>
                    </button>
                    
                    <!-- Orange -->
                    <button class="theme-color-btn w-12 h-12 rounded-xl shadow-lg transition-all duration-200 hover:scale-110 focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 bg-gradient-to-br from-orange-500 to-orange-600" 
                            data-theme="orange" title="Laranja">
                        <i data-lucide="check" class="w-5 h-5 text-white mx-auto theme-check hidden"></i>
                    </button>
                    
                    <!-- Pink -->
                    <button class="theme-color-btn w-12 h-12 rounded-xl shadow-lg transition-all duration-200 hover:scale-110 focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 bg-gradient-to-br from-pink-500 to-pink-600" 
                            data-theme="pink" title="Rosa">
                        <i data-lucide="check" class="w-5 h-5 text-white mx-auto theme-check hidden"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Escolha uma cor para personalizar seu painel</p>
            </div>

            <div class="space-y-3 mb-6">
                <button class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Editar Perfil</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Alterar informações pessoais</p>
                    </div>
                </button>
                
                <button class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Alterar Senha</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Segurança da conta</p>
                    </div>
                </button>
                
                <button class="w-full flex items-center space-x-3 p-3 text-left hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                    <i data-lucide="bell" class="w-5 h-5 text-gray-400"></i>
                    <div>
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Notificações</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Configurar alertas</p>
                    </div>
                </button>
            </div>

            <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                <button class="w-full flex items-center justify-center space-x-2 p-3 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                    <i data-lucide="log-out" class="w-5 h-5"></i>
                    <span class="font-medium">Sair da Conta</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

// Theme colors configuration
const themes = {
    green: {
        primary: 'from-emerald-500 to-emerald-600',
        light: 'from-emerald-400 to-emerald-600',
        focus: 'emerald-500'
    },
    blue: {
        primary: 'from-blue-500 to-blue-600',
        light: 'from-blue-400 to-blue-600',
        focus: 'blue-500'
    },
    purple: {
        primary: 'from-purple-500 to-purple-600',
        light: 'from-purple-400 to-purple-600',
        focus: 'purple-500'
    },
    orange: {
        primary: 'from-orange-500 to-orange-600',
        light: 'from-orange-400 to-orange-600',
        focus: 'orange-500'
    },
    pink: {
        primary: 'from-pink-500 to-pink-600',
        light: 'from-pink-400 to-pink-600',
        focus: 'pink-500'
    }
};

// Initialize sidebar functionality
function initializeSidebar() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');
    const closeSidebar = document.getElementById('close-sidebar');

    // Load saved theme
    const savedTheme = localStorage.getItem('sidebar-theme') || 'green';
    applyTheme(savedTheme);

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

    // Close sidebar on mobile when clicking menu items
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

// User profile modal functionality
function initializeUserProfile() {
    const userProfileBtn = document.getElementById('user-profile-btn');
    const userProfileModal = document.getElementById('user-profile-modal');
    const closeUserProfileModal = document.getElementById('close-user-profile-modal');

    function openUserProfileModal() {
        userProfileModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeUserProfileModalFunc() {
        userProfileModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    if (userProfileBtn) {
        userProfileBtn.addEventListener('click', openUserProfileModal);
    }
    
    if (closeUserProfileModal) {
        closeUserProfileModal.addEventListener('click', closeUserProfileModalFunc);
    }

    // Close modal on outside click
    if (userProfileModal) {
        userProfileModal.addEventListener('click', (e) => {
            if (e.target === userProfileModal) {
                closeUserProfileModalFunc();
            }
        });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (userProfileModal && !userProfileModal.classList.contains('hidden')) {
                closeUserProfileModalFunc();
            }
        }
    });
}

// Theme switching functionality
function initializeThemeSwitcher() {
    const themeButtons = document.querySelectorAll('.theme-color-btn');
    
    themeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const theme = button.dataset.theme;
            applyTheme(theme);
            localStorage.setItem('sidebar-theme', theme);
            
            // Update active theme button
            themeButtons.forEach(btn => {
                btn.classList.remove('active-theme');
                btn.querySelector('.theme-check').classList.add('hidden');
            });
            
            button.classList.add('active-theme');
            button.querySelector('.theme-check').classList.remove('hidden');
        });
    });
}

// Apply theme to sidebar and modal
function applyTheme(themeName) {
    const sidebar = document.getElementById('sidebar');
    const themeElements = document.querySelectorAll('.theme-accent');
    const themeModalElements = document.querySelectorAll('.theme-accent-modal');
    const activeItem = document.querySelector('.sidebar-item.active');
    
    if (sidebar) {
        sidebar.setAttribute('data-theme', themeName);
    }
    
    const theme = themes[themeName];
    
    // Update sidebar accent elements
    themeElements.forEach(element => {
        element.className = element.className.replace(/from-\w+-\d+\s+to-\w+-\d+/g, theme.primary);
        
        // Handle different element types
        if (element.classList.contains('w-12')) {
            element.className = `w-12 h-12 bg-gradient-to-br ${theme.primary} rounded-xl flex items-center justify-center shadow-lg transition-all duration-300 group-hover:scale-105 theme-accent`;
        } else if (element.classList.contains('w-10')) {
            element.className = `w-10 h-10 bg-gradient-to-br ${theme.light} rounded-lg flex items-center justify-center shadow-lg theme-accent`;
        }
    });
    
    // Update modal accent elements
    themeModalElements.forEach(element => {
        element.className = element.className.replace(/from-\w+-\d+\s+to-\w+-\d+/g, theme.light);
    });
    
    // Update active sidebar item
    if (activeItem) {
        const currentThemeColor = getThemeColor(themeName);
        activeItem.style.background = `linear-gradient(135deg, ${currentThemeColor}20, ${currentThemeColor}10)`;
        activeItem.style.borderLeft = `3px solid ${currentThemeColor}`;
    }
}

// Get theme color for active states
function getThemeColor(themeName) {
    const colorMap = {
        green: '#10b981',
        blue: '#3b82f6',
        purple: '#a855f7',
        orange: '#f97316',
        pink: '#ec4899'
    };
    return colorMap[themeName] || colorMap.green;
}

// Initialize everything when DOM is loaded
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        initializeSidebar();
        initializeUserProfile();
        initializeThemeSwitcher();
    });
} else {
    initializeSidebar();
    initializeUserProfile();
    initializeThemeSwitcher();
}
</script>

<style>
/* Clean sidebar styling */
.sidebar-item {
    position: relative;
    transition: all 0.2s ease;
}

.sidebar-item:hover {
    transform: translateX(2px);
}

.sidebar-item.active {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.1));
    border-left: 3px solid ${theme.primary};
    color: #10b981;
    font-weight: 600;
}

/* Theme color button styles */
.theme-color-btn {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.theme-color-btn:hover {
    transform: scale(1.1);
}

.theme-color-btn.active-theme {
    ring: 2px solid rgba(255, 255, 255, 0.5);
    transform: scale(1.1);
}

/* Scrollbar */
::-webkit-scrollbar {
    width: 6px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: rgba(75, 85, 99, 0.5);
    border-radius: 3px;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(75, 85, 99, 0.8);
}

/* Mobile optimizations */
@media (max-width: 1024px) {
    .sidebar-item:hover {
        transform: none;
    }
}

/* Focus states for accessibility */
.sidebar-item:focus-visible,
.theme-color-btn:focus-visible {
    outline: 2px solid #10b981;
    outline-offset: 2px;
}

/* Smooth transitions for theme changes */
.theme-accent,
.theme-accent-modal {
    transition: all 0.3s ease;
}
</style>