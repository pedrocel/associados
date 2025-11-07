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
        $this->baseUrl = config(key: 'services.sfbank.base_url');
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

    /**
     * Cria uma cobrança de Boleto na SFBank.
     * @param string $contaId O hash (ID) da conta SFBank da associação.
     * @param array $payload O corpo da requisição de boleto.
     * @return array Dados da cobrança criada.
     * @throws \Exception Se a API retornar um erro
     */
    public function createBoletoCharge(string $contaId, array $payload): array
    {
        $endpoint = "{$this->baseUrl}/v1/{$this->appName}/contas/{$contaId}/cobrancas";

        $response = Http::withHeaders([
            'USER' => $this->authUser,
            'SECRET' => $this->authSecret,
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        if ($response->failed()) {
            throw new \Exception("Falha ao gerar Boleto na SFBank. Status: {$response->status()}. Resposta: " . $response->body());
        }

        return $response->json();
    }

    /**
     * Cria uma cobrança Pix na SFBank.
     * @param string $contaId O hash (ID) da conta SFBank da associação.
     * @param array $payload O corpo da requisição de Pix.
     * @return array Dados da cobrança Pix criada.
     * @throws \Exception Se a API retornar um erro
     */
    public function createPixCharge(string $contaId, array $payload): array
    {
        // NOTE: O endpoint de PIX pode ser diferente, a documentação aponta para /cobrancas_pix
        $endpoint = "{$this->baseUrl}/v1/{$this->appName}/contas/{$contaId}/cobrancas_pix";

        $response = Http::withHeaders([
            'USER' => $this->authUser,
            'SECRET' => $this->authSecret,
            'Content-Type' => 'application/json',
        ])->post($endpoint, $payload);

        if ($response->failed()) {
            throw new \Exception("Falha ao gerar Pix na SFBank. Status: {$response->status()}. Resposta: " . $response->body());
        }

        return $response->json();
    }
    
    /**
     * Obtém a imagem do QR Code Pix (binário).
     * @param string $contaId O hash (ID) da conta SFBank da associação.
     * @param string $cobrancaId O hash (ID) da cobrança Pix.
     * @return string Conteúdo binário da imagem PNG.
     * @throws \Exception Se a API retornar um erro
     */
    public function getPixQrCodeImage(string $contaId, string $cobrancaId): string
    {
        $endpoint = "{$this->baseUrl}/v1/{$this->appName}/contas/{$contaId}/cobrancas_pix/{$cobrancaId}/qrCode";

        $response = Http::withHeaders([
            'USER' => $this->authUser,
            'SECRET' => $this->authSecret,
        ])->get($endpoint);

        if ($response->failed()) {
            throw new \Exception("Falha ao obter imagem do QR Code. Status: {$response->status()}.");
        }

        return $response->body(); // Retorna o conteúdo binário
    }

}