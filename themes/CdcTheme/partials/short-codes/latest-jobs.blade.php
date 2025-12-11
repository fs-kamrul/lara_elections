@isset($post->results)
<section class="bg-background-sky-2 py-85 lg:py-100">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container md:max-w-md-container px-4 lg:px-0">
        <div class="flex flex-col items-center text-center">
            <h2 class="font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
                {{ $shortcode->title }}
                <span
                    class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                    {{ $shortcode->tag_line }}
                </span>
            </h2>
            <p class="mt-30 max-w-603 font-pop text-sm font-normal text-p-color lg:text-base">
                {{ $shortcode->contain }}
            </p>
        </div>

        <div class="mt-85 flex flex-wrap gap-5 xs:justify-center">

            @foreach($post->results as $value)
                <div class="w-full xs:w-4/6 sm:w-45 rounded-26 bg-white px-5 py-6 lg:w-32 lg:px-6 lg:pb-8 lg:pt-10">
                    <a href="https://skill.jobs/jobs/{{ $value->slug }}" target="_blank"
                       class="line-clamp-1 block font-pop text-xl font-bold text-black transition duration-150 hover:text-primary-blue">
                        {{ $value->title }}
                    </a>

                    <div class="mt-5 flex gap-5">
                        <p class="clear-left line-clamp-1 font-pop text-base font-normal text-p-color">
                            <i class="ri-map-pin-fill mr-2"></i>{{ $value->division }}
                        </p>
                        <p class="clear-left line-clamp-1 font-pop text-base text-p-color">
                            <i class="ri-briefcase-fill mr-2"></i>{{ $value->type }}
                        </p>
                    </div>

                    <div class="mt-10 flex items-center">
                        <div
                            class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-background-sky-2 lg:h-20 lg:w-20">
                            <img src="https://studio.skill.jobs/{{ $value->company_info->logo }}" alt="logo" class="block h-auto w-10 lg:w-14"/>
                        </div>
                        <div class="ml-2 lg:ml-5">
                            <a href="@if($value->company_info->slug)https://skill.jobs/company-profile/{{ $value->company_info->slug }}@else # @endif" target="_blank"
                               class="line-clamp-2 block font-pop text-sm font-semibold text-black transition duration-200 hover:text-primary-blue lg:text-base">
                                {{ $value->company_info->name }}
                            </a>
                            <a href="#"
                               class="mt-1.5 block font-pop text-sm font-normal text-p-color lg:mt-10s lg:text-base">
                                5 Vacancies</a>
                        </div>
                    </div>
                    <a href="https://skill.jobs/jobs/{{ $value->slug }}" target="_blank"
                       class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-10 inline-block overflow-hidden rounded-full border border-btn-blue bg-white px-5 py-10s font-pop text-lg font-medium uppercase text-btn-blue before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:text-white hover:before:bg-black">
                        <span class="relative z-10">@lang('Apply now')</span></a>
                </div>
            @endforeach

        </div>

        <div class="text-center">
            <a href="{{ $shortcode->button_url1 }}"
               class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative mt-20 inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 font-pop text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black lg:mt-100">
                <span class="relative z-10">{{ $shortcode->button_label1 }}</span>
            </a>
        </div>
    </div>
</section>
@endisset
