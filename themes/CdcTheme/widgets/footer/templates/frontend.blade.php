
{{--<h5 class="mb-20">{{ $config['name'] }}</h5>--}}
<div class="w-full md:w-3/5 lg:w-3/5 xl:w-9/12 md:flex md:items-center">
    <p class="mb-10   text-xs lg:text-sm font-normal text-slate-400 md:mb-0 ">
        {{ theme_option('copyright') }}
    </p>
</div>
<div class="w-full md:w-2/5 lg:w-2/5 xl:w-3/12 lg:ml-100 mb-20 md:mb-0">
    <ul class="flex gap-6">
        @for ($i = 1; $i <= 5; $i++)
            @if (theme_option('social_' . $i . '_url') && theme_option('social_' . $i . '_name'))
                <li>
                    <a
{{--                        style="background: {{ theme_option('social_' . $i . '_color') }}"--}}
                       href="{{ theme_option('social_' . $i . '_url') }}"
                       class="text-2xl text-white transition duration-150 hover:text-text-highlight"
                       target="_blank"
                       title="{{ theme_option('social_' . $i . '_name') }}">
                        <i class="elegant-icon {{ theme_option('social_' . $i . '_icon') }}"></i>
                    </a>
                </li>
            @endif
        @endfor
    </ul>
</div>
