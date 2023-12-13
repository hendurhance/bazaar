@extends('partials.admin')
@section('title', 'Admin Media Details')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'media.index'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Media Details', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.media.index')])
            <div class="row row-sm">
                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="card custom-card overflow-hidden">
                        <div class="card-body p-3">
                            <a href="javascript:void(0)"><img src="{{$media->url}}" alt="img" class="br-5 w-100"></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body">
                            <h5 class="mb-3">File details</h5>
                            <div class="">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <th>File Name</th>
                                                        <td>{{$media->name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Uploaded</th>
                                                        <td>{{$media->created_at->diffForHumans()}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Size</th>
                                                        <td>
                                                            @if($media->size > 0)
                                                            {{ bytes_to_human($media->size) }}
                                                            @else
                                                            0 KB
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Storage</th>
                                                        <td>{{$media->storage->label()}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Extension</th>
                                                        <td>{{$media->extension}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>File Type</th>
                                                        <td>{{$media->mime_type}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mt-5 text-center d-flex justify-center">
                                            <a href="{{ $media->url }}" class="btn btn-icon  btn-info-light me-2 bradius"><i class="fa-regular fa-eye"></i></a>
                                            <a href="{{ $media->url }}" download="" class="btn btn-icon  btn-success-light me-2 bradius"><i class="fa-regular fa-download fs-14"></i></a>
                                            <form action="{{route('admin.media.destroy', $media->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="deleteMedia('{{$media->id}}')" class="btn btn-icon  btn-danger-light me-2 bradius"><i class="fa-regular fa-trash"></i></button>
                                            </form>
                                            <a href="" class="btn btn-icon  btn-warning-light bradius"><i class="fa-regular fa-share fs-14"></i></a>
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

@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>

@endpush