@if($admin)
<div class="form-group">
    <label class="form-label">Country</label>
    <div class="row">
        <div class="col-md-4 mb-2">
            <select class="form-control select2 form-select" name="country" id="country"
                <option>Select Country</option>
                @foreach ($countries as $country)
                <option value="{{ $country->iso2 }}">{{ $country->emoji }} {{ $country->name }}</option>
                @endforeach
            </select>
            <span class="text-danger fs-6">{{ $errors->first('country') }}</span>
        </div>
        <div class="col-md-4 mb-2">
            <select class="form-control select2 form-select" name="state" id="state">
                <option>Select State</option>
            </select>
            <span class="text-danger fs-6">{{ $errors->first('state') }}</span>
        </div>
        <div class="col-md-4 mb-2">
            <select class="form-control select2 form-select" name="city" id="city">
                <option>Select City</option>
            </select>
            <span class="text-danger fs-6">{{ $errors->first('city') }}</span>
        </div>
    </div>
</div>
@else
<div class="{{ $hasLabels ? 'col-xl-6 col-lg-12 col-md-6' : 'col-md-12' }}">
    <div class="form-inner">
        <label>Country *</label>
        <select name="country" id="country">
            <option value="">Select Country</option>
            @foreach ($countries as $country)
            <option value="{{ $country->iso2 }}"
                >{{ $country->name }}</option>
            @endforeach
        </select>
        <span class="text-danger fs-6">{{ $errors->first('country') }}</span>
    </div>
</div>
<div class="{{ $hasLabels ? 'col-xl-6 col-lg-12 col-md-6' : 'col-md-12' }}">
    <div class="form-inner">
        @if($hasLabels)
        <label>State *</label>
        @endif
        <select name="state" id="state">
            <option value="">Select State</option>
        </select>
        <span class="text-danger fs-6">{{ $errors->first('state') }}</span>
    </div>
</div>
<div class="{{ $hasLabels ? 'col-xl-6 col-lg-12 col-md-6' : 'col-md-12' }}">
    <div class="form-inner">
        @if($hasLabels)
        <label>City *</label>
        @endif
        <select name="city" id="city">
            <option value="">Select City</option>
        </select>
        <span class="text-danger fs-6">{{ $errors->first('city') }}</span>
    </div>
</div>

@endif

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@amplifiedhq/countries-atlas/dist/flags/css/flags.min.css">
@endpush

@push('scripts')
{{-- push flag to the country --}}
<script>
    function getStates(country){
        fetch(`/api/states/${country}`)
        .then(response => response.json())
        .then(data => {
            const states = data.data[0].states;
            let options = '';
            states.forEach(state => {
                options += `<option value="${state.code}">${state.name}</option>`;
            });
            document.getElementById('state').innerHTML = options;
            $('#state').niceSelect('update');
        })
    }
    function getCities(country, state){
        fetch(`/api/cities/${country}/${state}`)
        .then(response => response.json())
        .then(data => {
            const cities = data.data[0].cities;
            let options = '';
            cities.forEach(city => {
                options += `<option value="${city.id}">${city.name}</option>`;
            });
            document.getElementById('city').innerHTML = options;
            $('#city').niceSelect('update');
        })
    }
    $('#country').on('change', function(){
        const country = this.value;
        getStates(country);
    });
    $('#state').on('change', function(){
        const country = document.getElementById('country').value;
        const state = this.value;
        getCities(country, state);
    });
    // when document is ready
        $('#country').find('option').each(function(){
            const country = this.value;
            const flag = `<span class="flag flag-${country.toLowerCase()}"></span>`;
            $(this).html(flag + $(this).html());
        });
        $('#country').niceSelect('update');
</script>
@endpush