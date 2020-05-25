<div class="form-group">
    <label class='w-100'>
        <span> {{$label}}{{ (isset($required)) ? "* " : "" }} : </span>
        <select
        {{-- type="{{ (isset($type)) ? $type : "select" }}" --}}
        class="form-control pombo-select2 {{ (!isset($mask) ? "" : $mask) }}"
        value='{{ (old($name)) ? old($name) : (isset($value) ? $value : '') }}'
        name="{{$name}}" {{ (isset($required)) ? " required " : "" }}
        placeholder="{{ (!isset($placeholder) ? "" : $placeholder) }}"
        onkeyup="{{ (!isset($onkeyup) ? "" : $onkeyup) }}"
        id="{{ (!isset($id) ? "" : $id) }}"
        >
            <option value="-1" disabled selected> Pesquisar ... </option>
            @foreach ($values as $value)
                <option value='{{$value}}'> {{$value}} </option>;
            @endforeach
        </select>
    </label>
</div>
@include('components.inputErrors', ['name' => $name])

