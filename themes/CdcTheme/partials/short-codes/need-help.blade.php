@isset($post_types->post)
    @if($post_types->post != null)
        <section class="bg-white pt-130">
            <div class="mx-auto px-4 xs:max-w-xs-container sm:max-w-sm-container md:max-w-full lg:max-w-full">
                <div class="flex flex-col items-center text-center">
                    <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                        {{ $shortcode->title }}
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                            {{ $shortcode->tag_line }}</span>
                    </h2>
                    <p class="tect-sm mt-30 w-full md:max-w-603 font-pop font-normal text-p-color lg:text-base">
                        {{ $shortcode->contain }}
                    </p>
                </div>

                <div
                    class="mb-130 mt-90 flex flex-col sm:flex-row sm:flex-wrap justify-center gap-4 lg:flex-row lg:flex-nowrap xs:items-center md:items-start lg:items-stretch">
                    @foreach($post_types->post as $key=>$post)
                        <div
                            class="w-full shrink-0 xs:w-4/6 sm:w-45 md:w-30p rounded-26 bg-background-sky-2 pb-28 pl-28 pr-42 sm:pr-25 xl:pr-67 pt-30 lg:w-18p lg:shrink lg:flex-1">
                            <div class="flex h-84 w-84 items-center justify-center rounded-full bg-white">
                                <img src="{{ getImageUrl($post->icon_set) }}" alt="icon" class="w-54"/>
                            </div>

                            <a href="{{ $post->url }}"
                               class="mt-42 inline-block font-pop text-22 lg:max-xl:text-lg font-bold text-black transition duration-200 ease-linear hover:-translate-y-1 hover:text-primary-blue">
                                {{ $post->name }}<i class="ri-arrow-right-line ml-15"></i></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endisset
