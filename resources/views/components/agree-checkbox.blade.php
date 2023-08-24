<div class="{{ $class }}">
    <div class="form-group">
        <input type="checkbox" id="{{ $id }}" name="{{ $name }}">
        <label for="{{ $id }}">{{ $label }}</label>
        <span class="text-danger d-block fs-6">{{ $errors->first($name) }}</span>
    </div>
</div>