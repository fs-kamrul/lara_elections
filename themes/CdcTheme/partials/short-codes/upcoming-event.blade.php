<section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">
    <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container md:mt-172 sm:px-4 lg:px-0">
        <div class="flex flex-col items-center text-center sm:px-4 lg:px-0">
            <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                {{ $shortcode->title }}
                <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->tag_line }}</span>
            </h2>
            <p class="mt-30 max-w-603 font-pop text-base font-normal text-p-color">
                {{ $shortcode->contain }}
            </p>
        </div>

        @if($event)
            <div class="mt-90 justify-between lg:flex sm:px-4 lg:px-0">
                <div class="mb-20 w-full lg:mb-0 lg:w-45">
                    <img src="{{ getImageUrl($event->photo, 'adminboard/adminevent/') }}" alt="upcoming event CDC"
                         class="block h-full w-full rounded-xl object-cover lg:rounded-30" />
                </div>

                <div class="w-full lg:w-45">
                    <h3 class="font-pop text-xl font-bold tracking-wide lg:text-22">
                        {{ $event->name }}
                    </h3>
                    <p class="mt-30 line-clamp-3 font-pop text-sm font-normal text-p-color lg:text-base">
                        {!! description_summary($event->description) !!}
                    </p>

                    <div class="mt-42">
                        <div class="mb-5 flex items-center">
                            <span class="mr-4 flex h-8 w-8 items-center justify-center rounded-full bg-background-sky-2 text-lg">
                                <i class="ri-map-pin-fill"></i></span>
                            <p class="font-pop text-sm font-normal text-p-color">
                                {{ $event->location }}
                            </p>
                        </div>

                        <div class="flex items-center">
                            <span class="mr-4 flex h-8 w-8 items-center justify-center rounded-full bg-background-sky-2 text-lg">
                                <i class="ri-time-fill"></i></span>
                            <p class="font-pop text-sm font-normal text-p-color">
                                {{ $event->set_time }}, {{ date('d F Y', strtotime($event->start_date)) }}
                            </p>
                        </div>
                    </div>

                    @if($shortcode->button_label1)
                    <a href="{{ $shortcode->button_url1 }}"
                       class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-30 inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 font-pop text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black">
                        <span class="relative z-10">{{ $shortcode->button_label1 }}</span></a>
                    @endif
                </div>
            </div>
        @endif
        {!! Theme::partial('admin_board.event.items', ['events' => $events, 'img_slider' => true]) !!}
        @php
//            $posts = $post_types->post;
        @endphp
{{--        @include(Theme::getThemeNamespace() . '::views.venue.includes.news-items', compact('posts'))--}}

    </div>
</section>

