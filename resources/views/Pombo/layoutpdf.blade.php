<html>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js" type="text/javascript"></script>
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
    #gene-div{
        max-width: 100%;
        padding-right: 5px;
    }
.genealogic-tree{
  min-height: 625px;
  display: flex;
    justify-content: flex-start;
    align-items: center;
    min-width: calc((200px + 8px) * 3);
    overflow-x: auto;
    margin-left: 5px;
    margin-top: 0;
}
.current-pombo{
  /* // min-width: 250px; */
  margin: 0px 4px;
  margin-left: 16px;
}
.parent-pombos{
  /* // min-width: 250px; */
  margin: 0px 4px;
  margin-left: 16px;
}
.grandparent-pombos{
  /* // min-width: 250px; */
  margin: 0px 4px;
  margin-left: 16px;
}
.current-pombo{
  margin-top: 50%;
  transform: translateX(calc(55px - 15px)) translateY(-50%);
}
.grandparent-pombos{
  transform: translateX(calc(16px - 15px));
}
.pombo-gen-slot{
  position: relative;
  background-color: rgb(233, 233, 233);
  min-width: 180px;
  padding: 5px 0px;
  padding-left: 40px;

  min-height: 70px;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  padding-right: 5px;
  margin-bottom: 4px;
  /* // width: 100%; */
  margin-left: 45px;    
  }
.anilha{
      border-top: 1px solid black;
    }
.info{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    width: calc(100% - 0px);
}
.picture{
    position: absolute;
    top: 0;
    left: 0;
    transform: translateX(-50%);
    border-radius: 50%;
    max-width: 70px;
    border: 1px solid rgb(190, 190, 190);
  }
.pombo-pai{
  margin-bottom: calc(64px + 32px);
}
.pombo-pai-mae{
  margin-bottom: calc(40px);
}
.info-gerais{
    font-size: 18px;
    border-style: solid;
    border-width: 1px;
    margin-left: 20px;
    margin-right: 20px;
}
.itens{
    /* margin: 8px; */
    margin-right: 50px;
    margin-left: 50px;
}
.genealogic-tree{
    min-height: 0px !important;
    margin-left: -15px !important;
}
.info .nome{
        /* width: 100%; */
        /* text-align: center; */
        /* margin-bottom: 4px; */
        font-size: 18px !important;
      }

      .info .anilha{
        /* width: 100%; */
        /* text-align: center; */
        /* margin-top: 4px; */
        font-size: 18px !important;
      }
      .anilhatext{
        align-items: center;
    justify-content: center;
    display: flex;
    font-size: 30px;
     font-weight: bold;
      width: 100%;
       align-items: center
      }
</style>

<body id="container" style="background-color: transparent" onload="window.print();">
    {{-- style="background-color: transparent; width: 727px; height: 842px;" --}}
    <div >
<div class="image-container" style="display: flex; justify-content: center;margin-bottom: 25px;">    
    <img src="{{ (isset($pombo->foto)) ? '/public/img/pombo/'.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg'}}" id="imgProfile" style="width: 320px; height: 240px;  margin-top: 15px;" class="img-thumbnail" />                                     
</div>

<div class="anilhatext">
    <label class="" for="">Anilha: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->anilha}}</label>
    </div>

<div class="userData ml-3" style="display: flex; flex-direction: row; margin-bottom: 25px;justify-content: center;">       
    <div class="d-block" style="font-size: 30px; font-weight: bold;">        
        <label class="spacepdf" for="">Nome: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->nome}} {!!$pombo->morto == 1 ? '(morto)' :  ''!!}</label>
        <label class="spacepdf" for="">Pombal: </label>
        <label for="" style="color: #D9230F; text-decoration: none;">{{$pombo->pombal}}</label>        
    </div>    
</div>

<div class="info-gerais">

