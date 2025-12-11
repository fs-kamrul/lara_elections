<h4 class="font-pop font-medium text-xl leading-72 text-gray-3 text-center pb-4">{{ $category->name }}</h4>
<div class="flex items-center justify-between gap-4 p-4 border-b">
    <h6 class="font-inter font-medium text-18 leading-15 text-banner-dark">@lang('table::lang.title')</h6>
    <h6 class="font-inter font-medium text-sm leading-15 text-tertiary-orange">@lang('table::lang.published_date')</h6>
</div>
@foreach($posts as $post)
    <div class="flex items-center justify-between gap-4 p-4 border-b">
        <h6 class="font-inter font-medium text-18 leading-15 text-banner-dark"><a href="{{ $post->url }}">{{ $post->name }}</a></h6>
        <h6 class="font-inter font-medium text-sm leading-15 text-tertiary-orange">{{ date('d/m/Y', strtotime($post->created_at)) }}</h6>
    </div>
@endforeach

<div class="pagination-links">
{!! $posts->links(Theme::getThemeNamespace() . '::partials.pagination_portal') !!}
</div>
