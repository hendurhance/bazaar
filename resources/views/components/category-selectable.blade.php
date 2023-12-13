@if($admin)
<div class="row mb-4">
    <label class="col-md-3 form-label">Categories :</label>
    <div class="col-md-9">
        <select name="category" id="category" class="form-control form-select select2" data-bs-placeholder="Select Category">
            <option value="">Select Category</option>
            @foreach ($categories as $category)
            <option value="{{ $category->slug }}" {{ $selectedCategory == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-4">
    <label class="col-md-3 form-label">Subcategories :</label>
    <div class="col-md-9">
        <select name="subcategory" id="subcategory" class="form-control form-select select2" data-bs-placeholder="Select Subcategory">
            <option value="">Select Subcategory</option>
            
        </select>
    </div>
</div>
@push('scripts')
<!-- INTERNAL SELECT2 JS -->
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
<script>
    function getSubCategory(slug){
        fetch(`/api/subcategories/${slug}`)
        .then(response => response.json())
        .then(data => {
            const subcategories = data.data[0].sub_categories;
            let options = '';
            subcategories.forEach(subcategory => {
                options += `<option value="${subcategory.slug}">${subcategory.name}</option>`;
            });
            document.getElementById('subcategory').innerHTML = options;
            $('#subcategory').select2('destroy');
            $('#subcategory').select2();
        })
    }
    $('#category').on('change', function(){
        const category = this.value;
        getSubCategory(category);
    });
</script>
@endpush
@else
<div class="col-md-6">
    <select name="category" id="category" @class(['error' => $errors->has('category')])>
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <span class="text-danger fs-6">{{ $errors->first('category') }}</span>
</div>
<div class="col-md-6">
    <select name="subcategory" id="subcategory" @class(['error' => $errors->has('subcategory')])>
        <option value="">Select Subcategory</option>
    </select>
    <span class="text-danger fs-6">{{ $errors->first('subcategory') }}</span>
</div>

@push('scripts')
<script>
    function getSubCategory(slug){
        fetch(`/api/subcategories/${slug}`)
        .then(response => response.json())
        .then(data => {
            const subcategories = data.data[0].sub_categories;
            let options = '';
            subcategories.forEach(subcategory => {
                options += `<option value="${subcategory.slug}">${subcategory.name}</option>`;
            });
            document.getElementById('subcategory').innerHTML = options;
            $('#subcategory').niceSelect('update');
        })
    }
    $('#category').on('change', function(){
        const category = this.value;
        getSubCategory(category);
    });

</script>
@endpush
@endif