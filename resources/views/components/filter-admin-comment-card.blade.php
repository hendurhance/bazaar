<form class="row bid-filter">
    <div class="col-sm-12 col-md-8">
        <div id="data-table_filter" class="dataTables_filter">
            <label>Search for a post title, author, id:</label>
            <input type="search" name="search" class="form-control form-control" placeholder="Search for a post title, author, id..." aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-3">
        <div class="row mb-4">
            <div class="col-md-12">
                <label>Status</label>
                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                    <option value="">All</option>
                    @foreach ($statuses as $status)
                    <option value="{{ $status }}" {{ request()->status == $status->value ? 'selected' : '' }}>{{ $status->label() }}</option>
                    @endforeach
                </select>
                <span class="text-danger">{{ $errors->first('status') }}</span>
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