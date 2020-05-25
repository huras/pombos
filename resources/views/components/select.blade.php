<?php
    // dd(count($values));
?>
<div class="form-group">
    <label class='w-100'>
        <span> {{$label}}{{ (isset($required)) ? "* " : "" }} : </spán>
        <select 
            type="{{ (isset($type)) ? $type : "select" }}"
            class="form-control {{ (!isset($mask) ? "" : $mask) }}"
            value='{{ (old($name)) ? old($name) : (isset($value) ? $value : '') }}'
            name="{{$name}}" {{ (isset($required)) ? " required " : "" }}
            placeholder="{{ (!isset($placeholder) ? "" : $placeholder) }}"
            onkeyup="{{ (!isset($onkeyup) ? "" : $onkeyup) }}"
            id="{{ (!isset($id) ? "" : $id) }}"
        />
        
        @foreach ($values as $value)
            <option value='{{$value}}'> {{$value}} </option>;
        @endforeach

    </label>
</div>
@include('components.inputErrors', ['name' => $name])


