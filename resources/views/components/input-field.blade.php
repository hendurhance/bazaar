<div class="form-inner">
    <label>{{ $label }} {{$required?'*':''}}</label>
    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        @class(['error'=> $errors->has($name), 'disabled' => $disabled])
        value="{{ $value }}"
        @if ($type == 'datetime-local') step="3600" @endif
        @if ($readonly) readonly @endif
        @if($disabled) disabled @endif
    >
    @if ($type == 'password')
    <i class="bi bi-eye-slash" id="togglePassword"></i>
    @endif
    <span class="text-danger fs-6">{{ $errors->first(preg_replace('/\[\]/', '', $name)) }}</span>
</div>

@if ($type == 'datetime-local')
@push('scripts')
<script>
    function enforceAnHourInterval(identifier) {
        var time = document.getElementById(identifier).value;
        var hours = new Date(time).getHours();
        var minutes = new Date(time).getMinutes();
        var seconds = new Date(time).getSeconds();
        var newTime = new Date(time).setHours(hours + 1, 0, 0);
        document.getElementById(identifier).value = new Date(newTime).toISOString().slice(0, 16);
    }
    document.getElementById('start_date').addEventListener('change', function () {
        enforceAnHourInterval('start_date');
    });
    document.getElementById('end_date').addEventListener('change', function () {
        enforceAnHourInterval('end_date');
    });
</script>
@endpush
@endif



