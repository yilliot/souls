@if ($paginator->hasPages())
    <div class="ui pagination menu">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <div class="disabled item"><span>&laquo;</span></div>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="item">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <div class="disabled item"><span>{{ $element }}</span></div>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <div class="active item"><span>{{ $page }}</span></div>
                    @else
                        <a href="{{ $url }}" class="item">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="item">&raquo;</a>
        @else
            <div class="disabled item"><span>&raquo;</span></div>
        @endif
    </div>
@endif
