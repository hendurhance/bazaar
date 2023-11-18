<form class="row bid-filter">
    <div class="col-sm-12 col-md-3">
        <div id="data-table_filter" class="dataTables_filter">
            <label>Search for a username, ids, etc</label>
            <input type="search" name="search" class="form-control form-control" placeholder="Search username, ids..." aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Price Range</label>
                <select name="price_range" class="form-control form-select select2" data-bs-placeholder="Select Price Range">
                    @foreach ($priceRanges as $priceRange)
                    <option value="{{ $priceRange }}" @selected($priceRange->value == request()->price_range)>{{ $priceRange->label() }} </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('price_range') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Gateway</label>
                <select name="gateway" class="form-control form-select select2" data-bs-placeholder="Select Gateway">
                    <option value="">All</option>
                    @foreach ($gateways as $gateway)
                    <option value="{{ $gateway }}" @selected($gateway->value == request()->gateway)>{{ $gateway->label() }} </option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('gateway') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="row mb-4">
            <div class="col-sm-6 col-md-6">
                <label>Date from:</label>
                <input type="date" class="form-control" placeholder="Select date from" name="date_from" value="{{ request()->date_from }}" id="">
                <span class="text-danger">{{ $errors->first('date_from') }}</span>
            </div>
            <div class="col-sm-6 col-md-6">
                <label>Date to:</label>
                <input type="date" class="form-control" placeholder="Select date to" name="date_to" value="{{ request()->date_to }}" id="">
                <span class="text-danger">{{ $errors->first('date_to') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-1 align-self-end">
        <div class="row mb-4">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Filter">
            </div>
        </div>
    </div>
</form>