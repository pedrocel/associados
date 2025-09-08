<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Plan;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;

        // Metricas da Associacao (Usuários e Perfis)
        $totalUsers = User::where('association_id', $associationId)->count();
        $totalMembers = User::comPerfil('Membro')->where('association_id', $associationId)->count();
        $totalClients = User::comPerfil('Cliente')->where('association_id', $associationId)->count();

        // Metricas do Funil de Onboarding (Documentação e Pagamento)
        $docsPendingUploadCount = User::where('association_id', $associationId)->where('status', 'documentation_pending')->count();
        $docsUnderReviewCount = User::where('association_id', $associationId)->where('status', 'docs_under_review')->count();
        $paymentPendingCount = User::where('association_id', $associationId)->where('status', 'payment_pending')->count();
        
        // Metricas de Vendas
        $totalRevenue = Sale::where('association_id', $associationId)->where('status', 'paid')->sum('total_price');
        $pendingRevenue = Sale::where('association_id', $associationId)->where('status', 'awaiting_payment')->sum('total_price');
        $activePlans = Plan::where('association_id', $associationId)->where('is_active', true)->count();
        $totalPlans = Plan::where('association_id', $associationId)->count();

        // Metricas de Conteudo
        $publishedNews = News::where('association_id', $associationId)->published()->count();
        $draftNews = News::where('association_id', $associationId)->draft()->count();

        // Atividade Recente
        $recentSales = Sale::where('association_id', $associationId)
                           ->with(['user', 'plan'])
                           ->latest()
                           ->take(5)
                           ->get();
        
        $newUsersThisMonth = User::where('association_id', $associationId)
                                 ->whereMonth('created_at', now()->month)
                                 ->whereYear('created_at', now()->year)
                                 ->count();

        return view('associacao.dashboard.index', compact(
            'totalUsers', 'totalMembers', 'totalClients',
            'docsPendingUploadCount', 'docsUnderReviewCount', 'paymentPendingCount',
            'totalRevenue', 'pendingRevenue', 'activePlans',
            'publishedNews', 'draftNews', 'recentSales', 'newUsersThisMonth',
            'totalPlans'
        ));
    }
}