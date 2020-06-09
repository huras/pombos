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
  @if(isset($print))
    <style>
      .pombo-gen-slot{
        padding-left: 16px!important;
        border: 1px solid rgb(235,235,235);
        border-left: 1px solid black;
        background-color: rgb(255, 255, 255);
        margin-bottom: 16px;
        margin-left: 128px;
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

      .pombo-filho{
        margin-left: 32px;
      }

      
      .pombo-pai{
        margin-bottom: 128px;
      }

      .pombo-pai-mae{
        margin-bottom: 80px;
      }
    </style>
  @endif

  <div class='genealogic-tree'>
    
    <div class='pombo-gen-slot pombo-filho'>
      @if(!isset($print))
        <img class='picture' src="{{ (isset($pombo->foto) ? ''.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
      @endif
      <div class='info'>
        <div class='nome'> {{$pombo->nome}} </div>
        <div class='anilha'> {{$pombo->anilha}} </div>
      </div>
    </div>
    <div class='parent-pombos'>
      <div class='pombo-gen-slot pombo-pai'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->pai->foto) ? ''.$pombo->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{ isset($pombo->pai) ? $pombo->pai->nome : 'Sem cadastro'}} ♂ </div>
          <div class='anilha'> {{ isset($pombo->pai) ? $pombo->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->mae->foto) ? ''.$pombo->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae) ? $pombo->mae->nome : 'Sem cadastro'}} ♀</div>
          <div class='anilha'> {{isset($pombo->mae) ? $pombo->mae->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
    </div>
    <div class='grandparent-pombos'>
      <div class='pombo-gen-slot'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->pai->pai->foto) ? ''.$pombo->pai->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{isset($pombo->pai->pai) ? $pombo->pai->pai->nome : 'Sem cadastro'}} ♂</div>
          <div class='anilha'> {{isset($pombo->pai->pai) ? $pombo->pai->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot pombo-pai-mae'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->pai->mae->foto) ? ''.$pombo->pai->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{isset($pombo->pai->mae) ? $pombo->pai->mae->nome : 'Sem cadastro'}} ♀</div>
          <div class='anilha'> {{isset($pombo->pai->mae) ? $pombo->pai->mae->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>

      <div class='pombo-gen-slot'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->mae->pai->foto) ? ''.$pombo->mae->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae->pai) ? $pombo->mae->pai->nome : 'Sem cadastro'}} ♂</div>
          <div class='anilha'> {{isset($pombo->mae->pai) ? $pombo->mae->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        @if(!isset($print))
          <img class='picture' src="{{ (isset($pombo->mae->mae->foto) ? ''.$pombo->mae->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae->mae) ? $pombo->mae->mae->nome : 'Sem vinculo'}} ♀</div>
          <div class='anilha'> {{isset($pombo->mae->mae) ? $pombo->mae->mae->anilha : 'Sem vinculo'}} </div>
        </div>
      </div>
    </div>
  </div>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif