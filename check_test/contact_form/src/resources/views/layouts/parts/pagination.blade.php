@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="prev page-numbers" aria-hidden="true">Prev</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="prev page-numbers" rel="prev" aria-label="@lang('pagination.previous')">Prev</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-numbers dots" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-numbers current" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" class="page-numbers">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="next page-numbers" rel="next" aria-label="@lang('pagination.next')">Next</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="next page-numbers" aria-hidden="true">Next</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination {
            display: flex;
            justify-content: flex-end;
        }
        .pagination .page-numbers {
            display: grid;
            color: inherit;
            font-size: 13px;
            text-align: center;
            text-decoration: none;
            position: relative;
            border: solid 1px transparent;
            margin: 0 10px;
        }
        @media screen and (min-width: 769px) {
            .pagination .page-numbers {
                padding: 6px 8px 5px;
            }
        }

        .pagination .current {
            border-bottom: solid 1px var(--theme-color);
        }

        .pagination .prev {
            margin: 0 16px;
        }
        .pagination .next {
            margin-left: 16px;
            margin-right: 0;
        }
        @media screen and (min-width: 769px) {
            .pagination .prev,
            .pagination .next {
                margin: 0 30px;
            }
        }

        .pagination .prev::after,
        .pagination .next::after {
            position: absolute;
            content: '';
            top: 0;
            bottom: 0;
            width: 1px;
            height: 24px;
            background-color: var(--theme-color);
            margin: auto;
            transform: rotate(30deg);
        }
        @media screen and (min-width: 769px) {
            .pagination .prev::after,
            .pagination .next::after {
                height: 30px;
            }
        }

        .pagination .prev::after {
            right: -12px;
        }
        @media screen and (min-width: 769px) {
            .pagination .prev::after {
                right: -20px;
            }
        }

        .pagination .next::after {
            left: -12px;
        }
        @media screen and (min-width: 769px) {
            .pagination .next::after {
                left: -20px;
            }
        }

        .pagination a {
            transition: .3s;
        }

        .pagination a:hover {
            background: #F1ECE7;
        }
    </style>
@endif
