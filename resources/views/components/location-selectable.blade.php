<div class="form-group">
    <label class="form-label">Country</label>
    <div class="row">
        <div class="col-md-12 mb-2">
            <select class="form-control select2 form-select" name="country_id" id="country_id">
                    <option>All Countries</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ $country->id === $selectedCountry->id ? 'selected' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </select>
            <span class="text-danger">{{ $errors->first('country_id') }}</span>
        </div>
    </div>
</div>