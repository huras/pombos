<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
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
<style>
    .spacepdf{
        margin-left: 25px;
    }
    .spacepdf2{        
        float: right;
    }
</style>

<div class="image-container" style="margin-left: 120px; display: flex; justify-content: center;">    
    <img src="{{ (isset($pombo->foto)) ? public_path('/img/pombo/'.$pombo->foto) : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg'}}" id="imgProfile" style="width: 450px; height: 450px;  margin-top: 15px;" class="img-thumbnail" />                                     
</div>

<div class="userData ml-3" style="display: flex; flex-direction: row; margin-bottom: 25px;">
    <h6 class="d-block" style="font-size: 20px; font-weight: bold;">
        <label class="" for="">Anilha: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->anilha}}</label>
        <label class="spacepdf" for="">Nome: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->nome}} {!!$pombo->morto == 1 ? '(morto)' :  ''!!}</label>
        <label class="spacepdf" for="">Pombal: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->pombal}}</label>
    </h6>    
</div>

<div class="">
    <label style="font-weight:bold;">Data de nascimento: </label>
    <label for=""><?php echo strftime('%A, %d de %B de %Y', strtotime($pombo->nascimento));?></label>
    <label class="spacepdf2" style="font-weight:bold;">Pai: 
        @foreach($pombos as $pomboCad)
            @if($pomboCad->pai_id == $pomboCad->id)
            <a style="font-weight: normal;"> {{$pomboCad->pai->anilha}} - {{$pomboCad->pai->nome}} {!!$pomboCad->pai->morto == 1 ? '(morto)' :  ''!!}</a>
            @endif
        @endforeach    
    </label>
</div>
<hr />

<div class="">
        <label style="font-weight:bold;">Sexo: </label>
        <label for="">{{($pombo->macho == '1') ? 'Macho' : 'Feminino' }}</label>        
        <label class="spacepdf2" style="font-weight:bold;">Mãe:         
            @foreach($pombos as $pomboCad)
                @if($pomboCad->mae_id == $pomboCad->id)
                <a style="font-weight: normal;"> {{$pomboCad->mae->anilha}} - {{$pomboCad->mae->nome}}  {!!$pomboCad->mae->morto == 1 ? '(morto)' :  ''!!}</a>
                @endif
            @endforeach
        </label>
    </div>
</div>
<hr />

<div class="">
    <label style="font-weight:bold; color: black !important;">Idade: <a style="font-weight: normal;">{{$interval->y}} anos</a></label>    
    
    <label class="spacepdf2" style="font-weight:bold;">Cor: {{$pombo->cor}}</label>        
</div>
<hr />

<div class="">
    <label style="font-weight:bold;">Árvore genealógica: </label>
    <label class="" for="">Ainda não tem.</label>
</div>
<hr />

<div class="">
    <label style="font-weight:bold;">Observações: </label>
    <textarea name="" id="" cols="30" rows="10" style="border: none; background: transparent;"> {{$pombo->obs}} <p></textarea>    
</div>
{{-- <hr /> --}}



</html>
{{-- doc do dompdf, sobre compatibilidade de css --}}
{{-- https://github.com/dompdf/dompdf/wiki/CSSCompatibility --}}