<div class="col-md-6">
    <select name="category" id="category">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->slug }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <span class="text-danger fs-6">{{ $errors->first('category') }}</span>
</div>
<div class="col-md-6">
    <select name="subcategory" id="subcategory">
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
            const subcategories = data.categories[0].sub_categories;
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