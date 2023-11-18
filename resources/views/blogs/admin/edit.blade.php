@extends('partials.admin')
@section('title', 'Admin Edit Blog - ' . $post->title)
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'blogs'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Edit Blog', 'hasBack' => true, 'backTitle' => 'All Blogs', 'backUrl' => route('admin.blogs.index')])

             <div class="row">
                <div class="col-lg-12">
                    <form class="card" method="POST" action="{{ route('admin.blogs.update', $post->slug) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf
                        <div class="card-header">
                            <div class="card-title">Edit Blog</div>
                    </div>
                        <div class="card-body">
                            <x-input-item-field name="title" type="text" label="Blog Title *" placeholder="Enter Blog Title" value="{{ $post->title }}" />
                            <!-- Row -->
                            <x-text-area-field name="content" label="Blog Content" placeholder="Enter Blog Content" value="{{ $post->content }}" :admin="true" />
                            <br>
                            <x-tag-selectable :selected-tags="$post->tags" />
                            <div class="row">
                                <label class="col-md-3 form-label mb-4">Published *:</label>
                                <div class="col-md-9">
                                    <select name="published" id="published" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                        <option value="published" {{ $post->is_published ? 'selected' : '' }}>Published</option>
                                        <option value="draft" {{ !$post->is_published ? 'selected' : '' }}>Draft</option>
                                    </select>
                                    <span class="text-danger">{{ $errors->first('published') }}</span>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                        <div class="card-footer">
                            <!--Row-->
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-primary">Update Blog</button>
                                    <a href="{{ route('admin.blogs.show', $post->slug) }}" class="btn btn-default float-end">Discard</a>
                                </div>
                            </div>
                            <!--End Row-->
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- CONTAINER END -->
    </div>
</div>


@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
    
<script src="/plugin/fancyuploader/jquery.ui.widget.js"></script>
<script src="/plugin/fancyuploader/jquery.fileupload.js"></script>
<script src="/plugin/fancyuploader/jquery.iframe-transport.js"></script>
<script src="/plugin/fancyuploader/jquery.fancy-fileupload.js"></script>
<script src="/plugin/fancyuploader/fancy-uploader.js"></script>
@endpush
@push('styles')
<style>
    .ck .ck-powered-by {
        display: none !important;
    }
</style>

@endpush