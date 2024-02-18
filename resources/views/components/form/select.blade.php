@props([
    'name',
    'options',
    'label'=>false,
    'selected' => null
])
@if($label)
    <label for="">{{$label}}</label>
@endif
<div>
    <select class="form-select @error($name) is-invalid @enderror" name="{{$name}}">
        @foreach($options as $value => $text)
            <option value="{{$value}}"  @selected($value == $selected)>
                {{$text}}
            </option>
        @endforeach
    </select>

    @error($name)
        <div class="invalid-feedback">
            {{$message}}
        </div>
    @enderror
</div>
