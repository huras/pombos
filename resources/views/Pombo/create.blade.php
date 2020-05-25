@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Novo Pombo
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>            
            <li> Por favor corrija os campos indicados com erros. </li>
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('pombo.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class='w-100'>
                    <span> Foto: </spán>
                    <input type="file" class="form-control integer-mask" name="foto"/>
                </label>
            </div>
            
            @include('components.textInput', ['label'=>'Anilha', 'name'=>'anilha', 'mask' => 'integer-mask'])
            @include('components.textInput', ['label'=>'Nome', 'name'=>'nome'])
            @include('components.textInput', ['label'=>'Data de Nascimento', 'name'=>'nascimento', 'mask' => 'date-mask'])

            <div class="form-group">
                <label class='w-100'>
                    <span> Sexo: </spán>
                    <select name="macho" class="form-control">
                        <option value="1"> Macho </option>
                        <option value="0"> Fêmea </option>
                    </select>
                </label>
            </div>

            <div class="form-group">
                <span> Pai: </spán>
                <select class="form-control pombo-select2" name="pai_id">
                    <option value="-1" disabled selected> Pesquisar ... </option>
                    @foreach($pombos as $pombo)
                        @if($pombo->macho == '1')
                            <option value="{{$pombo->id}}"> {{$pombo->anilha}} - {{$pombo->nome}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <span> Mãe: </spán>
                <select class="form-control pombo-select2" name="mae_id">
                    <option value="-1" disabled selected> Pesquisar ... </option>
                    @foreach($pombos as $pombo)
                        @if($pombo->macho == '0')
                            <option value="{{$pombo->id}}"> {{$pombo->anilha}} - {{$pombo->nome}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @include('components.textInput', ['label'=>'Cor', 'name'=>'cor'])

            <div class="form-group">
                <span> Pombal: </spán>
                <select class="form-control pombo-select2" name="pombal_id">
                    <option value="-1" disabled selected> Pesquisar ... </option>
                    @foreach($pombais as $pombal)
                        <option value="{{$pombal->id}}"> {{$pombal->nome}} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class='w-100'>
                    <span> Observações : </spán>
                    <textarea rows="5" columns="5" class="form-control" name="obs"> {{old('obs')}} </textarea>
                </label>
            </div>
          <button type="submit" class="btn btn-success">Salvar</button>
          <a class="btn btn-danger" href='/pombos'> Cancelar </a>
      </form>
  </div>
</div>

<script>
    window.addEventListener('load', () => {
        $('.pombo-select2').select2();
    });
</script>

@endsection