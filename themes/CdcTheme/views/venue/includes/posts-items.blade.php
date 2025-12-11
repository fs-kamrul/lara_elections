@php
    $layout = theme_option('product_list_layout');

    $requestLayout = request()->input('layout');
    if ($requestLayout && in_array($requestLayout, array_keys(get_product_single_layouts()))) {
        $layout = $requestLayout;
    }

    $layout = ($layout && in_array($layout, array_keys(get_product_single_layouts()))) ? $layout : 'product-full-width';
//    dd($shortcode->image_side);
@endphp

<div class="w-full lg:w-3/5">
    <div class="@if($shortcode->image_side == null) flex flex-wrap justify-center lg:justify-start gap-4
                    @elseif($shortcode->image_side == 'right_side') flex flex-wrap gap-4 xs:justify-center lg:justify-end
                    @elseif($shortcode->image_side == 'left_side') flex flex-wrap gap-4 xs:justify-center lg:justify-start @endif">
    @forelse ($posts as $key=>$post)
        @include(Theme::getThemeNamespace() . '::views.venue.includes.posts-item', compact('post'))
    @empty
        <div class="tab-pane mb-5" id="pills-picnic" role="tabpanel" aria-labelledby="pills-picnic-tab"
             tabindex="0">
           {{ __('No Item found!') }}
        </div>
    @endforelse
    </div>
</div>
{{--        @if ($posts->total() > 0)--}}
{{--            <div class="mb_100">--}}
{{--            {!! $posts->withQueryString()->onEachSide(1)->links(Theme::getThemeNamespace() . '::partials.custom-pagination') !!}--}}
{{--            </div>--}}
{{--        @endif--}}
