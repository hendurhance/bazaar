@if($paginator->hasPages())
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="dataTables_info" id="crypto-data-table_info" role="status" aria-live="polite">
            Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} entries
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="dataTables_paginate paging_simple_numbers" id="crypto-data-table_paginate">
            <ul class="pagination">
                @if($paginator->onFirstPage())
                <li class="paginate_button page-item previous disabled" id="crypto-data-table_previous">
                    <a href="#" aria-controls="crypto-data-table" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                </li>
                @else
                <li class="paginate_button page-item previous" id="crypto-data-table_previous">
                    <a href="{{ $paginator->previousPageUrl() }}" aria-controls="crypto-data-table" data-dt-idx="0" tabindex="0"
                        class="page-link">Previous</a>
                </li>
                @endif
                @foreach($elements as $element)
                @if(is_string($element))
                <li class="paginate_button page-item disabled" aria-disabled="true">
                    <a href="#" aria-controls="crypto-data-table" data-dt-idx="1" tabindex="0"
                        class="page-link">{{ $element }}</a>
                </li>
                @endif
                @if(is_array($element))
                @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
                <li class="paginate_button page-item active" aria-current="page">
                    <a href="#" aria-controls="crypto-data-table" data-dt-idx="1" tabindex="0"
                        class="page-link">{{ $page }}</a>
                </li>
                @else
                <li class="paginate_button page-item">
                    <a href="{{ $url }}" aria-controls="crypto-data-table" data-dt-idx="1" tabindex="0"
                        class="page-link">{{ $page }}</a>
                </li>
                @endif
                @endforeach
                @endif
                @endforeach
                @if($paginator->hasMorePages())
                <li class="paginate_button page-item next" id="crypto-data-table_next">
                    <a href="{{ $paginator->nextPageUrl() }}" aria-controls="crypto-data-table" data-dt-idx="3" tabindex="0"
                        class="page-link">Next</a>
                </li>
                @else
                <li class="paginate_button page-item next disabled" id="crypto-data-table_next">
                    <a href="#" aria-controls="crypto-data-table" data-dt-idx="3" tabindex="0" class="page-link">Next</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endif