<div class="card-body pt-4">
<div class="grid-margin">
    <div class="">
        <div class="panel panel-primary">
            <div class="panel-body tabs-menu-body border-0 pt-0">
                @if(count($payments) > 0)
                <div class="tab-content">
                    <div class="tab-pane active">
                        <div class="table-responsive">
                            <div id="data-table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="data-table"
                                            class="table table-bordered text-nowrap mb-0 dataTable no-footer"
                                            role="grid" aria-describedby="data-table_info">
                                            <thead class="border-top">
                                                <tr role="row">
                                                    <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="
                                            Transaction ID: activate to sort column ascending"
                                                        style="width: 130.531px;">
                                                        Transaction ID
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="
                                            Payer: activate to sort column ascending" style="width: 103.695px;">
                                                        Payer
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="
                                            Payee: activate to sort column ascending" style="width: 103.695px;">
                                                        Payee
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting_disabled"
                                                        rowspan="1" colspan="1" aria-label="
                                            Amount" style="width: 80.1172px;">
                                                        Amount
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting sorting_desc"
                                                        tabindex="0" aria-controls="data-table" rowspan="1"
                                                        colspan="1" aria-label="
                                            Date: activate to sort column ascending" style="width: 74.6797px;"
                                                        aria-sort="descending">
                                                        Date
                                                    </th>
                                                     <th class="bg-transparent border-bottom-0 sorting"
                                                        style="width: 58.1172px;" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="Gateway: activate to sort column ascending">
                                                        Gateway
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting"
                                                        style="width: 58.1172px;" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="Status: activate to sort column ascending">
                                                        Status
                                                    </th>
                                                    <th class="bg-transparent border-bottom-0 sorting"
                                                        style="width: 51.6328px;" tabindex="0"
                                                        aria-controls="data-table" rowspan="1" colspan="1"
                                                        aria-label="Action: activate to sort column ascending">
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($payments as $payment)
                                                <tr class="border-bottom odd">
                                                    <td><span class="copy-text"
                                                            onclick="copyTransactionID('{{$payment->txn_id}}')">{{$payment->txn_id}}</span>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-0 mt-sm-2 fs-14 fw-semibold">
                                                            {{ $payment->payer->name}}
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="mt-0 mt-sm-2 fs-14 fw-semibold">
                                                            {{ $payment->payee->name}}
                                                        </h6>
                                                    </td>
                                                    <td><span class="fw-semibold mt-sm-2 d-block"> {{ money($payment->amount) }} </span>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <span class="mt-sm-2 d-block">
                                                            {{ $payment->created_at->format('d M, Y') }}
                                                        </span>
                                                    </td>
                                                    <td class="">
                                                        <div class="mt-sm-1 d-block">
                                                            <span
                                                                class="badge bg-{{$payment->gateway->color()}}-transparent rounded-pill text-{{$payment->gateway->color()}} p-2 px-3">
                                                                {{ $payment->gateway->label() }} </span>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="mt-sm-1 d-block">
                                                            <span
                                                                class="badge bg-{{$payment->status->color()}}-transparent rounded-pill text-{{$payment->status->color()}} p-2 px-3">
                                                                {{ $payment->status->label() }} </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ route('admin.payments.show', $payment->txn_id) }}"
                                                                class="btn text-dark btn-sm"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="View"><span
                                                                    class="fa-regular fa-eye fs-14"></span>
                                                            </a>
                                                            <a
                                                                class="btn text-primary btn-sm"
                                                                data-bs-target="#select2modal"
                                                                data-bs-toggle="modal"
                                                                href="javascript:;"
                                                                onclick="addToSelect2('{{$payment->txn_id}}', '{{$payment->status->label()}}')"
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
                                </div>
                                {{ $payments->links('pagination.admin') }}
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center p-4">
                    <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                    <h4 class="mt-3">No Payment Found</h4>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>