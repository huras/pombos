@extends('layout')

@section('content')
<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>
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
</style>
<div class="uper">
  @if(session()->get('success'))
      <div class="alert alert-success">
        {{ session()->get('success') }}  
      </div><br />
    @endif  
    @if (Auth::user()->type != 0)
    <button type="button" onclick="window.location.href = '{{route('auth.create')}}'" class="btn btn-success">Cadastrar usuário</button>    
  @endif
  <div class='minha-table' style='    margin-top: 16px;  padding-top: 12px;  border-top: 1px solid #dee2e6; margin-bottom: 64px;'>
    <table class="table table-striped datatable">    
      <thead>        
          <tr>
            @if (Auth::user()->type != 0)
              @if(!isMobile())<td>ID</td>@endif
            @endif
            <td>Nome</td>
            <td>Tipo</td>
            @if(!isMobile())<td>E-mail</td>@endif       
            <td>Ações</td>          
          </tr>
      </thead>
      <tbody>
          @foreach($usuarios as $item)
          @if ($item->id != 1)        
          <tr>          
            @if(!isMobile())<td>{{$item->id}}</td>@endif
              <td>{{$item->name}}</td>
              <td>
                  @if ($item->type == 0)
                      Vizualizar                    
                  @endif                       
                  @if ($item->type == 1)
                      Editar
                  @endif       
                  @if ($item->type == 2)
                      Admin
                  @endif       
              </td>            
              @if(!isMobile()) <td>{{$item->email}}</td>@endif
              <td>
                  <div style='display: flex;'>                    
                      @if (Auth::user()->type != 0)
                  <a href="/usuarios/edit/{{$item->id}}" class="btn btn-outline-primary"> Editar </a>
                      <pre> </pre>
                  <form action="/usuarios/destroy/{{$item->id}}" method="get">
                      @csrf
                      @method('DELETE')
                      <button 
                          class="btn btn-outline-danger" 
                          type="submit" 
                          onclick='
                              if(!confirm("Deseja mesmo remover o usuário {{$item->name}} do sistema?")) {
                                  event.preventDefault();
                              }
                          '> Deletar </button>
                      </form>

                  </div>
                  @endif
              </td>            
          </tr>
          @endif
          @endforeach
      </tbody>
    </table>  
  <div>
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
