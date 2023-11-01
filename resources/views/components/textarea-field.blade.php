@if($admin)
<div class="row">
    <label class="col-md-3 form-label mb-4"> {{ $label }} {{$required ? '*' : ''}} :</label>
    <div class="col-md-9 mb-4">
        <textarea name="{{$name}}" id="{{$name}}" placeholder="{{ $placeholder }}" @class(['error'=> $errors->has($name)])>{!! $value !!}</textarea>
        <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
    </div>
</div>
@else
<div class="form-inner">
    <label>{{ $label }} {{$required ? '*' : ''}}</label>
    <textarea name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder }}" @class(['error'=> $errors->has($name)])>{!! $value !!}</textarea>
    <span class="text-danger fs-6">{{ $errors->first($name) }}</span>
</div>
@endif

{{-- include ckeditor --}}
@push('scripts')
<script src="/assets/js/ckeditor.js"></script>
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
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' },
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
@endpush