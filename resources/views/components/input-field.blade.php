<div class="form-inner">
    <label>{{ $label }} {{$required ? '*' : ''}}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" @class(['error'=>
    $errors->has($name)])>
    @if ($type == 'password')
    <i class="bi bi-eye-slash" id="togglePassword"></i>
    @endif
    <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
</div>