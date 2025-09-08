@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 mb-6">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('associacao.news.index') }}" 
                       class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Voltar às Notícias
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('associacao.news.edit', $news) }}" 
                       class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                        Editar
                    </a>
                    <form action="{{ route('associacao.news.destroy', $news) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Tem certeza que deseja excluir esta notícia?')"
                                class="inline-flex items-center px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                            Excluir
                        </button>
                    </form>
                </div>
            </div>

            <!-- Status e Ações Rápidas -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                        {{ $news->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                           ($news->status === 'draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                           'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200') }}">
                        <i data-lucide="{{ $news->status === 'published' ? 'eye' : ($news->status === 'draft' ? 'edit' : 'archive') }}" 
                           class="w-3 h-3 mr-1"></i>
                        {{ ucfirst($news->status) }}
                    </span>

                    @if($news->is_featured)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                            <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                            Destaque
                        </span>
                    @endif

                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        <i data-lucide="eye" class="w-4 h-4 inline mr-1"></i>
                        {{ $news->views }} visualizações
                    </span>
                </div>

                <div class="flex items-center space-x-2">
                    @if($news->status === 'draft')
                        <form action="{{ route('associacao.news.toggle-publish', $news) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
                                <i data-lucide="send" class="w-3 h-3 mr-1"></i>
                                Publicar
                            </button>
                        </form>
                    @elseif($news->status === 'published')
                        <form action="{{ route('associacao.news.toggle-publish', $news) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors">
                                <i data-lucide="eye-off" class="w-3 h-3 mr-1"></i>
                                Despublicar
                            </button>
                        </form>
                    @endif

                    @if($news->is_featured)
                        <form action="{{ route('associacao.news.toggle-featured', $news) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition-colors">
                                <i data-lucide="star-off" class="w-3 h-3 mr-1"></i>
                                Remover Destaque
                            </button>
                        </form>
                    @else
                        <form action="{{ route('associacao.news.toggle-featured', $news) }}" method="POST" class="inline-block">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-600 text-white text-xs font-medium rounded hover:bg-purple-700 transition-colors">
                                <i data-lucide="star" class="w-3 h-3 mr-1"></i>
                                Destacar
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Conteúdo Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Artigo -->
        <div class="lg:col-span-2">
            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                <!-- Imagem Destacada -->
                @if($news->featured_image)
                    <div class="aspect-video w-full overflow-hidden rounded-t-lg">
                        <img src="{{ Storage::url($news->featured_image) }}" 
                             alt="{{ $news->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-6">
                    <!-- Título -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $news->title }}
                    </h1>

                    <!-- Meta Informações -->
                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                            {{ $news->author->name }}
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                            {{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : $news->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                            {{ $news->reading_time }} min de leitura
                        </div>
                    </div>

                    <!-- Resumo -->
                    @if($news->summary)
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                            <p class="text-gray-700 dark:text-gray-300 font-medium">
                                {{ $news->summary }}
                            </p>
                        </div>
                    @endif

                    <!-- Conteúdo -->
                    <div class="prose prose-lg max-w-none dark:prose-invert">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags && count($news->tags) > 0)
                        <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white mb-3">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($news->tags as $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        <i data-lucide="tag" class="w-3 h-3 mr-1"></i>
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informações da Notícia -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i data-lucide="info" class="w-5 h-5 inline mr-2"></i>
                    Informações
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Criado em:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $news->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Atualizado em:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $news->updated_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                    @if($news->published_at)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-500 dark:text-gray-400">Publicado em:</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $news->published_at->format('d/m/Y H:i') }}
                            </span>
                        </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Visualizações:</span>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ number_format($news->views) }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500 dark:text-gray-400">Slug:</span>
                        <span class="text-sm font-mono text-gray-900 dark:text-white">
                            {{ $news->slug }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Preview Público -->
            @if($news->status === 'published')
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                        <i data-lucide="external-link" class="w-5 h-5 inline mr-2"></i>
                        Preview Público
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Veja como esta notícia aparece para os clientes:
                    </p>
                    <a href="#" 
                       target="_blank"
                       class="inline-flex items-center w-full justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        Ver como Cliente
                    </a>
                </div>
            @endif

            <!-- Ações Rápidas -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i data-lucide="zap" class="w-5 h-5 inline mr-2"></i>
                    Ações Rápidas
                </h3>
                <div class="space-y-2">
                    <a href="{{ route('associacao.news.edit', $news) }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="edit" class="w-4 h-4 mr-3"></i>
                        Editar Notícia
                    </a>
                    <a href="{{ route('associacao.news.create') }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="plus" class="w-4 h-4 mr-3"></i>
                        Nova Notícia
                    </a>
                    <a href="{{ route('associacao.news.index') }}" 
                       class="flex items-center w-full px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i data-lucide="list" class="w-4 h-4 mr-3"></i>
                        Todas as Notícias
                    </a>
                </div>
            </div>

            <!-- Estatísticas -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    <i data-lucide="bar-chart" class="w-5 h-5 inline mr-2"></i>
                    Estatísticas
                </h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Palavras</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ str_word_count(strip_tags($news->content)) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Caracteres</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ strlen(strip_tags($news->content)) }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-purple-500 rounded-full mr-2"></div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">Tempo de leitura</span>
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">
                            {{ $news->reading_time }} min
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Confirmar exclusão
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForm = document.querySelector('form[action*="destroy"]');
        if (deleteForm) {
            deleteForm.addEventListener('submit', function(e) {
                if (!confirm('Tem certeza que deseja excluir esta notícia? Esta ação não pode ser desfeita.')) {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endpush
@endsection
