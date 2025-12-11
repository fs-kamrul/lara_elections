{!! Theme::partial('header') !!}
<!-- --------------- page Start --------------- -->

{{--    @if (Theme::get('hasBreadcrumb', true))--}}
{{--        {!! Theme::partial('breadcrumbs') !!}--}}
{{--    @endif--}}
<section class="mt-100 mb-142 px-4 lg:px-0">
    <div class="xl:max-w-container mx-auto">
        <div class="lg:flex justify-between">
            <div class="lg:w-12/12 lg:pr-10">
                <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43">
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                            {{ SeoHelper::getTitle() }}
                        </span>
                </h1>

                <div class="mt-4 md:mt-6 lg:mt-8">
                    {!! Theme::content() !!}
                </div>
            </div>

{{--            <div class="w-5/12">--}}
{{--                <div class="w-444 h-full">--}}
{{--                    <img src="../dist/images/upcoming-event.png" alt="CDC"--}}
{{--                         class="w-full h-605 object-cover rounded-30">--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</section>

<!-- --------------- page End --------------- -->
{!! Theme::partial('footer') !!}
