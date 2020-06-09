@extends('layout')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js" type="text/javascript"></script> --}}
<link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>

<?php
    //seta o local pra br
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    //calcula a idade
    $date = new DateTime($pombo->nascimento);                                
    $now = new DateTime();                                
    $interval = $now->diff($date);                                    
?>


<style>
    body{
        padding-top: 68px;
        padding-bottom: 50px;
    }
    .image-container {
        transition: transform .2s
        position: relative;
    }
    a{
        text-decoration: none;
    }                
    .image-container:hover {
        transition: transform .2s;        
        padding-right: 10px;
        padding-left: 90px;
        padding-top: 180px;
        padding-bottom: 190px;
        transform: scale(3.5);
    }        
    
</style>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>    
    
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img onclick="" class="image-perfil" class="zoom" src=" {{ (isset($pombo->foto) ? ''.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}" id="imgProfile" style="width: 160px; height: 120px;" class="img-thumbnail" />
                                </div>
                                <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a style="color: #D9230F">{{$pombo->nome}} {!!$pombo->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a></h2>
                                <h6 class="d-block"><a style="color: #D9230F">Anilha: </a>{{$pombo->anilha}}</h6>
                                    <h6 class="d-block"><a style="color: #D9230F">Pombal: </a>{{$pombo->pombal}}</h6>
                                <h6 class="d-block"><a style="color: #D9230F">Idade: </a>{{$interval->y}} anos</h6>
                                </div>                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4"  >
                                    <li class="nav-pombo" onclick="setTimeout(() => { document.getElementById('basicInfo').style.display = 'block'; document.getElementById('gene-div').style.display = 'none';}, 50);">
                                        <a class="nav-link " id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informações básicas</a>
                                    </li>
                                    <li class="nav-pombo" onclick="setTimeout(() => { document.getElementById('basicInfo').style.display = 'none'; document.getElementById('gene-div').style.display = 'block';}, 50);" >
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Árvore genealógica</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade  " id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">                                      

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Nome: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$pombo->nome}} {!!$pombo->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Data de nascimento</label>
                                            </div>
                                            <div class="col-md-8 col-6">                                                
                                                <?php
                                                    $diasSemana = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];                                                    
                                                    echo $diasSemana[strftime('%w', strtotime($pombo->nascimento))];
                                                    echo strftime(', %d de %B de %Y', strtotime($pombo->nascimento));?>
                                            </div>
                                        </div>
                                        <hr />                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Sexo: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{($pombo->macho == '1') ? 'Macho' : 'Fêmea' }}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Cor: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$pombo->cor}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Pai: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                @foreach($pombos as $pomboCad)                                                    
                                                    <td>
                                                        @if($pombo->pai)
                                                            @if($pombo->pai_id == $pomboCad->id)                                                        
                                                                <a href="{{ route('pombo.profile', $pomboCad->id)}}" class=""> {!!$pombo->pai->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pombo->pai->anilha}} - {{$pombo->pai->nome}} </a>                                                             
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Mãe: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                @foreach($pombos as $pomboCad)                                                    
                                                    <td>
                                                        @if ($pombo->mae)                                                         
                                                            @if($pombo->mae_id == $pomboCad->id)                                                        
                                                                <a href="{{ route('pombo.profile', $pombo->mae->id)}}" class=""> {!!$pombo->mae->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pombo->mae->anilha}} - {{$pombo->mae->nome}} </a> 
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Pombal: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$pombo->pombal}}
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Observação: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{$pombo->obs}}
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                    <div class="tab-pane fade" id="aba2" role="tabpanel" aria-labelledby="ConnectedServices-tab">  
                                        <div style="display: flex; width: 100%; height: 100%;">                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id='gene-div'>
                                @include('components.genealogic-tree', ['pombo' => $pombo])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('pombo.edit', $pombo->id)}}" class="btn btn-outline-primary"> Editar </a>        
        <a target="_blank" href="{{ route('pombo.pdf', $pombo->id)}}" class="btn btn-outline-primary"> <svg width="15px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="print" class="svg-inline--fa fa-print fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M448 192V77.25c0-8.49-3.37-16.62-9.37-22.63L393.37 9.37c-6-6-14.14-9.37-22.63-9.37H96C78.33 0 64 14.33 64 32v160c-35.35 0-64 28.65-64 64v112c0 8.84 7.16 16 16 16h48v96c0 17.67 14.33 32 32 32h320c17.67 0 32-14.33 32-32v-96h48c8.84 0 16-7.16 16-16V256c0-35.35-28.65-64-64-64zm-64 256H128v-96h256v96zm0-224H128V64h192v48c0 8.84 7.16 16 16 16h48v96zm48 72c-13.25 0-24-10.75-24-24 0-13.26 10.75-24 24-24s24 10.74 24 24c0 13.25-10.75 24-24 24z"></path></svg> Imprimir </a>        
        <a class="btn btn-danger" href='/pombos'> Cancelar </a>
    </div>
    
    <script>
        document.getElementById('basicInfo-tab').click();        
    </script>
{{-- 
<script>
    // gera base64 da arvore
var element = $("#gene-div");
var getCanvas;     
    html2canvas(element, {
    onrendered: function (canvas) {        
        getCanvas = canvas;
        var imgageData = getCanvas.toDataURL("image/png");
        console.log(imgageData);        
        }
    })
</script>     --}}
@endsection