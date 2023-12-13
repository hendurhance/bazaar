<form class="row bid-filter">
    <div class="col-sm-12 col-md-3">
        <div id="data-table_filter" class="dataTables_filter">
            <label>Search for a user</label>
            <input type="search" name="search" class="form-control form-control" placeholder="Search user..." aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Status</label>
                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                    <option value="">All</option>
                    <option value="active" @if (request()->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if (request()->status == 'inactive') selected @endif>Inactive</option>
                </select>
                <span class="text-danger">{{ $errors->first('status') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Country</label>
                <select name="country_id" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                    <option value="">All</option>
                    @foreach ($countries as $country)
                    <option value="{{ $country->id }}" @selected($country->id == request()->country_id)>{{ $country->emoji }} {{ $country->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('country_id') }}</span>
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