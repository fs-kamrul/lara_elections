<section class="mt-100 mb-142">
    <div class="xl:max-w-container mx-auto">
        <div class="flex justify-between">
            <div class="w-6/12 pr-10">
                <h1 class=" text-23 font-bold capitalize text-primary-dark lg:text-43">
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">@lang('Message')</span>
                </h1>

                <div class="mt-10 text-sm font-normal text-p-color lg:text-base mb-18 lg:leading-loose">
                    <p class="mb-5">
                        {!! clean($team->description) !!}
                    </p>
                </div>
            </div>

            <div class="w-5/12">
                <div class="w-444">
                    <div class="w-full h-605">
                        <img src="{{ getImageUrl($team->photo,'adminboard/adminteam') }}" alt="{{ $team->name }}" class="w-full h-full object-cover rounded-30">
                    </div>

                    <div class="mt-11 text-center px-10">
                        <h2 class="text-xl font-semibold text-blue-950">{{ $team->name }}</h2>
                        <h3 class="mt-3">{{ $team->designation }}</h3>
                        <p class="mt-8 text-slate-500 leading-relaxed">
                            {{ $team->email }} <br/>  {{ $team->phone }}
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

