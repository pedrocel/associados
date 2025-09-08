<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Associação - Sistema de Associações</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        gray: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                        },
                        green: {
                            50: '#f0fdf4',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                        },
                        blue: {
                            50: '#eff6ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        },
                        red: {
                            50: '#fef2f2',
                            500: '#ef4444',
                            600: '#dc2626',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
        }
        
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(45deg, rgba(34, 197, 94, 0.05), rgba(59, 130, 246, 0.05));
            animation: float 8s ease-in-out infinite;
        }
        
        .floating-shape:nth-child(1) {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .floating-shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 20%;
            right: 10%;
            animation-delay: 3s;
        }
        
        .floating-shape:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: 6s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .step-indicator {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .step-indicator.active {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
        }
        
        .step-indicator.completed {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: white;
        }
        
        .step-progress {
            height: 3px;
            background: #e4e4e7;
            border-radius: 2px;
            overflow: hidden;
            transition: all 0.4s ease;
        }
        
        .step-progress.active {
            background: linear-gradient(90deg, #22c55e 0%, #16a34a 100%);
        }
        
        .form-section {
            display: none;
            opacity: 0;
            transform: translateX(30px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .form-section.active {
            display: block;
            opacity: 1;
            transform: translateX(0);
        }
        
        .tipo-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .tipo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }
        
        .tipo-card.selected {
            border-color: #22c55e;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .tipo-card.selected::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 30px 30px 0;
            border-color: transparent #22c55e transparent transparent;
        }
        
        .tipo-card.selected::after {
            content: '✓';
            position: absolute;
            top: 8px;
            right: 8px;
            color: white;
            font-weight: bold;
            font-size: 12px;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            transition: all 0.3s ease;
        }
        
        .form-group.error input,
        .form-group.error select,
        .form-group.error textarea {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }
        
        .form-group.success input,
        .form-group.success select,
        .form-group.success textarea {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        }
        
        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-primary:hover:not(:disabled) {
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(34, 197, 94, 0.4);
        }
        
        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .btn-secondary {
            background: #f4f4f5;
            color: #52525b;
            border: 1px solid #e4e4e7;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: #e4e4e7;
            transform: translateY(-1px);
        }
        
        .fade-in {
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .loading-spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-purple-50 relative overflow-x-hidden">
    
    <!-- Floating Shapes -->
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    <div class="floating-shape"></div>
    
    <!-- Header -->
    <header class="relative z-10 p-4 lg:p-6">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i class="fas fa-bolt text-white text-xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">AssociaçõesPro</h1>
                    <p class="text-sm text-gray-600">Sistema de Gestão</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <a href="/login" class="text-gray-600 hover:text-gray-900 font-medium transition-colors">
                    Fazer Login
                </a>
                <a href="/member-login" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-medium transition-all transform hover:scale-105">
                    Área do Membro
                </a>
            </div>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="relative z-10 max-w-5xl mx-auto p-4 lg:p-6">
        <div class="glass-effect rounded-3xl shadow-2xl p-8 lg:p-12">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Cadastrar Nova Associação</h2>
                <p class="text-xl text-gray-600">Complete as etapas para criar sua associação</p>
            </div>
            
            <!-- Progress Steps -->
            <div class="flex items-center justify-center mb-12">
                <div class="flex items-center space-x-4">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center">
                        <div class="step-indicator active flex items-center justify-center w-12 h-12 rounded-full font-bold text-lg" data-step="1">
                            1
                        </div>
                        <span class="text-sm font-medium text-green-600 mt-2">Tipo</span>
                    </div>
                    
                    <!-- Progress Bar 1 -->
                    <div class="w-20 step-progress">
                        <div class="h-full bg-gray-300 rounded-full transition-all duration-500" id="progress-1"></div>
                    </div>
                    
                    <!-- Step 2 -->
                    <div class="flex flex-col items-center">
                        <div class="step-indicator flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-600 font-bold text-lg" data-step="2">
                            2
                        </div>
                        <span class="text-sm text-gray-500 mt-2">Dados</span>
                    </div>
                    
                    <!-- Progress Bar 2 -->
                    <div class="w-20 step-progress">
                        <div class="h-full bg-gray-300 rounded-full transition-all duration-500" id="progress-2"></div>
                    </div>
                    
                    <!-- Step 3 -->
                    <div class="flex flex-col items-center">
                        <div class="step-indicator flex items-center justify-center w-12 h-12 rounded-full bg-gray-200 text-gray-600 font-bold text-lg" data-step="3">
                            3
                        </div>
                        <span class="text-sm text-gray-500 mt-2">Responsável</span>
                    </div>
                </div>
            </div>
            
            <!-- Error Messages -->
            @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 rounded-xl p-6 fade-in">
                <div class="flex items-center mb-3">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                    <h3 class="text-red-800 font-semibold">Erro no cadastro</h3>
                </div>
                <ul class="text-red-700 space-y-2">
                    @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <i class="fas fa-circle text-red-400 text-xs mr-2"></i>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Form -->
            <form method="POST" action="{{ route('association.register') }}" id="registration-form" novalidate>
                @csrf
                
                <!-- Step 1: Tipo de Associação -->
                <div class="form-section active fade-in" id="step-1">
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Tipo de Associação</h3>
                        <p class="text-lg text-gray-600">Selecione o tipo da sua organização</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
                        <div class="tipo-card border-2 border-gray-200 rounded-2xl p-8" data-type="pf">
                            <input type="radio" id="tipo-pf" name="tipo" value="pf" class="sr-only" {{ old('tipo') == 'pf' ? 'checked' : '' }}>
                            <label for="tipo-pf" class="cursor-pointer block">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-green-100 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                                        <i class="fas fa-user text-green-600 text-3xl"></i>
                                    </div>
                                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Pessoa Física</h4>
                                    <p class="text-gray-600 text-lg">Para profissionais autônomos e pessoas físicas</p>
                                </div>
                            </label>
                        </div>
                        
                        <div class="tipo-card border-2 border-gray-200 rounded-2xl p-8" data-type="cnpj">
                            <input type="radio" id="tipo-cnpj" name="tipo" value="cnpj" class="sr-only" {{ old('tipo') == 'cnpj' ? 'checked' : '' }}>
                            <label for="tipo-cnpj" class="cursor-pointer block">
                                <div class="text-center">
                                    <div class="w-20 h-20 bg-blue-100 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                                        <i class="fas fa-building text-blue-600 text-3xl"></i>
                                    </div>
                                    <h4 class="text-2xl font-bold text-gray-900 mb-3">Pessoa Jurídica</h4>
                                    <p class="text-gray-600 text-lg">Para empresas, associações e organizações</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    <div class="error-message hidden text-center mt-6" id="tipo-error">
                        <i class="fas fa-exclamation-circle"></i>
                        Por favor, selecione o tipo de associação
                    </div>
                    
                    <div class="flex justify-center mt-12">
                        <button type="button" onclick="nextStep()" class="btn-primary text-white px-8 py-4 rounded-xl font-semibold text-lg">
                            Próximo
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 2: Dados da Associação -->
                <div class="form-section" id="step-2">
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">Dados da Associação</h3>
                        <p class="text-lg text-gray-600">Informações principais da organização</p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nome da Associação -->
                        <div class="md:col-span-2 form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Nome da Associação *</label>
                            <input type="text" name="nome" required 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="Digite o nome da associação"
                                   value="{{ old('nome') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Documento -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2" id="documento-label">Documento *</label>
                            <input type="text" name="documento_associacao" required 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="000.000.000-00"
                                   value="{{ old('documento_associacao') }}"
                                   id="documento">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Email -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">E-mail *</label>
                            <input type="email" name="email_associacao" required 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="contato@exemplo.com"
                                   value="{{ old('email_associacao') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Telefone -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Telefone *</label>
                            <input type="tel" name="telefone_associacao" required 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="(11) 99999-9999"
                                   value="{{ old('telefone_associacao') }}"
                                   id="telefone">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Data de Fundação -->
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Data de Fundação</label>
                            <input type="date" name="data_fundacao" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   value="{{ old('data_fundacao') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Site -->
                        <div class="md:col-span-2 form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Website</label>
                            <input type="url" name="site" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="https://www.exemplo.com"
                                   value="{{ old('site') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <!-- Descrição -->
                        <div class="md:col-span-2 form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Descrição</label>
                            <textarea name="descricao" rows="4" 
                                      class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg resize-none"
                                      placeholder="Descreva brevemente a associação...">{{ old('descricao') }}</textarea>
                            <div class="error-message hidden"></div>
                        </div>
                    </div>
                    
                    <!-- Endereço -->
                    <div class="mt-10">
                        <h4 class="text-2xl font-bold text-gray-900 mb-6">Endereço</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- CEP -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">CEP *</label>
                                <input type="text" name="cep" required 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="00000-000"
                                       value="{{ old('cep') }}"
                                       id="cep">
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Estado -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Estado *</label>
                                <select name="estado" required 
                                        class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                        id="estado">
                                    <option value="">Selecione</option>
                                    <option value="AC" {{ old('estado') == 'AC' ? 'selected' : '' }}>Acre</option>
                                    <option value="AL" {{ old('estado') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                    <option value="AP" {{ old('estado') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                    <option value="AM" {{ old('estado') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                    <option value="BA" {{ old('estado') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                    <option value="CE" {{ old('estado') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                    <option value="DF" {{ old('estado') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                    <option value="ES" {{ old('estado') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                    <option value="GO" {{ old('estado') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                    <option value="MA" {{ old('estado') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                    <option value="MT" {{ old('estado') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                    <option value="MS" {{ old('estado') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                    <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                    <option value="PA" {{ old('estado') == 'PA' ? 'selected' : '' }}>Pará</option>
                                    <option value="PB" {{ old('estado') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                    <option value="PR" {{ old('estado') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                    <option value="PE" {{ old('estado') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                    <option value="PI" {{ old('estado') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                    <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                    <option value="RN" {{ old('estado') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                    <option value="RS" {{ old('estado') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                    <option value="RO" {{ old('estado') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                    <option value="RR" {{ old('estado') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                    <option value="SC" {{ old('estado') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                    <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                    <option value="SE" {{ old('estado') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                    <option value="TO" {{ old('estado') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                                </select>
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Cidade -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Cidade *</label>
                                <input type="text" name="cidade" required 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Nome da cidade"
                                       value="{{ old('cidade') }}"
                                       id="cidade">
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Endereço -->
                            <div class="md:col-span-2 form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Endereço *</label>
                                <input type="text" name="endereco" required 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Rua, Avenida, etc."
                                       value="{{ old('endereco') }}"
                                       id="endereco">
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Número -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Número *</label>
                                <input type="text" name="numero" required 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="123"
                                       value="{{ old('numero') }}">
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Complemento -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Complemento</label>
                                <input type="text" name="complemento" 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Apto, Sala, etc."
                                       value="{{ old('complemento') }}">
                                <div class="error-message hidden"></div>
                            </div>
                            
                            <!-- Bairro -->
                            <div class="form-group">
                                <label class="block text-sm font-semibold text-gray-900 mb-2">Bairro *</label>
                                <input type="text" name="bairro" required 
                                       class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Nome do bairro"
                                       value="{{ old('bairro') }}"
                                       id="bairro">
                                <div class="error-message hidden"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-12">
                        <button type="button" onclick="prevStep()" class="btn-secondary px-8 py-4 rounded-xl font-semibold text-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Anterior
                        </button>
                        <button type="button" onclick="nextStep()" class="btn-primary text-white px-8 py-4 rounded-xl font-semibold text-lg">
                            Próximo
                            <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Step 3: Dados do Responsável -->
                <div class="form-section" id="step-3">
                    <div class="text-center mb-10">
                        <h3 class="text-3xl font-bold text-gray-900 mb-4" id="responsavel-title">Dados do Responsável</h3>
                        <p class="text-lg text-gray-600">Informações da pessoa responsável</p>
                    </div>
                    
                    <!-- Campos para PF -->
                    <div id="campos-pf" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Nome Completo *</label>
                            <input type="text" name="nome_responsavel" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="Nome completo do responsável"
                                   value="{{ old('nome_responsavel') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">CPF *</label>
                            <input type="text" name="documento_responsavel" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="000.000.000-00"
                                   value="{{ old('documento_responsavel') }}"
                                   id="responsavel_cpf">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">E-mail *</label>
                            <input type="email" name="email_responsavel" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="email@exemplo.com"
                                   value="{{ old('email_responsavel') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Telefone *</label>
                            <input type="tel" name="telefone_responsavel" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="(11) 99999-9999"
                                   value="{{ old('telefone_responsavel') }}"
                                   id="responsavel_telefone">
                            <div class="error-message hidden"></div>
                        </div>
                    </div>
                    
                    <!-- Campos para CNPJ -->
                    <div id="campos-cnpj" class="grid grid-cols-1 md:grid-cols-2 gap-6 hidden">
                        <div class="md:col-span-2 form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Nome do Representante Legal *</label>
                            <input type="text" name="representante_nome" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="Nome completo do representante"
                                   value="{{ old('representante_nome') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">CPF do Representante *</label>
                            <input type="text" name="representante_cpf" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="000.000.000-00"
                                   value="{{ old('representante_cpf') }}"
                                   id="representante_cpf">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">E-mail do Representante *</label>
                            <input type="email" name="representante_email" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="representante@exemplo.com"
                                   value="{{ old('representante_email') }}">
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Telefone do Representante *</label>
                            <input type="tel" name="representante_telefone" 
                                   class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                   placeholder="(11) 99999-9999"
                                   value="{{ old('representante_telefone') }}"
                                   id="representante_telefone">
                            <div class="error-message hidden"></div>
                        </div>
                    </div>
                    
                    <!-- Senha -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Senha *</label>
                            <div class="relative">
                                <input type="password" name="password" required 
                                       class="w-full px-4 py-4 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Mínimo 8 caracteres"
                                       id="password">
                                <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                            <div class="error-message hidden"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-900 mb-2">Confirmar Senha *</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" required 
                                       class="w-full px-4 py-4 pr-12 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all text-lg"
                                       placeholder="Confirme sua senha"
                                       id="password_confirmation">
                                <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                </button>
                            </div>
                            <div class="error-message hidden"></div>
                        </div>
                    </div>
                    
                    <div class="flex justify-between mt-12">
                        <button type="button" onclick="prevStep()" class="btn-secondary px-8 py-4 rounded-xl font-semibold text-lg">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Anterior
                        </button>
                        <button type="submit" class="btn-primary text-white px-8 py-4 rounded-xl font-semibold text-lg" id="submit-btn">
                            <i class="fas fa-check mr-2"></i>
                            Cadastrar Associação
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        class AssociationWizard {
            constructor() {
                this.currentStep = 1;
                this.totalSteps = 3;
                this.selectedType = '{{ old("tipo") }}' || null;
                
                this.init();
            }
            
            init() {
                this.setupEventListeners();
                this.setupMasks();
                this.setupValidation();
                this.updateStepDisplay();
                
                // Restore selection if old input exists
                if (this.selectedType) {
                    this.selectType(this.selectedType);
                    this.updateFormForType();
                }
            }
            
            setupEventListeners() {
                // Type selection
                document.querySelectorAll('.tipo-card').forEach(card => {
                    card.addEventListener('click', () => {
                        const type = card.dataset.type;
                        const radio = document.getElementById(`tipo-${type}`);
                        radio.checked = true;
                        this.selectType(type);
                    });
                });
                
                // CEP lookup
                document.getElementById('cep').addEventListener('blur', (e) => {
                    this.lookupCEP(e.target.value);
                });
                
                // Real-time validation
                document.querySelectorAll('input, select, textarea').forEach(field => {
                    field.addEventListener('blur', () => {
                        this.validateField(field);
                    });
                    
                    field.addEventListener('input', () => {
                        this.clearFieldError(field);
                    });
                });
                
                // Form submission
                document.getElementById('registration-form').addEventListener('submit', (e) => {
                    e.preventDefault();
                    this.submitForm();
                });
            }
            
            setupMasks() {
                // Phone masks
                ['telefone_associacao', 'telefone_responsavel', 'representante_telefone'].forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.addEventListener('input', (e) => {
                            let value = e.target.value.replace(/\D/g, '');
                            value = value.replace(/(\d{2})(\d)/, '($1) $2');
                            value = value.replace(/(\d{5})(\d)/, '$1-$2');
                            e.target.value = value;
                        });
                    }
                });
                
                // CPF masks
                ['documento_responsavel', 'representante_cpf'].forEach(id => {
                    const field = document.getElementById(id);
                    if (field) {
                        field.addEventListener('input', (e) => {
                            let value = e.target.value.replace(/\D/g, '');
                            value = value.replace(/(\d{3})(\d)/, '$1.$2');
                            value = value.replace(/(\d{3})(\d)/, '$1.$2');
                            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                            e.target.value = value;
                        });
                    }
                });
                
                // CEP mask
                document.getElementById('cep').addEventListener('input', (e) => {
                    let value = e.target.value.replace(/\D/g, '');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                    e.target.value = value;
                });
                
                // Dynamic document mask
                document.getElementById('documento').addEventListener('input', (e) => {
                    let value = e.target.value.replace(/\D/g, '');
                    let maskedValue = '';
                    
                    if (this.selectedType === 'pf' && value.length <= 11) {
                        maskedValue = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                    } else if (this.selectedType === 'cnpj' && value.length <= 14) {
                        maskedValue = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
                    } else {
                        maskedValue = value;
                    }
                    
                    e.target.value = maskedValue;
                });
            }
            
            setupValidation() {
                // Password confirmation validation
                document.getElementById('password_confirmation').addEventListener('input', (e) => {
                    const password = document.getElementById('password').value;
                    const confirmation = e.target.value;
                    
                    if (confirmation && password !== confirmation) {
                        this.showFieldError(e.target, 'As senhas não coincidem');
                    } else {
                        this.clearFieldError(e.target);
                    }
                });
            }
            
            
            selectType(type) {
                // Clear previous selections
                document.querySelectorAll('.tipo-card').forEach(card => {
                    card.classList.remove('selected');
                });
                
                // Add selection to clicked card
                const selectedCard = document.querySelector(`[data-type="${type}"]`);
                selectedCard.classList.add('selected');
                
                this.selectedType = type;
                this.updateFormForType();
                
                // Clear type error
                document.getElementById('tipo-error').classList.add('hidden');
            }
            
            updateFormForType() {
                const documentLabel = document.getElementById('documento-label');
                const documentInput = document.getElementById('documento');
                const responsavelTitle = document.getElementById('responsavel-title');
                const camposPF = document.getElementById('campos-pf');
                const camposCNPJ = document.getElementById('campos-cnpj');
                
                if (this.selectedType === 'pf') {
                    documentLabel.textContent = 'CPF *';
                    documentInput.placeholder = '000.000.000-00';
                    responsavelTitle.textContent = 'Dados do Responsável';
                    camposPF.classList.remove('hidden');
                    camposCNPJ.classList.add('hidden');
                    
                    // Set required fields
                    this.setFieldRequired('nome_responsavel', true);
                    this.setFieldRequired('documento_responsavel', true);
                    this.setFieldRequired('email_responsavel', true);
                    this.setFieldRequired('telefone_responsavel', true);
                    
                    this.setFieldRequired('representante_nome', false);
                    this.setFieldRequired('representante_cpf', false);
                    this.setFieldRequired('representante_email', false);
                    this.setFieldRequired('representante_telefone', false);
                } else {
                    documentLabel.textContent = 'CNPJ *';
                    documentInput.placeholder = '00.000.000/0000-00';
                    responsavelTitle.textContent = 'Dados do Representante Legal';
                    camposPF.classList.add('hidden');
                    camposCNPJ.classList.remove('hidden');
                    
                    // Set required fields
                    this.setFieldRequired('representante_nome', true);
                    this.setFieldRequired('representante_cpf', true);
                    this.setFieldRequired('representante_email', true);
                    this.setFieldRequired('representante_telefone', true);
                    
                    this.setFieldRequired('nome_responsavel', false);
                    this.setFieldRequired('documento_responsavel', false);
                    this.setFieldRequired('email_responsavel', false);
                    this.setFieldRequired('telefone_responsavel', false);
                }
            }
            
            setFieldRequired(fieldName, required) {
                const field = document.querySelector(`[name="${fieldName}"]`);
                if (field) {
                    field.required = required;
                }
            }
            
            validateStep(step) {
                let isValid = true;
                
                if (step === 1) {
                    if (!this.selectedType) {
                        document.getElementById('tipo-error').classList.remove('hidden');
                        isValid = false;
                    }
                } else {
                    const stepElement = document.getElementById(`step-${step}`);
                    const requiredFields = stepElement.querySelectorAll('input[required], select[required], textarea[required]');
                    
                    console.log(`Validating step ${step}, found ${requiredFields.length} required fields`);
                    
                    requiredFields.forEach(field => {
                        const fieldValid = this.validateField(field);
                        if (!fieldValid) {
                            console.log(`Field ${field.name} is invalid:`, field.value);
                            isValid = false;
                        }
                    });
                }
                
                console.log(`Step ${step} validation result:`, isValid);
                return isValid;
            }
            
            validateField(field) {
                const formGroup = field.closest('.form-group');
                let isValid = true;
                let message = '';
                
                // Required validation
                if (field.hasAttribute('required') && !field.value.trim()) {
                    isValid = false;
                    message = 'Este campo é obrigatório';
                }
                
                // Email validation
                if (field.type === 'email' && field.value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(field.value)) {
                        isValid = false;
                        message = 'E-mail inválido';
                    }
                }
                
                // CPF validation
                if ((field.name === 'documento_responsavel' || field.name === 'representante_cpf') && field.value) {
                    if (!this.validateCPF(field.value)) {
                        isValid = false;
                        message = 'CPF inválido';
                    }
                }
                
                // Document validation
                if (field.name === 'documento_associacao' && field.value) {
                    if (this.selectedType === 'pf' && !this.validateCPF(field.value)) {
                        isValid = false;
                        message = 'CPF inválido';
                    } else if (this.selectedType === 'cnpj' && !this.validateCNPJ(field.value)) {
                        isValid = false;
                        message = 'CNPJ inválido';
                    }
                }
                
                // Password validation
                if (field.name === 'password' && field.value) {
                    if (field.value.length < 8) {
                        isValid = false;
                        message = 'A senha deve ter pelo menos 8 caracteres';
                    }
                }
                
                // Password confirmation validation
                if (field.name === 'password_confirmation' && field.value) {
                    const password = document.getElementById('password').value;
                    if (field.value !== password) {
                        isValid = false;
                        message = 'As senhas não coincidem';
                    }
                }
                
                if (isValid) {
                    this.clearFieldError(field);
                    if (formGroup) formGroup.classList.add('success');
                } else {
                    this.showFieldError(field, message);
                    if (formGroup) formGroup.classList.remove('success');
                }
                
                return isValid;
            }
            
            showFieldError(field, message) {
                const formGroup = field.closest('.form-group');
                if (formGroup) {
                    formGroup.classList.add('error');
                    const errorElement = formGroup.querySelector('.error-message');
                    if (errorElement) {
                        errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
                        errorElement.classList.remove('hidden');
                    }
                }
            }
            
            clearFieldError(field) {
                const formGroup = field.closest('.form-group');
                if (formGroup) {
                    formGroup.classList.remove('error');
                    const errorElement = formGroup.querySelector('.error-message');
                    if (errorElement) {
                        errorElement.classList.add('hidden');
                    }
                }
            }
            
            validateCPF(cpf) {
                cpf = cpf.replace(/\D/g, '');
                
                if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) {
                    return false;
                }
                
                let sum = 0;
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf.charAt(i)) * (10 - i);
                }
                
                let remainder = 11 - (sum % 11);
                if (remainder === 10 || remainder === 11) remainder = 0;
                if (remainder !== parseInt(cpf.charAt(9))) return false;
                
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf.charAt(i)) * (11 - i);
                }
                
                remainder = 11 - (sum % 11);
                if (remainder === 10 || remainder === 11) remainder = 0;
                
                return remainder === parseInt(cpf.charAt(10));
            }
            
            validateCNPJ(cnpj) {
                cnpj = cnpj.replace(/\D/g, '');
                
                if (cnpj.length !== 14 || /^(\d)\1{13}$/.test(cnpj)) {
                    return false;
                }
                
                let length = cnpj.length - 2;
                let numbers = cnpj.substring(0, length);
                let digits = cnpj.substring(length);
                let sum = 0;
                let pos = length - 7;
                
                for (let i = length; i >= 1; i--) {
                    sum += numbers.charAt(length - i) * pos--;
                    if (pos < 2) pos = 9;
                }
                
                let result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                if (result !== parseInt(digits.charAt(0))) return false;
                
                length = length + 1;
                numbers = cnpj.substring(0, length);
                sum = 0;
                pos = length - 7;
                
                for (let i = length; i >= 1; i--) {
                    sum += numbers.charAt(length - i) * pos--;
                    if (pos < 2) pos = 9;
                }
                
                result = sum % 11 < 2 ? 0 : 11 - sum % 11;
                
                return result === parseInt(digits.charAt(1));
            }
            
            async lookupCEP(cep) {
                cep = cep.replace(/\D/g, '');
                
                if (cep.length === 8) {
                    try {
                        const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
                        const data = await response.json();
                        
                        if (!data.erro) {
                            document.getElementById('endereco').value = data.logradouro || '';
                            document.getElementById('bairro').value = data.bairro || '';
                            document.getElementById('cidade').value = data.localidade || '';
                            document.getElementById('estado').value = data.uf || '';
                        }
                    } catch (error) {
                        console.error('Erro ao buscar CEP:', error);
                    }
                }
            }
            
            nextStep() {
                if (this.validateStep(this.currentStep)) {
                    if (this.currentStep < this.totalSteps) {
                        this.currentStep++;
                        this.updateStepDisplay();
                    }
                }
            }
            
            prevStep() {
                if (this.currentStep > 1) {
                    this.currentStep--;
                    this.updateStepDisplay();
                }
            }
            
            updateStepDisplay() {
                // Hide all sections
                document.querySelectorAll('.form-section').forEach(section => {
                    section.classList.remove('active');
                });
                
                // Show current section
                const currentSection = document.getElementById(`step-${this.currentStep}`);
                setTimeout(() => {
                    currentSection.classList.add('active');
                    currentSection.classList.add('fade-in');
                }, 100);
                
                // Update step indicators
                document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                    const stepNumber = index + 1;
                    indicator.classList.remove('active', 'completed');
                    
                    if (stepNumber < this.currentStep) {
                        indicator.classList.add('completed');
                        indicator.innerHTML = '<i class="fas fa-check"></i>';
                    } else if (stepNumber === this.currentStep) {
                        indicator.classList.add('active');
                        indicator.textContent = stepNumber;
                    } else {
                        indicator.textContent = stepNumber;
                    }
                });
                
                // Update step labels
                document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                    const stepNumber = index + 1;
                    const label = indicator.nextElementSibling;
                    
                    if (stepNumber < this.currentStep) {
                        label.className = 'text-sm font-medium text-green-600 mt-2';
                    } else if (stepNumber === this.currentStep) {
                        label.className = 'text-sm font-medium text-green-600 mt-2';
                    } else {
                        label.className = 'text-sm text-gray-500 mt-2';
                    }
                });
                
                // Update progress bars
                const progress1 = document.getElementById('progress-1');
                const progress2 = document.getElementById('progress-2');
                
                if (this.currentStep >= 2) {
                    progress1.style.width = '100%';
                    progress1.classList.add('bg-green-500');
                } else {
                    progress1.style.width = '0%';
                    progress1.classList.remove('bg-green-500');
                }
                
                if (this.currentStep >= 3) {
                    progress2.style.width = '100%';
                    progress2.classList.add('bg-green-500');
                } else {
                    progress2.style.width = '0%';
                    progress2.classList.remove('bg-green-500');
                }
            }
            
            submitForm() {
                if (this.validateStep(this.currentStep)) {
                    const submitBtn = document.getElementById('submit-btn');
                    const originalText = submitBtn.innerHTML;
                    
                    // Show loading state
                    submitBtn.innerHTML = '<div class="loading-spinner mr-2"></div> Processando...';
                    submitBtn.disabled = true;
                    
                    // Submit form
                    document.getElementById('registration-form').submit();
                }
            }
        }
        
        // Global functions for buttons
        function nextStep() {
            window.wizard.nextStep();
        }
        
        function prevStep() {
            window.wizard.prevStep();
        }
        
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(`${fieldId}-icon`);
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                field.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }
        
        // Initialize wizard when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            window.wizard = new AssociationWizard();
        });
    </script>
</body>
</html>
