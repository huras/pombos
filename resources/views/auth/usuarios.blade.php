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
        <tr>          
            <td>{{$item->id}}</td>          
            <td>{{$item->nome}}</td>
            <td>{{$item->type}}</td>            
            <td>{{$item->email}}</td>
            <td>
                <div style='display: flex;'>                    
                    @if (Auth::user()->type != 0)
                    <a href="{{ route('auth.edit', $item->id)}}" class="btn btn-outline-primary"> Editar </a>
                    <pre> </pre>
                    <form action="{{ route('auth.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button 
                        class="btn btn-outline-danger" 
                        type="submit" 
                        onclick='
                            if(!confirm("Deseja mesmo remover o auth {{$item->anilha." - ".$item->nome}}  do sistema?")) {
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
<div>
@endsection
