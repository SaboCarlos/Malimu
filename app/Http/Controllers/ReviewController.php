<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Review;
use App\Models\Solicitacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Assistant $assistant)
    {
        $star_rated = $request->input('assistant_rating') ?? 5;
        $assistant_id = $request->input('assistant_id');
        $comment = $request->input('comment');
        
        // Verifica se o assistente existe
        $assistant_check = Assistant::find($assistant_id);
    
        if ($assistant_check) {
            // Verifica se o usuário tem uma solicitação paga com este assistente
            $solicitacaoPaga = Solicitacoes::where('user_id', Auth::id())
                ->where('assistant_id', $assistant_id)
                ->where('status_pagamento', 'pago')
                ->exists();
    
            // Se não houver solicitação paga, retorna mensagem de erro
            if (!$solicitacaoPaga) {
                return redirect()->back()->with('message', 'Você não pode avaliar este assistente, pois ainda não trabalhou com ele.');
            }
    
            // Verifica se já existe uma avaliação do usuário para o assistente
            $existe_rating = Review::where('user_id', Auth::id())
                ->where('assistant_id', $assistant_id)
                ->first();
    
            if ($existe_rating) {
                // Atualiza a avaliação existente
                $existe_rating->rating = $star_rated;
                $existe_rating->comment = $comment;
                $existe_rating->update();
            } else {
                // Cria uma nova avaliação
                Review::create([
                    'user_id' => Auth::id(),
                    'assistant_id' => $assistant_id,
                    'rating' => $star_rated,
                    'comment' => $comment,
                ]);
            }
    
            return redirect()->back()->with('message', 'Obrigado por avaliar.');
        } else {
            // Caso o assistente não exista ou algum erro ocorra
            return redirect()->back()->with('message', 'Algo deu errado.');
        }
    }
    
}
