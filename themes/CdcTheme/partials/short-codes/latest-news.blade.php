<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-10">
            <div class="mb-6 md:mb-0">
                <h2 class="text-3xl font-bold">{{ $shortcode->title }}</h2>
            </div>
            @if($shortcode->button_label1)
                <a href="{{ $shortcode->button_url1 }}" class="inline-block px-6 py-2 border-2 border-gray-800 text-gray-800 font-medium rounded-lg hover:bg-gray-800 hover:text-white transition-colors">{{ $shortcode->button_label1 }}</a>
            @endif
        </div>
        <!-- Swiper -->
        <div class="swiper ouractivity">
            <div class="swiper-wrapper">
                @foreach($post_types->post as $post)
                    <div class="swiper-slide">
                        <div class="rounded-lg overflow-hidden shadow-md bg-white">
                            <img src="{{ getImageUrl($post->photo) }}" alt="{{ $post->name }}" class="w-full h-52 object-cover">
                            <div class="p-4">
                                <a href="{{ $post->url }}" class="text-lg font-medium text-gray-900 hover:text-blue-600 transition-colors">{{ $post->name }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-md text-gray-800"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="swiper-button-prev flex items-center justify-center w-10 h-10 bg-white rounded-full shadow-md text-gray-800"><i class="fa-solid fa-chevron-left"></i></div>
        </div>
    </div>
</section>
