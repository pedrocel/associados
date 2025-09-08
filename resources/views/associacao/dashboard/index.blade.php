@extends('layouts.app')

@section('title', 'Dashboard - AssociaMe')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">
    <div class="relative bg-gradient-to-br from-emerald-500 via-teal-600 to-cyan-700 rounded-3xl p-8 shadow-2xl overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl -translate-y-48 translate-x-48"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-emerald-300 rounded-full blur-2xl translate-y-36 -translate-x-36"></div>
        </div>
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div>
                <div class="flex items-center space-x-4 mb-4">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center border border-white/20">
                        <i data-lucide="layout-dashboard" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-1">Dashboard</h1>
                        <p class="text-emerald-100 text-lg">Bem-vindo de volta! Aqui está o resumo da sua associação</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-6 text-white/90">
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-emerald-300 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium">Sistema Online</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span class="text-sm" id="current-time"></span>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="#" class="inline-flex items-center justify-center space-x-2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:scale-105 border border-white/20 group">
                    <i data-lucide="plus" class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300"></i>
                    <span>Novo Conteúdo</span>
                </a>
                <a href="#" class="inline-flex items-center justify-center space-x-2 bg-white text-emerald-600 hover:bg-emerald-50 px-6 py-3 rounded-2xl font-medium transition-all duration-300 hover:scale-105 shadow-lg">
                    <i data-lucide="download" class="w-5 h-5"></i>
                    <span>Relatório</span>
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="users" class="w-7 h-7 text-white"></i>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-1 text-green-600 dark:text-green-400">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">+12%</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Total de Usuários</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalUsers }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">+23 este mês</p>
            </div>
        </div>

        <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="user-check" class="w-7 h-7 text-white"></i>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-1 text-green-600 dark:text-green-400">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">+8%</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Membros Ativos</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $totalMembers }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">+15 este mês</p>
            </div>
        </div>

        <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="wallet" class="w-7 h-7 text-white"></i>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-1 text-green-600 dark:text-green-400">
                        <i data-lucide="trending-up" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">+24%</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Receita Total</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">+R$ 8.450 este mês</p>
            </div>
        </div>

        <div class="group bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <i data-lucide="credit-card" class="w-7 h-7 text-white"></i>
                </div>
                <div class="text-right">
                    <div class="flex items-center space-x-1 text-amber-600 dark:text-amber-400">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span class="text-sm font-medium">5 pendentes</span>
                    </div>
                </div>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Pagamentos Pendentes</p>
                <p class="text-3xl font-bold text-slate-900 dark:text-white">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Aguardando confirmação</p>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-200 dark:border-slate-700">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="funnel" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Funil de Onboarding</h3>
                    <p class="text-sm text-slate-600 dark:text-slate-400">Acompanhe o progresso dos novos membros</p>
                </div>
            </div>
            <a href="#" class="text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white transition-colors">
                <i data-lucide="more-horizontal" class="w-5 h-5"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="relative">
                <div class="bg-gradient-to-br from-rose-50 to-pink-50 dark:from-rose-900/20 dark:to-pink-900/20 rounded-2xl p-6 border border-rose-200 dark:border-rose-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-rose-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="file-upload" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-xs bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-300 px-3 py-1 rounded-full font-medium">Etapa 1</span>
                    </div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Documentos Pendentes</h4>
                    <p class="text-2xl font-bold text-rose-600 dark:text-rose-400 mb-2">{{ $docsPendingUploadCount }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Aguardando upload</p>
                </div>
                <div class="hidden sm:block absolute top-1/2 -right-3 w-6 h-0.5 bg-slate-300 dark:bg-slate-600"></div>
            </div>

            <div class="relative">
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-2xl p-6 border border-amber-200 dark:border-amber-800">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center">
                            <i data-lucide="search" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-xs bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 px-3 py-1 rounded-full font-medium">Etapa 2</span>
                    </div>
                    <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Aguardando Análise</h4>
                    <p class="text-2xl font-bold text-amber-600 dark:text-amber-400 mb-2">{{ $docsUnderReviewCount }}</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Em revisão</p>
                </div>
                <div class="hidden sm:block absolute top-1/2 -right-3 w-6 h-0.5 bg-slate-300 dark:bg-slate-600"></div>
            </div>

            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-2xl p-6 border border-emerald-200 dark:border-emerald-800">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xs bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 px-3 py-1 rounded-full font-medium">Etapa 3</span>
                </div>
                <h4 class="font-semibold text-slate-900 dark:text-white mb-1">Pagamento Pendente</h4>
                <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mb-2">{{ $paymentPendingCount }}</p>
                <p class="text-xs text-slate-600 dark:text-slate-400">Aguardando pagamento</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-800 dark:to-slate-700 px-6 py-4 border-b border-slate-200 dark:border-slate-600">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center">
                            <i data-lucide="activity" class="w-4 h-4 text-white"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Atividade Recente</h3>
                    </div>
                    <a href="#" class="text-emerald-600 hover:text-emerald-700 text-sm font-medium">Ver todas</a>
                </div>
            </div>
            
            <div class="p-6">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentSales as $sale)
                    <li class="py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-100 dark:bg-green-900/20 rounded-lg flex items-center justify-center">
                                    <i data-lucide="credit-card" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">
                                        Venda do Plano: {{ $sale->plan->name }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Cliente: {{ $sale->user->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-green-600">
                                    + R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $sale->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-4 text-center text-gray-500 dark:text-gray-400">
                        Nenhuma venda recente.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="newspaper" class="w-6 h-6 text-white"></i>
                    </div>
                    <a href="#" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Notícias Publicadas</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white mb-2">{{ $publishedNews }}</p>
                    <div class="flex items-center text-xs text-emerald-600 dark:text-emerald-400">
                        <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i>
                        <span>+3 esta semana</span>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="award" class="w-6 h-6 text-white"></i>
                    </div>
                    <a href="#" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                    </a>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Planos Ativos</p>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white mb-2">{{ $activePlans }} / {{ $totalPlans }}</p>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2 mb-2">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-600 h-2 rounded-full" style="width: {{ ($activePlans / $totalPlans) * 100 }}%"></div>
                    </div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ number_format(($activePlans / $totalPlans) * 100, 0) }}% dos planos ativos</p>
                </div>
            </div>

            <div class="bg-gradient-to-br from-violet-500 via-purple-600 to-indigo-700 rounded-2xl p-6 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -translate-y-16 translate-x-16"></div>
                <div class="relative z-10">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                        </div>
                        <h4 class="font-bold">Performance</h4>
                    </div>
                    <p class="text-2xl font-bold mb-2">Excelente</p>
                    <p class="text-sm text-violet-100 mb-4">Todos os sistemas funcionando perfeitamente</p>
                    <a href="#" class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-xl text-sm font-medium transition-all duration-300 border border-white/20">
                        Ver Detalhes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Initialize Lucide icons
document.addEventListener('DOMContentLoaded', function() {
    // Update current time
    // Add smooth animations for cards
    const cards = document.querySelectorAll('[class*="group"]');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '0';
                entry.target.style.transform = 'translateY(20px)';
                entry.target.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Add click animations
    document.querySelectorAll('a, button').forEach(el => {
        el.addEventListener('click', function(e) {
            const ripple = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
});
</script>

<style>
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: transparent;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.5);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(148, 163, 184, 0.7);
    }

    /* Smooth transitions */
    * {
        transition: color 0.2s ease, background-color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
    }
</style>
@endpush
@endsection