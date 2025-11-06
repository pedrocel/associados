@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Nova Página</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Escolha como deseja criar sua página</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Opção 1: Page Builder -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 p-8 hover:border-purple-500 dark:hover:border-purple-500 transition cursor-pointer" onclick="selectType('builder')">
                <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900 rounded-xl flex items-center justify-center mb-4">
                    <i data-lucide="layout" class="w-8 h-8 text-purple-600 dark:text-purple-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Page Builder</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Construa sua página visualmente com componentes pré-definidos</p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>Componentes prontos</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>Editor visual</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>Responsivo</span>
                    </li>
                </ul>
            </div>

            <!-- Opção 2: Importar HTML -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border-2 border-gray-200 dark:border-gray-700 p-8 hover:border-purple-500 dark:hover:border-purple-500 transition cursor-pointer" onclick="selectType('html')">
                <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center mb-4">
                    <i data-lucide="code" class="w-8 h-8 text-blue-600 dark:text-blue-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Importar HTML</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Faça upload de um arquivo HTML pronto</p>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>HTML puro</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>Arquivo único</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="check" class="w-4 h-4 text-green-500"></i>
                        <span>Controle total</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Form Builder -->
        <form id="builder-form" action="{{ route('associations.pages.store', $association->slug) }}" method="POST" class="hidden mt-8">
            @csrf
            <input type="hidden" name="type" value="builder">
            
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informações da Página</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Página *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_home" id="is_home" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                        <label for="is_home" class="text-sm text-gray-700 dark:text-gray-300">Definir como página inicial</label>
                    </div>
                </div>
                
                <div class="mt-6 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition">
                        Criar Página
                    </button>
                    <button type="button" onclick="cancelCreate()" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>

        <!-- Form HTML Import -->
        <form id="html-form" action="{{ route('associations.pages.import', $association->slug) }}" method="POST" enctype="multipart/form-data" class="hidden mt-8">
            @csrf
            
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Importar HTML</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome da Página *</label>
                        <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Arquivo HTML *</label>
                        <input type="file" name="html_file" accept=".html,.htm" required class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Apenas arquivos .html ou .htm (máx. 10MB)</p>
                    </div>
                </div>
                
                <div class="mt-6 flex gap-3">
                    <button type="submit" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition">
                        Importar HTML
                    </button>
                    <button type="button" onclick="cancelCreate()" class="px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition">
                        Cancelar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
    
    function selectType(type) {
        document.querySelectorAll('.grid > div').forEach(el => {
            el.classList.remove('border-purple-500', 'dark:border-purple-500');
            el.classList.add('border-gray-200', 'dark:border-gray-700');
        });
        
        event.currentTarget.classList.remove('border-gray-200', 'dark:border-gray-700');
        event.currentTarget.classList.add('border-purple-500', 'dark:border-purple-500');
        
        document.getElementById('builder-form').classList.add('hidden');
        document.getElementById('html-form').classList.add('hidden');
        
        if (type === 'builder') {
            document.getElementById('builder-form').classList.remove('hidden');
        } else {
            document.getElementById('html-form').classList.remove('hidden');
        }
    }
    
    function cancelCreate() {
        window.location.href = "{{ route('associations.pages.index', $association->slug) }}";
    }
</script>
@endsection
