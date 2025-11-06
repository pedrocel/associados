@extends('layouts.app')

@section('title', 'Criar Nova Notícia - Portal de Notícias')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center space-x-3 mb-4">
            <a href="{{ route('associacao.news.index') }}" class="text-green-600 dark:text-green-400 hover:underline flex items-center space-x-1">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Criar Nova Notícia</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-2">Compartilhe informações importantes com os membros da sua associação</p>
    </div>

    <form action="{{ route('associacao.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Coluna Principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Card - Informações Básicas -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center space-x-2">
                            <i data-lucide="file-text" class="w-5 h-5"></i>
                            <span>Informações Básicas</span>
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-6">
                        <!-- Título -->
                        <div>
                            <label for="title" class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Título da Notícia <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="title"
                                   name="title" 
                                   value="{{ old('title') }}"
                                   placeholder="Digite um título atrativo e informativo"
                                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all"
                                   required>
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resumo -->
                        <div>
                            <label for="summary" class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Resumo (Excerpt) <span class="text-red-500">*</span>
                            </label>
                            <textarea id="summary"
                                      name="summary" 
                                      rows="2"
                                      placeholder="Escreva um resumo breve que aparecerá na listagem"
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all resize-none"
                                      required>{{ old('summary') }}</textarea>
                            @error('summary')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Conteúdo -->
                        <div>
                            <label for="content" class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Conteúdo da Notícia <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content"
                                      name="content" 
                                      rows="10"
                                      placeholder="Digite o conteúdo completo da notícia aqui... Você pode usar formatação HTML básica."
                                      class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-all font-mono text-sm resize-none"
                                      required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card - Mídia -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center space-x-2">
                            <i data-lucide="image" class="w-5 h-5"></i>
                            <span>Imagem Destacada</span>
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center transition-colors hover:border-green-500 cursor-pointer" onclick="document.getElementById('featured_image').click()">
                                <div id="image-preview" class="mb-4">
                                    <i data-lucide="upload-cloud" class="w-12 h-12 text-gray-400 mx-auto"></i>
                                </div>
                                <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Clique ou arraste uma imagem</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF até 5MB</p>
                            </div>
                            
                            <input type="file" 
                                   id="featured_image"
                                   name="featured_image" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(event)">
                            
                            @error('featured_image')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card - Configurações de Publicação -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4">
                        <h2 class="text-xl font-bold text-white flex items-center space-x-2">
                            <i data-lucide="settings" class="w-5 h-5"></i>
                            <span>Configurações</span>
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status"
                                    name="status" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all"
                                    required>
                                <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Rascunho</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Publicado</option>
                            </select>
                        </div>

                        <!-- Destaque -->
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" 
                                   id="is_featured"
                                   name="is_featured" 
                                   value="1"
                                   {{ old('is_featured') ? 'checked' : '' }}
                                   class="w-5 h-5 text-green-600 rounded focus:ring-green-500 cursor-pointer dark:bg-gray-700 dark:border-gray-600">
                            <label for="is_featured" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                                Adicionar em Destaque
                            </label>
                        </div>

                        <!-- Categoria -->
                        <div>
                            <label for="category" class="block text-sm font-bold text-gray-900 dark:text-white mb-2">
                                Categoria
                            </label>
                            <select id="category"
                                    name="category" 
                                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-all">
                                <option value="">Selecione uma categoria</option>
                                <option value="Notícia" {{ old('category') === 'Notícia' ? 'selected' : '' }}>Notícia</option>
                                <option value="Evento" {{ old('category') === 'Evento' ? 'selected' : '' }}>Evento</option>
                                <option value="Comunicado" {{ old('category') === 'Comunicado' ? 'selected' : '' }}>Comunicado</option>
                                <option value="Aviso" {{ old('category') === 'Aviso' ? 'selected' : '' }}>Aviso</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Coluna Sidebar -->
            <div class="space-y-6">
                <!-- Card - Ações Rápidas -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden sticky top-6">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-500 px-6 py-4">
                        <h2 class="text-lg font-bold text-white flex items-center space-x-2">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                            <span>Ações</span>
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-3">
                        <button type="submit" 
                                class="w-full py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold rounded-lg transition-all shadow-lg hover:shadow-xl text-center flex items-center justify-center space-x-2">
                            <i data-lucide="save" class="w-5 h-5"></i>
                            <span>Criar Notícia</span>
                        </button>

                        <a href="{{ route('associacao.news.index') }}" 
                           class="w-full py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-bold rounded-lg transition-all text-center flex items-center justify-center space-x-2">
                            <i data-lucide="x" class="w-5 h-5"></i>
                            <span>Cancelar</span>
                        </a>
                    </div>
                </div>

                <!-- Card - Dicas -->
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800 overflow-hidden">
                    <div class="px-6 py-4">
                        <h3 class="text-lg font-bold text-blue-900 dark:text-blue-200 flex items-center space-x-2">
                            <i data-lucide="lightbulb" class="w-5 h-5"></i>
                            <span>Dicas</span>
                        </h3>
                    </div>
                    
                    <div class="px-6 pb-6 space-y-3 text-sm text-blue-800 dark:text-blue-300">
                        <p class="flex items-start space-x-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Use um título claro e descritivo</span>
                        </p>
                        <p class="flex items-start space-x-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Adicione uma imagem para mais impacto</span>
                        </p>
                        <p class="flex items-start space-x-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Escreva um resumo envolvente</span>
                        </p>
                        <p class="flex items-start space-x-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 mt-0.5 flex-shrink-0"></i>
                            <span>Revise antes de publicar</span>
                        </p>
                    </div>
                </div>

                <!-- Card - Informações -->
                <div class="bg-green-50 dark:bg-green-900/20 rounded-xl border border-green-200 dark:border-green-800 overflow-hidden">
                    <div class="px-6 py-4">
                        <h3 class="text-lg font-bold text-green-900 dark:text-green-200 flex items-center space-x-2">
                            <i data-lucide="info" class="w-5 h-5"></i>
                            <span>Info</span>
                        </h3>
                    </div>
                    
                    <div class="px-6 pb-6 space-y-2 text-sm text-green-800 dark:text-green-300">
                        <p>Publique notícias para manter seus associados informados sobre eventos, comunicados e atualizações importantes.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="max-h-40 mx-auto rounded-lg">`;
            };
            reader.readAsDataURL(file);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
