@extends('layout')

@section('content')
<style>
  <style>
  .uper {
    margin-top: 40px;
  }
table, input {
    width: auto;
    font: 15px Calibri;
}
table, th, td, th {
    border: solid 1px #DDD;
    border-collapse: collapse;
    padding: 2px 3px;
    text-align: center;
    font-weight: normal;
}
#camBox{
    display:none;
    position:fixed;
    border:0;
    top:0;
    right:0;
    left:0;
    overflow-x:auto;
    overflow-y:hidden;
    z-index:9999;
    background-color:rgba(239,239,239,.9);
    width:100%;
    height:100%;
    padding-top:10px;
    text-align:center;
    cursor:pointer;
    -webkit-box-align:center;-webkit-box-orient:vertical;
    -webkit-box-pack:center;-webkit-transition:.2s opacity;
    -webkit-perspective:1000
}

.revdivshowimg{
    width:300px;
    top:0;
    padding:0;
    position:relative;
    margin:0 auto;
    display:block;
    background-color:#fff;
    webkit-box-shadow:6px 0 10px rgba(0,0,0,.2),-6px 0 10px rgba(0,0,0,.2);
    -moz-box-shadow:6px 0 10px rgba(0,0,0,.2),-6px 0 10px rgba(0,0,0,.2);
    box-shadow:6px 0 10px rgba(0,0,0,.2),-6px 0 10px rgba(0,0,0,.2);
    overflow:hidden;
    border-radius:3px;
    color:#17293c
}        

#fotocam{
    display: none;
}
</style>

