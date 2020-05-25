@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped datatable">
    <thead>
        <tr>
          <td>ID</td>
          <td>Foto</td>
          <td>Anilha</td>
          <td>Nome</td>
          <td>Sexo</td>
          <td>Data de Nascimento</td>
          <td>Cor</td>
          <td>Pai</td>
          <td>Mãe</td>
          <td>Ações</td>
        </tr>
    </thead>
    <tbody>
        @foreach($pombos as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>
                @if($item->foto)
                    <img style='max-width: 50px; border-radius: 50%;' src='/img/pombo/{{$item->foto}}'>
                @endif
            </td>
            <td>{{$item->anilha}}</td>
            <td>{{$item->nome}}</td>
            <td>{!!$item->macho == 1 ? 
                'Macho <svg aria-hidden="true" style="height: 18px;" focusable="false" data-prefix="fas" data-icon="mars" class="svg-inline--fa fa-mars fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="#6cb2eb" d="M372 64h-79c-10.7 0-16 12.9-8.5 20.5l16.9 16.9-80.7 80.7c-22.2-14-48.5-22.1-76.7-22.1C64.5 160 0 224.5 0 304s64.5 144 144 144 144-64.5 144-144c0-28.2-8.1-54.5-22.1-76.7l80.7-80.7 16.9 16.9c7.6 7.6 20.5 2.2 20.5-8.5V76c0-6.6-5.4-12-12-12zM144 384c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z"></path></svg>' 
                : 
                'Fêmea <svg aria-hidden="true" style="height: 18px;" focusable="false" data-prefix="fas" data-icon="venus" class="svg-inline--fa fa-venus fa-w-9" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 288 512"><path fill="#f66d9b" d="M288 176c0-79.5-64.5-144-144-144S0 96.5 0 176c0 68.5 47.9 125.9 112 140.4V368H76c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h36v36c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12v-36h36c6.6 0 12-5.4 12-12v-40c0-6.6-5.4-12-12-12h-36v-51.6c64.1-14.5 112-71.9 112-140.4zm-224 0c0-44.1 35.9-80 80-80s80 35.9 80 80-35.9 80-80 80-80-35.9-80-80z"></path></svg>'
                !!}
            </td>
            <td>
                <span style='font-size: 0px;'>{{$item->nascimento}}</span> 
                <span>{{date("d/m/Y", strtotime($item->nascimento))}}</span>
            </td>
            <td>{{$item->cor}}</td>
            <td> 
                @if($item->pai_id != 0)
                    <a href="{{ route('pombo.edit', $item->pai->id)}}" class=""> {{$item->pai->nome}} </a> 
                @endif
            </td>
            <td> 
                @if($item->mae_id != 0)
                    <a href="{{ route('pombo.edit', $item->mae->id)}}" class=""> {{$item->mae->nome}} </a> 
                @endif
            </td>
            <td>
                <div style='display: flex;'>
                    <a href="{{ route('pombo.edit', $item->id)}}" class="btn btn-primary"> Editar </a>
                    <pre> </pre>
                    <form action="{{ route('pombo.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button 
                        class="btn btn-danger" 
                        type="submit" 
                        onclick='
                            if(!confirm("Deseja mesmo remover o pombo {{$item->anilha." - ".$item->nome}} do sistema?")) {
                                event.preventDefault();
                            }
                        '> Deletar </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection
