<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectByProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user) {
            return $next($request);
        }

        if($user->perfil = 'cliente'){
            return $next($request);
        }
        
        // Rotas que não devem ser redirecionadas (para evitar loops)
        $exemptRoutes = [
            'logout',
            'api/*',
            // Incluímos todas as rotas de onboarding na lista de isentos
            'cliente/documentos*',
            'cliente/pagamento*',
            'cliente/contrato*',
            'cliente/aguarde',
            'associacao/configuracoes*',
        ];

        foreach ($exemptRoutes as $route) {
            if ($request->is($route)) {
                return $next($request);
            }
        }
        
        // --- Fluxo de Redirecionamento 1: Perfis de Gestão (Dono da Associacao, Admin) ---
        // Este é o fluxo prioritário. Se o usuário tem um perfil de gestão, ele é redirecionado
        // para sua área, independentemente do status (ativo, pendente, etc.).
        if ($user->isAdmin() || $user->isDonoAssociacao() || $user->isModerador()) {
            
            $perfilAtual = $this->getPerfilAtual($user);

            if (!$perfilAtual) {
                Auth::logout();
                return redirect('/login')->with('error', 'Usuário sem perfil ativo. Entre em contato com o administrador.');
            }

            $redirectUrl = $this->getRedirectUrlByProfile($perfilAtual->name);
            
            // Redireciona apenas se o usuário não está na área correta.
            if ($redirectUrl && !$this->isAlreadyInCorrectArea($request, $perfilAtual->name)) {
                return redirect($redirectUrl);
            }
        }

        // --- Fluxo de Redirecionamento 2: Funil de Onboarding (para Clientes/Membros) ---
        // Este fluxo só se aplica a clientes e membros que não são administradores.
        switch ($user->status) {
            case 'documentation_pending':
            case 'docs_under_review':
                return redirect()->route('cliente.documentos.index');
            
            case 'payment_pending':
                return redirect()->route('cliente.pagamento.index');
            
            case 'contract_pending':
                return redirect()->route('cliente.contrato.index');

            case 'ativo':
                // Clientes ativos vão para o dashboard deles
                return redirect()->route('cliente.dashboard');
            
            case 'pendente':
            case 'inativo':
            case 'suspensa':
                // Clientes com status de espera vão para a tela de espera
                return redirect()->route('associacao.dashboard');
        }

        // Catch-all para qualquer caso não previsto
        return $next($request);
    }

    /**
     * Obtém o perfil atual do usuário
     */
    private function getPerfilAtual($user)
    {
        if (method_exists($user, 'perfilAtual')) {
            return $user->perfilAtual();
        }

        $userPerfil = $user->userPerfis()
            ->where('is_atual', 1)
            ->where('status', 1)
            ->with('perfil')
            ->first();

        return $userPerfil ? $userPerfil->perfil : null;
    }

    /**
     * Retorna a URL de redirecionamento baseada no perfil
     */
    private function getRedirectUrlByProfile($perfilName)
    {
        $redirectMap = [
            'Administrador' => '/admin/dashboard',
            'Cliente' => '/cliente/dashboard',
            'Associacao' => '/associacao/dashboard',
            'Membro' => '/membro/dashboard',
            'Moderador' => '/moderador/dashboard'
        ];

        return $redirectMap[$perfilName] ?? '/dashboard';
    }

    /**
     * Verifica se o usuário já está na área correta
     */
    private function isAlreadyInCorrectArea($request, $perfilName)
    {
        $areaMap = [
            'Administrador' => 'admin/*',
            'Cliente' => 'cliente/*',
            'Associacao' => 'associacao/*',
            'Membro' => 'membro/*',
            'Moderador' => 'moderador/*'
        ];

        $pattern = $areaMap[$perfilName] ?? null;
        
        return $pattern ? $request->is($pattern) : false;
    }
}