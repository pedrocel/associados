@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Top Bar -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4 sticky top-0 z-50">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('associations.pages.index', $association->slug) }}" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                </a>
                <div>
                    <h1 class="text-xl font-bold text-gray-900 dark:text-white">{{ $page->name }}</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400">/{{ $page->slug }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-3">
                <form action="{{ route('associations.pages.toggle-publish', [$association->slug, $page]) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 {{ $page->is_published ? 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' : 'bg-green-600 text-white hover:bg-green-700' }} rounded-lg font-medium transition">
                        <i data-lucide="{{ $page->is_published ? 'eye-off' : 'eye' }}" class="w-4 h-4 inline mr-2"></i>
                        {{ $page->is_published ? 'Despublicar' : 'Publicar' }}
                    </button>
                </form>
                
                <a href="{{ route('associations.pages.preview', [$association->slug, $page]) }}" target="_blank" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition">
                    <i data-lucide="external-link" class="w-4 h-4 inline mr-2"></i>
                    Preview
                </a>
                
                <button onclick="savePage()" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition shadow-lg shadow-purple-500/30">
                    <i data-lucide="save" class="w-4 h-4 inline mr-2"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>

    <div class="flex h-[calc(100vh-73px)]">
        <!-- Sidebar - Components -->
        @if($page->type === 'builder')
        <div class="w-80 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 overflow-y-auto">
            <div class="p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Componentes</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Clique para adicionar à página</p>
                
                <div class="space-y-3">
                    <!-- Improved component buttons with better visuals -->
                    <button onclick="addComponent('hero')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-purple-500 dark:hover:border-purple-500 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="layout" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Hero Section</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Seção principal com título e CTA</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-purple-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('features')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-blue-500 dark:hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="grid-3x3" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Features Grid</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Grade de recursos e benefícios</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-blue-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('pricing')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-green-500 dark:hover:border-green-500 hover:bg-green-50 dark:hover:bg-green-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="credit-card" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Pricing Table</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Tabela de planos e preços</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-green-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('text')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-yellow-500 dark:hover:border-yellow-500 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="type" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Text Block</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Bloco de texto rico</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-yellow-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('cta')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-red-500 dark:hover:border-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="megaphone" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Call to Action</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Seção de conversão</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-red-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('testimonials')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-indigo-500 dark:hover:border-indigo-500 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="message-square-quote" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Testimonials</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Depoimentos de clientes</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-indigo-500 transition"></i>
                    </button>
                    
                    <button onclick="addComponent('contact')" class="w-full flex items-center gap-3 p-4 border-2 border-gray-200 dark:border-gray-700 rounded-xl hover:border-pink-500 dark:hover:border-pink-500 hover:bg-pink-50 dark:hover:bg-pink-900/20 transition-all group shadow-sm hover:shadow-md">
                        <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform shadow-lg">
                            <i data-lucide="mail" class="w-6 h-6 text-white"></i>
                        </div>
                        <div class="text-left flex-1">
                            <div class="font-semibold text-gray-900 dark:text-white">Contact Form</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Formulário de contato</div>
                        </div>
                        <i data-lucide="plus-circle" class="w-5 h-5 text-gray-400 group-hover:text-pink-500 transition"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Editor Area -->
        <div class="flex-1 overflow-y-auto bg-gray-100 dark:bg-gray-950">
            @if($page->type === 'html')
                <!-- HTML Editor -->
                <div class="p-6">
                    <form id="page-form" action="{{ route('associations.pages.update', [$association->slug, $page]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="type" value="html">
                        
                        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 shadow-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Código HTML</label>
                            <textarea name="content" id="html-editor" rows="30" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white font-mono text-sm">{{ $page->content }}</textarea>
                        </div>
                    </form>
                </div>
            @else
                <!-- Visual Builder -->
                <div id="canvas" class="p-8 min-h-full">
                    <!-- Added empty state with better UX -->
                    <div id="empty-state" class="hidden">
                        <div class="max-w-2xl mx-auto text-center py-20">
                            <div class="w-20 h-20 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i data-lucide="layout" class="w-10 h-10 text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Comece a construir sua página</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-8">Adicione componentes da barra lateral para criar sua página personalizada</p>
                            <button onclick="addComponent('hero')" class="px-6 py-3 bg-purple-600 hover:bg-purple-700 text-white rounded-lg font-semibold transition shadow-lg shadow-purple-500/30">
                                <i data-lucide="plus" class="w-4 h-4 inline mr-2"></i>
                                Adicionar Primeiro Componente
                            </button>
                        </div>
                    </div>
                    
                    <div id="components-container" class="space-y-6 max-w-6xl mx-auto">
                        <!-- Components will be added here -->
                    </div>
                </div>
                
                <form id="page-form" action="{{ route('associations.pages.update', [$association->slug, $page]) }}" method="POST" class="hidden">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="type" value="builder">
                    <input type="hidden" name="components" id="components-data">
                </form>
            @endif
        </div>

        <!-- Properties Panel (for builder) -->
        @if($page->type === 'builder')
        <div id="properties-panel" class="w-96 bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 overflow-y-auto hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white">Propriedades</h2>
                    <button onclick="closeProperties()" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>
                <div id="properties-content">
                    <div class="text-center py-12">
                        <i data-lucide="mouse-pointer-click" class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-3"></i>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Clique em "Editar" em um componente para ver suas propriedades</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    lucide.createIcons();
    
    // --- NOVO CÓDIGO ---

