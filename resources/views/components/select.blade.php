<div class="form-group">
    <label class='w-100'>
        <span> {{$label}}{{ (isset($required)) ? "* " : "" }} : </span>
        <select
        {{-- type="{{ (isset($type)) ? $type : "select" }}" --}}
        class="form-control pombo-select2 {{ (!isset($mask) ? "" : $mask) }}"
        {{-- value='{{ (old($name)) ? old($name) : (isset($value) ? $value : '') }}' --}}
        name="{{$name}}" {{ (isset($required)) ? " required " : "" }}
        placeholder="{{ (!isset($placeholder) ? "" : $placeholder) }}"
        onkeyup="{{ (!isset($onkeyup) ? "" : $onkeyup) }}"
        id="{{ (!isset($id) ? "" : $id) }}"
        >
            <option value="{{ (old($name)) ? old($name) : (isset($value) ? $value : 'Pesquisar ...') }}" disabled selected> {{ (old($name)) ? old($name) : (isset($value) ? $value : 'Pesquisar ...') }} </option>
            
            @foreach ($values as $value)
                <option value='{{$value}}' {{ (isset($valueCad) ? ($value == $valueCad ? 'selected' : $value ) : $value ) }}> {{$value}} </option>;
            @endforeach
        </select>
    </label>
</div>
@include('components.inputErrors', ['name' => $name])


