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
    
<div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src=" {{ (isset($pombo->foto) ? '/public/img/pombo/'.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />                                    
                                    <div class="middle">
                                        <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div>
                                <div class="userData ml-3">
                                <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="javascript:void(0);">{{$pombo->nome}} {!!$pombo->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a></h2>
                                <h6 class="d-block"><a href="javascript:void(0)">Anilha: </a>{{$pombo->anilha}}</h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">Pombal: </a>{{$pombo->pombal}}</h6>
                                <h6 class="d-block"><a href="javascript:void(0)">Idade: </a>{{$interval->y}} anos</h6>
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-pombo">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Informações básicas</a>
                                    </li>
                                    <li class="nav-pombo">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Árvore genealógica</a>
                                    </li>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">                                      

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
                                                <?php echo strftime('%A, %d de %B de %Y', strtotime($pombo->nascimento));?>
                                            </div>
                                        </div>
                                        <hr />                                        
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Sexo: </label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                {{($pombo->macho == '1') ? 'Macho' : 'Feminino' }}
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
                                                            <a href="{{ route('pombo.profile', $pomboCad->pai->id)}}" class=""> {!!$pomboCad->pai->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->pai->anilha}} {{$pomboCad->pai->nome}} </a> 
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
                                                            <a href="{{ route('pombo.profile', $pomboCad->mae->id)}}" class=""> {!!$pomboCad->mae->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->mae->anilha}} {{$pomboCad->mae->nome}} </a> 
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
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('pombo.edit', $pombo->id)}}" class="btn btn-outline-primary"> Editar </a>        
        <a href="{{ route('pombo.pdf', $pombo->id)}}" class="btn btn-outline-primary"> PDF </a>        
        <a class="btn btn-danger" href='/pombos'> Cancelar </a>
    </div>

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

    