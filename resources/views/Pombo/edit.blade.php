@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Editar Pombo
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>            
            <li> Por favor corrija os campos indicados com erros. </li>
        </ul>
      </div><br />
    @endif
    <form method="post" action='/pombo/update/{{$pombo->id}}' method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class='w-100'>
                    <span> Foto: </spán>
                    <input type="file" class="form-control integer-mask" name="foto">
                </label>
            </div>
            
            @include('components.textInput', ['label'=>'Anilha', 'name'=>'anilha', 'mask' => 'integer-mask', 'value' => $pombo->anilha])
            @include('components.textInput', ['label'=>'Nome', 'name'=>'nome', 'value' => $pombo->nome])
                <?php                                
                    $dataBD = $pombo->nascimento;
                    $splitData = explode("-", $dataBD);                
                    $ano = $splitData[0];
                    $mes = $splitData[1];
                    $dia = $splitData[2];
                    $dataCompleta = $dia.'-'.$mes.'-'.$ano;
                ?>
            @include('components.textInput', ['label'=>'Data de Nascimento', 'name'=>'nascimento', 'mask' => 'date-mask', 'value' => $dataCompleta])

            <div class="form-group">
                <label class='w-100'>
                    <span> Sexo: </spán>
                    <select name="macho" class="form-control">
                        <option value="1" @if($pombo->macho == '1') selected @endif >Macho</option>
                        <option value="0" @if($pombo->macho == '0') selected @endif >Femea</option>                        
                    </select>
                </label>
            </div>

            <div class="form-group">
                <span> Pai: </spán>
                <select class="form-control pombo-select2" name="pai_id">                    
                    @foreach($pombos as $pomboCad)                    
                        @if($pomboCad->macho == '1')                        
                            <option value="{{$pomboCad->id}}"<?php if($pomboCad->id == $pombo->pai_id){echo("selected");}?>> {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <span> Mae: </spán>
                <select class="form-control pombo-select2" name="mae_id">                    
                    @foreach($pombos as $pomboCad)                    
                        @if($pomboCad->macho == '0')                        
                            <option value="{{$pomboCad->id}}"<?php if($pomboCad->id == $pombo->mae_id){echo("selected");}?>> {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @include('components.select', ['label'=>'Cor', 'name'=>'cor', $values = array('Azul', 'Azul PB', 'Branca', 'Bronze', 'Camurça', 'Chocolate', 'Dourado Escama', 'Escama', 'Escama PB', 'Fulvo', 'Macotado', 'Mosáico', 'Pigarço', 'Preta', 'Vermelha', 'Vermelha Macotado', 'Vermelho PB'), 'valueCad' => $pombo->cor])

            @include('components.select', ['label'=>'Pombal', 'name'=>'pombal', $values = array("Olhos D'água", 'Lagoa Santa', 'Pampulha'), 'valueCad' => $pombo->pombal]) 

            <div class="form-group">
                <label class='w-100'>
                    {{-- <span> Morto </spán> --}}
                    <select name="morto" class="form-control">
                        <option value="0" @if($pombo->morto == '0') selected @endif >Vivo</option>                        
                        <option value="1" @if($pombo->morto == '1') selected @endif >Morto</option>                        
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label class='w-100'>
                    <span> Observações : </spán>
                    <textarea rows="5" columns="5" class="form-control" name="obs"> {{$pombo->obs}} </textarea>
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