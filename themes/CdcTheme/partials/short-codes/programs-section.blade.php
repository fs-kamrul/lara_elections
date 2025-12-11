<!-- ----------------------- Different Start ----------------------- -->
@isset($post_types->post)
    @if($post_types->post != null)
        <div
            class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
            @if($shortcode->title != null)
                <div class="flex flex-col items-center text-center">
                    <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
              <span
                  class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                  {{ $shortcode->title }}</span>
                        {{ $shortcode->tag_line }}
                    </h2>
                    <p class="mt-30 max-w-603 font-pop text-sm font-normal text-p-color lg:text-base">
                        {{ $shortcode->contain }}
                    </p>
                </div>
            @endif
            <div class=" @if($shortcode->title != null) mt-90 items-center justify-between lg:flex @else mt-4 flex flex-col-reverse items-center justify-between pb-118 lg:flex-row @endif ">
                @if($shortcode->image_side == 'right_side')
                    <div class="mb-20 w-full lg:mb-0 lg:w-2/5 xl:w-2/5 sm:px-4 lg:px-0 text-center lg:text-left">
                        <h4 class="font-pop text-23 font-extrabold text-black lg:text-3xl">
                            {{ $post_types->name }}
                        </h4>
                        <p class="mt-30  lg:max-w-444 font-pop text-sm font-normal leading-6 text-p-color lg:text-base">
                            {!! $post_types->description !!}
                        </p>
                        @if($shortcode->button_label1)
                            <a href="{{ $shortcode->button_url1 }}"
                               class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-44 inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 font-pop text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black">
                                <span class="relative z-10">{{ $shortcode->button_label1 }}</span></a>
                        @endif
                    </div>
                @endif
                @php
                    $posts = $post_types->post;
                @endphp
                @include(Theme::getThemeNamespace() . '::views.venue.includes.posts-items', compact('posts'))
                @if($shortcode->image_side == 'left_side')
                    <div class="mb-20 w-full lg:mb-0 lg:w-2/5 xl:w-2/5 sm:px-4 lg:px-0 text-center lg:text-left">
                        <h4 class="font-pop text-23 font-extrabold text-black lg:text-3xl">
                            {{ $post_types->name }}
                        </h4>
                        <p class="mt-30  lg:max-w-444 font-pop text-sm font-normal leading-6 text-p-color lg:text-base">
                            {!! $post_types->description !!}
                        </p>
                        @if($shortcode->button_label1)
                            <a href="{{ $shortcode->button_url1 }}"
                               class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-44 inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 font-pop text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black">
                                <span class="relative z-10">{{ $shortcode->button_label1 }}</span></a>
                        @endif
                    </div>
                @endif

            </div>
        </div>
    @endif
@endisset
<!-- ----------------------- Different End ----------------------- -->
