<?php

namespace App\Http\Controllers;

use App\Models\PerfilModel;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CheckoutController extends Controller
{
    public function showCheckout(string $hash_id)
    {
        $plan = Plan::where('hash_id', $hash_id)
            ->with(['association', 'products'])
            ->firstOrFail();

        return view('checkout', compact('plan'));
    }

    public function storeSale(Request $request, string $hash_id)
    {
        $plan = Plan::where('hash_id', $hash_id)->firstOrFail();
        // Validação condicional para CPF/CNPJ
        // Exemplo:
        // if ($request['client_type'] === 'pf') {
        //     $request['document'] = array_merge($request['document'], ['cpf']);
        // } else {
        //     $request['document'] = array_merge($request['document'], ['cnpj']);
        // }
        // 2. Criação do Usuário
        $user = User::create([
            'association_id' => $plan->association_id,
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'tipo' =>  'membro',
            'documento' => $request['document'],
            'telefone' => $request['phone'],
            'status' => 'documentation_pending',
        ]);

        // 2. Atribuição do Perfil 'Cliente' (ID 2)
        $perfilClienteId = 3; // ID do perfil 'Cliente'
        $perfilCliente = PerfilModel::find($perfilClienteId);

        if ($perfilCliente) {
            // Usa o método adicionarPerfil da sua model User
            $user->adicionarPerfil($perfilCliente->id, true, 1); // Define como atual e ativo
        } else {
            // Opcional: logar um erro ou lançar uma exceção se o perfil não for encontrado
            \Log::error("Perfil 'Cliente' (ID: {$perfilClienteId}) não encontrado para o usuário {$user->id}.");
        }

        // 3. Criação da Venda
        $sale = Sale::create([
            'association_id' => $plan->association_id,
            'plan_id' => $plan->id,
            'user_id' => $user->id,
            'total_price' => $plan->total_price,
            'payment_method' => $request['payment_method'],
            'status' => 'awaiting_payment',
        ]);

        // 4. Lógica para o método de pagamento
        $transactionDetails = [];
        switch ($request['payment_method']) {
            case 'credit_card':
                // TODO: Processar cartão de crédito (gateway de pagamento)
                // Exemplo: $transactionDetails = Gateway::processCreditCard($request->input('card_data'));
                break;
            case 'pix':
                // TODO: Gerar um código Pix (usando um SDK)
                // Exemplo: $transactionDetails = Gateway::generatePix($sale->total_price);
                break;
            case 'boleto':
                // TODO: Gerar um boleto
                // Exemplo: $transactionDetails = Gateway::generateBoleto($sale->total_price);
                break;
        }

        // 5. Criação da Transação
        $transaction = $sale->transactions()->create([
            'amount' => $sale->total_price,
            'payment_method' => $sale->payment_method,
            'status' => 'created',
            'details' => $transactionDetails,
        ]);
        
        // Redireciona para uma página de sucesso
        return redirect()->route('checkout.success', $sale->id)
                         ->with('success', 'Sua compra foi registrada com sucesso!');
    }

    public function showSuccess(Sale $sale)
    {
        // Certifica que a venda existe e carrega os dados necessários
        $sale->load(['user', 'plan', 'association']);
        
        return view('checkout-success', compact('sale'));
    }
}