<!-- --------------------- News Resources Start --------------------- -->
<section id="news_resources" class="py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-wrap">
            <div class="w-full">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-primary text-center">Resources & News</h3>
                </div>
            </div>
        </div>

        <div class="mt-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($posts as $key=>$post)
                    <div class="mb-8 md:mb-0">
                        <div class="rounded-lg overflow-hidden shadow-lg">
                            <div class="relative">
                                <div class="absolute inset-0 bg-black bg-opacity-30 flex items-start justify-start p-4">
                                    <a href="#" class="bg-blue-600 text-white px-3 py-1 rounded-md text-sm hover:bg-blue-700 transition duration-300">Design</a>
                                </div>
                                @php
                                    if($post->photo){
                                        $image = getImageUrl($post->photo);
                                    }else{
                                        $image = getDefaultImage();
                                    }
                                @endphp
                                <img src="{{ $image }}" alt="{{ $post->name }}" class="w-full h-64 object-cover">
                            </div>

                            <div class="p-6 bg-white">
                                <a href="{{ $post->url }}" class="text-xl font-semibold text-gray-800 hover:text-blue-600 transition duration-300 block mb-4">{{ description_summary($post->name) }}</a>

                                <div class="flex items-center">
                                    <div class="w-5 h-5 mr-2">
                                        <img src="{{ url('themes/'. Theme::getThemeName() .'/img/calendar.png') }}" alt="Event Date" class="w-full h-full object-contain">
                                    </div>
                                    @php
                                        $start_date = $post->start_date;
                                        $formatted_date = date('d M Y', strtotime($start_date));
                                    @endphp
                                    <p class="text-sm text-gray-600">{{ $formatted_date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if($shortcode->button_url && $shortcode->button_label)
            <div class="text-center mt-28">
                <a href="{{ $shortcode->button_url }}" target="_blank" class="inline-block bg-blue-600 text-white font-bold py-3 px-8 rounded-lg hover:bg-blue-700 transition duration-300">{{ $shortcode->button_label }}</a>
            </div>
        @endif
    </div>
</section>
<!-- --------------------- News Resources End --------------------- -->
