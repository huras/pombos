<?php

namespace App\Http\Controllers;

use App\Exports\PombosExport;
use Illuminate\Http\Request;
use App\Models\Pombo;
use App\Models\Pombal;
use App\Models\Usuario;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriterXlsx;

class PomboController extends Controller
{
    public function index()
    {
        $pombos = Pombo::all();
        return view('Pombo.index', compact('pombos'));
    }

    public function create()
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $pombos = Pombo::all();
        $pombais = Pombal::all();
        return view('Pombo.create', compact(['pombos', 'pombais']));
    }

    public function store(Request $request)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

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

        // converte base64 para imagem e salva
        if($request->fotocam){            
            $img = $request->fotocam;        
            $folderPath = "img/pombo/";
            $image_parts = explode(";base64,", $img);                        
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, $image_base64);
            $filename = explode("img/pombo/", $file);
            $data['foto'] = $filename[1];
        }

        //upload de foto por arquivo
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

        // Conecta com os possíveis filhos
        if (isset($request->filhos)) {
            foreach ($request->filhos as $filhoID) {
                if ($request->macho == 1)
                    Pombo::where('id', $filhoID)->update(['pai_id' => $pombo->id, 'temp_pai' => null]);
                else
                    Pombo::where('id', $filhoID)->update(['mae_id' => $pombo->id, 'temp_mae' => null]);
            }
        }

        return redirect('/pombos')->with('success', 'Novo pombo salvo com sucesso!');
    }

    public function edit($id)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

        $pombos = Pombo::all();
        $pombo = Pombo::findOrFail($id);
        return view('Pombo.edit', compact('pombo', 'pombos'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }

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

        // converte base64 para imagem e salva
        if($request->fotocam){            
            $img = $request->fotocam;        
            $folderPath = "img/pombo/";
            $image_parts = explode(";base64,", $img);                        
            $image_base64 = base64_decode($image_parts[1]);
            $file = $folderPath . uniqid() . '.png';
            file_put_contents($file, $image_base64);
            $filename = explode("img/pombo/", $file);
            $data['foto'] = $filename[1];
        }
        
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

        if ($data['morto'] == 1) {
            $pombo->morto = 1;
        } else {
            $pombo->morto = 0;
        }

        $pombo->update($data);

        return redirect('/pombos')->with('success', 'Editado com sucesso!');
    }

    public function destroy($id)
    {
        if (Auth::user()->type == 0) {
            return redirect('/');
        }
        $pombo = Pombo::findOrFail($id); 

          // Remove a imagem do pombo
          if($pombo->foto){
            $filepath = public_path('/img/pombo/'.$pombo->foto);
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

    public function dateEmMysql($dateSql)
    {
        $ano = substr($dateSql, 6);
        $mes = substr($dateSql, 3, -5);
        $dia = substr($dateSql, 0, -8);
        return $ano . "-" . $mes . "-" . $dia;
    }

    public function geraPdf($id)
    {

        $pombos = Pombo::all();
        $pombo = Pombo::findOrFail($id);

        return view('Pombo.layoutpdf', compact('pombo', 'pombos'));

        $pdf = PDF::loadView('Pombo.layoutpdf', compact('pombo', 'pombos'));
        return $pdf->setPaper('a4')->stream('' . $pombo->anilha . '-' . $pombo->nome . '_Perfil.pdf');
    }

    public function exporta(){
        
        $spreadsheet = new Spreadsheet();
        $Excel_writer = new WriterXlsx($spreadsheet);

        $spreadsheet->setActiveSheetIndex(0);
        $activeSheet = $spreadsheet->getActiveSheet();
        
        // Auto size no range
        foreach(range('A','H') as $columnID) {
            $spreadsheet->getActiveSheet()->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        //Cabeçalho negrito
        foreach(range('A','H') as $row) {
            $col = 1;
            $spreadsheet->getActiveSheet()->getStyle($row.$col)->getFont()->setBold( true );
        }        
        
        $activeSheet->setCellValue('A1', 'Anilha');
        $activeSheet->setCellValue('B1', 'Nome');
        $activeSheet->setCellValue('C1', 'Nascimento');
        $activeSheet->setCellValue('D1', 'Sexo');
        $activeSheet->setCellValue('E1', 'Cor');
        // $activeSheet->setCellValue('G1', 'Pai');
        // $activeSheet->setCellValue('H1', 'Mae');
        $activeSheet->setCellValue('F1', 'Morto/Vivo');
        $activeSheet->setCellValue('G1', 'Pombal');
        $activeSheet->setCellValue('H1', 'obs');                

        $pombos = Pombo::all();
        $count = count($pombos);
        
        if ($count > 0){
        $i = 2;
        foreach($pombos as $pombo){        
            $activeSheet->setCellValue('A'.$i , $pombo['anilha']);
                $activeSheet->setCellValue('B'.$i , utf8_encode($pombo['nome']));
                $activeSheet->setCellValue('C'.$i , $pombo['nascimento']);
                    if($pombo['macho'] == 1){
                        $activeSheet->setCellValue('D'.$i , 'Macho');    
                    } else {
                        $activeSheet->setCellValue('D'.$i , 'Fêmea');
                    }                
                $activeSheet->setCellValue('E'.$i , utf8_encode($pombo['cor']));
                // if($pombo['pai_id']){                    
                // }
                // $activeSheet->setCellValue('G'.$i , $pombo['pai_id']);
                // $activeSheet->setCellValue('H'.$i , $pombo['mae_id']);
                    if($pombo['morto'] == 1){
                        $activeSheet->setCellValue('F'.$i ,'Morto');
                    } else {
                        $activeSheet->setCellValue('F'.$i ,'Vivo');
                    }                
                $activeSheet->setCellValue('G'.$i , $pombo['pombal']);
                $activeSheet->setCellValue('H'.$i , utf8_encode($pombo['obs']));
                $i++;
            }

            $filename = 'pombos.xlsx';
            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'. $filename);
            header('Cache-Control: max-age=0');

            $Excel_writer->save('php://output');
        }
    }
    
}
