@extends('layouts.mobile-app')

@section('title', 'Perfil - Minha Associação')

@section('content')
<!-- Profile Header -->
<div class="text-center mb-8">
    <div class="w-24 h-24 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
        <span class="text-2xl font-bold text-white">{{ substr(auth()->user()->name, 0, 2) }}</span>
    </div>
    <h1 class="text-2xl font-bold text-gray-900 mb-1">{{ auth()->user()->name }}</h1>
    <p class="text-gray-600">{{ auth()->user()->email }}</p>
    <div class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium mt-2">
        <i data-lucide="check-circle" class="w-4 h-4 mr-1"></i>
        Membro Ativo
    </div>
</div>

<!-- Profile Options -->
<div class="space-y-4 mb-8">
    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i data-lucide="user" class="w-6 h-6 text-blue-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Informações Pessoais</h3>
                <p class="text-sm text-gray-600">Editar dados do perfil</p>
            </div>
            <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i data-lucide="credit-card" class="w-6 h-6 text-green-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Financeiro</h3>
                <p class="text-sm text-gray-600">Mensalidades e pagamentos</p>
            </div>
            <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                <i data-lucide="bell" class="w-6 h-6 text-purple-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Notificações</h3>
                <p class="text-sm text-gray-600">Configurar alertas</p>
            </div>
            <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>

    <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                <i data-lucide="settings" class="w-6 h-6 text-orange-600"></i>
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-gray-900">Configurações</h3>
                <p class="text-sm text-gray-600">Preferências do app</p>
            </div>
            <i data-lucide="chevron-right" class="w-5 h-5 text-gray-400"></i>
        </div>
    </div>
</div>

<!-- Logout Button -->
<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="w-full bg-red-50 text-red-600 py-4 rounded-2xl font-semibold flex items-center justify-center space-x-2 hover:bg-red-100 transition-colors">
        <i data-lucide="log-out" class="w-5 h-5"></i>
        <span>Sair da Conta</span>
    </button>
</form>
@endsection
