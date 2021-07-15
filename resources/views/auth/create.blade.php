@extends('layout')

@section('content')
<?php
function isMobile() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
?>
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
            <div class="form-group">
                <label class='w-100'>
                    Tipo de Usuário:
                    <select name="type" id="" class="form-control pombo-select2">
                        <option value="0">Visualiza</option>
                        <option value="1">Editar</option>
                        <option value="2">Administrar</option>
                    </select>
                </label>
            </div>
            @include('components.textInput', ['label'=>'Senha','placeholder' => '******','type' => 'password', 'name'=>'password'])
            @include('components.textInput', ['label'=>'Confirmar senha','placeholder' => '******','type' => 'password', 'name'=>'ConfSenha'])

          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/usuarios'> Cancelar </a>
      </form>
  </div>
</div>
@endsection