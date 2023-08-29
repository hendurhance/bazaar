<div class="col-md-12">
    <div class="form-inner">
        <label for="{{ $name }}">{{ $label }}</label>
        <input class="expandable-input" type="tel" name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" @class(['error'=>
        $errors->has($name)])>
        <div class="phone-select-selected" id="phoneSelect">
            <span class="flag flag-ng">
                <i class="bi bi-caret-down-fill"></i>
            </span>
        </div>
        <div class="phone-select">
            <ul class="phone-select-list">
                @foreach ($countries as $country)
                <li class="phone-select-list-item" data-dial-code="{{ $country->phone_code }}" data-country-code="{{ $country->iso2 }}">
                    <span class="phone-select-list-item-label">{{ $country->emoji }}  {{ $country->name }}</span>
                    <span class="phone-select-list-item-dial-code">( +{{ $country->phone_code }} )</span>
                </li>
                @endforeach
            </ul>
        </div>
        <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        // set the first country as the default
        const firstCountry = $('.phone-select-list-item').first();
        console.log(firstCountry);  
        $('#phoneSelect').html(`<span class="flag flag-${firstCountry.data('country-code').toLowerCase()}">
                <i class="bi bi-caret-down-fill"></i>
            </span>`);
        $('#{{ $name }}').val(`+${firstCountry.data('dial-code')}`);
        // show the phone select on click
        $('#phoneSelect').on('click', function(){
            $('.phone-select').toggleClass('open');
        });

        // set the selected country
        $('.phone-select-list-item').on('click', function(){
            const dialCode = $(this).data('dial-code');
            const countryCode = $(this).data('country-code');
            $('#phoneSelect').html(`<span class="flag flag-${countryCode.toLowerCase()}">
                <i class="bi bi-caret-down-fill"></i>
            </span>`);
            $('#{{ $name }}').val(`+${dialCode}`);
            $('.phone-select').removeClass('open');
            $('.phone-select-list-item').removeClass('selected');
            $(this).addClass('selected');
        });
    });
</script>

@endpush