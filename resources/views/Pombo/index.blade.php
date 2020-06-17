@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;    
  }
  table.dataTable thead th, table.dataTable thead td{
    padding: 0px 6px;
    padding-top: 2px;
    vertical-align: inherit;
    text-align: center;
  }
  td{
    vertical-align: middle!important;
    text-align: center!important;
  }

  button svg{
    margin-right:10px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif  
  @if (Auth::user()->type != 0)
  <button style="margin-right:30px" type="button" onclick="window.location.href = '{{route('pombo.create')}}'" class="btn btn-success"> <svg width="16px" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus-square" class="svg-inline--fa fa-plus-square fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48zm-32 252c0 6.6-5.4 12-12 12h-92v92c0 6.6-5.4 12-12 12h-56c-6.6 0-12-5.4-12-12v-92H92c-6.6 0-12-5.4-12-12v-56c0-6.6 5.4-12 12-12h92v-92c0-6.6 5.4-12 12-12h56c6.6 0 12 5.4 12 12v92h92c6.6 0 12 5.4 12 12v56z"></path></svg>   Cadastrar pombo</button>

  <button type="button" onclick="window.location.href = '{{route('pombo.exporta')}}'" class="btn btn-success"> <svg width="16px" aria-hidden="true" focusable="false" data-prefix="far" data-icon="file-excel" class="svg-inline--fa fa-file-excel fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M369.9 97.9L286 14C277 5 264.8-.1 252.1-.1H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48V131.9c0-12.7-5.1-25-14.1-34zM332.1 128H256V51.9l76.1 76.1zM48 464V48h160v104c0 13.3 10.7 24 24 24h104v288H48zm212-240h-28.8c-4.4 0-8.4 2.4-10.5 6.3-18 33.1-22.2 42.4-28.6 57.7-13.9-29.1-6.9-17.3-28.6-57.7-2.1-3.9-6.2-6.3-10.6-6.3H124c-9.3 0-15 10-10.4 18l46.3 78-46.3 78c-4.7 8 1.1 18 10.4 18h28.9c4.4 0 8.4-2.4 10.5-6.3 21.7-40 23-45 28.6-57.7 14.9 30.2 5.9 15.9 28.6 57.7 2.1 3.9 6.2 6.3 10.6 6.3H260c9.3 0 15-10 10.4-18L224 320c.7-1.1 30.3-50.5 46.3-78 4.7-8-1.1-18-10.3-18z"></path></svg>  Exportar cadastro</button>
@endif
  <div class='minha-table' style='    margin-top: 16px;  padding-top: 12px;  border-top: 1px solid #dee2e6; margin-bottom: 64px;'>
    <table class="table table-striped datatable">    
      <thead>        
          <tr>
            @if (Auth::user()->type != 0)
              <td>ID</td>
            @endif
            <td style="display: none">Morto?</td>
            <td>Foto</td>
            <td>Anilha</td>
            <td>Nome</td>
            <td>Sexo</td>
            <td>Data de Nascimento</td>
            <td>Pombal</td>
            <td>Cor</td>
            <td>Pai</td>
            <td>Mãe</td>          
            <td>Ações</td>              
          </tr>
      </thead>
      <tbody>
          @foreach($pombos as $item)
          <tr {{$item->morto == 1 ? 'style=background-color:rgb(255,221,221)' : '' }} >
            @if (Auth::user()->type != 0)
              <td>{{$item->id}}</td>
            @endif
            <td style="display: none">{{$item->morto == 1 ? 'Morto' : 'Vivo'}}</td>            
              <td>
                  @if($item->foto)
                      <img loading = "lazy" style='max-width: 50px; border-radius: 50%; height: 50px;' src='/public/img/pombo/{{$item->foto}}'>
                      @else
                      <img loading = "lazy" style='max-width: 50px; border-radius: 50%; height: 50px;' src='https://www.policiajudiciaria.pt/wp-content/uploads/2004/04/sem-foto.jpg'>                    
                  @endif
              </td>            
              <td>{{$item->anilha}}</td>
              <td>
              {{$item->nome}}
              {!!$item->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}
              </td>
                <td><div style='display: flex; justify-content: center; align-items: center;'>{!!$item->macho == 1 ? 
                  'Macho <svg aria-hidden="true" style="height: 18px; margin-left: 4px;" focusable="false" data-prefix="fas" data-icon="mars" class="svg-inline--fa fa-mars fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#6cb2eb" d="M372 64h-79c-10.7 0-16 12.9-8.5 20.5l16.9 16.9-80.7 80.7c-22.2-14-48.5-22.1-76.7-22.1C64.5 160 0 224.5 0 304s64.5 144 144 144 144-64.5 144-144c0-28.2-8.1-54.5-22.1-76.7l80.7-80.7 16.9 16.9c7.6 7.6 20.5 2.2 20.5-8.5V76c0-6.6-5.4-12-12-12zM144 384c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path></svg>' 
                  : 
                  'Fêmea <svg aria-hidden="true" style="height: 18px; margin-left: 4px;" focusable="false" data-prefix="fas" data-icon="venus" class="svg-inline--fa fa-venus fa-w-9" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512"><path fill="#f66d9b" d="M288 176c0-79.5-64.5-144-144-144S0 96.5 0 176c0 68.5 47.9 125.9 112 140.4V368H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h36v36c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-36h36c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-36v-51.6c64.1-14.5 112-71.9 112-140.4zm-224 0c0-44.1 35.9-80 80-80s80 35.9 80 80-35.9 80-80 80-80-35.9-80-80z"></path></svg>'
                  !!}</div>
              </td>
              <td>
                  <span style='font-size: 0px;'>{{$item->nascimento}}</span> 
                  <span>{{date("d/m/Y", strtotime($item->nascimento))}}</span>
              </td>
              <td>{{$item->pombal}}</td>
              <td>{{$item->cor}}</td>

              <td> 
                  @if($item->pai)
                      <a href="{{ route('pombo.edit', $item->pai->id)}}" class="">{{$item->pai->nome}} {!!$item->pai->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a> 
                  @endif
              </td>

              <td>
                @if ($item->mae)
                <a href="{{ route('pombo.edit', $item->mae->id)}}" class="">{{$item->mae->nome}} {!!$item->mae->morto == 1 ? '<svg version="1.1" id="Capa_1" style="height: 18px;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g>	<g>		<path d="M356.233,0H155.769L94.96,139.227L163.087,512h185.826l68.127-372.773L356.233,0z M310.446,146.166L310.446,146.166			h-39.444v104.108H241V146.166h-39.444v-30.001H241V69.766h30.001v46.398h39.444V146.166z"/>	</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>' :  ''!!}</a> 
                @endif
              </td>            
              <td>
                  <div style='display: flex;'>
                      <a href="{{ route('pombo.profile', $item->id)}}" class="btn btn-outline-info"> Perfil </a>
                      <pre> </pre>
                      @if (Auth::user()->type != 0)
                      <a href="{{ route('pombo.edit', $item->id)}}" class="btn btn-outline-primary"> Editar </a>
                      <pre> </pre>

                      <form action="{{ route('pombo.destroy', $item->id)}}" method="post">
                      @csrf
                      @method('DELETE')
                      <button 
                          class="btn btn-outline-danger" 
                          type="submit" 
                          onclick='
                              if(!confirm("Deseja mesmo remover o pombo {{$item->anilha." - ".$item->nome}}  do sistema?")) {
                                  event.preventDefault();
                              }
                          '> Deletar </button>
                      </form>

                  </div>
                  @endif
              </td>            
          </tr>
          @endforeach
      </tbody>
    </table>  
  </div>
<div>


  <script>
    window.addEventListener('load', function () {
    $(document).ready(function () {

        // Datatables
        $('.datatable').DataTable({
            "order": [[0, 'asc']],
            "language": {
                "paginate": {
                    "previous": "Anterior",
                    'next': 'Próxima',
                    'first': 'Primeira',
                    'last': 'Última',
                },
                "lengthMenu": "Exibindo _MENU_ linhas",
                "infoFiltered": "(filtrados de um total de _MAX_ linhas)",
                "info": "Exibindo _START_ até _END_ de _TOTAL_ linhas",
                'search': 'Pesquisa rápida:',
                "zeroRecords": "0 resultados",
                "thousands": ".",
                "emptyTable": "Tabela vazia",
            },
            "pageLength": 100
        });
    });
});
  </script>
@endsection
