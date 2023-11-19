<div class="row mb-60 d-flex justify-content-lg-between">
    <div class="col-lg-4 col-md-6 col-sm-10">
        <h2>Filter Blog</h2>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12">
        <form class="form-wrapper">
            <div class="row d-flex">
                <div class="col-md-7">
                    <div class="form-inner">
                        <input type="text" placeholder="Search for a title, author..." name="search" value="{{ request()->search }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select class="form-inner" name="tag" @class(['error'=> $errors->has('tag')])>
                        <option selected value="">All tags</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @selected($tag->id == request()->tag)>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('tag') }}</span>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="filter-btn btn--primary btn--md">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('styles')
    <style>
        .form-wrapper {
        box-shadow:none;
        padding: 0;
       background: none;
    }
    </style>
@endpush