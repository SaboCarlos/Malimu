<?php

namespace App\Http\Controllers;

use App\Models\Assistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssistenteController extends Controller
{
    public function index()
    {  
        $assistente = Assistant::where('user_id', auth()->user()->id)->first();
        return view('user.assistente.index',compact('assistente'));
    }

    public function store(Request $request)
    {
        $assistente = Assistant::where('user_id', auth()->user()->id)->first();

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required|in:masculino,femenino', 
            'experience_summary' => 'required|string',
            'availability' => 'required|string',
            'contacts' => 'required|string',
            'academic_qualifications' => 'required|array',
            'skills' => 'required|array',
            'idiomas' => 'required|array',
            'status' => 'required',
            'area_of_experience' => 'required|string',
            'profile' => $assistente ? 'nullable|file|mimes:jpeg,png,jpg,gif|max:10048' : 'required|file|mimes:jpeg,png,jpg,gif|max:10048',
            'province' => 'required|string',
            'district' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        // Serialização dos campos em array
        $data['academic_qualifications'] = json_encode($data['academic_qualifications']);
        $data['skills'] = json_encode($data['skills']);
        $data['idiomas'] = json_encode($data['idiomas']);
        $data['user_id'] = auth()->user()->id;
        
        if ($request->hasFile('profile')) {
            // Exclui o perfil antigo, se existir
            if ($assistente && $assistente->profile) {
                Storage::disk('public')->delete($assistente->profile);
            }
            $data['profile'] = $request->file('profile')->store('profiles', 'public');
        }

        if ($assistente) {
            // Atualiza os dados do assistente existente
            $assistente->update($data);
            return redirect()->route('informação.index')->with('success', 'Assistente atualizado com sucesso!');
        } else {
            // Cria um novo assistente
            Assistant::create($data);
            return redirect()->route('informação.index')->with('success', 'Assistente adicionado com sucesso!');
        }
    }

}
