@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6">Pedido Confirmado!</h1>
    
    @if ($sale->status === 'awaiting_payment' && $transaction)
        <div class="bg-white shadow-xl rounded-lg p-8">
            <p class="text-lg mb-4">Sua compra do plano <strong>{{ $sale->plan->name }}</strong> foi registrada com sucesso.</p>
            <p class="text-2xl font-semibold text-purple-600 mb-6">Total: R$ {{ number_format($sale->total_price, 2, ',', '.') }}</p>

            <h2 class="text-xl font-bold border-b pb-2 mb-4">Detalhes do Pagamento ({{ ucfirst($sale->payment_method) }})</h2>
            
            <p class="mb-4">O pagamento deve ser efetuado até: <strong>{{ \Carbon\Carbon::parse($transaction->details['dataVencimento'])->format('d/m/Y') }}</strong></p>

            @if ($sale->payment_method === 'boleto')
                <div class="space-y-4">
                    <p class="text-gray-700">Utilize a linha digitável abaixo para pagar em seu banco ou lotérica:</p>
                    <div class="bg-gray-100 p-4 rounded font-mono break-all">
                        {{ $transaction->details['linhaDigitavel'] ?? 'Linha Digitável indisponível' }}
                    </div>
                    <p class="text-sm text-gray-500">Código de Barras: {{ $transaction->details['codigoDeBarra'] ?? 'N/A' }}</p>
                    
                    {{-- O URL de pagamento (urlPagamento) também pode ser recuperado da resposta para link de impressão --}}
                    <a href="#" class="inline-block px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Imprimir Boleto</a>

                </div>
            
            @elseif ($sale->payment_method === 'pix')
                <div class="text-center">
                    <p class="text-gray-700 mb-4">Escaneie o QR Code ou use o código Pix Copia e Cola:</p>
                    
                    {{-- A rota vai buscar a imagem binária na SFBank --}}
                    <img src="{{ route('checkout.pix.qrcode', $sale) }}" alt="QR Code Pix" class="mx-auto border p-2 mb-6" style="width: 250px; height: 250px;">
                    
                    <p class="font-semibold mb-2">Código Pix (Copia e Cola):</p>
                    <textarea class="w-full border p-4 bg-gray-100 rounded font-mono text-sm break-all" rows="4" readonly>{{ $transaction->details['qrCode'] ?? 'Código indisponível' }}</textarea>
                </div>
            @endif

            <p class="mt-8 text-sm text-gray-500">O status do seu pedido será atualizado automaticamente assim que o pagamento for confirmado (via Webhook).</p>
        </div>
    @else
        <p class="text-lg text-red-500">Detalhes da transação não encontrados ou status inválido.</p>
    @endif
</div>
@endsection