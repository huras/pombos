<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;

class Usuarios extends Controller
{
    public function index(){
        $usuarios = Usuario::all();    
        return view('auth.usuarios', compact('usuarios'));
    }    

    public function create()
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $usuarios = Usuario::all();        
        return view('auth.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $val = $this->validateRequest($request->all());        
        //verificar se teve algum erro na validação, se sim, retorna pra pagina
        if ($val->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($val);
        }
        $data = $request->all();        
        $data['password'] = bcrypt($data['password']);                
        $usuarios = Usuario::create($data);
        return redirect('/usuarios')->with('success', 'Novo usuário cadastrado com sucesso!');
    }

    public function edit($id)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $usuario = Usuario::findOrFail($id);
        return view('auth.edit', compact('usuario'));
    }  

    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $usuario = Usuario::find($id);       
        $data = $request->all();        
        $val = $this->validateRequest($request->all(), $id);

        //verificar se teve algum erro na validação, se sim, retorna pra pagina
        if ($val->fails()) {
            return redirect()->back()
                    ->withInput()                    
                    ->withErrors($val);
        }

        if($data['password'] != $usuario->password){
            $data['password'] = bcrypt($data['password']);                
        } else {
            $data['password'] = $usuario->password;
        }
        
        $usuario->update($data);
        return redirect('/usuarios')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id)
    {
        if (Auth::user()->type == 0) {
        return redirect('/');
    }
        $Usuario = Usuario::findOrFail($id);      
        $Usuario->delete();        
        return redirect()->back()->with('success', 'Usuario removido com sucesso!');
    }

    // ============================= Funcionalidades
    function validateRequest($request, $id = '')
    {
        $rules = [
            'name' => 'required',
            'email' => 'unique:users,email,'.$id,
            'type' => 'required',
            'password' => 'required|min:5',
            'ConfSenha' => 'same:password|min:5',            
        ];

        $messages = [
            'name.required' => 'Insira um nome válido',
            'email.unique' => 'E-mail já usado',             
            'email.required' => 'E-mail obrigatório',             
            'password.required' => 'Senha inválida',
            'password.min' => 'Mínimo 5 caractéres',
            'ConfSenha.same' => 'Senha não confere',            
        ];

        return Validator::make($request, $rules, $messages);
    }
}
