<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AssociaMe - Crie e gerencie sua associação</title>
    <meta name="description" content="Plataforma online para criar e gerenciar associações de qualquer tipo. Totalmente online, sem burocracia, para pessoas físicas e jurídicas.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.6s ease-out',
                        'fade-in-up': 'fadeInUp 0.8s ease-out',
                        'scale-in': 'scaleIn 0.5s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        },
                        scaleIn: {
                            '0%': { opacity: '0', transform: 'scale(0.95)' },
                            '100%': { opacity: '1', transform: 'scale(1)' }
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-20px)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons via CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
        }
        
        .gradient-hero {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.05) 0%, rgba(34, 197, 94, 0.1) 100%);
        }
        
        .gradient-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(240, 253, 244, 1) 100%);
        }
        
        .shadow-elegant {
            box-shadow: 0 10px 40px -10px rgba(34, 197, 94, 0.1);
        }
        
        .shadow-hover {
            box-shadow: 0 20px 50px -10px rgba(34, 197, 94, 0.2);
        }
        
        .btn-primary {
            background: #16a34a;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: #15803d;
            transform: translateY(-2px);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            border-color: rgba(34, 197, 94, 0.5);
            box-shadow: 0 20px 50px -10px rgba(34, 197, 94, 0.2);
            transform: translateY(-5px);
        }
        
        .icon-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover .icon-hover {
            transform: scale(1.1);
        }
        
        @media (max-width: 768px) {
            .animate-fade-in,
            .animate-fade-in-up,
            .animate-scale-in {
                animation: none;
                opacity: 1;
                transform: none;
            }
        }
    </style>
