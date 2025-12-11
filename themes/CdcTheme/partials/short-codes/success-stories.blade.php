<section class="overflow-hidden bg-background-sky-2 pb-32 pt-85 lg:pt-118">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
        <div class="flex flex-col items-center text-center">
            <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                {{ $shortcode->title }}
                <span class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->title2 }}
                </span>
            </h2>
            <p class="mt-30 max-w-603 font-pop text-sm font-normal text-p-color lg:text-base">
                {!! $shortcode->contain !!}
            </p>
        </div>

        <div class="mt-158">
            <div class="items-center lg:flex">
                <div class="relative mb-100 lg:mb-0">
                    <h5
                        class="relative z-10 text-center font-pop text-3xl font-bold sm:w-1/2 mx-auto capitalize text-p-color lg:ml-67 lg:w-336 lg:text-left lg:text-45 lg:font-semibold lg:leading-normal">
                        {{ $shortcode->tag_line }}
                    </h5>
                    <div class="absolute -left-45 -top-180 text-350 leading-none text-white">
                        <i class="ri-double-quotes-l"></i>
                    </div>
                </div>
                @isset($post_types->post)
                <div class="ml-auto w-full lg:max-w-496">
                    <div id="customize_wrapper">
                        <div class="customize" id="customize">
                            @foreach($post_types->post as $key=>$post)
                            <div>
                                <h6 class="text-center font-pop text-22 font-bold text-p-color">
                                    ''{{ $post->name }}''
                                </h6>

                                <p class="mt-51 text-center font-pop text-sm font-normal leading-loose text-p-color lg:text-base">
                                    {!! $post->description !!}
                                </p>
                            </div>
                            @endforeach
                        </div>
                        <div class="customize-tools mt-72">
                            <ul class="thumbnails flex flex-wrap items-center justify-center lg:flex-nowrap"
                                id="customize-thumbnails">
                                @foreach($post_types->post as $key1=>$post)
                                <li
                                    class=" @if($key1 == 0) relative @endif mx-2 inline-block !h-10 !max-h-10 !w-10 shrink-0 rounded-full lg:mx-5 lg:!h-60 lg:!max-h-60 lg:!w-60">
                                    <img src="{{ getImageUrl($post->photo) }}" alt="success-stories"
                                         class="!h-full !max-h-full w-full rounded-full !object-cover" />
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endisset
            </div>
        </div>
    </div>
</section>
