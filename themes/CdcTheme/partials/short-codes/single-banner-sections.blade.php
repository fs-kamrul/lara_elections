<div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
    <div class="flex pt-14 lg:pt-106">
        <div class="hidden w-2/5 lg:block">
            <div class="relative flex h-403 w-305 justify-center">

                @php
                    $data_photo= $shortcode->pics_file;
                    $data_photo = explode(',', $data_photo);
                @endphp
                @foreach($data_photo as $image)
                    <img src="{{ getImageUrlById($image, 'shortcodes') }}" alt="{{ $shortcode->contain }}"
                         class="relative z-20 block h-full w-auto object-cover object-center" />
                @endforeach
                <div
                    class="absolute bottom-0 left-1/2 z-10 h-373 w-305 -translate-x-1/2 rounded-br-20 rounded-tl-20 bg-text-highlight">
                </div>
                <div class="absolute -top-6 left-12 z-0 h-373 w-305 rounded-br-20 rounded-tl-20 bg-white"></div>
            </div>
        </div>

        <div class="flex w-full flex-col items-center justify-center text-center lg:w-3/5 relative z-20">
            <h1 class="w-full font-pop text-23 font-extrabold capitalize lg:max-w-542 lg:text-43 lg:leading-58">
                {{ $shortcode->header_title }}
                <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->contain }}</span>
                {{ $shortcode->contain2 }}
            </h1>
            <p class="mt-42 max-w-542 font-pop text-sm leading-26 tracking-wide text-p-color lg:line-clamp-4 lg:text-15">
                {{ $shortcode->tag_line }}
            </p>
            <div class="mt-44 flex items-center">

                @if($shortcode->button_label1)
                    <a href="{{ $shortcode->button_url1 }}"
                       class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-btn-blue px-42 py-18 font-pop text-base font-medium uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black">
                        <span class="relative z-10">{{ $shortcode->button_label1 }}</span>
                    </a>
                @endif
                @if($shortcode->button_label2)
                    <a href="{{ $shortcode->button_url2 }}" class="ml-35 inline-block">
                        @if($shortcode->button_label2 == 'icon-phone')
                        <i class="ri-phone-fill rounded-full border-2 border-slate-400 bg-transparent p-17 text-2xl font-black hover:border-white hover:bg-white hover:transition hover:duration-200 hover:ease-linear"></i>
                        @else
                            {{ $shortcode->button_label2 }}
                        @endif
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
