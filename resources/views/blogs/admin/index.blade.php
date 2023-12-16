@extends('partials.admin')
@section('title', 'Admin Blogs')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'blogs.index'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Blogs', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Blogs</h3>
                        </div>
                        <div class="">
                           <x-filter-admin-post-card />
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            @if(count($posts) > 0)
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    <div class="table-responsive">
                                                        <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                            <div class="row">
                                                                <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Title</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Author</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Tags</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                               Published</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 5%;">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($posts as $post)
                                                                        <tr class="border-bottom">
                                                                            <td>
                                                                                <h6 class="mb-0 fs-14 fw-semibold">{{$post->title}}</h6>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <h6 class="mb-0 fs-14 fw-semibold">{{$post->admin->name}}</h6>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    @forelse ($post->tags as $tag)
                                                                                        <span class="text-white badge bg-primary">{{ $tag->name }}</span>
                                                                                    @empty
                                                                                        <span class="text-white badge bg-warning">No Tags</span>
                                                                                    @endforelse
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    <span class="text-white badge bg-{{$post->is_published ? 'success' : 'danger'}}">{{$post->is_published ? 'Published' : 'Not Published'}}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-flex">
                                                                                    <div class="btn-group">
                                                                                        <a href="{{ route('admin.blogs.show', $post->slug) }}" class="btn text-dark btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="View"><span
                                                                                            class="fa-regular fa-eye fs-14"></span>
                                                                                        </a>
                                                                                        <a href="{{ route('admin.blogs.edit', $post->slug) }}" class="btn text-dark btn-sm"
                                                                                            data-bs-toggle="tooltip"
                                                                                            data-bs-original-title="View"><span
                                                                                                class="fa-regular fa-edit fs-14"></span>
                                                                                        </a>
                                                                                        <a class="btn text-danger btn-sm"
                                                                                            data-bs-target="#select2modal"
                                                                                            data-bs-toggle="modal"
                                                                                            href="javascript:;"
                                                                                            data-bs-original-title="Delete"
                                                                                            onclick="deletePost(`{{ $post->slug }}`, `{{ $post->title }}`)"
                                                                                            ><span
                                                                                                class="fa-regular fa-trash-alt fs-14"></span>
                                                                                        </a>
                                                                                    </div>

                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            {{ $posts->links('pagination.admin') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="text-center p-4">
                                                <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                                <h4 class="mt-3">No Posts Found</h4>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
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

 <!-- Select2 modal -->
 <div class="modal fade" id="select2modal">
    <div class="modal-dialog" role="document">
        <form class="modal-content modal-content-demo" id="delete-form" method="POST">
            @method('DELETE')
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Delete Post - <span id="delete-title"></span></h6>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>A post with the title <span id="delete-title"></span> will be deleted. This action cannot be undone.</h6>
                <p class="mt-3">By clicking on "Delete Post" below, this post will be deleted.</p>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-success" type="submit">Delete Post</button>
                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </form>
    </div>
</div>
<!-- End Select2 modal -->

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