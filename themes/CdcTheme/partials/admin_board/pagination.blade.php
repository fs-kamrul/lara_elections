
@if ($paginator->hasPages())
    <div class="flex items-center justify-center mt-20">
        <nav class="flex">
{{--        <ul class="pagination">--}}
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">--}}
                    <span class="px-3 py-2 text-gray-500 hover:bg-gray-100 rounded-l-lg">@lang('Previous')</span>
{{--                </li>--}}
            @else
{{--                <li class="page-item">--}}
                    <a class="px-3 py-2 text-gray-500 hover:bg-gray-100 rounded-l-lg"
                       href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">@lang('Previous')</a>
{{--                </li>--}}
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
{{--                    <li class="page-item disabled" aria-disabled="true">--}}
                        <span class="mx-2 px-3 py-2 bg-blue-500 text-white hover:bg-blue-600">{{ $element }}</span>
{{--                    </li>--}}
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
{{--                            <li class="page-item" aria-current="page">--}}
                                <span class="mx-2 px-3 py-2 bg-blue-500 text-white hover:bg-blue-600">{{ $page }}</span>
{{--                            </li>--}}
                        @else
{{--                            <li class="page-item">--}}
                                <a class="mx-2 px-3 py-2 text-gray-700 hover:bg-gray-100" href="{{ $url }}">{{ $page }}</a>
{{--                            </li>--}}
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
{{--                <li class="page-item">--}}
                    <a class="mx-2 px-3 py-2 text-gray-500 hover:bg-gray-100 rounded-r-lg" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">@lang('Next')</a>
{{--                </li>--}}
            @else
{{--                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">--}}
                    <span class="mx-2 px-3 py-2 text-gray-500 hover:bg-gray-100 rounded-r-lg" aria-hidden="true">@lang('Next')</span>
{{--                </li>--}}
            @endif
{{--        </ul>--}}
        </nav>
    </div>
@endif
