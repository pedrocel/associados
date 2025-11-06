@extends('layouts.app')

@section('title', 'Usuários - AssociaMe')
@section('page-title', 'Gerenciar Usuários')

@section('content')
<div class="space-y-4">
    <!-- Simplified header - removed card wrapper, made inline -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3">
        <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                <i data-lucide="users" class="w-5 h-5 text-emerald-600"></i>
                <span>Usuários</span>
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400">Gerencie todos os usuários do sistema</p>
        </div>
        <a href="{{ route('associacao.users.create') }}" 
           class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Novo Usuário</span>
        </a>
    </div>

    <!-- Converted stats cards to simple inline stats bar -->
    <div class="flex items-center gap-6 text-sm">
        <div class="flex items-center space-x-2">
            <span class="text-gray-600 dark:text-gray-400">Total:</span>
            <span class="font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600 dark:text-gray-400">Ativos:</span>
            <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $users->where('status', 'ativo')->count() }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600 dark:text-gray-400">Pendentes:</span>
            <span class="font-semibold text-amber-600 dark:text-amber-400">{{ $users->where('status', 'pendente')->count() }}</span>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-gray-600 dark:text-gray-400">Inativos:</span>
            <span class="font-semibold text-red-600 dark:text-red-400">{{ $users->where('status', 'inativo')->count() }}</span>
        </div>
    </div>

    <!-- Simplified filters - removed card wrapper, made more compact -->
    <div class="flex flex-col lg:flex-row gap-3 py-3 border-y border-gray-200 dark:border-gray-700">
        <div class="flex-1">
            <div class="relative">
                <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" 
                       placeholder="Buscar usuários..." 
                       class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
            </div>
        </div>
        <div class="flex gap-2">
            <select class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                <option>Todos os status</option>
                <option>Ativo</option>
                <option>Inativo</option>
                <option>Pendente</option>
            </select>
            <select class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                <option>Todos os perfis</option>
                <option>Administrador</option>
                <option>Associação</option>
                <option>Membro</option>
            </select>
        </div>
    </div>

    <!-- Converted user cards to compact list items without card wrappers -->
    <div class="space-y-2">
        @forelse($users as $user)
        <div class="flex items-center justify-between py-3 px-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 rounded-lg transition-colors border-b border-gray-100 dark:border-gray-800">
            <!-- User Info -->
            <div class="flex items-center space-x-3 flex-1 min-w-0">
                <div class="relative flex-shrink-0">
                    @if($user->avatar_url)
                        <img class="w-9 h-9 rounded-full object-cover" 
                             src="{{ $user->avatar_url }}" 
                             alt="{{ $user->name }}">
                    @else
                        <div class="w-9 h-9 bg-emerald-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-semibold">{{ substr($user->name, 0, 2) }}</span>
                        </div>
                    @endif
                    <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 rounded-full border-2 border-white dark:border-gray-900 
                                {{ $user->status == 'ativo' ? 'bg-emerald-500' : ($user->status == 'pendente' ? 'bg-amber-500' : 'bg-red-500') }}">
                    </div>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center space-x-2">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $user->name }}</h3>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                            {{ $user->status == 'ativo' ? 'bg-emerald-100 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400' : 
                               ($user->status == 'pendente' ? 'bg-amber-100 dark:bg-amber-900/20 text-amber-700 dark:text-amber-400' : 
                                'bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-400') }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </div>
                    <div class="flex items-center space-x-3 mt-0.5">
                        <p class="text-xs text-gray-600 dark:text-gray-400 flex items-center space-x-1">
                            <i data-lucide="mail" class="w-3 h-3"></i>
                            <span class="truncate">{{ $user->email }}</span>
                        </p>
                        <span class="text-xs text-gray-500 dark:text-gray-500">•</span>
                        <span class="text-xs text-gray-600 dark:text-gray-400 flex items-center space-x-1">
                            <i data-lucide="shield" class="w-3 h-3"></i>
                            <span>{{ $user->perfilAtual() ? $user->perfilAtual()->name : 'Sem Perfil' }}</span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-1 flex-shrink-0">
                <a href="{{ route('associacao.users.edit', $user) }}" 
                   class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-400 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 rounded transition-colors">
                    <i data-lucide="edit" class="w-3.5 h-3.5 mr-1"></i>
                    Editar
                </a>
                
                <button onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')"
                        class="inline-flex items-center px-2 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors">
                    <i data-lucide="trash-2" class="w-3.5 h-3.5 mr-1"></i>
                    Excluir
                </button>
            </div>
        </div>
        @empty
        <div class="py-12 text-center">
            <div class="w-12 h-12 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-3">
                <i data-lucide="users" class="w-6 h-6 text-gray-400"></i>
            </div>
            <h3 class="text-base font-medium text-gray-900 dark:text-white mb-1">Nenhum usuário encontrado</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Comece criando seu primeiro usuário no sistema.</p>
            <a href="{{ route('associacao.users.create') }}" 
               class="inline-flex items-center space-x-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                <i data-lucide="user-plus" class="w-4 h-4"></i>
                <span>Criar Primeiro Usuário</span>
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="pt-4">
        {{ $users->links() }}
    </div>
    @endif
</div>

<!-- Simplified modal - reduced padding and sizes -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-lg max-w-sm w-full p-5">
        <div class="flex items-center justify-center w-10 h-10 mx-auto mb-3 bg-red-100 dark:bg-red-900/20 rounded-full">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
        </div>
        
        <h3 class="text-base font-semibold text-gray-900 dark:text-white text-center mb-2">Confirmar Exclusão</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 text-center mb-5">
            Tem certeza que deseja excluir <span id="deleteUserName" class="font-medium text-gray-900 dark:text-white"></span>?
        </p>
        
        <div class="flex gap-2">
            <button onclick="closeDeleteModal()" 
                    class="flex-1 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
                Cancelar
            </button>
            <form id="deleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="w-full px-4 py-2 text-sm bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                    Excluir
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(userId, userName) {
        document.getElementById('deleteUserName').textContent = userName;
        document.getElementById('deleteForm').action = `{{ route('associacao.users.index') }}/${userId}`;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });
</script>
@endpush
@endsection
