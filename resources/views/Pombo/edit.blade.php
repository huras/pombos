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
                    <span> Foto: </span>
                    <input type="file" class="form-control integer-mask" name="foto">
                </label>
            </div>
            
            @include('components.textInput', ['label'=>'Anilha', 'name'=>'anilha', 'value' => $pombo->anilha, 'required' => true])
            @include('components.textInput', ['label'=>'Nome', 'name'=>'nome', 'value' => $pombo->nome])
                <?php                                
                    $dataBD = $pombo->nascimento;
                    $splitData = explode("-", $dataBD);                
                    $ano = $splitData[0];
                    $mes = $splitData[1];
                    $dia = $splitData[2];
                    $dataCompleta = $dia.'-'.$mes.'-'.$ano;
                ?>
            @include('components.textInput', ['label'=>'Data de Nascimento', 'name'=>'nascimento', 'mask' => 'date-mask', 'value' => (old('nascimento') ? old('nascimento') : $dataCompleta)])

            <div class="form-group">
                <label class='w-100'>
                    <span> Sexo: </span>
                    <?php $sexos = [1 => 'Macho', 0 => 'Fêmea'] ?>
                    <select name="macho" class="form-control">
                        @foreach($sexos as $key => $sexo)
                            <option value="{{$key}}" 
                                <?php if(!old('macho') ? $key == $pombo->macho : $key == old('macho') ){ echo(" selected ");}?> > 
                                {{$sexo}}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="form-group">
                <span> Pai: </span>
                <select class="form-control pombo-select2" name="pai_id">                    
                    @foreach($pombos as $pomboCad)
                        @if($pomboCad->macho == '1' && $pomboCad->id != $pombo->id)
                            <option value="{{$pomboCad->id}}" <?php if(!old('pai_id') ? $pomboCad->id == $pombo->pai_id : $pomboCad->id == old('pai_id') ){echo("selected");}?> > {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <span> Mae: </span>
                <select class="form-control pombo-select2" name="mae_id">                    
                    @foreach($pombos as $pomboCad)                    
                        @if($pomboCad->macho == '0' && $pomboCad->id != $pombo->id)
                            <option value="{{$pomboCad->id}}" <?php if(!old('mae_id') ? $pomboCad->id == $pombo->mae_id : $pomboCad->id == old('mae_id') ){echo("selected");}?> > {{$pomboCad->anilha}} - {{$pomboCad->nome}} {{$pomboCad->morto == 1 ? '(morto)' :  ''}} </option>
                        @endif
                    @endforeach
                </select>
            </div>

            @include('components.select', ['label'=>'Cor', 'name'=>'cor', $values = array('Azul', 'Azul PB', 'Branca', 'Bronze', 'Camurça', 'Chocolate', 'Dourada', 'Dourado Escama', 'Escama', 'Escama PB', 'Fulvo', 'Macotado', 'Mosáico', 'Pigarço', 'Preta', 'Vermelha', 'Vermelha Macotado', 'Vermelho PB'), 'valueCad' => $pombo->cor])

            @include('components.select', ['label'=>'Pombal', 'name'=>'pombal', $values = array("Olhos D'água", 'Lagoa Santa', 'Pampulha'), 'valueCad' => $pombo->pombal]) 

            <div class="form-group">
                <label class='w-100'>
                    {{-- <span> Morto </span> --}}
                    <select name="morto" class="form-control">
                        <option value="0" @if($pombo->morto == '0') selected @endif >Vivo</option>                        
                        <option value="1" @if($pombo->morto == '1') selected @endif >Morto</option>                        
                    </select>
                </label>
            </div>

            <div class="form-group">
                <label class='w-100'>
                    <span> Observações : </span>
                    <textarea rows="5" columns="5" class="form-control" name="obs"> {{old('obs') ? old('obs') : $pombo->obs}} </textarea>
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