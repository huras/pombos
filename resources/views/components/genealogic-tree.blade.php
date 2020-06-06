@if($pombo)
  @php
  // Pega pai e mãe
    $pombo->pai = $pombo->pai;
    $pombo->mae = $pombo->mae;

    // Pega avós de parte de pai
    $pombo->pai->pai = $pombo->pai->pai;
    $pombo->pai->mae = $pombo->pai->mae;

    // Pega avós de parte de mãe
    $pombo->mae->pai = $pombo->mae->pai;
    $pombo->mae->mae = $pombo->mae->mae;

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
      <img class='picture' src="{{ (isset($pombo->foto) ? '/img/pombo/'.$pombo->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
      <div class='info'>
        <div class='nome'> {{$pombo->nome}} </div>
        <div class='anilha'> {{$pombo->anilha}} </div>
      </div>
    </div>
    <div class='parent-pombos'>
      <div class='pombo-gen-slot pombo-pai'>
        <img class='picture' src="{{ (isset($pombo->pai->foto) ? '/img/pombo/'.$pombo->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->pai->nome}} </div>
          <div class='anilha'> {{$pombo->pai->anilha}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->foto) ? '/img/pombo/'.$pombo->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->mae->nome}} </div>
          <div class='anilha'> {{$pombo->mae->anilha}} </div>
        </div>
      </div>
    </div>
    <div class='grandparent-pombos'>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->pai->pai->foto) ? '/img/pombo/'.$pombo->pai->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->pai->pai->nome}} </div>
          <div class='anilha'> {{$pombo->pai->pai->anilha}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot pombo-pai-mae'>
        <img class='picture' src="{{ (isset($pombo->pai->mae->foto) ? '/img/pombo/'.$pombo->pai->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->pai->mae->nome}} </div>
          <div class='anilha'> {{$pombo->pai->mae->anilha}} </div>
        </div>
      </div>

      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->pai->foto) ? '/img/pombo/'.$pombo->mae->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->mae->pai->nome}} </div>
          <div class='anilha'> {{$pombo->mae->pai->anilha}} </div>
        </div>
      </div>
      <div class='pombo-gen-slot'>
        <img class='picture' src="{{ (isset($pombo->mae->mae->foto) ? '/img/pombo/'.$pombo->mae->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        <div class='info'>
          <div class='nome'> {{$pombo->mae->mae->nome}} </div>
          <div class='anilha'> {{$pombo->mae->mae->anilha}} </div>
        </div>
      </div>
    </div>
  </div>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif