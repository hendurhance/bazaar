<div class="row mb-60 d-flex justify-content-lg-between">
    <div class="col-lg-4 col-md-6 col-sm-10">
        <h2>Filter Listing</h2>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12">
        <form action="">
            <div class="row d-flex">
                <div class="col-md-3">
                    <select class="form-inner" name="category">
                        <option selected>Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-inner" name="country">
                        <option selected>Location</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->iso2 }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-inner" name="price_range">
                        <option selected>Price Range</option>
                        @foreach ($priceRanges as $priceRange)
                            <option value="{{ $priceRange->value }}">{{ $priceRange->label() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="filter-btn btn--primary btn--md">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>