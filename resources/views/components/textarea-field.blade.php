<div class="form-inner">
    <label>{{ $label }} {{$required ? '*' : ''}}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" @class(['error'=> $errors->has($name)])></textarea>
    <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
</div>