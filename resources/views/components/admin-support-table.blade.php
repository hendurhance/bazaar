<div class="row">
    <div class="panel-body tabs-menu-body border-0 pt-0">
        <div class="col-xl-12">
            <div class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="row">
                    <div class="card-body p-6">
                        <div class="inbox-body">
                            <div class="table-responsive">
                                <table class="table table-inbox table-hover text-nowrap mb-0">
                                    <tbody>
                                        @if ($supports->count() > 0)
                                            @foreach ($supports as $support)
                                            <tr>
                                                <td class="view-message dont-show fw-semibold clickable-row" data-href='{{ route('admin.support.show', $support->id) }}'>{{ $support->name }}</td>
                                                <td class="view-message dont-show fw-semibold clickable-row" data-href='{{ route('admin.support.show', $support->id) }}'>{{ $support->email }}</td>
                                                <td class="view-message" data-href=''{{ route('admin.support.show', $support->id) }}'>{{ shorten_chars($support->message, 50, true) ?? 'No message available for this ticket' }}</td>
                                                <td class="view-message text-end fw-semibold">{{ $support->created_at->format('M d, Y') }}</td>
                                                <td class="view-message text-end fw-semibold">
                                                    <span class="badge badge-{{ $support->status->color() }} bg-{{ $support->status->color() }}">{{ $support->status->label() }}</span>
                                                </td>
                                                <td class="inbox-small-cells"><a href="{{ route('admin.support.show', $support->id) }}"> <i class="fa-regular fa-eye text-primary"></i></a></td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <div class="text-center">
                                            <img src="/assets/images/icons/man.svg" alt="img" class="w-25">
                                            <h4 class="my-3">No Support Found</h4>
                                        </div>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-6">
                {{ $supports->links('pagination.admin') }}
                </div>
            </div>
        </div>
    </div>
</div>