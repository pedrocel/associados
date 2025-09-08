<?php

namespace App\Http\Controllers\Associacao;

use App\Http\Controllers\Controller;
use App\Models\Association;
use App\Http\Requests\AssociationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracoesController extends Controller
{
    /**
     * Exibe o formulário de configurações da associação.
     */
    public function edit()
    {
        // Pega a associação do usuário logado
        $association = auth()->user()->association;

        if (!$association) {
            return redirect()->route('dashboard')->with('error', 'Associação não encontrada.');
        }

        return view('associacao.configuracoes.edit', compact('association'));
    }

    /**
     * Atualiza as configurações da associação.
     */
    public function update(Request $request, Association $association)
    {
        // A autorização já é feita no AssociationRequest
        // Garante que o usuário só pode editar a própria associação
        if ($association->id !== auth()->user()->association_id) {
            abort(403, 'Acesso negado.');
        }

        $data = $request->all();

        // Lógica para upload da logo
        if ($request->hasFile('logo')) {
            // Remove a logo antiga se existir
            if ($association->logo) {
                Storage::disk('public')->delete($association->logo);
            }
            // Armazena a nova logo
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        } else {
            // Se nenhuma nova logo foi enviada e não foi marcada para remoção, mantém a existente
            // Se você tiver um checkbox "remover logo", adicione a lógica aqui.
            unset($data['logo']); // Remove do array para não sobrescrever com null se não for enviado
        }
        
        $association->update($data);

        return redirect()->route('associacao.configuracoes.edit', $association)
                         ->with('success', 'Configurações da associação atualizadas com sucesso!');
    }
}