
<!-- --------------- Faq page Start --------------- -->
@php
//dd($categories);
@endphp
@if($faq_categories->count()>0)

    <section class="mt-10 lg:mt-100">

        <!-- FAQ Content -->
        <div class="max-w-5xl mx-auto px-4 pb-16">
            @if($shortcode->title)
            <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43 mb-10">
                <span class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->title }}
                </span>
            </h1>
            @endif
            <!-- Getting Started Category -->
            @foreach($faq_categories as $key => $faq_category)
                <div class="mb-8 faq-category" data-category="getting-started">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-3">
                        <i class="ri-arrow-right-circle-line text-blue-600 text-2xl"></i>
                        {{ $faq_category->name }}
                    </h2>
                    <div class="space-y-3">
                        <!-- Question 1 -->
                        @foreach($faq_category->faqs as $faq_key => $faq)
                            <div class="faq-item bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden transition-all hover:shadow-md">
                                <button class="faq-question w-full px-6 py-5 flex items-center justify-between text-left focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-inset">
                                    <span class="font-semibold text-gray-900 pr-4">{{ $faq->question }}</span>
                                    <i class="ri-arrow-down-s-line faq-icon text-2xl text-gray-500 flex-shrink-0 transition-transform"></i>
                                </button>
                                <div class="faq-answer max-h-0 opacity-0 overflow-hidden transition-all duration-300">
                                    <div class="px-6 pb-5 pt-2 text-gray-600 leading-relaxed border-t border-gray-100">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endif
<!-- --------------- Faq page End --------------- -->
