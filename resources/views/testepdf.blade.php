<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
</head>
<?php
    //seta o local pra br
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    //calcula a idade
    $date = new DateTime($pombo->nascimento);                                
    $now = new DateTime();                                
    $interval = $now->diff($date);                                    
?>
    

<div class="image-container">
    <img src=" {{ (isset($pombo->foto) ? '/public/img/pombo/'.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />                                     
</div>

<div class="userData ml-3">
    <h1> Teste geração pdf lindao em arquivo separado </h1>
    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href="">{{$pombo->nome}} {!!$pombo->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a></h2>
    <h6 class="d-block"><a href="javascript:void(0)">Anilha: </a>{{$pombo->anilha}}</h6>
    <h6 class="d-block"><a href="javascript:void(0)">Pombal: </a>{{$pombo->pombal}}</h6>
    <h6 class="d-block"><a href="javascript:void(0)">Idade: </a>{{$interval->y}} anos</h6>
</div>


<div class="">
    <label style="font-weight:bold;">Data de nascimento</label>
</div>
<div class="">
    <?php echo strftime('%A, %d de %B de %Y', strtotime($pombo->nascimento));?>
</div>

<hr />

<div class="">
    <div class="">
        <label style="font-weight:bold;">Sexo: </label>
    </div>
    <div class="col-md-8 col-6">
        {{($pombo->macho == '1') ? 'Macho' : 'Feminino' }}
    </div>
</div>
<hr />

<div class="">
    <div class="">
        <label style="font-weight:bold;">Cor: </label>
    </div>
    <div class="col-md-8 col-6">
        {{$pombo->cor}}
    </div>
</div>
<hr />

<div class="">
    <div class="">
        <label style="font-weight:bold;">Pai: </label>
    </div>
    <div class="col-md-8 col-6">
        @foreach($pombos as $pomboCad)
            @if($pomboCad->pai_id == $pomboCad->id)
                <a href="{{ route('pombo.profile', $pomboCad->pai->id)}}" class=""> {!!$pomboCad->pai->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->pai->anilha}} {{$pomboCad->pai->nome}} </a>
            @endif
        @endforeach
    </div>
</div>
<hr />

<div class="">
    <div class="">
        <label style="font-weight:bold;">Mãe: </label>
    </div>
    <div class="col-md-8 col-6">
        @foreach($pombos as $pomboCad)
            @if($pomboCad->mae_id == $pomboCad->id)
                <a href="{{ route('pombo.profile', $pomboCad->mae->id)}}" class=""> {!!$pomboCad->mae->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!} {{$pomboCad->mae->anilha}} {{$pomboCad->mae->nome}} </a>
            @endif
        @endforeach
    </div>
</div>
<hr />

<div class="">
    <div class="">
        <label style="font-weight:bold;">Pombal: </label>
    </div>
    <div class="col-md-8 col-6">
        {{$pombo->pombal}}
    </div>
</div>
<hr />

<div class="">
    <div class="">
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
    <style>
     
    </style> 
  </html>