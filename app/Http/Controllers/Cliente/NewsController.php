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
            $user = auth()->user();
    
            if ($user->status !== 'ativo') {
                return redirect()->route('cliente.documentos.index')
                               ->with('warning', 'Por favor, complete a documentação necessária para continuar.');
            }
    
            $associationId = $user->association_id;
            
    
            $news = News::with('author')
                       ->where('association_id', $associationId)
                       ->latest()
                       ->take(6)
                       ->get();
    
            return view('cliente.dashboard-mobile', compact('news', 'user'));
    }
    

    public function profile()
    {
        return view('cliente.profile.mobile');
    }
}
