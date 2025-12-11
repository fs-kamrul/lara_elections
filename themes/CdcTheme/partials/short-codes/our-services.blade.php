<!-- ----------------------- Different Start ----------------------- -->
@isset($post_types->post)
@if($post_types->post != null)
    <div
        class="mx-auto mt-172 xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
        <div class="relative flex flex-col items-center text-center">
            <h2 class="font-pop text-23 lg:text-40 font-bold capitalize text-primary-dark">
                {{ $shortcode->title }} <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->tag_line }}</span>
            </h2>
            <p class="mt-30 max-w-603 font-pop text-sm font-normal text-p-color lg:text-base">
                {{ $shortcode->contain }}
            </p>

            <div class="absolute -top-158 right-2 lg:-top-106">
                <img src="{{ asset('themes/'. Theme::getThemeName() .'/images/path.png') }}" alt="path3" />
            </div>
        </div>

        <div class="mt-95 items-center pb-0 lg:flex xs:pb-20 lg:pb-142">
            @php
                $posts = $post_types->post;
            @endphp
            @include(Theme::getThemeNamespace() . '::views.venue.includes.posts-items', compact('posts'))

            <div class="mt-100 flex w-285 justify-center mx-auto xs:hidden lg:flex lg:mt-0 lg:w-2/5">
                <div class="h-403 relative flex w-full justify-center lg:w-305">
                    <img src="{{ getImageUrlById($shortcode->image, 'shortcodes') }}" alt="{{ $shortcode->tag_line }}"
                         class="relative z-20 block h-full w-full object-cover object-top" />
                    <div class="absolute bottom-0 left-1/2 z-10 h-320 w-full -translate-x-1/2 rounded-br-20 rounded-tl-20 bg-blue-2 lg:h-373 lg:w-305">
                    </div>
                    <div class="absolute -top-6 left-12 z-0 hidden h-373 w-305 rounded-br-20 rounded-tl-20 bg-white lg:block">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endisset
<!-- ----------------------- Different End ----------------------- -->
