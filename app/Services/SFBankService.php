<?php

namespace App\Services;

use App\Models\Association;
use Illuminate\Support\Facades\Http;

class SFBankService
{
    private $baseUrl;
    private $appName;
    private $authUser;
    private $authSecret;

    public function __construct()
    {
        // Use variáveis de ambiente para credenciais!
        $this->baseUrl = config('services.sfbank.base_url');
        $this->appName = config('services.sfbank.app_name');
        $this->authUser = config('services.sfbank.auth_user');
        $this->authSecret = config('services.sfbank.auth_secret');
    }

    /**
     * Cria uma conta digital na SFBank para a Associação
     * @param array $associationData Dados da associação e representante
     * @return array Dados da conta criada (ex: numero_conta, agencia, etc.)
     * @throws \Exception Se a API retornar um erro
     */
    public function createDigitalAccount(array $data): array
    {
        $endpoint = "{$this->baseUrl}/v1/{$this->appName}/contas";
        
        $response = Http::withHeaders([
            'USER' => $this->authUser,
            'SECRET' => $this->authSecret,
        ])->post($endpoint, $data);

        // Se o status HTTP não for 2xx (ex: 400, 500), lançamos uma exceção.
        if ($response->failed()) {
            throw new \Exception("Falha ao criar conta na SFBank. Status: {$response->status()}. Resposta: " . $response->body());
        }

        // Retorna o corpo da resposta, que deve conter os dados da nova conta
        return $response->json();
    }
}