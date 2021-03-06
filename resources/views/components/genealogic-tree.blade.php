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
    <div class='mobile-only'>
      <img src="/img/parent-lines.png" alt="">
    </div>
    <div class='parent-pombos'>
      <div class='pombo-gen-slot pombo-pai' title='Ir para perfil do pai' onclick='window.location = "{{isset($pombo->pai) ? '/pombo/profile/'.$pombo->pai->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->pai->foto) ? ''.$pombo->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif              
        <div class='info'>          
          <div class='nome'> {!! isset($pombo->pai) ? $pombo->pai->nome : (($pombo->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem pai </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!} {{ isset($pombo->pai) ? (($pombo->pai->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->pai) ? $pombo->pai->anilha : (($pombo->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem pai </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!}</div>
        </div>        
      </div>
      <div class='pombo-gen-slot' title='Ir para perfil da mãe' onclick='window.location = "{{isset($pombo->mae) ? '/pombo/profile/'.$pombo->mae->id : ''}}"'>
        @if(isset($useImage))
          <img class='picture' src="{{ (isset($pombo->mae->foto) ? ''.$pombo->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
        @endif        
        <div class='info'>
          <div class='nome'> {!! isset($pombo->mae) ? $pombo->mae->nome : (($pombo->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem mãe </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!} {{ isset($pombo->mae) ? (($pombo->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
          <div class='anilha'> {!! isset($pombo->mae) ? $pombo->mae->anilha : (($pombo->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem mãe </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') !!}</div>
        </div>
      </div>
    </div>    
    <div class='mobile-only'>
      <img src="/img/grandparent-lines.png" alt="">
    </div>
    <div class='grandparent-pombos'>
      <div class='paterno-grandparents'>
        <div class='pombo-gen-slot' title='Ir para perfil do avô paterno' onclick='window.location = "{{isset($pombo->pai->pai) ? '/pombo/profile/'.$pombo->pai->pai->id : ''}}"'>
          @if(isset($useImage))
            <img class='picture' src="{{ (isset($pombo->pai->pai->foto) ? ''.$pombo->pai->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
          @endif               
          <div class='info'>
            <div class='nome'> {!! isset($pombo->pai) ? (isset($pombo->pai->pai) ? $pombo->pai->pai->nome : (($pombo->pai->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem avô paterno </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Sem avô paterno </span>' !!} {{isset($pombo->pai->pai) ? (($pombo->pai->pai->macho == 1) ? '♂' : '♀') : ''}} </div>
            <div class='anilha'> {!! isset($pombo->pai) ? (isset($pombo->pai->pai) ? $pombo->pai->pai->anilha : (($pombo->pai->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem avô paterno </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Sem avô paterno </span>' !!} </div>
          </div>        
        </div>
        <div class='pombo-gen-slot pombo-pai-mae' title='Ir para perfil da avó paterna' onclick='window.location = "{{isset($pombo->pai->mae) ? '/pombo/profile/'.$pombo->pai->mae->id : ''}}"'>
          @if(isset($useImage))
            <img class='picture' src="{{ (isset($pombo->pai->mae->foto) ? ''.$pombo->pai->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
          @endif
          <div class='info'>
            <div class='nome'> {!! isset($pombo->pai) ? (isset($pombo->pai->mae) ? $pombo->pai->mae->nome : (($pombo->pai->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem avó paterna </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Sem avó paterna </span>' !!} {{isset($pombo->pai->mae) ? (($pombo->pai->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
            <div class='anilha'> {!! isset($pombo->pai) ? (isset($pombo->pai->mae) ? $pombo->pai->mae->anilha : (($pombo->pai->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem avó paterna </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Sem avó paterna </span>' !!} </div>
          </div>       
        </div>
      </div>
      <div class='materno-grandparents'>
        <div class='pombo-gen-slot' title='Ir para perfil do avô materno' onclick='window.location = "{{isset($pombo->mae->pai) ? '/pombo/profile/'.$pombo->mae->pai->id : ''}}"'>
          @if(isset($useImage))
            <img class='picture' src="{{ (isset($pombo->mae->pai->foto) ? ''.$pombo->mae->pai->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
          @endif
          <div class='info'>
            <div class='nome'> {!! isset($pombo->mae) ? (isset($pombo->mae->pai) ? $pombo->mae->pai->nome : (($pombo->mae->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem avô materno </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Sem avô materno </span>' !!} {{isset($pombo->mae->pai) ? (($pombo->mae->pai->macho == 1) ? '♂' : '♀') : ''}} </div>
            <div class='anilha'> {!! isset($pombo->mae) ? (isset($pombo->mae->pai) ? $pombo->mae->pai->anilha : (($pombo->mae->pai_id == 0) ? '<span style="color: #d4d4d4"> Sem avô materno </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Sem avô materno </span>' !!} </div>
          </div>               
        </div>
        <div class='pombo-gen-slot' title='Ir para perfil da avó materna' onclick='window.location = "{{isset($pombo->mae->mae) ? '/pombo/profile/'.$pombo->mae->mae->id : ''}}"'>
          @if(isset($useImage))
            <img class='picture' src="{{ (isset($pombo->mae->mae->foto) ? ''.$pombo->mae->mae->foto : 'https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg' ) }}">
          @endif
          <div class='info'>
            <div class='nome'> {!! isset($pombo->mae) ? (isset($pombo->mae->mae) ? $pombo->mae->mae->nome : (($pombo->mae->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem avó materna </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>') ) : '<span style="color: #d4d4d4"> Sem avó materna </span>' !!} {{isset($pombo->mae->mae) ? (($pombo->mae->mae->macho == 1) ? '♂' : '♀') : ''}} </div>
            <div class='anilha'> {!! isset($pombo->mae) ? (isset($pombo->mae->mae) ? $pombo->mae->mae->anilha : (($pombo->mae->mae_id == 0) ? '<span style="color: #d4d4d4"> Sem avó materna </span>' : '<span style="color: #d4d4d4"> Cadastro deletado </span>')  ) : '<span style="color: #d4d4d4"> Sem avó materna </span>' !!} </div>
          </div>                      
        </div>
      </div>
    </div>
  </div>
@else
  <div> Não foi recebido nenhum pombo para ser exibido. Erro: P-36 </div>
@endif


<style>
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

    /* CSS versão mobile */

@media (max-width: 768px) {
  .desktop-only {
    display: none;
  }
}

@media (min-width: 768px) {
  .mobile-only {
    display: none;
  }
}

.mobile-only table.dataTable tbody th,
.mobile-only table.dataTable tbody td {
  padding: 6px 4px!important;
  font-size: 12px;
}

.container {
  padding: 4px!important;
}

.mobile-only table {
  width: 100%!important;
}

@media (max-width: 768px) {
  .custom-checkbox .checkmark {
    height: 20px!important;
    width: 20px!important;
  }
  .custom-checkbox .checkmark:after {
    left: 7px!important;
    top: 3px!important;
  }
  .buttons-upper {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
  }
  .buttons-upper button {
    margin: 0!important;
    margin-bottom: 8px!important;
  }
  .genealogic-tree {
    flex-direction: column;
    min-width: unset;
    max-width: 100%;
    justify-content: flex-start!important;
  }
  .parent-pombos {
    display: flex;
  }
  .pombo-gen-slot {
    margin: 0!important;
    min-width: unset;
  }
  .pombo-gen-slot .nome,
  .pombo-gen-slot .anilha {
    font-size: 18px!important;
  }
  .parent-pombos .pombo-gen-slot .nome,
  .parent-pombos .pombo-gen-slot .anilha {
    font-size: 16px!important;
  }
  .paterno-grandparents {
    padding: 8px 4px;
    background-color: rgba(0, 60, 255, 0.192);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
  }
  .materno-grandparents {
    padding: 8px 4px;
    background-color: rgba(255, 0, 212, 0.192);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-evenly;
  }
  .paterno-grandparents div:first-of-type,
  .materno-grandparents div:first-of-type {
    margin-bottom: 12px!important;
  }
  .grandparent-pombos .pombo-gen-slot .nome,
  .grandparent-pombos .pombo-gen-slot .anilha {
    font-size: 14px!important;
  }
  .grandparent-pombos .pombo-gen-slot {
    /* margin-bottom: 16px!important; */
  }
  .pombo-gen-slot .info {
    width: unset!important;
  }
  .grandparent-pombos {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 100%;
  }
  .parent-pombos {
    width: 100%;
    align-items: center;
    justify-content: space-evenly;
  }
}
</style>