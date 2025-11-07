<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use App\Models\Subscription;
use App\Models\SubscriptionModel;
use App\Models\UserPerfilModel;
use App\Models\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebhookController extends Controller
{
    public function handleSFBank(Request $request)
    {
        // 1. Armazena o log do webhook (Usando WebhookLog)
        $cobrancaData = $request->input('cobranca');
        $eventType = $request->input('eventType');

        $log = WebhookLog::create([
            'event' => "SFBANK - {$eventType} - " . ($cobrancaData['status'] ?? 'N/A'),
            'payload' => $request->all(),
        ]);

        try {
            // 2. Validação da Autenticidade do Webhook
            if (!$this->validateSFBankWebhook($request)) {
                $log->update(['status' => 'failed', 'error_message' => 'Unauthorized Access']);
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            
            // Garante que temos os dados essenciais
            if (!$cobrancaData || !$cobrancaData['idIntegracao']) {
                 $log->update(['status' => 'failed', 'error_message' => 'Dados essenciais da cobranca ausentes.']);
                 return response()->json(['message' => 'Dados da cobranca ausentes'], 400);
            }

            $statusSFBank = $cobrancaData['status'] ?? '';
            
            // 3. Verifica o Evento de Liquidação (Pagamento Confirmado)
            // eventType = L (Liquidação), status = Pago
            if ($eventType === 'L' && $statusSFBank === 'Pago') {
                $this->processSFBankLiquidation($cobrancaData, $request->input('pagamento'));
                $log->update(['status' => 'processed']);
            } else {
                // Outros status (Aguardando Pagamento, Cancelado, etc.)
                $log->update(['status' => 'ignored']);
            }

            return response()->json(['message' => 'Webhook received'], 200);

        } catch (\Exception $e) {
            // Atualiza o log com o erro
            $log->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            return response()->json(['message' => 'Webhook processing failed'], 500);
        }
    }
    
    /**
     * Lógica para processar o pagamento liquidado (status "Pago")
     */
    protected function processSFBankLiquidation(array $cobrancaData, ?array $pagamentoData)
    {
        // O ID de Integração é o que usamos para buscar a Venda: SAAS-SALE-ID
        $idIntegracao = $cobrancaData['idIntegracao'];
        $sfbankChargeId = $cobrancaData['id'];

        // Extrai o ID da Venda (assumindo o prefixo 'SAAS-SALE-')
        $saleId = (int) str_replace('SAAS-SALE-', '', $idIntegracao);
        
        // Use a model Sale do seu sistema (substitua pelo nome correto, se for diferente de Sale)
        // Certifique-se de importar a model Sale no topo do arquivo.
        $sale = Sale::findOrFail($saleId); // Assumindo namespace padrão

        // Garante que a venda ainda não foi paga para evitar reprocessamento
        if ($sale->status !== 'paid') {
            
            // 1. Atualizar a Venda
            $sale->update([
                'status' => 'paid',
                'payment_date' => now(), 
            ]);

            // 2. Atualizar a Transação (Busca pelo sfbank_charge_id nos detalhes)
            $transaction = $sale->transactions()
                                ->whereJsonContains('details->sfbank_charge_id', $sfbankChargeId)
                                ->latest()->first();

            if ($transaction) {
                $transaction->update([
                    'status' => 'paid',
                    'details' => array_merge($transaction->details, [
                        'payment_details_sfbank' => $pagamentoData,
                        'payment_confirmed_at' => now(),
                    ]),
                ]);
            }
            
            // 3. Atualizar o Usuário/Ativação
            $user = $sale->user;
            
            // Substitua 'documentation_pending' pelo seu status inicial se for diferente
            if ($user->status === 'documentation_pending' || $user->status === 'awaiting_payment') {
                $user->update(['status' => 'ativo']);

                // Ativar perfis (ID 3 para Cliente/Membro no seu fluxo)
                UserPerfilModel::where('user_id', $user->id)
                    ->where('perfil_id', 3) // Assumindo 3 é o ID de Cliente/Membro
                    ->update(['status' => 1]); 
            }
        }
    }

    /**
     * Valida a autenticidade do Webhook SFBank (deve ser o mesmo da config/services.php)
     */
    private function validateSFBankWebhook(Request $request): bool
    {
        $expectedKey = config('services.sfbank.webhook_secret');
        $receivedKey = $request->header('Authorization');

        // A chave deve ser comparada com a que você configurou no .env
        // É crucial que essa chave seja um valor secreto e não o valor 'auth_key' literal.
        if ($receivedKey === $expectedKey && !empty($expectedKey)) {
            return true;
        }

        return false;
    }
}

