<a @if($career_navigator->document != null) href="{{ $career_navigator->document }}" target="_blank"  @endif>
{{--    <p class="  text-50 font-bold">{{ date('d', strtotime($career_navigator->start_date)) }}</p>--}}
{{--    <p class="  text-15 font-normal uppercase tracking-wider">--}}
{{--        {{ date('F', strtotime($career_navigator->start_date)) }}--}}
{{--    </p>--}}

    <a @if($career_navigator->document != null) href="{{ getImageUrl($career_navigator->document, 'adminboard/admincareernavigator') }}" target="_blank"  @endif class="mt-30 line-clamp-2   text-15 font-semibold capitalize leading-6">
        {{ $career_navigator->name }}
    </a>
    @if($career_navigator->start_date)
        <div class="mt-30 flex items-center">
            <span class="mr-3 text-lg"><i class="ri-time-fill"></i></span>
            <p class="  text-sm font-normal"> {{ date('d M Y', strtotime($career_navigator->start_date)) }}</p>
        </div>
    @endif
</a>

