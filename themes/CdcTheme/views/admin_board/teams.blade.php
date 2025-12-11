<section class="mt-100 mb-142">
    <div class="mx-auto xl:max-w-container lg:max-w-lg-container px-4 lg:px-0">
        <!-- Section Title -->
        <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43 text-center">
            @lang('Our')
            <span
                class="inline-block after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                @lang('Teams')</span>
        </h1>

        <div class="mt-60 flex flex-wrap justify-center gap-x-8 gap-y-16">

            @foreach($teams as $key=>$team)
                {!! Theme::partial('admin_board.team.item', ['team' => $team, 'img_slider' => true]) !!}
            @endforeach
            @if ($teams->total() > 0)
                {!! $teams->links(Theme::getThemeNamespace() . '::partials.admin_board.pagination') !!}
            @endif
        </div>
    </div>
</section>


