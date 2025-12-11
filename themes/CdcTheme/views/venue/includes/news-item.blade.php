@if ($post)

    <div class="w-full xs:w-4/6 sm:w-45 shrink-0 rounded-26 @if($key == 0) bg-primary-dark text-white  @else bg-background-sky-2 text-p-color @endif  px-28 py-30 transition duration-200 ease-linear  hover:text-white hover:bg-primary-blue xl:w-24p lg:w-22p">
        <a href="{{ $post->url }}">
            <p class="font-pop text-50 font-bold">{{ date('d', strtotime($post->start_date)) }}</p>
            <p class="font-pop text-15 font-normal uppercase tracking-wider">
                {{ date('F', strtotime($post->start_date)) }}
            </p>

            <h6 class="mt-30 line-clamp-2 font-pop text-15 font-semibold capitalize leading-6">
                {{ description_summary($post->name, 50) }}
            </h6>

            <div class="mt-30 flex items-center">
                <span class="mr-3 text-lg"><i class="ri-time-fill"></i></span>
                <p class="font-pop text-sm font-normal">{{ $post->set_time }}</p>
            </div>
        </a>
    </div>
@endif
