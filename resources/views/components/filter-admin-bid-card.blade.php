<form class="row bid-filter">
    <div class="col-sm-12 col-md-3">
        <div id="data-table_filter" class="dataTables_filter">
            <label>Search for a bid</label>
            <input type="search" name="bid_id" class="form-control form-control" placeholder="Search bid id..." aria-controls="data-table" value="{{ request()->bid_id }}">
            <span class="text-danger">{{ $errors->first('bid_id') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Price range</label>
                <select name="price_range" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                    @foreach ($priceRanges as $range)
                    <option value="{{ $range }}" @selected($range->value == request()->price_range)>{{ $range->label() }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('price_range') }}</span>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-2">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Accepted</label>
                <select name="accepted" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                    <option value="">All</option>
                    <option value="pending" @if (request()->accepted == 'pending') selected @endif>Pending</option>
                    <option value="accepted" @if (request()->accepted == 'accepted') selected @endif>Accepted</option>
                    <option value="rejected" @if (request()->accepted == 'rejected') selected @endif>Rejected</option>
                </select>
                <span class="text-danger">{{ $errors->first('accepted') }}</span>
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