<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - {{ $plan->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Finalizar Compra</h1>
            <p class="text-gray-600">Complete seus dados para adquirir o plano</p>
        </div>

        <form action="{{ route('checkout.store', $plan->hash_id) }}" method="POST" class="grid lg:grid-cols-3 gap-8">
            @csrf
            
            <!-- Formulário Principal -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Dados Pessoais -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">1</div>
                        <h2 class="text-xl font-semibold text-gray-900">Dados Pessoais</h2>
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                            <input type="text" name="name" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                   placeholder="Digite seu nome completo">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                   placeholder="seu@email.com">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Telefone</label>
                            <input type="tel" name="phone" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                   placeholder="(11) 99999-9999">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CPF/CNPJ</label>
                            <input type="text" name="document" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                   placeholder="000.000.000-00">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                            <input type="password" name="password" required 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                                   placeholder="Crie uma senha">
                        </div>
                    </div>
                </div>

                <!-- Método de Pagamento -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-8 h-8 bg-primary-500 rounded-full flex items-center justify-center text-white font-semibold text-sm mr-3">2</div>
                        <h2 class="text-xl font-semibold text-gray-900">Método de Pagamento</h2>
                    </div>
                    
                    <div class="space-y-4">
                        <!-- Cartão de Crédito -->
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="credit_card" class="text-primary-500 focus:ring-primary-500" checked>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fas fa-credit-card text-primary-500 mr-2"></i>
                                    <span class="font-medium text-gray-900">Cartão de Crédito</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Pagamento seguro e instantâneo</p>
                            </div>
                            <div class="flex space-x-2">
                                <i class="fab fa-cc-visa text-2xl text-blue-600"></i>
                                <i class="fab fa-cc-mastercard text-2xl text-red-500"></i>
                            </div>
                        </label>
                        
                        <!-- PIX -->
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="pix" class="text-primary-500 focus:ring-primary-500">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fas fa-qrcode text-primary-500 mr-2"></i>
                                    <span class="font-medium text-gray-900">PIX</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Pagamento instantâneo via QR Code</p>
                            </div>
                            <div class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium">
                                Instantâneo
                            </div>
                        </label>
                        
                        <!-- Boleto -->
                        <label class="flex items-center p-4 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                            <input type="radio" name="payment_method" value="boleto" class="text-primary-500 focus:ring-primary-500">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center">
                                    <i class="fas fa-barcode text-primary-500 mr-2"></i>
                                    <span class="font-medium text-gray-900">Boleto Bancário</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Vencimento em 3 dias úteis</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Resumo do Pedido -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Resumo do Pedido</h3>
                    
                    <!-- Plano Selecionado -->
                    <div class="border border-gray-200 rounded-lg p-4 mb-6">
                        @if($plan->image)
                            <img src="{{ asset('storage/' . $plan->image) }}" alt="{{ $plan->name }}" class="w-full h-32 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-32 bg-gradient-to-br from-primary-500 to-primary-600 rounded-lg mb-4 flex items-center justify-center">
                                <i class="fas fa-star text-white text-3xl"></i>
                            </div>
                        @endif
                        
                        <h4 class="font-semibold text-gray-900 mb-2">{{ $plan->name }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $plan->description }}</p>
                        
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Recorrência:</span>
                            <span class="font-medium text-gray-900 capitalize">{{ $plan->recurrence }}</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm mt-2">
                            <span class="text-gray-600">Associação:</span>
                            <span class="font-medium text-gray-900">{{ $plan->association->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <!-- Produtos Inclusos -->
                    @if($plan->products && $plan->products->count() > 0)
                        <div class="mb-6">
                            <h5 class="font-medium text-gray-900 mb-3">Produtos Inclusos</h5>
                            <div class="space-y-2">
                                @foreach($plan->products as $product)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">{{ $product->name }}</span>
                                        <span class="font-medium text-gray-900">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Total -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-gray-600">Subtotal:</span>
                            <span class="font-medium text-gray-900">R$ {{ number_format($plan->total_price, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-lg font-semibold text-gray-900">
                            <span>Total:</span>
                            <span class="text-primary-600">R$ {{ number_format($plan->total_price, 2, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <!-- Botão de Finalizar -->
                    <button type="submit" 
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-semibold py-4 px-6 rounded-lg transition-colors mt-6 flex items-center justify-center">
                        <i class="fas fa-lock mr-2"></i>
                        Finalizar Compra
                    </button>
                    
                    <!-- Segurança -->
                    <div class="mt-4 text-center">
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Pagamento 100% seguro
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Máscara para telefone
        document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(\d{2})(\d)/, '($1) $2');
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
            e.target.value = value;
        });

        // Máscara para CPF/CNPJ
        document.querySelector('input[name="document"]').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            } else {
                value = value.replace(/^(\d{2})(\d)/, '$1.$2');
                value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
                value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
                value = value.replace(/(\d{4})(\d)/, '$1-$2');
            }
            e.target.value = value;
        });

        // Animação nos campos de input
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-primary-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-primary-500');
            });
        });
    </script>
</body>
</html>
