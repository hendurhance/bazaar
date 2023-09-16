<div class="col-xl-6 col-lg-12 col-md-6'">
    <div class="form-inner">
        <label>{{ $label }} *</label>
        <select name="{{$name}}" id="{{$name}}">
            <option>Select {{ $label }}</option>
            @foreach ($gender as $gender)
            <option value="{{ $gender->value }}" @selected($selected == $gender)
                >{{ $gender->label() }}</option>
            @endforeach
        </select>
        <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
    </div>
</div>