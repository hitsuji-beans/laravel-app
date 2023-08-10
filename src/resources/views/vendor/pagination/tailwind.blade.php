@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="relative w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="relative w-full inline-flex items-center justify-center px-4 py-2 text-sm font-bold text-white bg-red-600/75 border border-rose-300 leading-5 rounded-md hover:bg-rose-500 focus:outline-none focus:ring ring-pink-300 focus:border-slate-300   transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="relative w-full inline-flex items-center justify-center px-4 py-2 ml-3 text-sm font-bold text-white bg-red-600/75 border border-rose-300 leading-5 rounded-md hover:bg-rose-500 focus:outline-none focus:ring ring-pink-300 focus:border-slate-300   transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span
                    class="relative w-full inline-flex items-center justify-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:block w-full">
            <div>
                <span class="relative z-0 inline-flex w-full justify-center gap-3">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span
                                class="relative inline-flex items-center  w-10 h-10 justify-center text-sm font-medium rounded-full
                                text-gray-500 bg-white border border-gray-300 cursor-default leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            class="relative inline-flex items-center  w-10 h-10 justify-center text-sm font-bold rounded-full
                            text-white bg-red-400 leading-5 focus:z-10 hover:bg-red-300 focus:outline-none
                            focus:ring  focus:border-blue-100 active:bg-red-500 transition ease-in-out duration-150"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span
                                    class="relative inline-flex items-center w-10 h-10 pb-1 justify-center -ml-px text-sm font-medium rounded-full
                                    text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span
                                            class="relative inline-flex items-center w-10 h-10 justify-center -ml-px text-sm font-medium rounded-full
                                            text-red-600 bg-pink-100/75 border border-gray-300 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center w-10 h-10 justify-center -ml-px text-sm font-bold rounded-full
                                        text-white bg-red-400 leading-5 focus:z-10 hover:bg-red-300 focus:outline-none
                                        focus:ring  focus:border-blue-100 active:bg-red-500 transition ease-in-out duration-150"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                            class="relative inline-flex items-center  w-10 h-10 justify-center -ml-px text-sm font-bold rounded-full
                            text-white bg-red-400 leading-5 focus:z-10 hover:bg-red-300 focus:outline-none
                            focus:ring  focus:border-blue-100 active:bg-red-500 transition ease-in-out duration-150"
                            aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span
                                class="relative inline-flex items-center  w-10 h-10 justify-center -ml-px text-sm font-medium rounded-full
                                text-gray-500 bg-white border border-gray-300 cursor-default leading-5"
                                aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
            <div class="mt-4">
                <p class="text-sm text-gray-700 leading-5 text-right">
                    <span class="font-medium">{{ $paginator->total() }}件中</span>

                    <span class="font-medium">
                        @if ($paginator->firstItem())
                            {{ $paginator->firstItem() }} ~ {{ $paginator->lastItem() }}
                        @else
                            {{ $paginator->count() }}
                        @endif
                    </span>

                    <span class="font-medium">件を表示しています</span>
                </p>
            </div>
        </div>
    </nav>
@endif