@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Novo Pombal
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('pombal.store') }}">
            @csrf

            <div class="form-group">
                <label class='w-100'>
                    <span> Nome: </spán>
                    <input type="text" class="form-control" name="nome"/>
                </label>
            </div>            

          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/pombais'> Cancelar </a>
      </form>
  </div>
</div>

@endsection