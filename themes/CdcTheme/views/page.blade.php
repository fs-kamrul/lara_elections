@php

    Theme::set('pageId', $page->id);
    Theme::set('title', $page->name);
//    dd($page);
@endphp

{!! apply_filters(PAGE_FILTER_FRONT_PAGE_CONTENT, clean($page->description), $page) !!}