<div class="itens" style="display: flex;flex-direction: row; justify-content: space-between; margin-top: 1rem;">
    <label style="font-weight:bold;">Data de nascimento: <label style="font-weight:normal;" for="">{{$pombo->nascimento ? (strftime('%A, %d de %B de %Y', strtotime($pombo->nascimento))) : 'Data não informada'}}</label> </label>
    <label class="itens" style="font-weight:bold;">Cor: <a style="text-decoration: none;font-weight:normal; color: black;">{{$pombo->cor}}</a></label> 
</div>
<hr />

<div class="itens" style="display: flex;flex-direction: row; justify-content: space-between">
        @php
            $sexo = "";
            if ($pombo->macho == '1')
                $sexo = 'Macho';
            else if ($pombo->macho == '0')
                $sexo = 'Fêmea';
            else
                $sexo = 'Não informado';
        @endphp
        <label style="font-weight:bold;">Sexo: <label style="font-weight:normal;" for="">{{$sexo}}</label></label>                

        <label class="itens" style="font-weight:bold;">Situação: <a style="text-decoration: none;font-weight:normal; color: black;">{{ (($pombo->morto==0) ? 'Vivo' : (($pombo->morto==1) ? 'Morto' : (($pombo->morto==2) ? 'Doado' : (($pombo->morto==3) ? 'Perdido' : '')))) }}</a></label> 
</div>
<hr />

<div class="itens" style="display: flex;flex-direction: row; justify-content: space-between">
    {{-- <label style="font-weight:bold; color: black !important;">Idade: <a style="font-weight: normal;">{{$interval->y}} anos</a></label>         --}}
      
    <label class="antesEra-itens" style="font-weight:bold;">Mãe:         
        @foreach($pombos as $pomboCad)
        @if ($pombo->mae)        
            @if($pombo->mae_id == $pomboCad->id)
                <a style="font-weight: normal;"> {{$pombo->mae->anilha}} - {{$pombo->mae->nome}}  {!!$pombo->mae->morto == 1 ? '(morto)' :  ''!!}</a>
            @endif                        
        @endif        
        @endforeach
        @if(!$pombo->mae)
            <a style="font-weight: normal;"> Sem mãe</a>
        @endif
    </label>

    <label class="itens" style="font-weight:bold;">Pai: 
        @foreach($pombos as $pomboCad)
            @if ($pombo->pai)            
                @if($pombo->pai_id == $pomboCad->id)
                    <a style="font-weight: normal;"> {{$pombo->pai->anilha}} - {{$pombo->pai->nome}} {!!$pombo->pai->morto == 1 ? '(morto)' :  ''!!}</a>
                @endif
            @endif
        @endforeach    
    @if(!$pombo->pai)
        <a style="font-weight: normal;"> Sem pai</a>
    @endif
    </label>      
</div>
{{-- <hr /> --}}

{{-- <div class="itens" style="margin: 0;display: flex;flex-direction: row; justify-content: space-between">    
    
</div> --}}
<hr />

<div class="itens">
    <label style="font-weight:bold;">Árvore genealógica: </label>    
    <div id='gene-div' style="background-color: white">
        @include('components.genealogic-tree', ['pombo' => $pombo, 'print' => true])
    </div>
</div>
<hr />

<div class="itens" style="display: flex">
    <label style="margin-top: 2px;font-weight:bold;">Observações: </label>
    <textarea name="" id="" cols="80" rows="9" style="border: none; background: transparent;"> {{$pombo->obs}} </textarea>    
</div>
</div>



</div>

</body>


<script>
    // gera base64 da arvore
// var element = $("#container");
// var getCanvas;     
//     html2canvas(element, {
//     onrendered: function (canvas) {        
//         getCanvas = canvas;
//         var imgageData = getCanvas.toDataURL("image/png");
//         console.log(imgageData);
//         // $('#gene-div').css('display', 'none');        
//         // document.getElementById("imagemArvore").src = imgageData;
//         }
//     })

</script>

</html>
{{-- doc do dompdf, sobre compatibilidade de css --}}
{{-- https://github.com/dompdf/dompdf/wiki/CSSCompatibility --}}