// 1. Recebemos o valor bruto (que pode ser um Array JS ou uma String JSON)
let rawComponents = @json($page->components ?? []);

// 2. Definimos o array final, usando uma lógica defensiva.
let components;

if (typeof rawComponents === 'string' && rawComponents.trim().startsWith('[')) {
    // O Cast falhou no PHP, então decodificamos a string JSON no JavaScript.
    try {
        components = JSON.parse(rawComponents);
    } catch (e) {
        console.error("Erro ao decodificar componentes JSON:", e);
        components = []; // Em caso de JSON inválido, retorna vazio.
    }
} else if (Array.isArray(rawComponents)) {
    // O Cast funcionou (ou é novo dado), já é um array.
    components = rawComponents;
} else {
    // Valor nulo ou inesperado.
    components = [];
}

let selectedComponentIndex = null; // Mantenha a variável de controle

// --- FIM DO NOVO CÓDIGO ---
    
    renderComponents();
    updateEmptyState();
    
    function addComponent(type) {
        const defaultData = getDefaultComponentData(type);
        components.push({ type, data: defaultData });
        renderComponents();
        updateEmptyState();
        
        // Auto-select the new component
        setTimeout(() => {
            editComponent(components.length - 1);
        }, 100);
    }
    
    function getDefaultComponentData(type) {
        const defaults = {
            hero: {
                title: 'Transforme Seu Negócio Hoje',
                subtitle: 'Soluções inovadoras para impulsionar seu crescimento',
                button_text: 'Começar Agora',
                button_link: '#',
                bg_color: 'from-purple-600 to-blue-500'
            },
            features: {
                title: 'Recursos Poderosos',
                subtitle: 'Tudo que você precisa em um só lugar',
                features: [
                    { icon: 'zap', title: 'Ultra Rápido', description: 'Performance otimizada para máxima velocidade' },
                    { icon: 'shield', title: 'Totalmente Seguro', description: 'Proteção de dados de nível empresarial' },
                    { icon: 'heart', title: 'Suporte 24/7', description: 'Equipe dedicada sempre disponível' }
                ]
            },
            pricing: {
                title: 'Planos e Preços',
                subtitle: 'Escolha o plano perfeito para você',
                plans: [
                    { 
                        name: 'Básico', 
                        price: 'R$ 29', 
                        period: '/mês',
                        features: ['Recurso 1', 'Recurso 2', 'Recurso 3'], 
                        button_text: 'Começar', 
                        button_link: '#',
                        highlighted: false
                    },
                    { 
                        name: 'Pro', 
                        price: 'R$ 79', 
                        period: '/mês',
                        features: ['Tudo do Básico', 'Recurso 4', 'Recurso 5', 'Recurso 6'], 
                        button_text: 'Começar', 
                        button_link: '#',
                        highlighted: true
                    }
                ]
            },
            text: {
                title: 'Título da Seção',
                content: 'Digite seu conteúdo aqui. Você pode adicionar parágrafos, listas e formatação.',
                align: 'left'
            },
            cta: {
                title: 'Pronto para Começar?',
                description: 'Junte-se a milhares de usuários satisfeitos e transforme seu negócio hoje mesmo',
                button_text: 'Começar Agora',
                button_link: '#',
                bg_color: 'from-purple-600 to-purple-700'
            },
            testimonials: {
                title: 'O Que Nossos Clientes Dizem',
                subtitle: 'Histórias reais de sucesso',
                testimonials: [
                    { name: 'João Silva', role: 'CEO, Empresa XYZ', content: 'Excelente serviço! Superou todas as nossas expectativas.', avatar: '' },
                    { name: 'Maria Santos', role: 'Diretora de Marketing', content: 'Resultados incríveis em pouco tempo. Recomendo!', avatar: '' }
                ]
            },
            contact: {
                title: 'Entre em Contato',
                description: 'Estamos aqui para ajudar. Envie sua mensagem e responderemos em breve.',
                email: 'contato@exemplo.com',
                phone: '(11) 9999-9999'
            }
        };
        
        return defaults[type] || {};
    }
    
    function renderComponents() {
        const container = document.getElementById('components-container');
        container.innerHTML = '';
        
        components.forEach((component, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <div class="absolute -top-3 right-4 hidden group-hover:flex gap-2 z-20">
                    <button onclick="editComponent(${index})" class="px-4 py-2 bg-purple-600 text-white rounded-lg text-sm font-semibold hover:bg-purple-700 transition shadow-lg">
                        <i data-lucide="edit-3" class="w-3 h-3 inline mr-1"></i> Editar
                    </button>
                    <button onclick="moveComponent(${index}, -1)" class="px-3 py-2 bg-gray-700 text-white rounded-lg text-sm hover:bg-gray-800 transition shadow-lg ${index === 0 ? 'opacity-50 cursor-not-allowed' : ''}" ${index === 0 ? 'disabled' : ''}>
                        <i data-lucide="arrow-up" class="w-3 h-3"></i>
                    </button>
                    <button onclick="moveComponent(${index}, 1)" class="px-3 py-2 bg-gray-700 text-white rounded-lg text-sm hover:bg-gray-800 transition shadow-lg ${index === components.length - 1 ? 'opacity-50 cursor-not-allowed' : ''}" ${index === components.length - 1 ? 'disabled' : ''}>
                        <i data-lucide="arrow-down" class="w-3 h-3"></i>
                    </button>
                    <button onclick="duplicateComponent(${index})" class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition shadow-lg">
                        <i data-lucide="copy" class="w-3 h-3"></i>
                    </button>
                    <button onclick="deleteComponent(${index})" class="px-3 py-2 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700 transition shadow-lg">
                        <i data-lucide="trash-2" class="w-3 h-3"></i>
                    </button>
                </div>
                <div class="border-2 border-transparent group-hover:border-purple-500 dark:group-hover:border-purple-500 rounded-xl transition-all bg-white dark:bg-gray-800 shadow-sm group-hover:shadow-xl overflow-hidden">
                    ${renderComponentPreview(component)}
                </div>
            `;
            container.appendChild(div);
        });
        
        lucide.createIcons();
    }
    
    function renderComponentPreview(component) {
        const previews = {
            hero: (data) => `
                <div class="bg-gradient-to-br ${data.bg_color} p-16 text-center text-white">
                    <h1 class="text-4xl font-bold mb-4">${data.title}</h1>
                    <p class="text-xl mb-8 opacity-90">${data.subtitle}</p>
                    <button class="px-8 py-3 bg-white text-purple-600 rounded-lg font-semibold">${data.button_text}</button>
                </div>
            `,
            features: (data) => `
                <div class="p-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-3">${data.title}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mb-10">${data.subtitle || ''}</p>
                    <div class="grid grid-cols-3 gap-6">
                        ${data.features.map(f => `
                            <div class="text-center p-6 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="${f.icon}" class="w-6 h-6 text-purple-600 dark:text-purple-400"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 dark:text-white mb-2">${f.title}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">${f.description}</p>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `,
            pricing: (data) => `
                <div class="p-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-3">${data.title}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mb-10">${data.subtitle || ''}</p>
                    <div class="grid grid-cols-${data.plans.length} gap-6 max-w-4xl mx-auto">
                        ${data.plans.map(p => `
                            <div class="p-8 bg-white dark:bg-gray-700 rounded-2xl border-2 ${p.highlighted ? 'border-purple-500 shadow-xl' : 'border-gray-200 dark:border-gray-600'}">
                                ${p.highlighted ? '<div class="text-xs font-bold text-purple-600 dark:text-purple-400 mb-2">MAIS POPULAR</div>' : ''}
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">${p.name}</h3>
                                <div class="mb-6">
                                    <span class="text-4xl font-bold text-gray-900 dark:text-white">${p.price}</span>
                                    <span class="text-gray-600 dark:text-gray-400">${p.period}</span>
                                </div>
                                <ul class="space-y-3 mb-6">
                                    ${p.features.map(f => `<li class="text-sm text-gray-600 dark:text-gray-400">✓ ${f}</li>`).join('')}
                                </ul>
                                <button class="w-full py-3 ${p.highlighted ? 'bg-purple-600 text-white' : 'bg-gray-100 dark:bg-gray-600 text-gray-900 dark:text-white'} rounded-lg font-semibold">${p.button_text}</button>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `,
            text: (data) => `
                <div class="p-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4 text-${data.align}">${data.title}</h2>
                    <div class="text-gray-600 dark:text-gray-400 text-${data.align}">${data.content}</div>
                </div>
            `,
            cta: (data) => `
                <div class="bg-gradient-to-br ${data.bg_color} p-16 text-center text-white">
                    <h2 class="text-3xl font-bold mb-4">${data.title}</h2>
                    <p class="text-lg mb-8 opacity-90">${data.description}</p>
                    <button class="px-8 py-3 bg-white text-purple-600 rounded-lg font-semibold">${data.button_text}</button>
                </div>
            `,
            testimonials: (data) => `
                <div class="p-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-3">${data.title}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mb-10">${data.subtitle || ''}</p>
                    <div class="grid grid-cols-2 gap-6 max-w-4xl mx-auto">
                        ${data.testimonials.map(t => `
                            <div class="p-6 bg-white dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600">
                                <p class="text-gray-600 dark:text-gray-400 mb-4">"${t.content}"</p>
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-full"></div>
                                    <div>
                                        <div class="font-semibold text-gray-900 dark:text-white">${t.name}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">${t.role}</div>
                                    </div>
                                </div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            `,
            contact: (data) => `
                <div class="p-12">
                    <h2 class="text-3xl font-bold text-center text-gray-900 dark:text-white mb-3">${data.title}</h2>
                    <p class="text-center text-gray-600 dark:text-gray-400 mb-10">${data.description}</p>
                    <div class="max-w-2xl mx-auto grid grid-cols-2 gap-6">
                        <div class="col-span-2">
                            <input type="text" placeholder="Nome" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
                        </div>
                        <input type="email" placeholder="Email" class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
                        <input type="tel" placeholder="Telefone" class="px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700">
                        <textarea placeholder="Mensagem" rows="4" class="col-span-2 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700"></textarea>
                        <button class="col-span-2 py-3 bg-purple-600 text-white rounded-lg font-semibold">Enviar Mensagem</button>
                    </div>
                </div>
            `
        };
        
        return previews[component.type] ? previews[component.type](component.data) : `
            <div class="p-8 text-center">
                <div class="text-sm font-semibold text-gray-600 dark:text-gray-300 mb-2">${component.type.toUpperCase()}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Preview não disponível</div>
            </div>
        `;
    }
    
    function editComponent(index) {
        selectedComponentIndex = index;
        const component = components[index];
        
        document.getElementById('properties-panel').classList.remove('hidden');
        
        const propertiesContent = document.getElementById('properties-content');
        propertiesContent.innerHTML = generatePropertiesForm(component, index);
        
        lucide.createIcons();
    }
    
    function generatePropertiesForm(component, index) {
        let html = `
            <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wide">${component.type}</div>
            </div>
            <div class="space-y-4">
        `;
        
        // Generate form fields based on component data
        Object.keys(component.data).forEach(key => {
            const value = component.data[key];
            const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
            
            if (Array.isArray(value)) {
                // Handle arrays (features, plans, testimonials)
                html += `
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">${label}</label>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mb-2">${value.length} item(s)</div>
                        <button onclick="alert('Editor de arrays em desenvolvimento')" class="text-sm text-purple-600 dark:text-purple-400 hover:underline">Editar itens</button>
                    </div>
                `;
            } else if (key.includes('color')) {
                // Color/gradient selector
                html += `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${label}</label>
                        <select onchange="updateComponentData(${index}, '${key}', this.value)" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                            <option value="from-purple-600 to-blue-500" ${value.includes('purple') ? 'selected' : ''}>Roxo → Azul</option>
                            <option value="from-blue-600 to-cyan-500" ${value.includes('cyan') ? 'selected' : ''}>Azul → Ciano</option>
                            <option value="from-green-600 to-teal-500" ${value.includes('teal') ? 'selected' : ''}>Verde → Teal</option>
                            <option value="from-red-600 to-pink-500" ${value.includes('pink') ? 'selected' : ''}>Vermelho → Rosa</option>
                            <option value="from-orange-600 to-yellow-500" ${value.includes('yellow') ? 'selected' : ''}>Laranja → Amarelo</option>
                            <option value="from-gray-800 to-gray-900" ${value.includes('gray-9') ? 'selected' : ''}>Cinza Escuro</option>
                        </select>
                    </div>
                `;
            } else if (key === 'align') {
                // Text alignment
                html += `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${label}</label>
                        <div class="flex gap-2">
                            <button onclick="updateComponentData(${index}, '${key}', 'left'); this.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('bg-purple-600', 'text-white')); this.classList.add('bg-purple-600', 'text-white');" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg ${value === 'left' ? 'bg-purple-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white'}">
                                <i data-lucide="align-left" class="w-4 h-4 mx-auto"></i>
                            </button>
                            <button onclick="updateComponentData(${index}, '${key}', 'center'); this.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('bg-purple-600', 'text-white')); this.classList.add('bg-purple-600', 'text-white');" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg ${value === 'center' ? 'bg-purple-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white'}">
                                <i data-lucide="align-center" class="w-4 h-4 mx-auto"></i>
                            </button>
                            <button onclick="updateComponentData(${index}, '${key}', 'right'); this.parentElement.querySelectorAll('button').forEach(b => b.classList.remove('bg-purple-600', 'text-white')); this.classList.add('bg-purple-600', 'text-white');" class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg ${value === 'right' ? 'bg-purple-600 text-white' : 'bg-white dark:bg-gray-700 text-gray-900 dark:text-white'}">
                                <i data-lucide="align-right" class="w-4 h-4 mx-auto"></i>
                            </button>
                        </div>
                    </div>
                `;
            } else if (key.includes('content') && typeof value === 'string' && value.length > 50) {
                // Textarea for long content
                html += `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${label}</label>
                        <textarea onchange="updateComponentData(${index}, '${key}', this.value)" rows="4" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">${value}</textarea>
                    </div>
                `;
            } else if (typeof value === 'string') {
                // Regular text input
                html += `
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">${label}</label>
                        <input type="text" value="${value}" onchange="updateComponentData(${index}, '${key}', this.value)" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-purple-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm">
                    </div>
                `;
            }
        });
        
        html += `</div>`;
        return html;
    }
    
    function updateComponentData(index, key, value) {
        components[index].data[key] = value;
        renderComponents();
        // Keep properties panel open
        editComponent(index);
    }
    
    function moveComponent(index, direction) {
        const newIndex = index + direction;
        if (newIndex >= 0 && newIndex < components.length) {
            [components[index], components[newIndex]] = [components[newIndex], components[index]];
            renderComponents();
        }
    }
    
    function duplicateComponent(index) {
        const component = JSON.parse(JSON.stringify(components[index]));
        components.splice(index + 1, 0, component);
        renderComponents();
        updateEmptyState();
    }
    
    function deleteComponent(index) {
        if (confirm('Tem certeza que deseja deletar este componente?')) {
            components.splice(index, 1);
            renderComponents();
            updateEmptyState();
            closeProperties();
        }
    }
    
    function closeProperties() {
        document.getElementById('properties-panel').classList.add('hidden');
        selectedComponentIndex = null;
    }
    
    function updateEmptyState() {
        const emptyState = document.getElementById('empty-state');
        if (components.length === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }
    
    function savePage() {
        @if($page->type === 'builder')
            document.getElementById('components-data').value = JSON.stringify(components);
        @endif
        
        // Show saving feedback
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i data-lucide="loader" class="w-4 h-4 inline mr-2 animate-spin"></i> Salvando...';
        btn.disabled = true;
        
        document.getElementById('page-form').submit();
    }
</script>
@endsection
