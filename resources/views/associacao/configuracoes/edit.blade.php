@extends('layouts.app')

@section('title', 'Configurações da Associação - AssociaMe')
@section('page-title', 'Configurações da Associação')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-6 border border-green-100 dark:border-gray-600">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <i data-lucide="settings" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                        Configurações da Associação
                    </h2>
                    <p class="text-gray-600 dark:text-gray-400">
                        Gerencie as informações e configurações da sua associação.
                    </p>
                </div>
            </div>
            <a href="{{ route('associacao.dashboard') }}" 
               class="inline-flex items-center space-x-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-600 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Voltar</span>
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded-md">
            <h4 class="font-bold mb-2">Ops! Houve alguns erros:</h4>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('associacao.configuracoes.update', $association) }}" 
          method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-2">
            <div class="flex space-x-2">
                <button type="button" class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-900 dark:text-white transition-colors duration-200 bg-green-100 dark:bg-green-900/20" data-tab="geral">
                    <i data-lucide="info" class="w-4 h-4 inline mr-2"></i>
                    Geral
                </button>
                <button type="button" class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="contato">
                    <i data-lucide="phone" class="w-4 h-4 inline mr-2"></i>
                    Contato e Endereço
                </button>
                <button type="button" class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="representante">
                    <i data-lucide="user-check" class="w-4 h-4 inline mr-2"></i>
                    Representante
                </button>
                <button type="button" class="tab-button w-full px-4 py-2 rounded-lg font-medium text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700" data-tab="documentos">
                    <i data-lucide="file-check-2" class="w-4 h-4 inline mr-2"></i>
                    Documentos
                </button>
            </div>
        </div>

        <div class="tab-content" id="geral">
            @include('associacao.configuracoes._geral')
        </div>
        <div class="tab-content hidden" id="contato">
            @include('associacao.configuracoes._contato')
        </div>
        <div class="tab-content hidden" id="representante">
            @include('associacao.configuracoes._representante')
        </div>
        <div class="tab-content hidden" id="documentos">
            @include('associacao.configuracoes._documentos')
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex flex-col sm:flex-row gap-4 justify-end">
                <a href="{{ route('associacao.dashboard') }}" 
                   class="inline-flex items-center justify-center space-x-2 px-6 py-3 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                    <span>Cancelar</span>
                </a>
                <button type="submit" 
                        class="inline-flex items-center justify-center space-x-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-all duration-200 hover:transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Salvar Configurações</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');

        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                tabButtons.forEach(btn => {
                    btn.classList.remove('bg-green-100', 'dark:bg-green-900/20', 'text-gray-900', 'dark:text-white');
                    btn.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
                });
                tabContents.forEach(content => content.classList.add('hidden'));

                button.classList.add('bg-green-100', 'dark:bg-green-900/20', 'text-gray-900', 'dark:text-white');
                button.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');

                const tabId = button.dataset.tab;
                document.getElementById(tabId).classList.remove('hidden');
            });
        });
    });
</script>
@endpush