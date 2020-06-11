@extends('layout')

@section('content')

<script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js "></script>
<div class="card uper">
  <div class="card-header">
    Novo Usuário
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>            
            <li> Por favor, corrija os campos indicados com erros. </li>
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('auth.store') }}" enctype="multipart/form-data">
            @csrf                    
            @include('components.textInput', ['label'=>'Nome', 'name'=>'name'])            
            @include('components.textInput', ['label'=>'E-mail', 'name'=>'email'])
            @include('components.select', ['label'=>'Tipo de usuário', 'name'=>'type', $values = array(0, 1, 2)])
            @include('components.textInput', ['label'=>'Senha', 'name'=>'password'])
            @include('components.textInput', ['label'=>'Confirmar senha', 'name'=>'ConfSenha'])

          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/usuarios'> Cancelar </a>
      </form>
  </div>
</div>
@endsection