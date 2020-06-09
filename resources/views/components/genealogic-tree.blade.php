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

  <div class='genealogic-tree'>
    
    <div class='pombo-gen-slot'>
      <img class='picture' src="{{ (isset($pombo->foto) ? ''.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
      <div class='info'>
        <div class='nome'> {{$pombo->nome}} </div>
        <div class='anilha'> {{$pombo->anilha}} </div>
      </div>
    </div>
    <div class='parent-pombos'>
      <div class='pombo-gen-slot pombo-pai'>
        <img class='picture' src="{{ (isset($pombo->pai->foto) ? ''.$pombo->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{ isset($pombo->pai) ? $pombo->pai->nome : 'Sem cadastro'}} </div>
          <div class='anilha'> {{ isset($pombo->pai) ? $pombo->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->foto) ? ''.$pombo->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae) ? $pombo->mae->nome : 'Sem cadastro'}} </div>
          <div class='anilha'> {{isset($pombo->mae) ? $pombo->mae->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
    </div>
    <div class='grandparent-pombos'>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->pai->pai->foto) ? ''.$pombo->pai->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{isset($pombo->pai) ? $pombo->pai->pai->nome : 'Sem cadastro'}} </div>
          <div class='anilha'> {{isset($pombo->pai) ? $pombo->pai->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot pombo-pai-mae'>
        <img class='picture' src="{{ (isset($pombo->pai->mae->foto) ? ''.$pombo->pai->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{isset($pombo->pai->mae) ? $pombo->pai->mae->nome : 'Sem cadastro'}} </div>
          <div class='anilha'> {{isset($pombo->pai->mae) ? $pombo->pai->mae->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>

      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->pai->foto) ? ''.$pombo->mae->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae->pai) ? $pombo->mae->pai->nome : 'Sem cadastro'}} </div>
          <div class='anilha'> {{isset($pombo->mae->pai) ? $pombo->mae->pai->anilha : 'Sem cadastro'}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->mae->foto) ? ''.$pombo->mae->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{isset($pombo->mae->mae) ? $pombo->mae->mae->nome : 'Sem vinculo'}} </div>
          <div class='anilha'> {{isset($pombo->mae->mae) ? $pombo->mae->mae->anilha : 'Sem vinculo'}} </div>
        </div>
      </div>
    </div>
  </div>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif