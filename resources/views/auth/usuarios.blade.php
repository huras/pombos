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
  <table class="table table-striped datatable">    
    <thead>        
        <tr>
          @if (Auth::user()->type != 0)
            <td>ID</td>
          @endif
          <td>Nome</td>
          <td>Tipo</td>
          <td>E-mail</td>          
          <td>Ações</td>          
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $item)
        @if ($item->id != 1)        
        <tr>          
            <td>{{$item->id}}</td>          
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
            <td>{{$item->email}}</td>
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
@endsection
