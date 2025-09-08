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

    public function register(StoreAssociationRequest $request)
    {

        try {
            DB::beginTransaction();

            // Criar associação
            $association = $this->createAssociation($request);

            // Criar usuário responsável
            $user = $this->createUser($request, $association);

            // Atribuir perfil "Dono de Associação"
            $this->atribuirPerfilDonoAssociacao($user);

            DB::commit();

            return redirect()
                ->route('login')
                ->with('success', 'Associação cadastrada com sucesso! Aguarde a aprovação para fazer login.');

        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()
                ->withErrors(['error' => $e.'Erro ao cadastrar associação. Tente novamente.'])
                ->withInput();
        }
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
