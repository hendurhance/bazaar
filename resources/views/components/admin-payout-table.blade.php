<div class="card-body pt-4">
    <div class="grid-margin">
        <div class="">
            <div class="panel panel-primary">
                <div class="panel-body tabs-menu-body border-0 pt-0">
                    @if(count($payouts) > 0)
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
                                                Payout Token: activate to sort column ascending"
                                                            style="width: 130.531px;">
                                                            Payout Token
                                                        </th>
                                                        <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                            aria-controls="data-table" rowspan="1" colspan="1"
                                                            aria-label="
                                                User: activate to sort column ascending" style="width: 103.695px;">
                                                            User
                                                        </th>
                                                        <th class="bg-transparent border-bottom-0 sorting" tabindex="0"
                                                            aria-controls="data-table" rowspan="1" colspan="1"
                                                            aria-label="
                                                Amount / Fee: activate to sort column ascending" style="width: 103.695px;">
                                                            Amount / Fee
                                                        </th>
                                                        <th class="bg-transparent border-bottom-0 sorting_disabled"
                                                            rowspan="1" colspan="1" aria-label="
                                                Method" style="width: 80.1172px;">
                                                            Method
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
                                                    @foreach ($payouts as $payout)
                                                    <tr class="border-bottom odd">
                                                        <td><span class="copy-text"
                                                                onclick="copyTransactionID('{{$payout->pyt_token}}')">{{$payout->pyt_token}}</span>
                                                        </td>
                                                        <td>
                                                            <h6 class="mt-0 mt-sm-2 fs-14 fw-semibold">
                                                                {{ $payout->user->name}}
                                                            </h6>
                                                        </td>
                                                        <td>
                                                            <h6 class="mt-0 mt-sm-2 fs-14 fw-semibold">
                                                                {{ money($payout->amount) }} / {{ money($payout->fee) }}
                                                            </h6>
                                                        </td>
                                                        <td><span class="fw-semibold mt-sm-2 d-block"> {{ $payout->payoutMethod->account_number }} - {{ $payout->payoutMethod->bank_name }} </span>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <span class="mt-sm-2 d-block">
                                                                {{ $payout->created_at->format('d M, Y') }}
                                                            </span>
                                                        </td>
                                                        <td class="">
                                                            <div class="mt-sm-1 d-block">
                                                                @if($payout->gateway)
                                                                <span
                                                                    class="badge bg-{{$payout->gateway->color()}}-transparent rounded-pill text-{{$payout->gateway->color()}} p-2 px-3">
                                                                    {{ $payout->gateway->label() }} </span>
                                                                @else
                                                                <span
                                                                    class="badge bg-warning-transparent rounded-pill text-warning p-2 px-3">
                                                                    Not Processed </span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="mt-sm-1 d-block">
                                                                <span
                                                                    class="badge bg-{{$payout->status->color()}}-transparent rounded-pill text-{{$payout->status->color()}} p-2 px-3">
                                                                    {{ $payout->status->label() }} </span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('admin.payouts.show', $payout->pyt_token) }}"
                                                                class="btn text-dark btn-sm"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-original-title="View"><span
                                                                    class="fa-regular fa-eye fs-14"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    {{ $payouts->links('pagination.admin') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center p-4">
                        <img src="{{ asset('assets/images/icons/man.svg') }}" class="w-25" alt="empty">
                        <h4 class="mt-3">No Payout Found</h4>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    </div>