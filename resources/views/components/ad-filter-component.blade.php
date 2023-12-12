<div class="row mb-60 d-flex justify-content-lg-between">
    <div class="col-lg-4 col-md-6 col-sm-10">
        <h2>Filter Listing</h2>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12">
        <form>
            <div class="row d-flex">
                <div class="col-md-3">
                    <select class="form-inner" name="category" @class(['error'=> $errors->has('category')])>
                        <option selected value="">Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected($category->slug == request()->category)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-inner" name="country" @class(['error'=> $errors->has('country')])>
                        <option selected value="">Location</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->iso2 }}" @selected($country->iso2 == request()->country)>{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select class="form-inner" name="price_range" @class(['error'=> $errors->has('price_range')])>
                        @foreach ($priceRanges as $range)
                        <option value="{{ $range }}" @selected($range->value == request()->price_range)>{{ $range->label() }}</option>
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