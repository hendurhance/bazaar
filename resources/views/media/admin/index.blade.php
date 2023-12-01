@extends('partials.admin')
@section('title', 'Admin Media')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'media.index'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Media', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Media</h3>
                        </div>
                        <div class="">
                           <x-filter-admin-media-card />
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    @if($media->count() > 0)
                                    <div class="panel panel-primary">
                                        <div class="row row-sm">
                                            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                <div class="col-lg-12 col-xl-12">
                                                    <div class="row row-sm">
                                                        @foreach ($media as $med)
                                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-xxl-2">
                                                            <div class="card overflow-hidden">
                                                                <a href="{{ route('admin.media.show', $med->id) }}"><img src="{{ $med->url }}" alt="img" class="file-manager-list w-100"></a>
                                                                <div class="card-footer">
                                                                    <div class="d-block">
                                                                        <a href="{{ route('admin.media.show', $med->id) }}">
                                                                            <h5 class="mb-0 fw-semibold text-break">{{ $med->name }}</h5>
                                                                        </a>
                                                                        <div class="ms-auto my-auto">
                                                                            <span class="text-dark mb-0">
                                                                                @if($med->size > 0)
                                                                                {{ bytes_to_human($med->size) }}
                                                                                @else
                                                                                0 KB
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                {{ $media->links('pagination.admin') }}
                                            </div>
                                            <!-- End Row -->
                                        </div>
                                    </div>
                                    @else
                                    <div class="text-center">
                                        <img src="/assets/images/icons/man.svg" alt="img" class="w-25">
                                        <h4 class="my-3">No Media Found</h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
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

<script>
    function deletePost(slug, title) {
        document.getElementById('delete-title').innerHTML = title;
        const url = "{{ route('admin.blogs.destroy', ':slug') }}".replace(':slug', slug);
        document.getElementById('delete-form').setAttribute('action', url);
        document.getElementById('delete-form').setAttribute('action', url);
    }
</script>

@endpush