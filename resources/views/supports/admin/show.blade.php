@extends('partials.admin')
@section('title', 'Admin Support Details')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'support.index'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'Support Details', 'hasBack' => true, 'backTitle' => 'All Support', 'backUrl' => route('admin.support.index')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">Support Details</h3>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body" id="email-body">
                                        <div class="email-media">
                                            <div class="mt-0 d-sm-flex">
                                                <img class="me-2 rounded-circle avatar avatar-lg" src="{{ get_random_avatar() }}" alt="avatar">
                                                <div class="media-body pt-0">
                                                    <div class="float-md-end d-flex fs-15">
                                                        <small class="me-3 mt-3 text-muted">{{ $support->created_at->diffForHumans() }}</small>
                                                        <div class="me-3">
                                                            <a href="javascript:void(0)" class="text-danger email-icon bg-danger-transparent" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-ellipsis"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <form action="{{route('admin.support.destroy', $support->id)}}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="dropdown-item" type="submit"><i class="fa-regular fa-trash me-2"></i>Delete</button>
                                                                </form>
                                                                <a class="dropdown-item" onclick="printSupport()" href="javascript:void(0)"><i class="fa-regular fa-print me-2"></i>Print</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="media-title text-dark font-weight-semibold mt-1">{{ $support->name }} <span class="text-muted font-weight-semibold">( {{ $support->email }} )</span></div>
                                                    <small class="mb-0">to {{config('app.name')}} Support Team ({{$support->admin->email ?? 'No Admin'}})</small>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="eamil-body mt-5">
                                            {!! $support->message ?? 'No message' !!}</>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if($support->response)
                                        <div class="fw-bold mt-1">Response from {{config('app.name')}} Support Team</div>
                                        <div class="eamil-body mt-5">
                                            {!! $support->response !!}
                                        </div>
                                        @else
                                        <form action="{{route('admin.support.update', $support->id)}}" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <x-text-area-field name="response" label="Reply" placeholder="Enter Reply" :admin="true" />
                                            <div class="row">
                                                <label class="col-md-3 form-label mb-4">Status * :</label>
                                                <div class="col-md-9">
                                                    <select class="form-control select2" name="status" id="status" data-bs-placeholder="Select Status">
                                                        @foreach (\App\Enums\SupportStatusEnum::all() as $status)
                                                        <option value="{{$status}}" {{ $support->status == $status ? 'selected' : '' }}>{{ucfirst($status->label())}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger">{{ $errors->first('status') }}</span>
                                                </div>
                                            </div>
                                            <div class="d-sm-flex pt-4">
                                                <div class="btn-list ms-auto my-auto">
                                                    <a href="{{route('admin.support.index')}}" class="btn btn-danger btn-space mb-0">Cancel</a>
                                                    <button type="submit" class="btn btn-primary btn-space mb-0">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                        @endif
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
<script>
    function printSupport() {
        var printWin = window.open('');
        printWin.document.write(document.getElementById("email-body").innerHTML);
        printWin.stop();
        printWin.print();
        printWin.close();
    }
</script>

<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
@endpush