</head>
<body class="bg-white text-gray-900">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 glass-effect border-b border-gray-200">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center gap-3 animate-fade-in">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary-600">
                        <i data-lucide="users" class="w-6 h-6 text-white"></i>
                    </div>
                    <h1 class="text-2xl font-bold bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent">
                        AssociaMe
                    </h1>
                </div>
                <div class="flex items-center gap-4 animate-fade-in">
                    <a href="/login" class="text-gray-700 hover:text-primary-600 font-medium transition-colors px-4 py-2">
                        Login
                    </a>
                    <a href="/cadastro-associacao" class="btn-primary px-6 py-2.5 rounded-lg font-medium shadow-elegant">
                        Abrir uma associação
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 overflow-hidden">
        <div class="absolute inset-0 gradient-hero opacity-60"></div>
        <div class="absolute inset-0 bg-gradient-radial from-primary-100/30 via-transparent to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 animate-fade-in-up">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 border border-primary-200">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-primary-600"></i>
                        <span class="text-sm font-medium text-primary-700">
                            100% online e sem burocracia
                        </span>
                    </div>
                    
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold leading-tight">
                        Crie e gerencie sua 
                        <span class="bg-gradient-to-r from-primary-600 via-primary-500 to-primary-600 bg-clip-text text-transparent">
                            associação
                        </span> 
                        em minutos
                    </h1>
                    
                    <p class="text-xl text-gray-600 leading-relaxed">
                        A plataforma completa para criar, gerenciar e expandir sua associação. 
                        Totalmente online, para pessoas físicas e jurídicas.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/registro" class="btn-primary px-8 py-4 rounded-lg text-lg font-semibold shadow-elegant inline-flex items-center justify-center group">
                            Abrir uma Associação
                            <i data-lucide="arrow-right" class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="#como-funciona" class="border-2 border-gray-300 hover:border-primary-600 hover:bg-primary-50 px-8 py-4 rounded-lg text-lg font-semibold transition-all inline-flex items-center justify-center">
                            Ver como funciona
                        </a>
                    </div>
                    
                    <div class="flex items-center gap-8 pt-8">
                        <div>
                            <div class="text-3xl font-bold text-primary-600">10k+</div>
                            <div class="text-sm text-gray-600">Associações criadas</div>
                        </div>
                        <div class="w-px h-12 bg-gray-300"></div>
                        <div>
                            <div class="text-3xl font-bold text-primary-600">50k+</div>
                            <div class="text-sm text-gray-600">Membros ativos</div>
                        </div>
                        <div class="w-px h-12 bg-gray-300"></div>
                        <div>
                            <div class="text-3xl font-bold text-primary-600">4.9</div>
                            <div class="text-sm text-gray-600">Avaliação média</div>
                        </div>
                    </div>
                </div>
                
                <div class="relative animate-scale-in">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary-200/40 to-primary-300/40 rounded-3xl blur-3xl"></div>
                    <img 
                        src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop" 
                        alt="Pessoas colaborando em associações" 
                        class="relative rounded-3xl shadow-hover w-full h-auto"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">
                    Por que escolher o 
                    <span class="bg-gradient-to-r from-primary-600 to-primary-500 bg-clip-text text-transparent">
                        AssociaMe
                    </span>?
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Simplifique a gestão da sua associação com nossa plataforma completa e intuitiva
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="settings" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Gestão Simplificada</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Interface intuitiva para gerenciar todos os aspectos da sua associação de forma eficiente e organizada.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="shield" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Acesso Seguro</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Seus dados protegidos com os mais altos padrões de segurança e conformidade com a LGPD.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="users" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Membros Ilimitados</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Cadastre quantos membros precisar, sem limitações ou custos adicionais por usuário.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="zap" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Automatização Inteligente</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Automatize processos repetitivos e foque no que realmente importa para sua associação.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="globe" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Acesso de Qualquer Lugar</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Gerencie sua associação de qualquer dispositivo, a qualquer hora, de qualquer lugar do mundo.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-start gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="lock" class="w-7 h-7 text-primary-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold">Privacidade Garantida</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Total controle sobre seus dados com políticas rigorosas de privacidade e backup automático.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="como-funciona" class="py-24 bg-gradient-to-b from-white to-primary-50/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">Como funciona</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Apenas 3 passos simples para transformar a gestão da sua associação
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8 relative">
                <div class="hidden md:block absolute top-1/4 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-primary-300 to-transparent -z-10"></div>
                
                <div class="relative bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-center text-center gap-6">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-primary-600 flex items-center justify-center icon-hover">
                                <i data-lucide="user-plus" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white">
                                <span class="text-sm font-bold text-primary-600">01</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-semibold">Cadastre-se</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Crie sua conta em poucos minutos com dados básicos da sua associação. Processo simples e rápido.
                        </p>
                    </div>
                </div>
                
                <div class="relative bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-center text-center gap-6">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-primary-600 flex items-center justify-center icon-hover">
                                <i data-lucide="settings-2" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white">
                                <span class="text-sm font-bold text-primary-600">02</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-semibold">Configure</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Personalize sua associação com informações, regras e estrutura organizacional de forma intuitiva.
                        </p>
                    </div>
                </div>
                
                <div class="relative bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col items-center text-center gap-6">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-primary-600 flex items-center justify-center icon-hover">
                                <i data-lucide="rocket" class="w-10 h-10 text-white"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center border-2 border-white">
                                <span class="text-sm font-bold text-primary-600">03</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-semibold">Gerencie</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Convide membros, organize eventos e administre sua associação com eficiência total.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- For Who Section -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">Para quem é o AssociaMe?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Ideal para qualquer tipo de organização que deseja profissionalizar sua gestão
                </p>
            </div>
            
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="dumbbell" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Clubes Esportivos</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Organize campeonatos, gerencie atletas e controle mensalidades com facilidade.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="heart" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">ONGs</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Coordene voluntários, projetos sociais e arrecadações de forma eficiente.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="building-2" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Empresas</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Associações empresariais, sindicatos e câmaras de comércio.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="users" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Coletivos</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Grupos comunitários, culturais e de interesse comum.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="graduation-cap" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Instituições de Ensino</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Associações de pais, mestres e ex-alunos.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="tree-pine" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Associações Ambientais</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Grupos de preservação e conscientização ambiental.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="music" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Grupos Culturais</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Associações artísticas, musicais e culturais.
                        </p>
                    </div>
                </div>
                
                <div class="gradient-card p-6 border-2 border-gray-200 rounded-2xl card-hover cursor-pointer">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-primary-100 flex items-center justify-center icon-hover">
                            <i data-lucide="briefcase" class="w-8 h-8 text-primary-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold">Profissionais</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            Associações e conselhos profissionais diversos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-24 bg-gradient-to-b from-primary-50/20 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">O que nossos usuários dizem</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Histórias reais de quem transformou a gestão da sua associação
                </p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col gap-6">
                        <div class="flex gap-1">
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic">
                            "Transformou completamente a gestão do nosso clube. Agora tudo é digital, organizado e acessível. A comunicação com os membros melhorou significativamente!"
                        </p>
                        <div class="flex items-center gap-4 pt-4 border-t">
                            <img 
                                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" 
                                alt="João Silva"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div>
                                <h4 class="font-semibold">João Silva</h4>
                                <p class="text-sm text-gray-600">Presidente do Clube de Futebol São Pedro</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col gap-6">
                        <div class="flex gap-1">
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic">
                            "Conseguimos dobrar o número de voluntários organizados através da plataforma. A transparência na gestão nos trouxe mais credibilidade e doadores."
                        </p>
                        <div class="flex items-center gap-4 pt-4 border-t">
                            <img 
                                src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" 
                                alt="Maria Santos"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div>
                                <h4 class="font-semibold">Maria Santos</h4>
                                <p class="text-sm text-gray-600">Coordenadora da ONG Esperança</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white p-8 border-2 border-gray-200 rounded-2xl card-hover">
                    <div class="flex flex-col gap-6">
                        <div class="flex gap-1">
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                            <i data-lucide="star" class="w-5 h-5 fill-primary-600 text-primary-600"></i>
                        </div>
                        <p class="text-gray-600 leading-relaxed italic">
                            "Interface intuitiva e suporte excelente. Nossa associação cresceu 300% em um ano. Recomendo para qualquer organização séria."
                        </p>
                        <div class="flex items-center gap-4 pt-4 border-t">
                            <img 
                                src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=100&h=100&fit=crop&crop=face" 
                                alt="Carlos Oliveira"
                                class="w-12 h-12 rounded-full object-cover"
                            />
                            <div>
                                <h4 class="font-semibold">Carlos Oliveira</h4>
                                <p class="text-sm text-gray-600">Diretor da Associação Comercial Local</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-24 bg-white">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in">
                <h2 class="text-4xl sm:text-5xl font-bold mb-4">Perguntas Frequentes</h2>
                <p class="text-xl text-gray-600">Tire suas dúvidas sobre o AssociaMe</p>
            </div>
            
            <div class="space-y-4">
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>É gratuito para criar uma associação?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Sim! Você pode começar gratuitamente e ter acesso a recursos essenciais. Conforme sua associação cresce, você pode escolher planos com funcionalidades avançadas.
                    </p>
                </details>
                
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>Posso migrar minha associação existente?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Absolutamente! Nossa equipe especializada te ajuda a migrar todos os dados da sua associação atual de forma segura e sem perder informações. O processo é guiado e sem complicações.
                    </p>
                </details>
                
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>Qual o limite de membros?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Não há limite! Você pode cadastrar quantos membros precisar, sem custos adicionais por usuário. Nossa infraestrutura escala conforme sua associação cresce.
                    </p>
                </details>
                
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>Os dados ficam seguros?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Sim, utilizamos criptografia de ponta, backups automáticos diários e seguimos rigorosamente as normas da LGPD. Seus dados são armazenados em servidores seguros no Brasil.
                    </p>
                </details>
                
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>Posso personalizar a plataforma?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Sim! Você pode personalizar cores, logos, adicionar campos customizados e adaptar a plataforma às necessidades específicas da sua associação.
                    </p>
                </details>
                
                <details class="group border-2 border-gray-200 rounded-2xl px-6 py-4 hover:border-primary-500 transition-colors">
                    <summary class="flex justify-between items-center cursor-pointer text-lg font-semibold hover:text-primary-600 list-none">
                        <span>Há suporte técnico disponível?</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 group-open:rotate-180 transition-transform"></i>
                    </summary>
                    <p class="mt-4 text-gray-600 leading-relaxed">
                        Oferecemos suporte via chat, email e telefone. Nossa equipe está pronta para ajudar você a tirar o máximo proveito da plataforma.
                    </p>
                </details>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 relative overflow-hidden bg-gradient-to-br from-primary-600 via-primary-500 to-primary-700">
        <div class="absolute inset-0 bg-gradient-radial from-white/10 via-transparent to-transparent"></div>
        
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center animate-fade-in-up">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6">
                Pronto para transformar sua associação?
            </h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                Junte-se a milhares de associações que já revolucionaram sua gestão com o AssociaMe.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                <a href="/registro" class="bg-white text-primary-600 hover:bg-gray-100 px-8 py-4 rounded-lg text-lg font-semibold shadow-hover transition-all inline-flex items-center justify-center group">
                    Criar Minha Associação
                    <i data-lucide="arrow-right" class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                </a>
                <a href="/contato" class="border-2 border-white text-white hover:bg-white/10 px-8 py-4 rounded-lg text-lg font-semibold transition-all inline-flex items-center justify-center">
                    Falar com Especialista
                </a>
            </div>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6 text-white/90">
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    <span>Sem cartão de crédito</span>
                </div>
                <div class="hidden sm:block w-1 h-1 rounded-full bg-white/50"></div>
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    <span>Configuração em 5 minutos</span>
                </div>
                <div class="hidden sm:block w-1 h-1 rounded-full bg-white/50"></div>
                <div class="flex items-center gap-2">
                    <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                    <span>Suporte gratuito</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-primary-600">
                            <i data-lucide="users" class="w-6 h-6 text-white"></i>
                        </div>
                        <h4 class="text-xl font-bold">AssociaMe</h4>
                    </div>
                    <p class="text-gray-400 leading-relaxed">
                        A plataforma completa para criar e gerenciar associações online com eficiência e profissionalismo.
                    </p>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4 text-lg">Produto</h5>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Funcionalidades</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Preços</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Integrações</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">API</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4 text-lg">Empresa</h5>
                    <ul class="space-y-3 text-gray-400">
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Sobre Nós</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Blog</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Carreiras</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Contato</a></li>
                    </ul>
                </div>
                
                <div>
                    <h5 class="font-semibold mb-4 text-lg">Suporte</h5>
                    <ul class="space-y-3 text-gray-400 mb-6">
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Documentação</a></li>
                        <li><a href="#" class="hover:text-primary-500 transition-colors">Status</a></li>
                    </ul>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i data-lucide="facebook" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i data-lucide="twitter" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i data-lucide="linkedin" class="w-5 h-5"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <i data-lucide="instagram" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4 text-gray-400">
                <p>&copy; 2025 AssociaMe. Todos os direitos reservados.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-primary-500 transition-colors">Privacidade</a>
                    <a href="#" class="hover:text-primary-500 transition-colors">Termos</a>
                    <a href="#" class="hover:text-primary-500 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        lucide.createIcons();
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>
</html>
