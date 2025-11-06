<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Models\AssociationPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    // Listar páginas da associação
    public function index($slug)
    {
        $association = Association::where("slug", $slug)->firstOrFail();
        $pages = $association->pages()->orderBy('order')->get();
        return view('associacao.pages.index', compact('association', 'pages'));
    }

    // Criar nova página
    public function create($slug)
    {
        $association = Association::where("slug", $slug)->firstOrFail();

        return view('associacao.pages.create', compact('association'));
    }

    // Salvar nova página
    public function store(Request $request, $slug)
    {

        $association = Association::where("slug", $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $validated['association_id'] = $association->id;

        $page = AssociationPage::create($validated);

        return redirect()
            ->route('associations.pages.edit', [$slug, $page])
            ->with('success', 'Página criada com sucesso!');
    }

    // Editar página
    public function edit($slug, AssociationPage $page)
    {
        $association = Association::where("slug", $slug)->firstOrFail();

        return view('associacao.pages.edit', compact('association', 'page'));
    }

    // Atualizar página
    public function update(Request $request, $slug, AssociationPage $page)
    {

        $association = Association::where("slug", $slug)->firstOrFail();
        
        $page->update($request->all());

        return back()->with('success', 'Página atualizada com sucesso!');
    }

    // Deletar página
    public function destroy($slug, AssociationPage $page)
    {

        $association = Association::where("slug", $slug)->firstOrFail();

        $page->delete();

        return redirect()
            ->route('associations.pages.index', $association)
            ->with('success', 'Página deletada com sucesso!');
    }

    // Importar HTML
    public function import(Request $request, $slug)
    {
        $association = Association::where("slug", $slug)->firstOrFail();


        $request->validate([
            'html_file' => 'required|file|mimes:html,htm|max:10240', // 10MB max
            'name' => 'required|string|max:255',
        ]);

        $content = file_get_contents($request->file('html_file')->getRealPath());

        $page = AssociationPage::create([
            'association_id' => $association->id,
            'name' => $request->name,
            'type' => 'html',
            'content' => $content,
        ]);

        return redirect()
            ->route('associations.pages.edit', [$association, $page])
            ->with('success', 'HTML importado com sucesso!');
    }

    // Preview da página
    public function preview($slug, AssociationPage $page)
    {
        $association = Association::where("slug", $slug)->firstOrFail();

        return view('associacao.pages.preview', compact('association', 'page'));
    }

    // Publicar/despublicar
    public function togglePublish( $slug, AssociationPage $page)
    {
        $page->update(['is_published' => !$page->is_published]);

        $status = $page->is_published ? 'publicada' : 'despublicada';
        return back()->with('success', "Página {$status} com sucesso!");
    }
}
