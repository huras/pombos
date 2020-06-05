<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pombo;
use App\Models\Pombal;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade as PDF;

class PomboController extends Controller
{
    public function index()
    {
        $pombos = Pombo::all();    
        return view('Pombo.index', compact('pombos'));
    }

    public function create()
    {
        $pombos = Pombo::all();
        $pombais = Pombal::all();
        return view('Pombo.create', compact(['pombos', 'pombais']));
    }

    public function store(Request $request)
    {
        $val = $this->validatePombo($request->all());
        $valAnilha = $this->validateAnilha($request->all());

        //verificar se teve algum erro na validação, se sim, retorna pra pagina
        if ($val->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($val);
        }
        
        //Validaçao da anilha separada, para não atrapalhar a page de edição.
        if ($valAnilha->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($valAnilha);
        }

        $data = $request->all();        

        // Set date format
        $data['nascimento'] = $this->dateEmMysql($data['nascimento']);

        
        //upload de foto da cam ja covnertida em base64
        if($request->fotocam){
            $data['foto'] = $request->fotocam;            
        }

        // upload de foto por aquivo
        if ($request->file('foto')) {
            // pega o caminho
            $imagefile = $request->file('foto')->path();            
            
            // pega o tipo da imagem, monta o link e converte
            $type = pathinfo($imagefile, PATHINFO_EXTENSION);
            $content = file_get_contents($imagefile);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($content);            
            // grava a imagem convertida em base
            $data['foto'] = $base64;
        }        

        $pombo = Pombo::create($data);

        return redirect('/pombos')->with('success', 'Novo pombo salvo com sucesso!');
    }

    public function edit($id)
    {
        $pombos = Pombo::all();
        $pombo = Pombo::findOrFail($id);
        return view('Pombo.edit', compact('pombo', 'pombos'));
    }  

    public function update(Request $request, $id){
        $data = $request->all();        
        $val = $this->validatePombo($request->all());

        //verificar se teve algum erro na validação, se sim, retorna pra pagina
        if ($val->fails()) {
            return redirect()->back()
                    ->withInput()
                    ->withErrors($val);
        }
        
        $pombo = Pombo::find($id);
        // Set date format
        $data['nascimento'] = $this->dateEmMysql($data['nascimento']);

       //upload de foto da cam ja covnertida em base64
       if($request->fotocam){
        $data['foto'] = $request->fotocam;            
        }
        // upload de foto por aquivo
        if ($request->file('foto')) {
            // pega o caminho
            $imagefile = $request->file('foto')->path();            
            
            // pega o tipo da imagem, monta o link e converte
            $type = pathinfo($imagefile, PATHINFO_EXTENSION);
            $content = file_get_contents($imagefile);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($content);            
            // grava a imagem convertida em base
            $data['foto'] = $base64;
        }
                
        if ($data['morto'] == 1){
            $pombo->morto = 1;
        } else {
            $pombo->morto = 0;
        }

        $pombo->update($data);

        return redirect('/pombos')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id)
    {
    $pombo = Pombo::findOrFail($id);

        // Remove a imagem do pombo
        if($pombo->foto){
            $filepath = public_path(''.$pombo->foto);
            if(file_exists($filepath))
                unlink($filepath);
        }

        $pombo->delete();        

        return redirect()->back()->with('success', 'Pombo removido com sucesso!');
    }


    public function profile($id)
    {
        $pombos = Pombo::all();
        $pombo = Pombo::findOrFail($id);
        return view('Pombo.profile', compact('pombo', 'pombos'));
    }
    
    // ============================= Funcionalidades

    function validatePombo($request)
    {
        $rules = [
            'foto' => 'max:2120',            
            'nome' => 'max:200',
            'nascimento' => 'date_format:d/m/Y',
            'macho' => 'required',
            'pai_id' => 'numeric',
            'mae_id' => 'numeric',            
            'pombal' => 'required',
        ];

        $messages = [
            'required' => 'Campo obrigatório',
            'mimes' => 'Tipo de imagem inválida (use jpeg, png, jpg ou webp)',
            'max' => 'A imagem não deve ter mais do que 2 MB',
            'date_format' => 'Data inválida!',
            'numeric' => 'Este campo deve ser numérico',            
        ];

        return Validator::make($request, $rules, $messages);
    }

    function validateAnilha($request)
    {
        $rules = [
            'anilha' => 'required|unique:pombo',
        ];

        $messages = [
            'unique' => 'Anilha já existente no banco de dados',
        ];

        return Validator::make($request, $rules, $messages);
    }

    public function dateEmMysql($dateSql){
        $ano= substr($dateSql, 6);
        $mes= substr($dateSql, 3,-5);
        $dia= substr($dateSql, 0,-8);
        return $ano."-".$mes."-".$dia;
    }

    public function geraPdf($id){

        $pombos = Pombo::all();
        $pombo = Pombo::findOrFail($id);        

        $pdf = PDF::loadView('Pombo.layoutpdf', compact('pombo','pombos'));
        return $pdf->setPaper('a4')->stream(''.$pombo->anilha.'-'.$pombo->nome.'_Perfil.pdf');

    }
}


 
