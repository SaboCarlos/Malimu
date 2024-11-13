<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssistentesController extends Controller
{
    public function index()
    {
        $assistants = Assistant::where('status','aceito')->latest()->paginate(10);
        return view('admin.assistants.index', compact('assistants'));
    }

    public function criar()
    {
        return view('admin.assistants.criar');
    }

    public function store(Request $request)
    {
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
            'profile' => 'required|file|mimes:jpeg,png,jpg,gif|max:10048',
            'province' => 'required|string',
            'district' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        $data['academic_qualifications'] = json_encode($data['academic_qualifications']);
        $data['skills'] = json_encode($data['skills']);
        $data['idiomas'] = json_encode($data['idiomas']);
        $data['user_id'] = auth()->user()->id;

        if ($request->hasFile('profile')) {
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $data['profile'] = $profilePath;
        }

        Assistant::create($data);
        return redirect()->route('assistants.index')->with('success', 'Assistente adicionado com sucesso!');
    }

    public function edit($id)
    {
        $assistant = Assistant::findOrFail($id);
        return view('admin.assistants.edit', compact('assistant'));
    }
    
    public function update(Request $request, $id)
    {
        $assistant = Assistant::findOrFail($id);

        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'gender' => 'required',
            'experience_summary' => 'required|string',
            'availability' => 'required|string',
            'contacts' => 'required|string',
            'academic_qualifications' => 'required|array',
            'skills' => 'required|array',
            'idiomas' => 'required|array',
            'status' => 'required',
            'area_of_experience' => 'required|string',
            'profile' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:10048',
            'province' => 'required|string',
            'district' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',
        ]);

        $data['academic_qualifications'] = json_encode($data['academic_qualifications']);
        $data['skills'] = json_encode($data['skills']);
        $data['idiomas'] = json_encode($data['idiomas']);

        // Verifica se uma nova imagem de perfil foi enviada
        if ($request->hasFile('profile')) {
            // Remove o perfil antigo, se existir
            if ($assistant->profile) {
                Storage::disk('public')->delete($assistant->profile);
            }
            $profilePath = $request->file('profile')->store('profiles', 'public');
            $data['profile'] = $profilePath;
        }

        // Atualiza os dados do assistente
        $assistant->update($data);

        return redirect()->route('assistants.index')->with('success', 'Assistente atualizado com sucesso!');
    }

    public function destroy(Assistant $item)
    {
        if ($item->count()>0) {
            $destination = $item->profile;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $item->delete(); 
            return redirect()->route('assistants.index')->with('message','Slider Eliminado com sucesso'); 
        }
        return redirect()->route('assistants.index')->with('message','Alguma coisa correu mal'); 
       
    }

    public function cadastros(){
        $assistants = Assistant::where('status','pendente')->latest()->paginate(10);
        return view('admin.assistants.cadastro', compact('assistants')); 
    }

    public function editStatus($id)
    {
        $assistant = Assistant::findOrFail($id); // Busca o assistente pelo ID
        return view('admin.assistants.edit-status', compact('assistant')); // Retorna a view de edição de status
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:aceito,pendente,recusado', // Validação do status
        ]);

        $assistant = Assistant::findOrFail($id);
        $assistant->status = $request->status; // Atualiza apenas o campo status
        $assistant->save();

        return redirect()->route('assistants.cadastro')->with('success', 'Status atualizado com sucesso!');
    }





}
