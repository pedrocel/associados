@extends('layouts.app')

@section('title', 'Dashboard - AssociaMe')
@section('page-title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-blue-50 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5 text-blue-600 dark:text-blue-400"></i>
                </div>
                <span class="text-xs text-green-600 dark:text-green-400 font-medium">+0%</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Total de Usuários</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-purple-50 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                    <i data-lucide="user-check" class="w-5 h-5 text-purple-600 dark:text-purple-400"></i>
                </div>
                <span class="text-xs text-green-600 dark:text-green-400 font-medium">+8%</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Membros Ativos</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">{{ $totalMembers }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                    <i data-lucide="wallet" class="w-5 h-5 text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <span class="text-xs text-green-600 dark:text-green-400 font-medium">+24%</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Receita Total</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">R$ {{ number_format($totalRevenue, 2, ',', '.') }}</p>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between mb-3">
                <div class="w-10 h-10 bg-amber-50 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                    <i data-lucide="credit-card" class="w-5 h-5 text-amber-600 dark:text-amber-400"></i>
                </div>
                <span class="text-xs text-amber-600 dark:text-amber-400 font-medium">5 pendentes</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Aguardando confirmação</p>
            <p class="text-2xl font-semibold text-slate-900 dark:text-white">R$ {{ number_format($pendingRevenue, 2, ',', '.') }}</p>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-gray-700">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                    <i data-lucide="funnel" class="w-5 h-5 text-indigo-600 dark:text-indigo-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Funil de Onboarding</h3>
                    <p class="text-sm text-slate-600 dark:text-gray-400">Acompanhe o progresso dos novos membros</p>
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-slate-50 dark:bg-gray-700/50 rounded-lg p-5 border border-slate-200 dark:border-gray-600">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="file-upload" class="w-4 h-4 text-rose-600 dark:text-rose-400"></i>
                    </div>
                    <span class="text-xs bg-slate-200 dark:bg-gray-600 text-slate-700 dark:text-gray-300 px-2 py-1 rounded-full font-medium">Etapa 1</span>
                </div>
                <h4 class="font-medium text-slate-900 dark:text-white mb-1">Documentos Pendentes</h4>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white mb-1">{{ $docsPendingUploadCount }}</p>
                <p class="text-xs text-slate-600 dark:text-gray-400">Aguardando upload</p>
            </div>

            <div class="bg-slate-50 dark:bg-gray-700/50 rounded-lg p-5 border border-slate-200 dark:border-gray-600">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="search" class="w-4 h-4 text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <span class="text-xs bg-slate-200 dark:bg-gray-600 text-slate-700 dark:text-gray-300 px-2 py-1 rounded-full font-medium">Etapa 2</span>
                </div>
                <h4 class="font-medium text-slate-900 dark:text-white mb-1">Aguardando Análise</h4>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white mb-1">{{ $docsUnderReviewCount }}</p>
                <p class="text-xs text-slate-600 dark:text-gray-400">Em revisão</p>
            </div>

            <div class="bg-slate-50 dark:bg-gray-700/50 rounded-lg p-5 border border-slate-200 dark:border-gray-600">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="credit-card" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <span class="text-xs bg-slate-200 dark:bg-gray-600 text-slate-700 dark:text-gray-300 px-2 py-1 rounded-full font-medium">Etapa 3</span>
                </div>
                <h4 class="font-medium text-slate-900 dark:text-white mb-1">Pagamento Pendente</h4>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white mb-1">{{ $paymentPendingCount }}</p>
                <p class="text-xs text-slate-600 dark:text-gray-400">Aguardando pagamento</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-slate-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                            <i data-lucide="activity" class="w-4 h-4 text-emerald-600 dark:text-emerald-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Atividade Recente</h3>
                    </div>
                    <a href="#" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 text-sm font-medium">Ver todas</a>
                </div>
            </div>
            
            <div class="p-6">
                <ul role="list" class="divide-y divide-slate-200 dark:divide-gray-700">
                    @forelse($recentSales as $sale)
                    <li class="py-3">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-50 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                    <i data-lucide="credit-card" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-slate-900 dark:text-white">
                                        Venda do Plano: {{ $sale->plan->name }}
                                    </p>
                                    <p class="text-xs text-slate-600 dark:text-gray-400">
                                        Cliente: {{ $sale->user->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    + R$ {{ number_format($sale->total_price, 2, ',', '.') }}
                                </p>
                                <p class="text-xs text-slate-500 dark:text-gray-500">
                                    {{ $sale->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="py-4 text-center text-slate-500 dark:text-gray-400">
                        Nenhuma venda recente.
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="space-y-4">
            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="newspaper" class="w-5 h-5 text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Notícias Publicadas</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white mb-2">{{ $publishedNews }}</p>
                <p class="text-xs text-green-600 dark:text-green-400">+3 esta semana</p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow-sm border border-slate-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-emerald-50 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="award" class="w-5 h-5 text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                </div>
                <p class="text-sm text-slate-600 dark:text-gray-400 mb-1">Planos Ativos</p>
                <p class="text-2xl font-semibold text-slate-900 dark:text-white mb-2">{{ $activePlans }} / {{ $totalPlans }}</p>
                
                @php
                    $percentage = $totalPlans > 0 ? ($activePlans / $totalPlans) * 100 : 0;
                @endphp
                
                <div class="w-full bg-slate-200 dark:bg-gray-700 rounded-full h-2 mb-2">
                    <div class="bg-emerald-600 dark:bg-emerald-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
                
                <p class="text-xs text-slate-600 dark:text-gray-400">{{ number_format($percentage, 0) }}% dos planos ativos</p>
            </div>

            <div class="bg-emerald-600 dark:bg-emerald-700 rounded-xl p-5 text-white">
                <div class="flex items-center space-x-3 mb-3">
                    <div class="w-8 h-8 bg-white/20 rounded-lg flex items-center justify-center">
                        <i data-lucide="zap" class="w-4 h-4 text-white"></i>
                    </div>
                    <h4 class="font-semibold">Performance</h4>
                </div>
                <p class="text-xl font-semibold mb-1">Excelente</p>
                <p class="text-sm text-emerald-100 dark:text-emerald-200 mb-3">Todos os sistemas funcionando perfeitamente</p>
                <a href="#" class="inline-block bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    Ver Detalhes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