<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js "></script>
<div class="card uper">
  <div class="card-header">
    Editar Pombo
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>            
            <li> Por favor corrija os campos indicados com erros. </li>
        </ul>
      </div><br />
    @endif
    <form method="post" action='/pombo/update/{{$pombo->id}}' method="POST" enctype="multipart/form-data">
            @csrf
                <label class='w-100' style="justify-content: center;display: flex;">
                    <div id="camBox" style="width:100%;height:100%;">
                        <!--POPUP DIALOG BOX TO SHOW LIVE WEBCAM.-->
                        <div class="revdivshowimg" style="top:20%;text-align:center;margin:0 auto;">                    
                            <div id="camera" style="height:auto;text-align:center;margin:0 auto;"></div>                    
                            <p>
                                <input type="button" value="Ok" id="btAddPicture" 
                                    onclick="addCamPicture()" /> 
                                <input type="button" value="Cancel" 
                                    onclick="document.getElementById('camBox').style.display = 'none';" />
                            </p>
                            <input type="hidden" id="rowid" /><input type="hidden" id="dataurl" />
                        </div>                    
                    </div>
                    
                    <div>
                        <table id="myTable">
                            <tbody>
                                <tr>                                    
                                    <th>Foto escolhida:</th>
                                </tr>
                                <tr>                                    
                                    <td>
                                        <div id="div_foto">
                                        <img src="{{'/public/img/pombo/'.$pombo->foto}}" width="200px" heigh="140px" alt="" id="imgShow" />
                                        </div>
                                        <input type="button" value="Abrir webcam" id="fotosnap" 
                                            onclick="takeSnapshot(this)" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                    
                </label>


            <input id="fotocam" alt="" name="fotocam" >            
            
            <span id="filelbl"> Foto: </span>
            <input id="fileinput" type="file" class="form-control integer-mask" name="foto" onchange="inputfoto()" style="margin-bottom: 1rem"/>
            
            
            @include('components.textInput', ['label'=>'Anilha', 'name'=>'anilha', 'value' => $pombo->anilha])
            @include('components.textInput', ['label'=>'Nome', 'name'=>'nome', 'value' => $pombo->nome])
                <?php   
                    $ano = "";
                    $mes = "";
                    $dia = "";
                    if($pombo->nascimento){
                        $dataBD = $pombo->nascimento;
                        $splitData = explode("-", $dataBD);
                        $ano = $splitData[0];
                        $mes = $splitData[1];
                        $dia = $splitData[2];
                    }
                    if($dia != "" && $mes != "" && $ano != "")
                        $dataCompleta = $dia.'-'.$mes.'-'.$ano;
                    else
                        $dataCompleta = "";
                ?>
            @include('components.textInput', ['label'=>'Data de Nascimento', 'name'=>'nascimento', 'mask' => 'date-mask', 'value' => (old('nascimento') ? old('nascimento') : $dataCompleta)])

            <div class="form-group">
                <label class='w-100'>
                    <span> Sexo: </span>
                    <?php $sexos = [1 => 'Macho', 0 => 'Fêmea', 2 => 'Não informado'] ?>
                    <select name="macho" class="form-control">
                        @foreach($sexos as $key => $sexo)
                            <option value="{{$key}}" 
                                <?php if(!old('macho') ? $key == $pombo->macho : $key == old('macho') ){ echo(" selected ");}?> > 
                                {{$sexo}}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="form-group">
                <span> Pai: </span>
                <select class="form-control pombo-select2" name="pai_id">        
                    <option value="0"> Sem pai </option>            
                    @foreach($pombos as $pomboCad)
                        @if($pomboCad->macho == '1' && $pomboCad->id != $pombo->id)
                            <option value="{{$pomboCad->id}}" <?php if(!old('pai_id') ? $pomboCad->id == $pombo->pai_id : $pomboCad->id == old('pai_id') ){echo("selected");}?> > {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <span> Mae: </span>
                <select class="form-control pombo-select2" name="mae_id">                
                    <option value="0"> Sem mãe </option>    
                    @foreach($pombos as $pomboCad)                    
                        @if($pomboCad->macho == '0' && $pomboCad->id != $pombo->id)
                            <option value="{{$pomboCad->id}}" <?php if(!old('mae_id') ? $pomboCad->id == $pombo->mae_id : $pomboCad->id == old('mae_id') ){echo("selected");}?> > {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @include('components.select', ['label'=>'Cor', 'name'=>'cor', $values = array('Azul', 'Azul PB', 'Ardósia', 'Branca', 'Bronze', 'Camurça', 'Chocolate', 'Dourada', 'Dourado Escama', 'Escama', 'Escama PB', 'Fulvo', 'Macotado', 'Mosáico', 'Pigarço', 'Preta', 'Vermelha', 'Vermelha Macotado', 'Vermelho PB', 'Chapinha', 'Escama Macotado', 'Bronze Macotado', 'Azul Macotado', 'Pigarço Branco'), 'valueCad' => $pombo->cor])

            @include('components.select', ['label'=>'Pombal', 'name'=>'pombal', $values = array("Olhos D'água", 'Lagoa Santa', 'Pampulha'), 'valueCad' => $pombo->pombal]) 

            <div class="form-group">
                <label class='w-100'>
                    <span> Situação: </span>
                    <select name="morto" class="form-control">
                        <option value="0" @if($pombo->morto == '0') selected @endif >Vivo</option>                        
                        <option value="1" @if($pombo->morto == '1') selected @endif >Morto</option>                        
                        <option value="2" @if($pombo->morto == '2') selected @endif >Doado</option>                        
                        <option value="3" @if($pombo->morto == '3') selected @endif >Perdido</option>                                                
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label class='w-100'>
                    <span> Observações : </span>
                    <textarea rows="5" columns="5" class="form-control" name="obs"> {{old('obs') ? old('obs') : $pombo->obs}} </textarea>
                </label>
            </div>
          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/pombos'> Cancelar </a>
      </form>
  </div>
</div>

<script>
    window.addEventListener('load', () => {
        $('.pombo-select2').select2();
    });

    // CAMERA SCONFIGRACAO
    Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 100
    });
    Webcam.attach('#camera');

     // CAPTURAR IMAGEM
    takeSnapshot = function (oButton) {
        document.getElementById('camBox').style.display = 'block';
        document.getElementById('rowid').value = oButton.id        
    }

    addCamPicture = function () {
        Webcam.snap(function (data_uri) {
            document.getElementById('imgShow').src = data_uri;
            // document.getElementById('div_foto').innerHTML = 
            //     '<img src="' + data_uri + '" id="" width="70px" height="50px" />';
        });
        // esconde o poupup
        document.getElementById('rowid').value = '';
        document.getElementById('camBox').style.display = 'none';     
        
        // salva foto
        Webcam.snap(function (data_uri) {                
            //grava a url no input invisivel pra enviar pro php
            document.getElementById('fotocam').value = data_uri;
            // esconde a opçao de subir arquivo
            $("#fileinput").prop('disabled', true);
        })
    } 
    //esconde a opçao de webcam se escolher enviar por arquivo e atualiza a img profile no view
    inputfoto = function(){
        $("#fotosnap").prop('disabled', true);       

        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#imgShow').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#fileinput").change(function(){
        readURL(this);
    });

    }

    
</script>

@endsection