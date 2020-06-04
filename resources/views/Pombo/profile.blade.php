@extends('layout')

@section('content')

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

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
                                    <img src=" {{ (isset($pombo->foto) ? '/img/pombo/'.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />                                    
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a style="color: #D9230F">{{$pombo->nome}} {!!$pombo->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a></h2>
                                <h6 class="d-block"><a style="color: #D9230F">Anilha: </a>{{$pombo->anilha}}</h6>
                                    <h6 class="d-block"><a style="color: #D9230F">Pombal: </a>{{$pombo->pombal}}</h6>
                                <h6 class="d-block"><a style="color: #D9230F">Idade: </a>{{$interval->y}} anos</h6>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
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
                                                        @if($pomboCad->pai_id == $pomboCad->id)
                                                            <a href="{{ route('pombo.profile', $pomboCad->pai->id)}}" class=""> {!!$pomboCad->pai->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->pai->anilha}} - {{$pomboCad->pai->nome}} </a> 
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
                                                        @if($pomboCad->mae_id == $pomboCad->id)
                                                            <a href="{{ route('pombo.profile', $pomboCad->mae->id)}}" class=""> {!!$pomboCad->mae->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->mae->anilha}} - {{$pomboCad->mae->nome}} </a> 
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
                        </div>
                    </div>
                    <div id='gene-div' style='height: 625px; width: 100vw; overflow-x: auto; overflow-y: hidden;'>
                        @include('components.genealogic-tree', ['pombo' => $pombo])
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('pombo.edit', $pombo->id)}}" class="btn btn-outline-primary"> Editar </a>        
        <a href="{{ route('pombo.pdf', $pombo->id)}}" class="btn btn-outline-primary"> <svg width="15px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-pdf" class="svg-inline--fa fa-file-pdf fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm250.2-143.7c-12.2-12-47-8.7-64.4-6.5-17.2-10.5-28.7-25-36.8-46.3 3.9-16.1 10.1-40.6 5.4-56-4.2-26.2-37.8-23.6-42.6-5.9-4.4 16.1-.4 38.5 7 67.1-10 23.9-24.9 56-35.4 74.4-20 10.3-47 26.2-51 46.2-3.3 15.8 26 55.2 76.1-31.2 22.4-7.4 46.8-16.5 68.4-20.1 18.9 10.2 41 17 55.8 17 25.5 0 28-28.2 17.5-38.7zm-198.1 77.8c5.1-13.7 24.5-29.5 30.4-35-19 30.3-30.4 35.7-30.4 35zm81.6-190.6c7.4 0 6.7 32.1 1.8 40.8-4.4-13.9-4.3-40.8-1.8-40.8zm-24.4 136.6c9.7-16.9 18-37 24.7-54.7 8.3 15.1 18.9 27.2 30.1 35.5-20.8 4.3-38.9 13.1-54.8 19.2zm131.6-5s-5 6-37.3-7.8c35.1-2.6 40.9 5.4 37.3 7.8z"></path></svg> PDF </a>        
        <a class="btn btn-danger" href='/pombos'> Cancelar </a>
    </div>
    
    <script>
        document.getElementById('connectedServices-tab').click();
        // window.addEventListener('load', () => {
        // });
    </script>


    <style>
        body{
    padding-top: 68px;
    padding-bottom: 50px;
}
        .image-container {
            position: relative;
        }
        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }
        .image-container:hover .image {
            opacity: 0.3;
        }
        .image-container:hover .middle {
            opacity: 1;
        }

        a{
            text-decoration: none;
        }
    </style>

    <script>
        $(document).ready(function () {
            $imgSrc = $('#imgProfile').attr('src');
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgProfile').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#btnChangePicture').on('click', function () {
                // document.getElementById('profilePicture').click();
                if (!$('#btnChangePicture').hasClass('changing')) {
                    $('#profilePicture').click();
                }
                else {
                    // change
                }
            });
            $('#profilePicture').on('change', function () {
                readURL(this);
                $('#btnChangePicture').addClass('changing');
                $('#btnChangePicture').attr('value', 'Confirm');
                $('#btnDiscard').removeClass('d-none');
                // $('#imgProfile').attr('src', '');
            });
            $('#btnDiscard').on('click', function () {
                // if ($('#btnDiscard').hasClass('d-none')) {
                $('#btnChangePicture').removeClass('changing');
                $('#btnChangePicture').attr('value', 'Change');
                $('#btnDiscard').addClass('d-none');
                $('#imgProfile').attr('src', $imgSrc);
                $('#profilePicture').val('');
                // }
            });
        });
    </script>

@endsection