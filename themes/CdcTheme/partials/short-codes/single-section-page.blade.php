<section class="mt-10 lg:mt-100 mb-142 px-4 lg:px-0">
    <div class="xl:max-w-container mx-auto">
        <div class="lg:flex justify-between">
            <div class=" @if($shortcode->image != null) w-full lg:w-6/12 lg:pr-10 @else w-full @endif ">
                <h1 class="  text-23 font-bold capitalize text-primary-dark lg:text-43">
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                            {{ $shortcode->title }}</span>
                </h1>

                <div class="mt-10">
                    <p class="text-sm font-normal text-p-color-70 lg:text-base !leading-loose">The Career
                        {{ $shortcode->contain }}</p>
                </div>
                @if($shortcode->button_label)
                    <div class="mt-44">
                        <a href="{{ $shortcode->button_url }}" class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black first:mr-4">
                            <span class="relative z-10">{{ $shortcode->button_label }}</span>
                        </a>
                    </div>
                @endif
            </div>

            @if($shortcode->image != null)
                <div class="w-full lg:w-5/12 mt-10 lg:mt-0">
                    <div class="w-444 h-full">
                        <img src="{{ getImageUrlById($shortcode->image, 'shortcodes') }}" alt="{{ $shortcode->title }}"
                             class="w-full h-full object-cover rounded-30">
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
