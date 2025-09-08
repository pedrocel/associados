<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $associationId = auth()->user()->association_id;
        
        // Buscar as últimas notícias para exibir no dashboard
        $news = News::with('author')
                   ->where('association_id', $associationId)
                   ->where('status', 'published')
                   ->latest()
                   ->take(6)
                   ->get();

        return view('cliente.dashboard-mobile', compact('news'));
    }

    public function profile()
    {
        return view('cliente.profile.mobile');
    }
}
