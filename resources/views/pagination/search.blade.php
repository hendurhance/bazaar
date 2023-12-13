<ul class="pagination justify-content-center">
    @if($paginator->onFirstPage())
        <li class="page-item page-prev disabled">
            <a class="page-link" href="javascript:void(0)" tabindex="-1">Prev</a>
        </li>
    @else
        <li class="page-item page-prev">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1">Prev</a>
        </li>
    @endif
    @foreach($elements as $element)
        @if(is_string($element))
            <li class="page-item disabled">
                <a class="page-link" href="javascript:void(0)">{{ $element }}</a>
            </li>
        @endif
        @if(is_array($element))
            @foreach($element as $page => $url)
                @if($page == $paginator->currentPage())
                    <li class="page-item active">
                        <a class="page-link" href="javascript:void(0)">{{ $page }}</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    @endforeach
    @if($paginator->hasMorePages())
        <li class="page-item page-next">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Next</a>
        </li>
    @else
        <li class="page-item page-next disabled">
            <a class="page-link" href="javascript:void(0)">Next</a>
        </li>
    @endif
</ul>