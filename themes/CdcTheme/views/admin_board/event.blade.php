<section class="mt-10 lg:mt-100 px-4 lg:px-0">
    <div class="xl:max-w-container mx-auto">
        <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43">
                <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ __('Event') }}</span>
        </h1>
        <div class="lg:flex justify-between mt-10">
            <div class="lg:w-8/12 lg:pr-10">
                <div>
                    <h2 class="text-xl font-bold leading-relaxed">{{ $event->name }}</h2>

                    <div class="w-full h-full mt-35">
                        <img src="{{ getImageUrl($event->photo,'adminboard/adminevent') }}" alt="{{ $event->name }}"
                             class="w-full h-284 lg:h-332 object-cover rounded-30">
                    </div>
{{--                    <h3 class="lg:text-center px-5 mt-18 text-xs font-semibold leading-relaxed">Mr. Anik Brahmachari,HR--}}
{{--                        professional and Global Member of SHRM (USA) along with the participants at the News--}}
{{--                        entitled “Let’s Map Your Way to Excellence”</h3>--}}

                    <div class="mt-44 text-sm leading-7">
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
                    <div class="mt-44 text-sm leading-7 ">
                        <p class="mb-5 ">
                            {!! clean($event->description) !!}
                        </p>
                    </div>

{{--                    <div class="flex gap-3 mt-10">--}}
{{--                        <a href="#"--}}
{{--                           class="w-7 h-7 bg-primary-blue rounded-full flex justify-center items-center text-white text-lg hover:text-text-highlight ease-in-out duration-200"><i--}}
{{--                                class="ri-facebook-fill"></i></a>--}}
{{--                        <a href="#"--}}
{{--                           class="w-7 h-7 bg-primary-blue rounded-full flex justify-center items-center text-white text-lg hover:text-text-highlight ease-in-out duration-200 "><i--}}
{{--                                class="ri-twitter-fill"></i></a>--}}
{{--                        <a href="#"--}}
{{--                           class="w-7 h-7 bg-primary-blue rounded-full flex justify-center items-center text-white text-lg hover:text-text-highlight ease-in-out duration-200"><i--}}
{{--                                class="ri-instagram-line"></i></a>--}}
{{--                    </div>--}}
                </div>
                @if (is_module_active('Faq') && count($event->courses_learn) > 0)
                    <!-- Event Breakdown -->
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold text-primary-dark mb-8">@lang('Event Breakdown')</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            @foreach($event->courses_learn as $key => $value)
                                <div class="flex items-start gap-3">
                                    <i class="ri-checkbox-circle-fill text-text-highlight text-xl mt-1 flex-shrink-0"></i>
                                    <span class="text-sm leading-7 text-p-color">{!! DboardHelper::clean($value[0]['value']) !!}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($event->videoStories && $event->videoStories->count() > 0)
                    <!-- Facilitators Carousel -->
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold text-primary-dark mb-8">@lang('Meet Your Facilitators')</h2>
                        <div class="relative">
                            <div class="testimonial-slider overflow-hidden">
                                <div class="testimonial-track flex transition-transform duration-500 ease-in-out">
                                    @foreach ($event->videoStories as $index => $story)
                                        <div class="testimonial-slide flex-shrink-0 w-full px-2">
                                            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                                                <div class="flex items-start gap-4">
                                                    <img src="{{ $story->user_image ? url('uploads/' . $story->user_image) : getImageUrlById('', 'adminboard') }}"
                                                             class="w-16 h-16 rounded-full object-cover flex-shrink-0"
                                                             alt="{{ $story->user_name }}">
                                                    <div class="flex-1">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <h4 class="font-semibold text-primary-dark">{{ $story->user_name }}</h4>
                                                            <span class="text-xs text-p-color">- {{ $story->user_designation }}</span>
                                                        </div>
                                                        <p class="text-sm leading-7 text-p-color">"{{ $story->text_story }}"</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Navigation Buttons -->
                                <button class="testimonial-prev absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 w-10 h-10 bg-primary-blue text-white rounded-full flex items-center justify-center hover:bg-opacity-80 transition duration-200 shadow-lg z-10">
                                    <i class="ri-arrow-left-s-line text-2xl"></i>
                                </button>
                                <button class="testimonial-next absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 w-10 h-10 bg-primary-blue text-white rounded-full flex items-center justify-center hover:bg-opacity-80 transition duration-200 shadow-lg z-10">
                                    <i class="ri-arrow-right-s-line text-2xl"></i>
                                </button>
                                <div class="flex justify-center gap-2 mt-6">
                                    @foreach ($event->videoStories as $index => $story)
                                        <button class="testimonial-dot w-2 h-2 rounded-full @if($index == 0) bg-primary-blue @else bg-gray-300 @endif  transition duration-200" data-index="{{ $index }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if ($event->teams && $event->teams->count() > 0)
                    <!-- Facilitators Carousel -->
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold text-primary-dark mb-8">@lang('Meet Your Facilitators')</h2>
                        <div class="space-y-8">
                            @foreach($event->teams as $index => $value)
                                <div class="flex flex-col md:flex-row gap-6 bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                                    <img src="{{ getImageUrl($value->photo, 'adminboard/adminteam') }}"
                                         alt="{{ $value->name }}" class="w-32 h-32 rounded-2xl object-cover">
                                    <div class="flex-1">
                                        <h3 class="text-xl font-bold text-primary-dark mb-2">{{ $value->name }}</h3>
                                        <p class="text-sm text-primary-blue font-medium mb-3">{{ $value->designation }}</p>
                                        <p class="text-sm leading-7 text-p-color mb-4">{{ $value->short_description }}</p>
                                        <div class="flex gap-3">
                                            @if($value->linkedin_id)
                                                <a href="{{ $value->linkedin_id }}" class="w-8 h-8 bg-background-sky-2 rounded-full flex items-center justify-center text-primary-blue hover:bg-primary-blue hover:text-white transition duration-200">
                                                    <i class="ri-linkedin-fill"></i>
                                                </a>
                                            @endif
                                            @if($value->facebook_id)
                                                <a href="{{ $value->facebook_id }}" class="w-8 h-8 bg-background-sky-2 rounded-full flex items-center justify-center text-primary-blue hover:bg-primary-blue hover:text-white transition duration-200">
                                                    <i class="ri-facebook-fill"></i>
                                                </a>
                                            @endif
{{--                                            @if($value->email)--}}
{{--                                                <a href="{{ $value->email }}" class="w-8 h-8 bg-background-sky-2 rounded-full flex items-center justify-center text-primary-blue hover:bg-primary-blue hover:text-white transition duration-200">--}}
{{--                                                    <i class="ri-mail-line"></i>--}}
{{--                                                </a>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if (is_module_active('Faq') && count($event->faq_items) > 0)
                    <div class="mt-16">
                        <h2 class="text-2xl font-bold text-primary-dark mb-8">@lang('Frequently Asked Questions')</h2>
                        <div class="space-y-4">
                            @foreach($event->faq_items as $key=>$faq)
                                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                                    <button class="faq-toggle w-full text-left p-6 flex justify-between items-center hover:bg-gray-50 transition duration-200">
                                        <h3 class="text-base font-semibold text-primary-dark pr-4">{!! DboardHelper::clean($faq[0]['value']) !!}</h3>
                                        <i class="ri-arrow-down-s-line text-2xl text-primary-blue flex-shrink-0"></i>
                                    </button>
                                    <div class="faq-content hidden px-6 pb-6">
                                        <p class="text-sm leading-7 text-p-color">{!! DboardHelper::clean($faq[1]['value']) !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            {!! Theme::partial('admin_board.event.event-recently', compact('events')) !!}
        </div>
    </div>
</section>
{{--{!! $workshop->status->toHtml() !!}--}}

<section class="mt-20 lh:mt-0 mb-130 bg-white px-4 lg:mt-32 lg:px-0">
    <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container md:mt-172 sm:px-4 lg:px-0">
        <div class="flex flex-col items-center text-center sm:px-4 lg:px-0">
            <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                @lang('Upcoming')
                <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    @lang('Events')</span>
            </h2>
{{--            <p class="mt-30 max-w-603 font-pop text-base font-normal text-p-color">--}}
{{--                {{ $shortcode->contain }}--}}
{{--            </p>--}}
        </div>

        @php
            $adminBoardRepository = app(\Modules\AdminBoard\Repositories\Interfaces\AdminEventInterface::class);
            $upcoming_event = $adminBoardRepository->advancedGet(array_merge([
                'take' => 1,
                'order_by' => ['start_date' => 'desc'],
            ]));
        @endphp
        <div class="mt-90 justify-between lg:flex sm:px-4 lg:px-0">
            <div class="mb-20 w-full lg:mb-0 lg:w-45">
                <img src="{{ getImageUrl($upcoming_event->photo, 'adminboard/adminevent') }}" alt="{{ $upcoming_event->name }}"
                     class="block h-full w-full rounded-xl object-cover lg:rounded-30" />
            </div>

            <div class="w-full lg:w-45">
                <h3 class="font-pop text-xl font-bold tracking-wide lg:text-22">
                    {{ $upcoming_event->name }}
                </h3>
                <p class="mt-30 line-clamp-3 font-pop text-sm font-normal text-p-color lg:text-base">
                    {!! description_summary($upcoming_event->description) !!}
                </p>

                <div class="mt-42">
                    <div class="mb-5 flex items-center">
                        <span class="mr-4 flex h-8 w-8 items-center justify-center rounded-full bg-background-sky-2 text-lg">
                            <i class="ri-map-pin-fill"></i></span>
                        <p class="font-pop text-sm font-normal text-p-color">
                            {{ $upcoming_event->location }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <span class="mr-4 flex h-8 w-8 items-center justify-center rounded-full bg-background-sky-2 text-lg">
                            <i class="ri-time-fill"></i></span>
                        <p class="font-pop text-sm font-normal text-p-color">
                            {{ $upcoming_event->set_time }}, {{ date('d F Y', strtotime($upcoming_event->start_date)) }}
                        </p>
                    </div>
                </div>

                <a href="{{ $upcoming_event->url }}"
                   class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-30 inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 font-pop text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black">
                    <span class="relative z-10">@lang('View')</span></a>
            </div>
        </div>
        @php
            $recent_events = getRecentAdminEvent($upcoming_event, 4)
        @endphp
        {!! Theme::partial('admin_board.event.items', ['events' => $recent_events, 'img_slider' => true]) !!}

    </div>
</section>
