@if($pombo)
  @php
  // Pega pai
  if($pombo->pai){
    $pombo->pai_id = $pombo->pai;
    // Pega avós de parte de pai
    $pombo->pai->pai = $pombo->pai->pai;
    $pombo->pai->mae = $pombo->pai->mae;
  }

  // Pega mãe
  if($pombo->mae){
    $pombo->mae_id = $pombo->mae;
   // Pega avós de parte de mãe
    $pombo->mae->pai = $pombo->mae->pai;
    $pombo->mae->mae = $pombo->mae->mae;
  } 
  
  @endphp

  {{-- <canvas id='genealogic-tree-{{$pombo->id}}'>
  </canvas>
  <script src="{{ asset('js/genealogic-tree.js') }}" defer></script>
  <script>
    window.addEventListener('load', () => {
      let genealogicTree = new GenealogicTree('genealogic-tree-{{$pombo->id}}');
      let currentPombo = JSON.parse(`{!!json_encode($pombo)!!}`);
      genealogicTree.start(currentPombo);
    });
  </script> --}}
  
    <style>
      .pombo-gen-slot{
        padding-left: 16px!important;
        border: 1px solid rgb(235,235,235);
        border-left: 1px solid black;
        background-color: rgb(255, 255, 255);
        margin-bottom: 16px;
        margin-left: 128px;
        transition: all ease-in 0.2s;
      }
      .pombo-gen-slot:hover{
        background-color: rgba(200, 235, 255, 0.5);
        transition: all ease-out 0.3s;
      }

      .info .nome{
        width: 100%;
        text-align: center;
        margin-bottom: 4px;
        font-size: 24px;
      }

      .info .anilha{
        width: 100%;
        text-align: center;
        margin-top: 4px;
        font-size: 24px;
      }

      @if(isset($print))
        .pombo-filho {
            margin-left: 32px;
        }
      @else
        .pombo-filho{
            margin-left: 0px;
        }
        #gene-div{
          width: 100%;
          display: flex;
          align-items: center;
          justify-content: center;
        }
        .genealogic-tree{
          justify-content: space-evenly;
        }
      @endif

      
      .pombo-pai{
        margin-bottom: 128px;
      }

      .pombo-pai-mae{
        margin-bottom: 80px;
      }

      .pombo-gen-slot{
        cursor: pointer;
      }

      .pombo-gen-slot .info .anilha{
        border-top: 2px solid #e2e2e2;
      }
    </style>
  

  <div class='genealogic-tree'>    
    <div class='pombo-gen-slot pombo-filho' title='Pombo atual' onclick='window.location = "/pombo/profile/{{$pombo->id}}"' style='cursor: default;'>
      @if(isset($useImage))
        <img class='picture' src="{{ (isset($pombo->foto) ? ''.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
      @endif
      <div class='info'>
        <div class='nome'> {{$pombo->nome}} {{($pombo->macho == 1) ? '♂' : '♀'}}</div>
        <div class='anilha'> {{$pombo->anilha}} </div>
      </div>
    </div>

    <div class='parent-pombos'>
      <div class='pombo-gen-slot pombo-pai' title='{{ (isset($pombo->pai) ? 'Ir para perfil do pai' : '' ) }}' onclick='window.location = "{{isset($pombo->pai) ? '/pombo/profile/'.$pombo->pai->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->pai->foto) ? ''.$pombo->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif              
        <div class='info'>          
          <div class='nome'> {!! isset($pombo->pai) ? $pombo->pai->nome : (($pombo->pai_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!} {{ isset($pombo->pai) ? (($pombo->pai->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->pai) ? $pombo->pai->anilha : (($pombo->pai_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!}</div>
        </div>        
      </div>
      <div class='pombo-gen-slot' title='{{ (isset($pombo->mae) ? 'Ir para perfil da mãe' : '' ) }}' onclick='window.location = "{{isset($pombo->mae) ? '/pombo/profile/'.$pombo->mae->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->mae->foto) ? ''.$pombo->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif        
        <div class='info'>
          <div class='nome'> {!! isset($pombo->mae) ? $pombo->mae->nome : (($pombo->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!} {{ isset($pombo->mae) ? (($pombo->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->mae) ? $pombo->mae->anilha : (($pombo->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!}</div>
        </div>
      </div>
    </div>

    <div class='grandparent-pombos'>
      <div class='pombo-gen-slot' title='{{ (isset($pombo->pai->pai) ? 'Ir para perfil do avô paterno' : '' ) }}' onclick='window.location = "{{isset($pombo->pai->pai) ? '/pombo/profile/'.$pombo->pai->pai->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->pai->pai->foto) ? ''.$pombo->pai->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif               
        <div class='info'>
          <div class='nome'> {!! isset($pombo->pai) ? (isset($pombo->pai->pai) ? $pombo->pai->pai->nome : (($pombo->pai->pai_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} {{isset($pombo->pai->pai) ? (($pombo->pai->pai->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->pai) ? (isset($pombo->pai->pai) ? $pombo->pai->pai->anilha : (($pombo->pai->pai_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} </div>
        </div>        
      </div>

      <div class='pombo-gen-slot pombo-pai-mae' title='{{ (isset($pombo->pai->mae) ? 'Ir para perfil da avó paterna' : '' ) }}' onclick='window.location = "{{isset($pombo->pai->mae) ? '/pombo/profile/'.$pombo->pai->mae->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->pai->mae->foto) ? ''.$pombo->pai->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {!! isset($pombo->pai) ? (isset($pombo->pai->mae) ? $pombo->pai->mae->nome : (($pombo->pai->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} {{isset($pombo->pai->mae) ? (($pombo->pai->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->pai) ? (isset($pombo->pai->mae) ? $pombo->pai->mae->anilha : (($pombo->pai->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} </div>
        </div>       
      </div>

      <div class='pombo-gen-slot' title='{{ (isset($pombo->mae->pai) ? 'Ir para perfil do avô materno' : '' ) }}' onclick='window.location = "{{isset($pombo->mae->pai) ? '/pombo/profile/'.$pombo->mae->pai->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->mae->pai->foto) ? ''.$pombo->mae->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {!!isset($pombo->mae->pai) ? $pombo->mae->pai->nome : '<span style="color: #d4d4d4"> Cadastro deletado </span>'!!} ♂</div>
          <div class='anilha'> {!!isset($pombo->mae->pai) ? $pombo->mae->pai->anilha : '<span style="color: #d4d4d4"> Cadastro deletado </span>'!!} </div>
        </div>

      </div>
      <div class='pombo-gen-slot' title='{{ (isset($pombo->mae->mae) ? 'Ir para perfil da avó materna' : '' ) }}' onclick='window.location = "{{isset($pombo->mae->mae) ? '/pombo/profile/'.$pombo->mae->mae->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->mae->mae->foto) ? ''.$pombo->mae->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {!! isset($pombo->mae) ? (isset($pombo->mae->mae) ? $pombo->mae->mae->nome : (($pombo->mae->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} {{isset($pombo->mae->mae) ? (($pombo->mae->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->mae) ? (isset($pombo->mae->mae) ? $pombo->mae->mae->anilha : (($pombo->mae->mae_id == 0) ? '<span style="color: #d4d4d4"> Cadastro deletado </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Cadastro deletado </span>' !!} </div>
        </div>                      
      </div>
    </div>
  </div>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif