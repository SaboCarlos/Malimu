<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use App\Models\Review;
use App\Models\Solicitacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getAssistantsByProvince(Request $request)
    {
        $province = $request->input('province');
        $district = $request->input('district');
        $gender = $request->input('gender');
        $ageRange = $request->input('age_range');
    
        // Inicializando a consulta
        $query = Assistant::where('status', 'aceito');
        
        // Filtrando por província
        if ($province) {
            $query->where('province', $province);
        }
        
        // Filtrando por distrito (ignorando maiúsculas/minúsculas)
        if ($district) {
            $query->whereRaw('LOWER(district) LIKE ?', ['%' . strtolower($district) . '%']);
        }
        
        // Filtrando por gênero
        if ($gender) {
            $query->where('gender', $gender);
        }
        
        // Filtrando por faixa etária
        if ($ageRange) {
            list($minAge, $maxAge) = explode('-', $ageRange);
            if ($maxAge == '46+') {
                $query->where('age', '>=', 46);
            } else {
                $query->whereBetween('age', [(int)$minAge, (int)$maxAge]);
            }
        }
    
        // Executando a consulta
        $assistants = $query->get();
    
        // Retornando os assistentes filtrados como resposta JSON
        return response()->json($assistants);
    }
    
    
    public function show($id)
    {
        // Obtenha a solicitação do usuário autenticado para o assistente especificado
        $solicitacao = Solicitacoes::where('user_id', Auth::id())
            ->where('assistant_id', $id)
            ->first();

        $reviews = Review::where('assistant_id', $id)
            ->with('user') // Supondo que a tabela `reviews` tenha relação com `users`
            ->get();

        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? $reviews->avg('rating') : 0;
        // Obtenha o assistente pelo ID e garanta que esteja aceito
        $assistant = Assistant::where('id', $id)->where('status', 'aceito')->firstOrFail();

        return view('user.assistente.profile', [
            'assistant' => $assistant,
            'solicitacao' => $solicitacao,
            'reviews' => $reviews,
            'totalReviews' => $totalReviews,
            'averageRating' => $averageRating
        ]);
    }
    
    


    public function start()
    {
        return view('starmozbiz');
    }
}
