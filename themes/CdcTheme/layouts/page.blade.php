{!! Theme::partial('header') !!}

{{--{!! Theme::content() !!}--}}
{{--<section id="course_page">--}}

{{--    @if (Theme::get('hasBreadcrumb', true))--}}
{{--        {!! Theme::partial('breadcrumbs') !!}--}}
{{--    @endif--}}
{{--    {!! Theme::breadcrumb()->render() !!}--}}

<section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">
    <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
        <h1 class="mb-5">{{ SeoHelper::getTitle() }}</h1>

        {!! Theme::content() !!}
    </div>
</section>


{{--</section>--}}

{!! Theme::partial('footer') !!}
