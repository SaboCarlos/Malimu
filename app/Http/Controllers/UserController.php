<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $usuarios = User::latest()->paginate(10);
        return view('admin.user.index',compact('usuarios'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role'=> 'required|string|max:255',
        ]);

        // Criação do usuário
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.user')->with('success', 'Usuário criado com sucesso!');
    }
    
    public function edit($id){
        $user = User::findOrFail($id); 
        return view('admin.user.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Ignora o email atual do usuário
            'password' => 'nullable|string|min:8|confirmed', // Deixa a senha opcional
            'role'=> 'required|string|max:255',
        ]);
    
        // Encontra o usuário pelo ID
        $user = User::findOrFail($id);
        
        // Atualiza os dados do usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            // Atualiza a senha somente se for fornecida uma nova
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);
    
        return redirect()->route('admin.user')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function perfil()
    {
        return view('user.perfil.index');
    }

    public function updateUserDetails(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',           
        ]);
        
       $user = User::findOrFail(Auth::user()->id);

       
        $user->update([
            'name' => $request->name,
        ]);

       return redirect()->back()->with('message','perfil do usuario atualizado');
    }

    public function passwordCreate()
    {
        return view('user.perfil.change-password');
    }
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required','string','min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('message','Password Atualizado com sucesso!');

        }else{

            return redirect()->back()->with('message','O Password actual não corresponde o password antigo!');
        }
    }

    public function destroy(int $userId)
    {
        $user = User::findOrFail($userId);
        $user ->delete();
        return redirect()->route('admin.user')->with('message','Usuario Eliminado com sucesso');
    }
}
