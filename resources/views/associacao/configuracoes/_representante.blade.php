<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 border-b border-gray-200 dark:border-gray-600">
        <div class="flex items-center space-x-2">
            <i data-lucide="user-check" class="w-5 h-5 text-green-600 dark:text-green-400"></i>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Representante Legal</h3>
        </div>
    </div>
    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="representante_nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nome do Representante</label>
            <input type="text" id="representante_nome" name="representante_nome" value="{{ old('representante_nome', $association->representante_nome) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('representante_nome') border-red-500 @enderror" disabled>
            @error('representante_nome') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="representante_cpf" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">CPF do Representante</label>
            <input type="text" id="representante_cpf" disabled  name="representante_cpf" value="{{ old('representante_cpf', $association->representante_cpf) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('representante_cpf') border-red-500 @enderror">
            @error('representante_cpf') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="representante_email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email do Representante</label>
            <input type="email" id="representante_email" disabled  name="representante_email" value="{{ old('representante_email', $association->representante_email) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('representante_email') border-red-500 @enderror">
            @error('representante_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="representante_telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Telefone do Representante</label>
            <input type="tel" id="representante_telefone" disabled  name="representante_telefone" value="{{ old('representante_telefone', $association->representante_telefone) }}"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white @error('representante_telefone') border-red-500 @enderror">
            @error('representante_telefone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>
</div>