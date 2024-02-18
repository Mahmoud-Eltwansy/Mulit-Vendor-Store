@props([
    'name',
    'options',
    'label'=>false,
    'checked'=>false
])
@if($label)
    <label for="">{{$label}}</label>
@endif

@foreach($options as $value => $text)
    <div class="form-check">
        <input class="form-check-input"
               value="{{$value}}"
               type="radio"
               name="{{$name}}" @checked(old($name,$checked)==$value)
            {{$attributes->class([
                'form-check-input',
                'is-invalid'=>$errors->has($name)
             ])
         }}
        >
        <label class="form-check-label">
            {{$text}}
        </label>
    </div>
@endforeach

@error("{{$name}}")
<div class="text-danger">
    {{$message}}
</div>
@enderror

