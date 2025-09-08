@extends('layouts.mobile-app')

@section('title', 'Dashboard - Cliente')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Olá, ' . (auth()->user()->name ? explode(' ', auth()->user()->name)[0] : 'Cliente'))

@section('content')
<div class="p-6 space-y-6">
    <!-- Mobile Header Card -->
    <div class="lg:hidden gradient-bg rounded-2xl p-6 text-white">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                <i data-lucide="zap" class="w-6 h-6 text-white"></i>
            </div>
            <div class="relative">
                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                    <span class="text-sm font-semibold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</span>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full flex items-center justify-center">
                    <span class="text-xs font-bold">3</span>
                </div>
            </div>
        </div>
        <div>
            <h1 class="text-2xl font-display font-bold mb-1">Olá, {{ auth()->user()->name ? explode(' ', auth()->user()->name)[0] : 'Cliente' }}</h1>
            <p class="text-green-100">{{ auth()->user()->association->name ?? 'Associação Profissional' }}</p>
        </div>
    </div>


    <!-- Adicionando seção de notícias ao dashboard -->
    <!-- Latest News Section -->
    @if(isset($news) && $news->count() > 0)
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
        <div class="p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Últimas Notícias</h2>
                <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium flex items-center space-x-1">
                    <span>Ver todas</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
            
            <div class="grid gap-4 lg:grid-cols-2">
                @foreach($news->take(4) as $article)
                <article class="card-hover group cursor-pointer">
                    <div class="flex space-x-4 p-4 rounded-xl border border-gray-100 dark:border-gray-700 hover:border-primary-200 dark:hover:border-primary-800 transition-colors">
                        @if($article->featured_image)
                        <div class="flex-shrink-0">
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-16 h-16 rounded-lg object-cover">
                        </div>
                        @else
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 dark:from-primary-900/20 dark:to-primary-800/20 rounded-lg flex items-center justify-center">
                                <i data-lucide="newspaper" class="w-6 h-6 text-primary-600"></i>
                            </div>
                        </div>
                        @endif
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                @if($article->category)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/20 dark:text-primary-300">
                                    {{ $article->category }}
                                </span>
                                @endif
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $article->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 line-clamp-2 mb-1">
                                {{ $article->title }}
                            </h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <div class="flex items-center justify-between mt-2">
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    Por {{ $article->author->name ?? 'Admin' }}
                                </span>
                                @if($article->views_count)
                                <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                    <i data-lucide="eye" class="w-3 h-3"></i>
                                    <span>{{ $article->views_count }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Stats and Events Grid -->
    <div class="grid lg:grid-cols-2 gap-6">
        <!-- Upcoming Events -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Próximos Eventos</h2>
                    <a href="#" class="text-primary-600 hover:text-primary-700 text-sm font-medium">Ver todos</a>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="text-center min-w-[48px]">
                            <div class="text-xl font-bold text-gray-900 dark:text-white">15</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase">Dez</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <i data-lucide="users" class="w-4 h-4 text-primary-600"></i>
                                <h3 class="font-medium text-gray-900 dark:text-white">Assembleia Geral</h3>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Reunião mensal dos associados</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">19:00</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    
                    <div class="flex items-center space-x-4 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="text-center min-w-[48px]">
                            <div class="text-xl font-bold text-gray-900 dark:text-white">22</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 uppercase">Dez</div>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-1">
                                <i data-lucide="credit-card" class="w-4 h-4 text-blue-600"></i>
                                <h3 class="font-medium text-gray-900 dark:text-white">Vencimento Taxa</h3>
                            </div>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Mensalidade de dezembro</p>
                            <p class="text-xs text-gray-400 dark:text-gray-500">23:59</p>
                        </div>
                        <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-display font-semibold text-gray-900 dark:text-white">Atividade Recente</h2>
                    <div class="flex items-center space-x-1 text-xs bg-primary-100 text-primary-800 dark:bg-primary-900/20 dark:text-primary-300 px-2 py-1 rounded-full">
                        <span>3 novas</span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Documento aprovado</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Há 2 horas</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Pagamento confirmado</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Há 1 dia</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="w-2 h-2 bg-gray-300 rounded-full"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-400">Nova mensagem recebida</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Há 3 dias</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation for Mobile -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 px-6 py-2">
        <div class="flex items-center justify-around">
            <a href="{{ route('cliente.dashboard') }}" class="flex flex-col items-center space-y-1 py-2 px-3 rounded-lg text-primary-600 bg-primary-50 dark:bg-primary-900/20">
                <i data-lucide="home" class="w-6 h-6"></i>
                <span class="text-xs font-medium">Início</span>
            </a>
            <a href="#" class="flex flex-col items-center space-y-1 py-2 px-3 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <i data-lucide="calendar" class="w-6 h-6"></i>
                <span class="text-xs font-medium">Eventos</span>
            </a>
            <a href="#" class="flex flex-col items-center space-y-1 py-2 px-3 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <i data-lucide="newspaper" class="w-6 h-6"></i>
                <span class="text-xs font-medium">Notícias</span>
            </a>
            <a href="#" class="flex flex-col items-center space-y-1 py-2 px-3 rounded-lg text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
                <span class="text-xs font-medium">Mensagens</span>
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
