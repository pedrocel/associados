@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Page Builder</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Gerencie as páginas de {{ $association->nome }}</p>
                </div>
                <div class="flex gap-3">
                    
                    <a href="{{ route('associations.pages.create', $association->slug) }}" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition">
                        <i data-lucide="plus" class="w-4 h-4 inline mr-2"></i>
                        Nova Página
                    </a>
                </div>
            </div>
        </div>

        <!-- Lista de Páginas -->
        @if($pages->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="file-text" class="w-8 h-8 text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Nenhuma página criada</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Comece criando sua primeira página personalizada</p>
                <a href="{{ route('associations.pages.create', $association->slug) }}" class="inline-block px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition">
                    Criar Primeira Página
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pages as $page)
                    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition">
                        <!-- Preview Thumbnail -->
                        <div class="h-48 bg-gradient-to-br from-purple-100 to-blue-100 dark:from-purple-900 dark:to-blue-900 flex items-center justify-center">
                            <i data-lucide="layout" class="w-16 h-16 text-purple-600 dark:text-purple-400"></i>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">{{ $page->name }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">/{{ $page->slug }}</p>
                                </div>
                                @if($page->is_home)
                                    <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs font-semibold rounded">Home</span>
                                @endif
                            </div>
                            
                            <div class="flex items-center gap-2 mb-4">
                                <span class="px-2 py-1 {{ $page->is_published ? 'bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }} text-xs font-semibold rounded">
                                    {{ $page->is_published ? 'Publicada' : 'Rascunho' }}
                                </span>
                                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 text-xs font-semibold rounded">
                                    {{ $page->type === 'builder' ? 'Builder' : 'HTML' }}
                                </span>
                            </div>
                            
                            <!-- Actions -->
                            <div class="flex gap-2">
                                <a href="{{ route('associations.pages.edit', [$association->slug, $page]) }}" class="flex-1 px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-center rounded-lg font-medium transition text-sm">
                                    <i data-lucide="edit" class="w-4 h-4 inline mr-1"></i>
                                    Editar
                                </a>
                                <a href="{{ route('associations.pages.preview', [$association->slug, $page]) }}" target="_blank" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition text-sm">
                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                </a>
                                <form action="{{ route('associations.pages.destroy', [$association->slug, $page]) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja deletar esta página?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-4 py-2 border border-red-300 dark:border-red-600 rounded-lg hover:bg-red-50 dark:hover:bg-red-900 text-red-600 dark:text-red-400 transition text-sm">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
@endsection
