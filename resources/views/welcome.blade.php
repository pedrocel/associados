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
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            900: '#14532d'
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-white text-gray-900">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-primary-600">AssociaMe</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">Login</a>
                    <a href="{{ route('association.register.form') }}" class="bg-primary-600 text-white px-6 py-2 rounded-lg hover:bg-primary-700 transition-colors font-medium">Abrir uma associação</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-5xl sm:text-6xl font-bold text-gray-900 mb-6">
                    Crie e gerencie sua associação em poucos cliques
                </h2>
                <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                    Totalmente online. Sem burocracia. Para pessoas físicas e jurídicas.
                </p>
                <a href="{{  route('association.register.form') }}" class="bg-primary-600 text-white px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-700 transition-colors inline-block">
                    Abrir uma Associação Agora
                </a>
            </div>
        </div>
    </section>

    <!-- Benefícios -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Por que escolher o AssociaMe?</h3>
                <p class="text-gray-600 text-lg">Simplifique a gestão da sua associação com nossa plataforma completa</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-cogs text-primary-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Gestão Simplificada</h4>
                    <p class="text-gray-600">Interface intuitiva para gerenciar todos os aspectos da sua associação de forma eficiente.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-primary-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Acesso Seguro</h4>
                    <p class="text-gray-600">Seus dados protegidos com os mais altos padrões de segurança e privacidade.</p>
                </div>
                <div class="text-center p-6">
                    <div class="bg-primary-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-primary-600 text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-semibold mb-2">Membros Ilimitados</h4>
                    <p class="text-gray-600">Cadastre quantos membros precisar, sem limitações ou custos adicionais.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Como Funciona -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Como funciona</h3>
                <p class="text-gray-600 text-lg">Apenas 3 passos simples para começar</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">1</div>
                    <h4 class="text-xl font-semibold mb-2">Cadastre-se</h4>
                    <p class="text-gray-600">Crie sua conta em poucos minutos com dados básicos da sua associação.</p>
                </div>
                <div class="text-center">
                    <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">2</div>
                    <h4 class="text-xl font-semibold mb-2">Configure</h4>
                    <p class="text-gray-600">Personalize sua associação com informações, regras e estrutura organizacional.</p>
                </div>
                <div class="text-center">
                    <div class="bg-primary-600 text-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-xl font-bold">3</div>
                    <h4 class="text-xl font-semibold mb-2">Gerencie</h4>
                    <p class="text-gray-600">Convide membros, organize eventos e administre sua associação online.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Para Quem É -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Para quem é o AssociaMe?</h3>
                <p class="text-gray-600 text-lg">Ideal para qualquer tipo de organização</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center p-6 border rounded-lg hover:shadow-lg transition-shadow">
                    <i class="fas fa-dumbbell text-primary-600 text-3xl mb-4"></i>
                    <h4 class="font-semibold mb-2">Clubes Esportivos</h4>
                    <p class="text-gray-600 text-sm">Organize campeonatos, gerencie atletas e controle mensalidades.</p>
                </div>
                <div class="text-center p-6 border rounded-lg hover:shadow-lg transition-shadow">
                    <i class="fas fa-heart text-primary-600 text-3xl mb-4"></i>
                    <h4 class="font-semibold mb-2">ONGs</h4>
                    <p class="text-gray-600 text-sm">Coordene voluntários, projetos sociais e arrecadações.</p>
                </div>
                <div class="text-center p-6 border rounded-lg hover:shadow-lg transition-shadow">
                    <i class="fas fa-building text-primary-600 text-3xl mb-4"></i>
                    <h4 class="font-semibold mb-2">Empresas</h4>
                    <p class="text-gray-600 text-sm">Associações empresariais, sindicatos e câmaras de comércio.</p>
                </div>
                <div class="text-center p-6 border rounded-lg hover:shadow-lg transition-shadow">
                    <i class="fas fa-users text-primary-600 text-3xl mb-4"></i>
                    <h4 class="font-semibold mb-2">Coletivos</h4>
                    <p class="text-gray-600 text-sm">Grupos comunitários, culturais e de interesse comum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">O que nossos usuários dizem</h3>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=50&h=50&fit=crop&crop=face" alt="João Silva" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h5 class="font-semibold">João Silva</h5>
                            <p class="text-gray-600 text-sm">Presidente do Clube de Futebol São Pedro</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Transformou completamente a gestão do nosso clube. Agora tudo é digital e organizado!"</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=50&h=50&fit=crop&crop=face" alt="Maria Santos" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h5 class="font-semibold">Maria Santos</h5>
                            <p class="text-gray-600 text-sm">Coordenadora da ONG Esperança</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Conseguimos dobrar o número de voluntários organizados através da plataforma."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <div class="flex items-center mb-4">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=50&h=50&fit=crop&crop=face" alt="Carlos Oliveira" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h5 class="font-semibold">Carlos Oliveira</h5>
                            <p class="text-gray-600 text-sm">Diretor da Associação Comercial Local</p>
                        </div>
                    </div>
                    <p class="text-gray-600">"Interface intuitiva e suporte excelente. Recomendo para qualquer associação."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h3 class="text-3xl font-bold text-gray-900 mb-4">Perguntas Frequentes</h3>
            </div>
            <div class="space-y-6">
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold mb-2">É gratuito para criar uma associação?</h4>
                    <p class="text-gray-600">Sim! Você pode começar gratuitamente e escolher um plano pago conforme sua associação cresce.</p>
                </div>
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold mb-2">Posso migrar minha associação existente?</h4>
                    <p class="text-gray-600">Absolutamente! Nossa equipe te ajuda a migrar todos os dados da sua associação atual.</p>
                </div>
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold mb-2">Qual o limite de membros?</h4>
                    <p class="text-gray-600">Não há limite! Você pode cadastrar quantos membros precisar, sem custos adicionais.</p>
                </div>
                <div class="border-b pb-6">
                    <h4 class="text-lg font-semibold mb-2">Os dados ficam seguros?</h4>
                    <p class="text-gray-600">Sim, utilizamos criptografia avançada e seguimos as melhores práticas de segurança e LGPD.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Final -->
    <section class="py-20 bg-primary-600">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h3 class="text-3xl font-bold text-white mb-4">Pronto para começar?</h3>
            <p class="text-xl text-primary-100 mb-8">Crie sua associação em poucos minutos e transforme sua gestão.</p>
            <a href="{{ ('association.register.form') }}" class="bg-white text-primary-600 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition-colors inline-block">
                Abrir uma Associação Agora
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">AssociaMe</h4>
                    <p class="text-gray-400">A plataforma completa para criar e gerenciar associações online.</p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Produto</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Funcionalidades</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Preços</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Integrações</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Suporte</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contato</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Redes Sociais</h5>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 AssociaMe. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>