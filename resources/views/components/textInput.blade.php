
<div class="form-group">
    <label class='w-100'>
        <span> {{$label}}{{ (isset($required)) ? "* " : "" }} : </span>
        <input 
            type="{{ (isset($type)) ? $type : "text" }}"
            class="form-control {{ (!isset($mask) ? "" : $mask) }}"
            value='{{ (old($name)) ? old($name) : (isset($value) ? $value : '') }}'
            name="{{$name}}" {{ (isset($required)) ? " required " : "" }}
            placeholder="{{ (!isset($placeholder) ? "" : $placeholder) }}"
            onkeyup="{{ (!isset($onkeyup) ? "" : $onkeyup) }}"
            id="{{ (!isset($id) ? "" : $id) }}"
            {{ (!isset($oninput) ? "" : "oninput=".$oninput."(event);") }}
        />
    </label>
</div>
@include('components.inputErrors', ['name' => $name ])


