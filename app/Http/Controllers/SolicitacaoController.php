<?php

namespace App\Http\Controllers;

use App\Models\Solicitacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitacaoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Garantir que o usuário esteja logado
    }
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Por favor, faça login para solicitar os contatos.'], 401);
        }
    
        $assistantId = $request->input('assistant_id');
    
        // Verificar se já existe uma solicitação pendente para este usuário e assistente
        $existingSolicitacao = Solicitacoes::where('user_id', Auth::id())
            ->where('assistant_id', $assistantId)
            ->where('status_pagamento', 'pendente')
            ->first();
    
        if ($existingSolicitacao) {
            return response()->json(['success' => false, 'message' => 'Já existe uma solicitação pendente.']);
        }
    
        // Criar uma nova solicitação
        Solicitacoes::create([
            'user_id' => Auth::id(),
            'assistant_id' => $assistantId,
            'status_pagamento' => 'pendente',
        ]);
    
        return response()->json(['success' => true, 'message' => 'Solicitação enviada! Aguardando confirmação do pagamento.']);
    }
    
    
    public function solicitacoes()
    {
        // Buscar todas as solicitações pendentes e aceitas
        $solicitacoes = Solicitacoes::with('assistant') // Carregar a relação do assistente
                                    ->orderBy('created_at', 'desc') // Ordenar pela data de criação
                                    ->get();

        return view('admin.solicitacoes.index', compact('solicitacoes'));
    }

    public function showSolicitacao($id)
    {
        $solicitacao = Solicitacoes::with('assistant')->findOrFail($id); // Buscar a solicitação específica com o assistente
        return view('admin.solicitacoes.show', compact('solicitacao'));
    }

    public function aprovarPagamento($id)
    {
        $solicitacao = Solicitacoes::findOrFail($id);
        $solicitacao->status_pagamento = 'pago'; // Alterar para 'pago'
        $solicitacao->save();

        return redirect()->route('solicitacoes')->with('success', 'Pagamento aprovado com sucesso!');
    }


}
