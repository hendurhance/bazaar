@extends('partials.admin')
@section('title', 'Admin Users List')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'users'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'User', 'hasBack' => true, 'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])

             <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-between">
                            <h3 class="card-title mb-0">All User List</h3>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Add New User</a>
                        </div>
                        <div class="">
                           <x-filter-admin-user-card />
                        </div>
                        <div class="card-body pt-4">
                            <div class="grid-margin">
                                <div class="">
                                    <div class="panel panel-primary">
                                        <div class="panel-body tabs-menu-body border-0 pt-0">
                                            @if(count($users) > 0)
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab5">
                                                    <div class="table-responsive">
                                                        <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                                            <div class="row">
                                                                <table id="data-table" class="table table-bordered text-nowrap mb-0">
                                                                    <thead class="border-top">
                                                                        <tr>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 5%;">Full Name</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Email</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Phone</th>
                                                                            <th
                                                                                class="bg-transparent border-bottom-0">
                                                                                Country</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 10%;">Status</th>
                                                                            <th class="bg-transparent border-bottom-0"
                                                                                style="width: 5%;">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($users as $user)
                                                                        <tr class="border-bottom">
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <span class="avatar bradius"
                                                                                        style="background-image: url({{$user->avatar}})"></span>
                                                                                    <div
                                                                                        class="ms-3 mt-0 mt-sm-2 d-block">
                                                                                        <h6
                                                                                            class="mb-0 fs-14 fw-semibold">
                                                                                            {{$user->name}}</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <td><span class="mt-sm-2 d-block"> {{ $user->email }}</span></td>
                                                                            <td><span class="mt-sm-2 d-block"> {{ $user->mobile }}</span></td>
                                                                            <td><span class="mt-sm-2 d-block"> {{ $user->country->emoji }} {{ $user->country->name }}</span></td>
                                                                            <td>
                                                                                <div class="d-flex">
                                                                                    <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }} me-2">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="mt-sm-1 d-block">
                                                                                    <a href="{{ route('admin.users.show', $user->id) }}" class="btn text-dark btn-sm"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="View"><span
                                                                                        class="fa-regular fa-eye fs-14"></span>
                                                                                    </a>
                                                                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn text-primary btn-sm"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-original-title="Edit"><span
                                                                                        class="fa-regular fa-edit fs-14"></span>
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            {{ $users->links('pagination.admin') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="text-center p-4">
                                                <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                                                <h4 class="mt-3">No Users Found</h4>
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


@endsection
@push('scripts')
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
    
@endpush