@extends('layout')

@section('content')

<div class="card uper">
  <div class="card-header">
    Editar usuário
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>            
            <li> Por favor corrija os campos indicados com erros. </li>
        </ul>
      </div><br />
    @endif
    <form method="post" action='/usuarios/update/{{$usuario->id}}' method="POST" enctype="multipart/form-data">
            @csrf

            @include('components.textInput', ['label'=>'Nome', 'name'=>'name', 'value' => $usuario->name, 'required' => true])            
            @include('components.textInput', ['label'=>'E-mail', 'name'=>'email', 'value' => (old('email') ? old('email') : $usuario->email)])

            <div class="form-group">
                <label class='w-100'>
                    <span>Tipo de Usuário:</span>
                    <?php $types = [1 => 'Edita', 0 => 'Vizualiza', 2 => 'Administra'] ?>
                    <select name="type" class="form-control">
                        @foreach($types as $key => $type)
                            <option value="{{$key}}" 
                                <?php if(!old('type') ? $key == $usuario->type : $key == old('type') ){ echo(" selected ");}?> > 
                                {{$type}}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            @include('components.textInput', ['label'=>'Senha', 'name'=>'password', 'placeholder' => '******', 'type' => 'password', 'value' => (old('password') ? old('password') : $usuario->password)])
            @include('components.textInput', ['label'=>'Confirmar senha', 'type' => 'password', 'placeholder' => '******', 'name'=>'ConfSenha', 'value' => (old('password') ? old('password') : $usuario->password)])
            


          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/usuarios'> Cancelar </a>
      </form>
  </div>
</div>
@endsection