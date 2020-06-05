@if($pombo)
  @php
  // Pega pai e mãe
    $pombo->pai_id = $pombo->pai;
    $pombo->mae_id = $pombo->mae;

    // Pega avós de parte de pai
    $pombo->pai->pai = $pombo->pai->pai;
    $pombo->pai->mae = $pombo->pai->mae;

    // Pega avós de parte de mãe
    $pombo->mae->pai = $pombo->mae->pai;
    $pombo->mae->mae = $pombo->mae->mae;
  @endphp

  <canvas id='genealogic-tree-{{$pombo->id}}'>
  </canvas>
  <script src="{{ asset('js/genealogic-tree.js') }}" defer></script>
  <script>
    window.addEventListener('load', () => {
      let genealogicTree = new GenealogicTree('genealogic-tree-{{$pombo->id}}');
      let currentPombo = JSON.parse(`{!!json_encode($pombo)!!}`);
      genealogicTree.start(currentPombo);
    });
  </script>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif