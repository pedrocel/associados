@extends('layouts.mobile-app')

@section('title', 'Dashboard - Cliente')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Olá, ' . (auth()->user()->name ? explode(' ', auth()->user()->name)[0] : 'Cliente'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800 pt-6 pb-24">
    <div class="max-w-4xl mx-auto px-4 space-y-6">
        
        <!-- Premium Header Card with Gradient -->
        <div class="relative overflow-hidden rounded-3xl shadow-lg border border-blue-200/50 dark:border-blue-900/30">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-blue-500 to-indigo-600 dark:from-blue-700 dark:via-blue-600 dark:to-indigo-700"></div>
            <div class="absolute inset-0 opacity-10 mix-blend-overlay" style="background-image: url('data:image/svg+xml,<svg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"><g fill=\"none\" fill-rule=\"evenodd\"><g fill=\"%23ffffff\" fill-opacity=\"0.1\"><path d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/></g></g></svg>')"></div>
            
            <div class="relative p-8 text-white">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-2xl flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold">{{ auth()->user()->name ? explode(' ', auth()->user()->name)[0] : 'Cliente' }}</h1>
                            <p class="text-blue-100 text-sm">{{ auth()->user()->association->name ?? 'Associação Profissional' }}</p>
                        </div>
                    </div>
                    
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center font-bold text-white text-lg shadow-lg border border-white/30">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                    </div>
                </div>
                
                <!-- Quick Stats Row -->
                <div class="grid grid-cols-3 gap-3 pt-4 border-t border-white/20">
                    <div class="text-center py-2">
                        <div class="text-2xl font-bold">{{ auth()->user()->documentations?->count() ?? 0 }}</div>
                        <div class="text-xs text-blue-100">Documentos</div>
                    </div>
                    <div class="text-center py-2">
                        <div class="text-2xl font-bold">{{ $upcomingEvents->count() ?? 0 }}</div>
                        <div class="text-xs text-blue-100">Eventos</div>
                    </div>
                    <div class="text-center py-2">
                        <div class="text-2xl font-bold">{{ $recentActivity->count() ?? 0 }}</div>
                        <div class="text-xs text-blue-100">Atividades</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest News Section - Only shows if news exists -->
        @if(isset($news) && $news->count() > 0)
        <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700/50 dark:to-slate-600/50 px-8 py-6 border-b border-slate-200 dark:border-slate-700">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Últimas Notícias</h2>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Mantenha-se atualizado com as novidades</p>
                    </div>
                    <a href="#" class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-full text-sm font-semibold transition-all hover:shadow-lg">
                        <span>Ver todas</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            
            <div class="grid gap-4 p-8 lg:grid-cols-2">
                @foreach($news->take(4) as $article)
                <article class="group cursor-pointer relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-blue-300 dark:hover:border-blue-600 transition-all hover:shadow-lg hover:-translate-y-1">
                    <div class="flex space-x-4 h-full">
                        @if($article->featured_image)
                        <div class="flex-shrink-0 w-24 h-24">
                            <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        </div>
                        @else
                        <div class="flex-shrink-0 w-24 h-24 bg-gradient-to-br from-blue-100 to-indigo-200 dark:from-blue-900/30 dark:to-indigo-900/30 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2v-5.5a2 2 0 012-2H20"/>
                            </svg>
                        </div>
                        @endif
                        
                        <div class="flex-1 p-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center space-x-2 mb-2">
                                    @if($article->category)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300 uppercase tracking-wide">
                                        {{ $article->category }}
                                    </span>
                                    @endif
                                    <span class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $article->created_at->format('d/m/Y') }}
                                    </span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 line-clamp-2 mb-1 transition-colors">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 line-clamp-2">
                                    {{ Str::limit(strip_tags($article->content), 80) }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-2 pt-2 border-t border-slate-100 dark:border-slate-700">
                                <span class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $article->author->name ?? 'Admin' }}
                                </span>
                                @if($article->views_count)
                                <div class="flex items-center space-x-1 text-xs text-slate-500 dark:text-slate-400">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
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
        @endif

        <!-- Events and Activity Grid - Only shows sections if data exists -->
        <div class="grid lg:grid-cols-2 gap-6">
            <!-- Upcoming Events - Only shows if events exist -->
            @if(isset($upcomingEvents) && $upcomingEvents->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-slate-700/50 dark:to-slate-600/50 px-8 py-6 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">📅 Próximos Eventos</h2>
                </div>
                
                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($upcomingEvents as $event)
                    <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="text-center bg-gradient-to-br from-purple-100 to-pink-100 dark:from-purple-900/30 dark:to-pink-900/30 rounded-2xl p-3 min-w-[60px]">
                                <div class="text-lg font-bold text-slate-900 dark:text-white">{{ $event->event_date->format('d') }}</div>
                                <div class="text-xs text-slate-600 dark:text-slate-400 font-semibold">{{ $event->event_date->format('M') }}</div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 12H9m6 0a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <h3 class="font-bold text-slate-900 dark:text-white group-hover:text-purple-600 transition-colors">{{ $event->title }}</h3>
                                </div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ $event->description }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <span>{{ $event->event_time ?? 'Horário não definido' }}</span>
                                </p>
                                @if($event->location)
                                <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 flex items-center space-x-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $event->location }}</span>
                                </p>
                                @endif
                            </div>
                            <svg class="w-5 h-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <!-- Empty state for no events -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 dark:from-slate-700/50 dark:to-slate-600/50 px-8 py-6 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">📅 Próximos Eventos</h2>
                </div>
                <div class="p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Nenhum evento próximo agendado</p>
                </div>
            </div>
            @endif

            <!-- Recent Activity - Only shows if activities exist -->
            @if(isset($recentActivity) && $recentActivity->count() > 0)
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-slate-700/50 dark:to-slate-600/50 px-8 py-6 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white">🔔 Atividade Recente</h2>
                        <div class="inline-flex items-center space-x-1 text-xs bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 px-3 py-1 rounded-full font-semibold">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                            </span>
                            <span>{{ $recentActivity->count() }} novas</span>
                        </div>
                    </div>
                </div>
                
                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($recentActivity as $activity)
                    <div class="p-6 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="w-3 h-3 rounded-full flex-shrink-0" style="background-color: {{ $activity->color ?? '#3b82f6' }};"></div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $activity->icon ?? '•' }} {{ $activity->title }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                @if($activity->description)
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">{{ $activity->description }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <!-- Empty state for no activities -->
            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-lg border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-slate-700/50 dark:to-slate-600/50 px-8 py-6 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">🔔 Atividade Recente</h2>
                </div>
                <div class="p-8 text-center">
                    <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Nenhuma atividade recente</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Quick Actions Section -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('cliente.documentos.index') }}" class="group bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <div class="font-semibold text-sm">Documentos</div>
            </a>
            
            <a href="#" class="group bg-gradient-to-br from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                <div class="font-semibold text-sm">Configurações</div>
            </a>
            
            <a href="#" class="group bg-gradient-to-br from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0018 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                <div class="font-semibold text-sm">Notificações</div>
            </a>
            
            <a href="#" class="group bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 text-center">
                <svg class="w-8 h-8 mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <div class="font-semibold text-sm">Suporte</div>
            </a>
        </div>
    </div>
</div>

<!-- Enhanced Bottom Navigation for Mobile -->
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 px-6 py-2 backdrop-blur-lg bg-white/80 dark:bg-slate-800/80">
    <div class="flex items-center justify-around max-w-4xl mx-auto">
        <a href="{{ route('cliente.dashboard') }}" class="flex flex-col items-center space-y-1 py-3 px-4 rounded-xl text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-900/20 transition-all">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 4v4m0 0v4m0-4h4m-4 0H9"/></svg>
            <span class="text-xs font-semibold">Início</span>
        </a>
        <a href="#" class="flex flex-col items-center space-y-1 py-3 px-4 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all hover:bg-slate-100 dark:hover:bg-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            <span class="text-xs font-semibold">Eventos</span>
        </a>
        <a href="#" class="flex flex-col items-center space-y-1 py-3 px-4 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all hover:bg-slate-100 dark:hover:bg-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2v-5.5a2 2 0 012-2H20"/></svg>
            <span class="text-xs font-semibold">Notícias</span>
        </a>
        <a href="#" class="flex flex-col items-center space-y-1 py-3 px-4 rounded-xl text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-200 transition-all hover:bg-slate-100 dark:hover:bg-slate-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <span class="text-xs font-semibold">Mensagens</span>
        </a>
    </div>
</nav>
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
