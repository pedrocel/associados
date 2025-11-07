<?php

namespace App\Http\Controllers;

use App\Models\Association;
use App\Models\PerfilModel;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use App\Services\SFBankService;
use DB;
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

    public function storeSale(Request $request, string $hash_id, SFBankService $sfBankService)
    {
        $plan = Plan::where('hash_id', $hash_id)->firstOrFail();
        
        // Assumindo que a Association tem o ID da conta SFBank salvo (sfbank_account_id)
        $association = $plan->association; 
        $contaId = $association->sfbank_account_id; // O hash de 36 caracteres.
        
        if (!$contaId) {
             return back()->withErrors(['error' => 'Conta digital da associação não configurada para cobrança.'])->withInput();
        }

        // NOVO: Adicione validação para campos de endereço e data de nascimento 
        // (necessários para o payload da SFBank)

        try {
            DB::beginTransaction();

            $user = User::create([
                'association_id' => $association->id,
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'tipo' =>  'membro',
                'documento' => $request['document'],
                'telefone' => $request['phone'],
                'status' => 'documentation_pending',
            ]);

            $perfilClienteId = 3;
            $perfilCliente = PerfilModel::find($perfilClienteId);
            if ($perfilCliente) {
                $user->adicionarPerfil($perfilCliente->id, true, 1);
            } else {
                \Log::error("Perfil 'Cliente' (ID: {$perfilClienteId}) não encontrado para o usuário {$user->id}.");
            }


            $sale = Sale::create([
                'association_id' => $association->id,
                'plan_id' => $plan->id,
                'user_id' => $user->id,
                'total_price' => $plan->total_price,
                'payment_method' => $request['payment_method'],
                'status' => 'awaiting_payment',
            ]);

            $chargeId = null;
            $chargeResponse = null;
            $payload = $this->buildChargePayload($request, $user, $association, $sale);

            switch ($request['payment_method']) {
                case 'pix':
                    $chargeResponse = $sfBankService->createPixCharge($contaId, $payload);
                    $chargeId = $chargeResponse['id'] ?? null;
                    break;
                case 'boleto':
                    $chargeResponse = $sfBankService->createBoletoCharge($contaId, $payload);
                    $chargeId = $chargeResponse['id'] ?? null;
                    break;
                case 'credit_card':
                    // TODO: Integração de Cartão de Crédito
                    break;
            }

            if ($chargeId === null && in_array($request['payment_method'], ['pix', 'boleto'])) {
                 throw new \Exception("Falha na API SFBank: ID da cobrança não retornado.");
            }
            
            $transaction = $sale->transactions()->create([
                'amount' => $sale->total_price,
                'payment_method' => $sale->payment_method,
                'status' => 'created',
                // Armazena dados essenciais para consulta e exibição
                'details' => [
                    'sfbank_charge_id' => $chargeId,
                    'qrCode' => $chargeResponse['qrCode'] ?? null, // Para PIX (código Copia e Cola)
                    'linhaDigitavel' => $chargeResponse['linhaDigitavel'] ?? null, // Para Boleto
                    'codigoDeBarra' => $chargeResponse['codigoDeBarra'] ?? null, // Para Boleto
                    'dataVencimento' => $chargeResponse['dataVencimento'] ?? null,
                ],
            ]);
            
            DB::commit();

            return redirect()->route('checkout.success', $sale->id)
                             ->with('success', 'Sua cobrança foi gerada com sucesso! Prossiga para o pagamento.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Erro no Checkout/SFBank: " . $e->getMessage());

            return back()
                ->withErrors(['error' => 'Erro ao processar o pagamento. Contate o suporte.'])
                ->withInput();
        }
    }

    private function getSacadorData(Association $association): array
    {
        // Assumindo que a Association foi cadastrada como PJ (seu controller anterior sugere isso)
        $cleanDocumento = preg_replace('/[^0-9]/', '', $association->documento);
        $cleanTelefone = preg_replace('/[^0-9]/', '', $association->telefone);
        $representanteCpf = preg_replace('/[^0-9]/', '', $association->representante_cpf);
        
        return [
            "cnpj" => $cleanDocumento,
            "nome" => $association->nome,
            "email" => $association->email,
            "endereco" => [
                "cep" => preg_replace('/[^0-9]/', '', $association->cep),
                "rua" => $association->endereco,
                "bairro" => $association->bairro,
                "cidade" => $association->cidade,
                "estado" => $association->estado,
                "numero" => $association->numero,
                "complemento" => $association->complemento,
            ],
            "fantasia" => $association->nome,
            "telefones" => [$cleanTelefone],
            "pessoaTipo" => "J",
            "representante" => [
                "cpf" => $representanteCpf,
                "nome" => $association->representante_nome,
                "email" => $association->representante_email,
                // Assumindo que endereço e data do representante são o mesmo da Associação para fins de Sacador
                "endereco" => [
                    "cep" => preg_replace('/[^0-9]/', '', $association->cep),
                    "rua" => $association->endereco,
                    "bairro" => $association->bairro,
                    "cidade" => $association->cidade,
                    "estado" => $association->estado,
                    "numero" => $association->numero,
                    "complemento" => $association->complemento,
                ],
                "pessoaTipo" => "F",
                "dataNascimento" => '1980-01-01T00:00:00-03:00', // Padrão, se não tiver no DB
            ]
        ];
    }
    
    // NOVO: Função para montar o Pagador e o Payload completo
    private function buildChargePayload(Request $request, User $user, Association $association, Sale $sale): array
    {
        $cleanDocumentPagador = preg_replace('/[^0-9]/', '', $user->documento);
        $cleanPhonePagador = preg_replace('/[^0-9]/', '', $user->telefone);
        
        $pagador = [
            "pessoaTipo" => strlen($cleanDocumentPagador) === 11 ? "F" : "J",
            "cpf" => strlen($cleanDocumentPagador) === 11 ? $cleanDocumentPagador : null,
            "cnpj" => strlen($cleanDocumentPagador) !== 11 ? $cleanDocumentPagador : null,
            "nome" => $user->name,
            "email" => $user->email,
            "endereco" => [
                "cep" => preg_replace('/[^0-9]/', '', $request['cep']),
                "rua" => $request['address'],
                "bairro" => $request['neighborhood'] ?? '', // Assumindo que este campo está no formulário
                "cidade" => $request['city'] ?? '', // Assumindo que este campo está no formulário
                "estado" => $request['state'] ?? '', // Assumindo que este campo está no formulário
                "numero" => $request['number'],
                "complemento" => $request['complement'] ?? null
            ],
            "telefones" => [$cleanPhonePagador],
            "dataNascimento" => \Carbon\Carbon::parse($request['birth_date'])->format('Y-m-d\T00:00:00-03:00'),
        ];
        
        return [
            "valor" => number_format($sale->total_price, 2, '.', ''),
            "codTipo" => $request['payment_method'] === 'pix' ? "P" : "B",
            "pagador" => $pagador,
            "sacador" => $this->getSacadorData($association),
            "descricao" => "Pagamento do Plano: {$sale->plan->name} - Venda #{$sale->id}",
            "valorJuros" => 0, 
            "valorMulta" => 0, 
            "idIntegracao" => "SAAS-SALE-{$sale->id}",
            "dataVencimento" => now()->addDays(2)->format('Y-m-d\T00:00:00-03:00'),
        ];
    }

    public function showSuccess(Sale $sale)
    {
        // Carrega a última transação para mostrar os detalhes do pagamento
        $sale->load(['user', 'plan', 'association', 'transactions']);
        $transaction = $sale->transactions->last(); 
        
        return view('checkout-success', compact('sale', 'transaction'));
    }

    public function showPixQrCode(Sale $sale, SFBankService $sfBankService)
    {
        // Pega a transação mais recente de PIX
        $transaction = $sale->transactions()->where('payment_method', 'pix')->latest()->firstOrFail();
        
        $contaId = $sale->association->sfbank_account_id;
        $chargeId = $transaction->details['sfbank_charge_id'] ?? null;
        
        if (!$chargeId || !$contaId) {
            abort(404, 'Dados do PIX não encontrados.');
        }

        try {
            $imageBinary = $sfBankService->getPixQrCodeImage($contaId, $chargeId);

            // Retorna o binário da imagem com o cabeçalho correto
            return response($imageBinary, 200)
                ->header('Content-Type', 'image/png');

        } catch (\Exception $e) {
            \Log::error("Erro ao carregar QR Code: " . $e->getMessage());
            abort(500, 'Não foi possível carregar a imagem do QR Code. Verifique o log.');
        }
    }
}