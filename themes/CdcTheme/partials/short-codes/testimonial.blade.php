<section class="bg-white py-85 lg:py-130">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-container md:max-w-md-container px-4 lg:px-0">
        <div class="flex flex-col items-center text-center">
            <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                {{ $shortcode->title }}
                <span
                    class="inline-block after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->tag_line }}
                </span>
            </h2>
            <p class="mt-30 lg:max-w-603 font-pop text-sm font-normal text-p-color lg:text-base">
                {!! description_summary($shortcode->contain) !!}
            </p>
        </div>

        @if($post_types)
            <div
                class="mt-85 flex flex-wrap sm:flex-col gap-10 md:flex-row md:flex-nowrap md:gap-6 xs:justify-center sm:items-center">
                @foreach($post_types->post as $post)
                    <div class="w-full xs:w-4/6 sm:w-45 md:w-1/3 lg:w-32">
                        <div class="h-320 w-full rounded-23 bg-center lg:h-421" style="
                background:
                  linear-gradient(0deg, #000000cc 0%, #00000000 100%) 0% 0%
                    no-repeat padding-box,
                  url({{ getImageUrl($post->photo) }}) no-repeat; background-size: cover;
              ">
                            <div class="flex h-full items-end">
                                <div class="flex items-center px-22 py-5">
                                    <div
                                        class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-white lg:h-84 lg:w-84">
                                        <img src="{{ getImageUrl($post->icon_set) }}" alt="logo" class="block h-auto w-12"/>
                                    </div>
                                    <p class="ml-22 font-pop text-sm font-semibold text-white lg:text-base">
                                        {{ $post->header_title }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-35 text-center">
                            <h6 class="font-pop text-base font-semibold text-primary-dark">
                                {{ $post->name }}
                            </h6>
                            <p class="mt-2 font-pop font-normal text-p-color">
                                {{ $post->designation }}
                            </p>
                            <a href="{{ $post->url }}"
                               class="before:btn_clip before:content[''] hover:before:btn_clip_hover group relative mt-35 inline-block overflow-hidden rounded-full border border-btn-blue bg-white px-5 py-10s font-pop text-lg font-medium uppercase text-btn-blue before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:text-white hover:before:bg-black">
                                <span class="relative z-10">@lang('View Message')</span></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
