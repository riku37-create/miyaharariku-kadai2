@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="pagination-container">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-button disabled" aria-disabled="true">
                &lt;
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-button" rel="prev">
                &lt;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination-ellipsis">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-button" rel="next">
                &gt;
            </a>
        @else
            <span class="pagination-button disabled" aria-disabled="true">
                &gt;
            </span>
        @endif
    </nav>
@endif