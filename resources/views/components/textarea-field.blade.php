<div class="form-inner">
    <label>{{ $label }} {{$required ? '*' : ''}}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" @class(['error'=> $errors->has($name)])></textarea>
    <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
</div>
{{-- include ckeditor --}}
@section('scripts')
<script src="assets/js/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#{{ $name }}' ), {
            toolbar: {
                items: [
                    'heading', '|', 'bold', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo'
                ]
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' }
                ]
            }
        } )
        .then( editor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection