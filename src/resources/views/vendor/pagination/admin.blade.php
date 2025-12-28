@if ($paginator->hasPages())
<nav class="admin-pagination" role="navigation" aria-label="Pagination Navigation">
    <ul class="admin-pagination__list">
        {{-- ＜（前へ） --}}
        @if ($paginator->onFirstPage())
        <li class="admin-pagination__item is-disabled" aria-disabled="true">
            <span class="admin-pagination__link" aria-hidden="true">&lt;</span>
        </li>
        @else
        <li class="admin-pagination__item">
            <a class="admin-pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&lt;</a>
        </li>
        @endif

        {{-- ページ番号 --}}
        @foreach ($elements as $element)
        {{-- "..." は仕様に無いので表示しない（必要なら表示ONにできます） --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="admin-pagination__item is-active" aria-current="page">
            <span class="admin-pagination__link">{{ $page }}</span>
        </li>
        @else
        <li class="admin-pagination__item">
            <a class="admin-pagination__link" href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- ＞（次へ） --}}
        @if ($paginator->hasMorePages())
        <li class="admin-pagination__item">
            <a class="admin-pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">&gt;</a>
        </li>
        @else
        <li class="admin-pagination__item is-disabled" aria-disabled="true">
            <span class="admin-pagination__link" aria-hidden="true">&gt;</span>
        </li>
        @endif
    </ul>
</nav>
@endif