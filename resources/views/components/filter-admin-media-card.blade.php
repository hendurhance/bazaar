<form class="row bid-filter">
    <div class="col-sm-12 col-md-11">
        <div id="data-table_filter" class="dataTables_filter">
            <input type="search" name="search" class="form-control form-control" placeholder="Search for a media name, user's name, or username..." aria-controls="data-table" value="{{ request()->search }}">
            <span class="text-danger">{{ $errors->first('search') }}</span>
        </div>
     </div>
    <div class="col-sm-12 col-md-1 align-self-end">
        <div class="row mb-4">
            <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Search">
            </div>
        </div>
    </div>
</form>