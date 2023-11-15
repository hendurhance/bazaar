@extends('partials.admin')
@section('title', 'Admin Payment')
@section('content')

@include('layouts.header', ['admin' => true])
@include('layouts.sidebar', ['admin' => true, 'active' => 'payments.all'])

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">
            @include('layouts.breadcrumb', ['admin' => true, 'pageTitle' => 'All Payments', 'hasBack' => true,
            'backTitle' => 'Dashboard', 'backUrl' => route('admin.dashboard')])
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title mb-0">All Payments</h3>
                        </div>
                        <div class="">
                            <x-filter-admin-payment-card />
                        </div>
                        <x-admin-payment-table :payments="$payments" />
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
        <form class="modal-content modal-content-demo" id="form-id" method="POST">
            @method('PATCH')
            @csrf
            <div class="modal-header">
                <h6 class="modal-title">Update Payment Status - <span id="transaction-id"></span></h6>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <h6>You are about to update the payment status of this payment with transaction ID <span
                        id="transaction-id"></span> and current status of <span id="current-status"
                        class="fw-bold"></span>.
                    Please select the new status below.</h6>
                <!-- Select2 -->
                <select name="status" class="form-control select2 select2-dropdown">
                    <option label="Choose one">Choose status</option>
                    @foreach (\App\Enums\PaymentStatus::all() as $status)
                    <option value="{{ $status }}">{{ $status->label() }}</option>
                    @endforeach
                </select>
                <!-- Select2 -->
                <p class="mt-3">By clicking on "Save changes" below, this payment status will be updated.</p>
            </div>
            <div class="modal-footer">
                <button class="btn ripple btn-success" type="submit">Save changes</button>
                <button class="btn ripple btn-danger" data-bs-dismiss="modal" type="button">Close</button>
            </div>
        </form>
    </div>
</div>
<!-- End Select2 modal -->


@endsection

@push('scripts')
<script>
    function copyTransactionID(id) {
        const copyText = id;
        navigator.clipboard.writeText(copyText);
    }

    function addToSelect2(id, status) {
       document.getElementById('transaction-id').innerHTML = id;
       document.getElementById('current-status').innerHTML = status;
       const url = "{{ route('admin.payments.update.status', ':id') }}".replace(':id', id);
         document.getElementById('form-id').setAttribute('action', url);
    }

</script>
<script src="/plugin/select2/select2.full.min.js"></script>
<script src="/assets/js/select2.js"></script>
@endpush