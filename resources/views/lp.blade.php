<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $association->nome }} - Planos e Serviços</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                        },
                        accent: {
                            500: '#8b5cf6',
                            600: '#7c3aed',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
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
        
        @keyframes scaleIn {
            from { 
                opacity: 0; 
                transform: scale(0.9); 
            }
            to { 
                opacity: 1; 
                transform: scale(1); 
            }
        }
        
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }
        
        .animate-scale-in {
            animation: scaleIn 0.6s ease-out forwards;
            opacity: 0;
        }
        
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .gradient-mesh {
            background: 
                radial-gradient(at 0% 0%, rgba(102, 126, 234, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(118, 75, 162, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(14, 165, 233, 0.1) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(139, 92, 246, 0.1) 0px, transparent 50%);
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
        }
        
        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-gradient:hover::before {
            left: 100%;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .plan-card {
            background: white;
            border: 2px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .plan-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #0ea5e9);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .plan-card:hover::before {
            transform: scaleX(1);
        }
        
        .plan-card:hover {
            border-color: #667eea;
            box-shadow: 0 20px 40px -12px rgba(102, 126, 234, 0.3);
            transform: translateY(-4px);
        }
        
        .popular-badge {
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
        }
        
        .icon-box {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            transition: all 0.3s ease;
        }
        
        .icon-box:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: scale(1.1) rotate(5deg);
        }
        
        .icon-box:hover i {
            color: white !important;
        }
    </style>
</head>
<body class="bg-white text-slate-900 font-sans antialiased">
    
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-effect border-b border-slate-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-3">
                    @if($association->logo)
                        <img src="{{ Storage::url($association->logo) }}" alt="Logo" class="h-10 w-auto">
                    @else
                        <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-blue-500 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-building text-white text-lg"></i>
                        </div>
                    @endif
                    <div>
                        <h1 class="font-bold text-slate-900 text-lg">{{ $association->nome }}</h1>
                    </div>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="#planos" class="text-slate-600 hover:text-purple-600 font-medium transition-colors duration-200">Planos</a>
                    <a href="#sobre" class="text-slate-600 hover:text-purple-600 font-medium transition-colors duration-200">Sobre</a>
                    <a href="#contato" class="text-slate-600 hover:text-purple-600 font-medium transition-colors duration-200">Contato</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-40 lg:pb-32 overflow-hidden gradient-mesh">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 left-10 w-72 h-72 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl animate-float"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute bottom-20 left-1/2 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl animate-float" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if($association->logo)
                <div class="mb-8 animate-fade-in-up">
                    <img src="{{ Storage::url($association->logo) }}" alt="Logo da Associação" 
                         class="mx-auto h-20 w-auto object-contain drop-shadow-2xl">
                </div>
            @endif
            
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-slate-900 mb-6 animate-fade-in-up delay-100 leading-tight">
                {{ $association->nome }}
            </h1>
            
            @if($association->descricao)
                <p class="text-xl lg:text-2xl text-slate-600 max-w-3xl mx-auto mb-12 leading-relaxed animate-fade-in-up delay-200">
                    {{ $association->descricao }}
                </p>
            @endif
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center animate-fade-in-up delay-300">
                <a href="#planos" class="btn-gradient text-white font-bold py-4 px-10 rounded-2xl shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    Torne-se um associado
                </a>
                
                
            </div>
        </div>
    </section>

    <!-- Stats Section -->
 

    <!-- Plans Section -->
    <section id="planos" class="py-20 lg:py-32 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 lg:mb-20">
                <div class="inline-block mb-4">
                    <span class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide">
                        Nossos Planos
                    </span>
                </div>
                <h2 class="text-4xl lg:text-6xl font-black text-slate-900 mb-6">
                    Escolha o plano <span class="text-gradient">perfeito</span>
                </h2>
                <p class="text-xl text-slate-600 max-w-2xl mx-auto">
                    Soluções flexíveis que crescem junto com você
                </p>
            </div>

            @php
                $activePlans = $association->plans->where('is_active', true);
                $planCount = $activePlans->count();
                
                $gridClass = match($planCount) {
                    1 => 'flex justify-center',
                    2 => 'grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto',
                    3 => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8',
                    default => 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8'
                };
            @endphp

            <div class="{{ $gridClass }}">
                @forelse($activePlans as $index => $plan)
                    <div class="plan-card rounded-3xl p-8 {{ $planCount === 1 ? 'max-w-md' : '' }} relative">
                        
                        <!-- Popular Badge -->
                        @if($index === 1 && $planCount > 2)
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-10">
                                <span class="popular-badge text-white px-6 py-2 rounded-full text-sm font-bold uppercase tracking-wide">
                                    <i class="fas fa-crown mr-1"></i>
                                    Mais Popular
                                </span>
                            </div>
                        @endif
                        
                        <!-- Plan Content -->
                        <div class="text-center">
                            @if($plan->image)
                                <div class="w-20 h-20 mx-auto mb-6 rounded-2xl overflow-hidden shadow-lg">
                                    <img src="{{ Storage::url($plan->image) }}" alt="Imagem do Plano" 
                                         class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-20 h-20 icon-box rounded-2xl mx-auto mb-6 flex items-center justify-center shadow-lg">
                                    <i class="fas fa-gem text-purple-600 text-3xl"></i>
                                </div>
                            @endif

                            <h3 class="text-2xl font-black text-slate-900 mb-3">{{ $plan->name }}</h3>
                            <p class="text-slate-600 mb-8 leading-relaxed min-h-[3rem]">{{ $plan->description }}</p>
                            
                            <div class="mb-8 py-6 bg-gradient-to-br from-slate-50 to-purple-50 rounded-2xl">
                                <div class="flex items-baseline justify-center mb-1">
                                    <span class="text-2xl font-bold text-slate-600">R$</span>
                                    <span class="text-6xl font-black text-slate-900 mx-2">
                                        {{ number_format(floor($plan->getTotalPriceAttribute()), 0, ',', '.') }}
                                    </span>
                                </div>
                                <p class="text-slate-500 font-semibold capitalize">
                                    por {{ $plan->recurrence }}
                                </p>
                            </div>

                            <a href="{{ route('checkout.show', ['hash_id' => $plan->hash_id]) }}" 
                               class="block w-full btn-gradient text-white font-bold py-4 px-6 rounded-2xl text-center shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-arrow-right mr-2"></i>
                                Começar Agora
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="max-w-md mx-auto text-center plan-card rounded-3xl p-12">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl mx-auto mb-6 flex items-center justify-center">
                            <i class="fas fa-clock text-slate-400 text-3xl"></i>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 mb-4">Em Breve</h3>
                        <p class="text-slate-600 mb-8 text-lg">Novos planos incríveis estão chegando!</p>
                        <a href="#contato" class="inline-block btn-gradient text-white font-bold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300">
                            Entrar em Contato
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="sobre" class="py-20 lg:py-32 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 lg:gap-20 items-center">
                <div>
                    <div class="inline-block mb-6">
                        <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide">
                            Sobre Nós
                        </span>
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-black text-slate-900 mb-8 leading-tight">
                        Conheça nossa <span class="text-gradient">história</span>
                    </h2>
                    
                    @if($association->descricao)
                        <p class="text-xl text-slate-600 mb-10 leading-relaxed">
                            {{ $association->descricao }}
                        </p>
                    @endif
                    
                    <div class="space-y-6">
                        @if($association->data_fundacao)
                            <div class="flex items-center group">
                                <div class="w-14 h-14 icon-box rounded-2xl flex items-center justify-center mr-5 shadow-md">
                                    <i class="fas fa-calendar text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-lg">Fundada em</p>
                                    <p class="text-slate-600">{{ $association->data_fundacao->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        @endif
                        
                        @if($association->numero_membros)
                            <div class="flex items-center group">
                                <div class="w-14 h-14 icon-box rounded-2xl flex items-center justify-center mr-5 shadow-md">
                                    <i class="fas fa-users text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-900 text-lg">Membros ativos</p>
                                    <p class="text-slate-600">{{ number_format($association->numero_membros, 0, ',', '.') }} pessoas</p>
                                </div>
                            </div>
                        @endif
                        
                    </div>
                </div>
                
                <div class="relative">
                    @if($association->logo)
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-400 to-blue-400 rounded-3xl transform rotate-3 opacity-20"></div>
                            <img src="{{ Storage::url($association->logo) }}" alt="Logo da Associação" 
                                 class="relative w-full max-w-lg mx-auto rounded-3xl shadow-2xl transform hover:scale-105 transition-transform duration-500">
                        </div>
                    @else
                        <div class="relative w-full max-w-lg mx-auto h-96 bg-gradient-to-br from-purple-100 to-blue-100 rounded-3xl flex items-center justify-center shadow-2xl">
                            <i class="fas fa-building text-purple-300 text-8xl"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="py-20 lg:py-32 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 lg:mb-20">
                <div class="inline-block mb-4">
                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold uppercase tracking-wide">
                        Contato
                    </span>
                </div>
                <h2 class="text-4xl lg:text-6xl font-black text-slate-900 mb-6">
                    Vamos <span class="text-gradient">conversar</span>?
                </h2>
                <p class="text-xl text-slate-600">
                    Estamos prontos para ajudar você
                </p>
            </div>
            
            <div class="grid lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="space-y-6">
                    @if($association->telefone)
                        <div class="flex items-center group">
                            <div class="w-16 h-16 icon-box rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                                <i class="fas fa-phone text-purple-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1 text-lg">Telefone</h3>
                                <p class="text-slate-600 text-lg">{{ $association->telefone_formatado }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->email)
                        <div class="flex items-center group">
                            <div class="w-16 h-16 icon-box rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                                <i class="fas fa-envelope text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1 text-lg">E-mail</h3>
                                <p class="text-slate-600 text-lg break-all">{{ $association->email }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->endereco)
                        <div class="flex items-start group">
                            <div class="w-16 h-16 icon-box rounded-2xl flex items-center justify-center mr-6 shadow-lg flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1 text-lg">Endereço</h3>
                                <p class="text-slate-600 leading-relaxed text-lg">{{ $association->endereco_completo }}</p>
                            </div>
                        </div>
                    @endif
                    
                    @if($association->site)
                        <div class="flex items-center group">
                            <div class="w-16 h-16 icon-box rounded-2xl flex items-center justify-center mr-6 shadow-lg">
                                <i class="fas fa-globe text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900 mb-1 text-lg">Website</h3>
                                <a href="{{ $association->site }}" target="_blank" 
                                   class="text-purple-600 hover:text-purple-700 transition-colors text-lg font-semibold">
                                    {{ $association->site }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Contact Form -->
                <div class="bg-white rounded-3xl p-8 lg:p-10 shadow-2xl border-2 border-slate-100">
                    <h3 class="text-2xl font-black text-slate-900 mb-8">Envie uma mensagem</h3>
                    
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Nome</label>
                                <input type="text" class="w-full px-4 py-3.5 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-200 font-medium">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">E-mail</label>
                                <input type="email" class="w-full px-4 py-3.5 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-200 font-medium">
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Assunto</label>
                            <input type="text" class="w-full px-4 py-3.5 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-200 font-medium">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Mensagem</label>
                            <textarea rows="5" class="w-full px-4 py-3.5 border-2 border-slate-200 rounded-xl focus:ring-4 focus:ring-purple-100 focus:border-purple-500 transition-all duration-200 resize-none font-medium"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full btn-gradient text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Enviar Mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
                <!-- Association Info -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        @if($association->logo)
                            <img src="{{ Storage::url($association->logo) }}" alt="Logo" class="h-10 w-auto">
                        @else
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-blue-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-building text-white text-lg"></i>
                            </div>
                        @endif
                        <h3 class="font-bold text-xl">{{ $association->nome }}</h3>
                    </div>
                    @if($association->descricao)
                        <p class="text-slate-400 leading-relaxed">{{ Str::limit($association->descricao, 150) }}</p>
                    @endif
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="font-bold text-lg mb-6">Links Rápidos</h3>
                    <ul class="space-y-3">
                        <li><a href="#planos" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Planos</a></li>
                        <li><a href="#sobre" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Sobre</a></li>
                        <li><a href="#contato" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Contato</a></li>
                        @if($association->site)
                            <li><a href="{{ $association->site }}" target="_blank" class="text-slate-400 hover:text-white transition-colors duration-200 flex items-center"><i class="fas fa-chevron-right text-xs mr-2"></i>Website</a></li>
                        @endif
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="font-bold text-lg mb-6">Contato</h3>
                    <div class="space-y-3 text-slate-400">
                        @if($association->telefone)
                            <p class="flex items-center"><i class="fas fa-phone mr-3 w-4 text-purple-400"></i>{{ $association->telefone_formatado }}</p>
                        @endif
                        @if($association->email)
                            <p class="flex items-center"><i class="fas fa-envelope mr-3 w-4 text-purple-400"></i>{{ $association->email }}</p>
                        @endif
                        @if($association->cidade && $association->estado)
                            <p class="flex items-center"><i class="fas fa-map-marker-alt mr-3 w-4 text-purple-400"></i>{{ $association->cidade }}/{{ $association->estado }}</p>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="border-t border-slate-800 pt-8 text-center text-slate-400">
                <p class="mb-2">&copy; {{ now()->year }} {{ $association->nome }}. Todos os direitos reservados.</p>
                @if($association->documento_formatado)
                    <p class="text-sm">{{ $association->tipo === 'pf' ? 'CPF' : 'CNPJ' }}: {{ $association->documento_formatado }}</p>
                @endif
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('[class*="animate-"]').forEach(el => {
            if (!el.classList.contains('animate-float')) {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            }
        });
    </script>
</body>
</html>
