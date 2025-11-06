@extends('layouts.app')

@section('title', isset($user) ? 'Editar Usuário - AssociaMe' : 'Novo Usuário - AssociaMe')
@section('page-title', isset($user) ? 'Editar Usuário' : 'Novo Usuário')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header simplificado sem card -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ isset($user) ? 'Editar Usuário' : 'Novo Usuário' }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                {{ isset($user) ? 'Atualize as informações do usuário' : 'Preencha os dados para criar um novo usuário' }}
            </p>
        </div>
        <a href="{{ route('associacao.users.index') }}" 
           class="inline-flex items-center space-x-1 text-sm text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Voltar</span>
        </a>
    </div>

    <!-- Formulário sem cards, apenas com bordas simples -->
    <form action="{{ isset($user) ? route('associacao.users.update', $user) : route('associacao.users.store') }}" 
          method="POST" 
          class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6 space-y-6">
        @csrf

        <!-- Informações Pessoais -->
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                Informações Pessoais
            </h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="lg:col-span-2">
                    <label for="name" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                        Nome Completo *
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $user->name ?? '') }}" 
                           required
                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('name') border-red-500 @enderror"
                           placeholder="Digite o nome completo">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                        Email *
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email ?? '') }}" 
                           required
                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('email') border-red-500 @enderror"
                           placeholder="exemplo@email.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="telefone" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                        Telefone
                    </label>
                    <input type="tel" 
                           id="telefone" 
                           name="telefone" 
                           value="{{ old('telefone', $user->telefone ?? '') }}"
                           class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('telefone') border-red-500 @enderror"
                           placeholder="(00) 00000-0000">
                    @error('telefone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Configurações do Sistema -->
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                Configurações do Sistema
            </h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div>
                    <label for="role" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                        Perfil *
                    </label>
                    <select id="role" 
                            name="role" 
                            required
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('role') border-red-500 @enderror">
                        <option value="">Selecione o perfil</option>
                        @foreach($perfis as $perfil)
                            <option value="{{ $perfil->id }}" 
                                    {{ old('role', $user->perfis[0]->id ?? '') == $perfil->id ? 'selected' : '' }}>
                                {{ $perfil->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                        Status *
                    </label>
                    <select id="status" 
                            name="status" 
                            required
                            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('status') border-red-500 @enderror">
                        <option value="ativo" {{ old('status', $user->status ?? '') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                        <option value="inativo" {{ old('status', $user->status ?? '') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                        <option value="pendente" {{ old('status', $user->status ?? '') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Segurança -->
        <div class="space-y-4">
            <h3 class="text-sm font-medium text-gray-900 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-2">
                Segurança
            </h3>
            
            <div>
                <label for="password" class="block text-sm text-gray-700 dark:text-gray-300 mb-1">
                    Senha {{ isset($user) ? '' : '*' }}
                </label>
                <div class="relative">
                    <input type="password" 
                           id="password" 
                           name="password"
                           class="w-full px-3 py-2 pr-10 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('password') border-red-500 @enderror"
                           placeholder="Digite a senha">
                    <button type="button" 
                            onclick="togglePassword()"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                        <i data-lucide="eye" id="eye-icon" class="w-4 h-4"></i>
                    </button>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                    @if(isset($user))
                        Deixe em branco para manter a senha atual
                    @else
                        Mínimo de 8 caracteres
                    @endif
                </p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @if(isset($user))
        <!-- Informações adicionais simplificadas em linha -->
        <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-wrap gap-4 text-xs text-gray-500 dark:text-gray-400">
                <span>Criado: {{ $user->created_at->format('d/m/Y H:i') }}</span>
                <span>•</span>
                <span>Atualizado: {{ $user->updated_at->format('d/m/Y H:i') }}</span>
                <span>•</span>
                <span>Último acesso: {{ $user->ultimo_acesso ? $user->ultimo_acesso->diffForHumans() : 'Nunca' }}</span>
            </div>
        </div>
        @endif

        <!-- Botões de ação simplificados -->
        <div class="flex gap-3 justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
            <a href="{{ route('associacao.users.index') }}" 
               class="px-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Cancelar
            </a>
            <button type="submit" 
                    class="px-4 py-2 text-sm bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors">
                {{ isset($user) ? 'Atualizar' : 'Criar' }}
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            eyeIcon.setAttribute('data-lucide', 'eye');
        }
        
        lucide.createIcons();
    }

    document.getElementById('telefone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/(\d{2})(\d)/, '($1) $2');
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
        e.target.value = value;
    });

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
