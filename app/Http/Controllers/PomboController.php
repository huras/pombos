<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pombo;
use App\Models\Pombal;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

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

        //upload de foto
        $cover = $request->file('foto');        
        if ($cover) {
            $novo_nome_imagem = rand(). '.' .$cover->getClientOriginalExtension();
            //move a iamgem para o diretorio correcto
            $cover->move(public_path("img/pombo/"), $novo_nome_imagem);
            //salva a imagem na ram e dá o resize
            $imgcrop = Image::make(public_path("img/pombo/".$novo_nome_imagem))->resize(250,250);
            //salva a imagem cropada na pasta com o mesmo nome da original substituindo
            $imgcrop->save(public_path("img/pombo/".$novo_nome_imagem));
            $data['foto'] = $novo_nome_imagem;
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

        //upload de foto
        $cover = $request->file('foto');        
        if ($cover) {
            $novo_nome_imagem = rand(). '.' .$cover->getClientOriginalExtension();
            //move a iamgem para o diretorio correcto
            $cover->move(public_path("img/pombo/"), $novo_nome_imagem);
            //salva a imagem na ram e dá o resize
            $imgcrop = Image::make(public_path("img/pombo/".$novo_nome_imagem))->resize(250,250);
            //salva a imagem cropada na pasta com o mesmo nome da original substituindo
            $imgcrop->save(public_path("img/pombo/".$novo_nome_imagem));
            $data['foto'] = $novo_nome_imagem;
        }

        $pombo->update($data);

        return redirect('/pombos')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id)
    {
        $pombo = Pombo::findOrFail($id);

        // Remove a imagem do pombo
        if($pombo->foto){
            $filepath = public_path('/img/pombo/'.$pombo->foto);
            if(file_exists($filepath))
                unlink($filepath);
        }

        $pombo->delete();        

        return redirect()->back()->with('success', 'Pombo removido com sucesso!');
    }
    
    // ============================= Funcionalidades

    function validatePombo($request)
    {
        $rules = [
            'foto' => 'max:2120',
            // 'anilha' => 'required|numeric|unique:pombo',
            'nome' => 'max:200',
            'nascimento' => 'date_format:d/m/Y',
            'macho' => 'required',
            'pai_id' => 'numeric',
            'mae_id' => 'numeric',
            // 'cor' => 'required',
            'pombal' => 'required',
        ];

        $messages = [
            'required' => 'Campo obrigatório',
            'mimes' => 'Tipo de imagem inválida (use jpeg, png, jpg ou webp)',
            'max' => 'A imagem não deve ter mais do que 2 MB',
            'date_format' => 'Data inválida!',
            'numeric' => 'Este campo deve ser numérico',
            // 'unique' => 'Anilha já existente no banco de dados',
        ];

        return Validator::make($request, $rules, $messages);
    }

    function validateAnilha($request)
    {
        $rules = [
            'anilha' => 'required|numeric|unique:pombo',
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
}
