@isset($post->results)
<section class="bg-white py-85 lg:py-130">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
        <div class="flex flex-col items-center text-center">
            <h2 class="a font-pop text-23 font-bold capitalize text-primary-dark lg:text-43">
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

        @php
            $icon = array(
                'color.png',
                'grow.png',
                'i-planning.png',
                'it.png',
                'i-portfolio.png',
                'research.png',
                'i-intern.png',
                'i-entre.png',
            );
        @endphp
        <div class="mt-85 flex flex-wrap gap-5 xs:justify-center">
            @foreach($post->results as $key=>$value)
                <div class="box-border w-full xs:w-4/6 sm:w-45 rounded-26 bg-background-sky-2 py-28 pl-30 pr-28 lg:w-23p">
                    <div class="flex h-84 w-84 items-center justify-center rounded-full bg-white">
                        <img src="{{ asset('themes/CdcTheme/icons/' . $icon[$key]) }}" alt="color" class="block h-auto w-54" />
                    </div>

                    <a href="https://skill.jobs/browse-jobs?search={{ $value->name }}" target="_blank"
                       class="mr-16 mt-42 block font-pop text-22 font-bold text-black transition duration-200 hover:text-primary-blue">
                        {{ $value->name }}
                    </a>
                    <a class="mt-3 block font-pop text-base font-normal text-p-color">{{ $value->tt_job }} @lang('Vacancies')</a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endisset
