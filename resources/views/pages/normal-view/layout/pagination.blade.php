<div>
    <ul class="pagination justify-content-center">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">Previous</span>
            </li>
        @else
            <li class="page-item">
                <button class="page-link" wire:click="previousPage" rel="prev"
                    aria-label="@lang('pagination.previous')">Previous</button>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span
                                class="page-link">{{ $page }}</span></li>
                    @elseif ($page <= $paginator->lastPage() && ($page <= 2 || $page >= $paginator->lastPage() - 1 || abs($paginator->currentPage() - $page) <= 1))
                        <li class="page-item"><button class="page-link"
                                wire:click="gotoPage({{ $page }})">{{ $page }}</button></li>
                    @elseif ($page == $paginator->lastPage())
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <button class="page-link" wire:click="nextPage" rel="next"
                    aria-label="@lang('pagination.next')">Next</button>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">Next</span>
            </li>
        @endif
    </ul>
</div>
