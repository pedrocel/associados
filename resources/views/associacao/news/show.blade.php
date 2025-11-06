@extends('layouts.app')

@section('title', $news->title . ' - Portal de Notícias')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <div class="flex items-center space-x-2 text-sm">
            <a href="{{ route('associacao.news.index') }}" class="text-green-600 dark:text-green-400 hover:underline flex items-center space-x-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar às Notícias</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Conteúdo Principal -->
        <div class="lg:col-span-2">
            <article class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg">
                <!-- Imagem Destacada -->
                @if($news->featured_image)
                    <div class="aspect-video w-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                        <img src="{{ Storage::url($news->featured_image) }}" 
                             alt="{{ $news->title }}"
                             class="w-full h-full object-cover">
                    </div>
                @endif

                <div class="p-8 lg:p-10">
                    <!-- Badges e Status -->
                    <div class="flex flex-wrap items-center gap-3 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        @if($news->is_featured)
                            <span class="inline-flex items-center space-x-1 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">
                                <i data-lucide="star" class="w-3 h-3"></i>
                                <span>DESTAQUE</span>
                            </span>
                        @endif
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $news->status === 'published' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300' : 
                               'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300' }}">
                            {{ $news->status === 'published' ? 'Publicado' : 'Rascunho' }}
                        </span>
                    </div>

                    <!-- Título -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                        {{ $news->title }}
                    </h1>

                    <!-- Meta Informações do Autor -->
                    <div class="flex flex-col sm:flex-row sm:items-center gap-6 mb-8 pb-8 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center space-x-4 text-sm text-gray-600 dark:text-gray-400">
                            <div class="flex items-center space-x-1">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                                <span>{{ $news->published_at ? $news->published_at->format('d \d\e M \d\e Y') : $news->created_at->format('d \d\e M \d\e Y') }}</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                                <span>{{ $news->reading_time ?? '5' }} min de leitura</span>
                            </div>
                            <div class="flex items-center space-x-1">
                                <i data-lucide="eye" class="w-4 h-4"></i>
                                <span>{{ $news->views_count ?? 0 }} visualizações</span>
                            </div>
                        </div>
                    </div>

                    <!-- Conteúdo Principal -->
                    <div class="prose prose-lg max-w-none dark:prose-invert
                        [&>h1]:text-gray-900 dark:[&>h1]:text-white [&>h1]:font-bold [&>h1]:mt-8 [&>h1]:mb-4
                        [&>h2]:text-gray-800 dark:[&>h2]:text-gray-100 [&>h2]:font-bold [&>h2]:mt-8 [&>h2]:mb-4
                        [&>h3]:text-gray-800 dark:[&>h3]:text-gray-100 [&>h3]:font-semibold [&>h3]:mt-6 [&>h3]:mb-3
                        [&>p]:text-gray-700 dark:[&>p]:text-gray-300 [&>p]:leading-relaxed [&>p]:mb-4
                        [&>ul]:text-gray-700 dark:[&>ul]:text-gray-300 [&>ul]:space-y-2 [&>ul]:mb-4
                        [&>ol]:text-gray-700 dark:[&>ol]:text-gray-300 [&>ol]:space-y-2 [&>ol]:mb-4
                        [&>blockquote]:border-l-4 [&>blockquote]:border-green-500 [&>blockquote]:pl-4 [&>blockquote]:italic [&>blockquote]:text-gray-700 dark:[&>blockquote]:text-gray-300
                        [&>a]:text-green-600 dark:[&>a]:text-green-400 [&>a]:font-medium [&>a]:hover:underline">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags -->
                    @if($news->tags && count($news->tags) > 0)
                        <div class="mt-10 pt-8 border-t border-gray-200 dark:border-gray-700">
                            <h3 class="text-sm font-bold uppercase tracking-wide text-gray-900 dark:text-white mb-4">Tags da Notícia</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($news->tags as $tag)
                                    <a href="{{ route('associacao.news.index', ['search' => $tag]) }}"
                                       class="inline-flex items-center space-x-1 px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 transition-colors hover:bg-blue-200 dark:hover:bg-blue-900/50">
                                        <i data-lucide="tag" class="w-4 h-4"></i>
                                        <span>{{ $tag }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </article>

            <!-- Notícias Relacionadas -->
           
        </div>

        <!-- Sidebar Direita -->
        <div class="space-y-6">
            <!-- Card de Informações -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 sticky top-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center space-x-2">
                    <i data-lucide="info" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <span>Informações</span>
                </h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Criado em:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $news->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Atualizado em:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $news->updated_at->format('d/m/Y') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Palavras:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ str_word_count(strip_tags($news->content)) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Tempo leitura:</span>
                        <span class="font-medium text-gray-900 dark:text-white">{{ $news->reading_time ?? '5' }} min</span>
                    </div>
                </div>
            </div>

            <!-- Compartilhar -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center space-x-2">
                    <i data-lucide="share-2" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <span>Compartilhar</span>
                </h3>
                
                <div class="space-y-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('associacao.news.show', $news)) }}" 
                       target="_blank"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 dark:text-gray-300 transition-colors hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                        <span class="font-medium">Facebook</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('associacao.news.show', $news)) }}&text={{ urlencode($news->title) }}" 
                       target="_blank"
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 dark:text-gray-300 transition-colors hover:text-sky-600 hover:bg-sky-50 dark:hover:bg-sky-900/20">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                        <span class="font-medium">Twitter</span>
                    </a>
                    <button onclick="copyToClipboard('{{ route('associacao.news.show', $news) }}')"
                       class="w-full flex items-center space-x-3 p-3 rounded-lg text-gray-700 dark:text-gray-300 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700 text-left">
                        <i data-lucide="link" class="w-5 h-5"></i>
                        <span class="font-medium">Copiar Link</span>
                    </button>
                </div>
            </div>

            <!-- Ações -->
            <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center space-x-2">
                    <i data-lucide="zap" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
                    <span>Ações</span>
                </h3>
                
                <div class="space-y-2">
                    <a href="{{ route('associacao.news.index') }}" 
                       class="flex items-center space-x-3 p-3 rounded-lg text-gray-700 dark:text-gray-300 transition-colors hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i data-lucide="list" class="w-5 h-5"></i>
                        <span>Todas as Notícias</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Link copiado com sucesso!');
        }).catch(() => {
            alert('Erro ao copiar o link');
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
