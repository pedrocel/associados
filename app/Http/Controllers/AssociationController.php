<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssociationRequest;
use App\Models\Association;
use App\Models\User;
use App\Models\PerfilModel;
use App\Models\UserPerfilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AssociationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register-association');
    }

    public function register(StoreAssociationRequest $request, SFBankService $sfBankService) // Injetar o Serviço
    {

        try {
            DB::beginTransaction();

            // 1. Criar associação
            $association = $this->createAssociation($request);

            // 2. Criar usuário responsável
            $user = $this->createUser($request, $association);

            // 3. Montar e Enviar Payload para SFBank
            $payload = $this->buildSFBankPayload($request, $association);
            
            // AQUI É O PONTO CRÍTICO: Se esta chamada falhar, uma exceção será lançada.
            // O catch abaixo irá capturá-la e fazer o DB::rollBack().
            $sfBankResponse = $sfBankService->createDigitalAccount($payload);

            // 4. Salvar os dados da conta digital
            // Supondo que você criou um modelo chamado AccountAssociation
            $this->createAccountAssociation($association->id, $sfBankResponse);

            // 5. Atribuir perfil "Dono de Associação"
            $this->atribuirPerfilDonoAssociacao($user);

            DB::commit();

            return redirect()
                ->route('login')
                ->with('success', 'Associação cadastrada com sucesso! Conta digital criada. Aguarde a aprovação.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Retorna a mensagem de erro da SFBank se for o caso
            return back()
                ->withErrors(['error' => 'Erro ao cadastrar. Falha na criação da Conta Digital.'])
                ->withInput();
        }
    }

    private function buildSFBankPayload(Request $request, Association $association): array
    {
        $payload = [
            // Dados da Associação (CNPJ)
            "pessoaTipo" => "J",
            "nome" => $request->nome_associacao,
            "cnpj" => preg_replace('/[^0-9]/', '', $request->documento_associacao), // Limpar pontuação
            "taxas" => [
                ["codigo" => "B", "valor" => "4.99"],
                ["codigo" => "P", "valor" => "4.99"],
                // Adicione outras taxas se necessário
            ],
            
            // Dados do Representante
            "representante" => [
                "pessoaTipo" => "F",
                "cpf" => preg_replace('/[^0-9]/', '', ($request->tipo === 'pf' ? $request->documento_responsavel : $request->representante_cpf)),
                "rg" => null, // Assumindo que RG não está no formulário, ajuste se necessário
                "nome" => ($request->tipo === 'pf' ? $request->nome_responsavel : $request->representante_nome),
                "email" => ($request->tipo === 'pf' ? $request->email_responsavel : $request->representante_email),
                "dataNascimento" => $request->data_nascimento_responsavel ?? '2000-01-01', // Inclua este campo no formulário
                "endereco" => [
                    "rua" => $request->endereco,
                    "bairro" => $request->bairro,
                    "cep" => preg_replace('/[^0-9]/', '', $request->cep),
                    "cidade" => $request->cidade,
                    "estado" => $request->estado,
                    "numero" => $request->numero,
                    "complemento" => $request->complemento,
                ],
                "telefones" => [
                    preg_replace('/[^0-9]/', '', ($request->tipo === 'pf' ? $request->telefone_responsavel : $request->representante_telefone)),
                ]
            ]
        ];

        return $payload;
    }

    private function createAccountAssociation(int $associationId, array $sfBankResponse): void
    {
        // **Você precisará adaptar isso** baseado no retorno real da API da SFBank.
        // Assumindo que a resposta vem com 'account_number' e 'branch_number'
        
        // Exemplo: AccountAssociation::create([
        //     'association_id' => $associationId,
        //     'account_number' => $sfBankResponse['conta'],
        //     'branch_number' => $sfBankResponse['agencia'],
        //     'status' => 'ativa', // ou o status retornado pela API
        //     'response_data' => json_encode($sfBankResponse), // Salvar o retorno completo para auditoria
        // ]);
        
        // Se este modelo/tabela não existir, o Eloquent lançará um erro, causando o rollback.
    }

    private function getValidationRules($tipo): array
    {
        $baseRules = [
            'tipo' => 'required|in:pf,cnpj',
            'nome_associacao' => 'required|string|max:255',
            'email_associacao' => 'required|email|unique:associations,email',
            'telefone_associacao' => 'required|string|max:20',
            'endereco' => 'required|string|max:255',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:100',
            'bairro' => 'required|string|max:100',
            'cidade' => 'required|string|max:100',
            'estado' => 'required|string|size:2',
            'cep' => 'required|string|size:9',
            'data_fundacao' => 'nullable|date',
            'descricao' => 'nullable|string|max:1000',
            'site' => 'nullable|url|max:255',
        ];

        if ($tipo === 'pf') {
            $baseRules = array_merge($baseRules, [
                'documento_associacao' => 'required|string|size:11|unique:associations,documento',
                'nome_responsavel' => 'required|string|max:255',
                'email_responsavel' => 'required|email|unique:users,email',
                'telefone_responsavel' => 'required|string|max:20',
                'documento_responsavel' => 'required|string|size:11|unique:users,documento',
                'password' => 'required|string|min:8|confirmed',
            ]);
        } else {
            $baseRules = array_merge($baseRules, [
                'documento_associacao' => 'required|string|size:14|unique:associations,documento',
                'representante_nome' => 'required|string|max:255',
                'representante_cpf' => 'required|string|size:11|unique:associations,representante_cpf',
                'representante_email' => 'required|email|unique:users,email',
                'representante_telefone' => 'required|string|max:20',
                'password' => 'required|string|min:8|confirmed',
            ]);
        }

        return $rules;
    }

    private function createAssociation(Request $request): Association
    {
        $data = [
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'documento' => $request->documento_associacao,
            'email' => $request->email_associacao,
            'telefone' => $request->telefone_associacao,
            'endereco' => $request->endereco,
            'numero' => $request->numero,
            'complemento' => $request->complemento,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'cep' => $request->cep,
            'data_fundacao' => $request->data_fundacao,
            'descricao' => $request->descricao,
            'site' => $request->site,
            'status' => 'pendente',
        ];

        // Dados específicos para CNPJ
        if ($request->tipo === 'cnpj') {
            $data['representante_nome'] = $request->representante_nome;
            $data['representante_cpf'] = $request->representante_cpf;
            $data['representante_email'] = $request->representante_email;
            $data['representante_telefone'] = $request->representante_telefone;
        }

        return Association::create($data);
    }

    private function createUser(Request $request, Association $association): User
    {
        if ($request->tipo === 'pf') {
            $userData = [
                'association_id' => $association->id,
                'name' => $request->nome_responsavel,
                'email' => $request->email_responsavel,
                'telefone' => $request->telefone_responsavel,
                'documento' => $request->documento_responsavel,
                'password' => Hash::make($request->password),
                'tipo' => 'cliente',
                'status' => 'pendente',
            ];
        } else {
            $userData = [
                'association_id' => $association->id,
                'name' => $request->representante_nome,
                'email' => $request->representante_email,
                'telefone' => $request->representante_telefone,
                'documento' => $request->representante_cpf,
                'password' => Hash::make($request->password),
                'tipo' => 'cliente',
                'status' => 'pendente',
            ];
        }

        return User::create($userData);
    }

    /**
     * Atribuir perfil "Dono de Associação" ao usuário
     */
    private function atribuirPerfilDonoAssociacao(User $user): void
    {
        // Buscar o perfil "Dono de Associação"
        $perfilDonoAssociacao = PerfilModel::where('name', 'Associacao')->first();
        
        if (!$perfilDonoAssociacao) {
            // Se não existir, criar
            $perfilDonoAssociacao = PerfilModel::create([
                'name' => 'Associacao'
            ]);
        }

        // Atribuir perfil ao usuário
        UserPerfilModel::create([
            'user_id' => $user->id,
            'perfil_id' => $perfilDonoAssociacao->id,
            'is_atual' => 1,
            'status' => 1,
        ]);
    }

    public function index()
    {
        $associations = Association::with(['users.userPerfis.perfil'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.associations.index', compact('associations'));
    }

    public function show(Association $association)
    {
        $association->load(['users.userPerfis.perfil']);
        return view('admin.associations.show', compact('association'));
    }

    public function approve(Association $association)
    {
        try {
            DB::beginTransaction();

            // Ativar associação
            $association->update(['status' => 'ativa']);
            
            // Ativar usuário responsável
            $association->users()->where('tipo', 'cliente')->update(['status' => 'ativo']);

            // Ativar perfis do usuário
            foreach ($association->users as $user) {
                UserPerfilModel::where('user_id', $user->id)->update(['status' => 1]);
            }

            DB::commit();

            return back()->with('success', 'Associação aprovada com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao aprovar associação.']);
        }
    }

    public function reject(Association $association)
    {
        try {
            DB::beginTransaction();

            $association->update(['status' => 'inativa']);
            
            // Inativar perfis do usuário
            foreach ($association->users as $user) {
                UserPerfilModel::where('user_id', $user->id)->update(['status' => 0]);
            }

            DB::commit();

            return back()->with('success', 'Associação rejeitada.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Erro ao rejeitar associação.']);
        }
    }
}
