<a href="{{ $news->url }}">
    <p class="  text-50 font-bold">{{ date('d', strtotime($news->start_date)) }}</p>
    <p class="  text-15 font-normal uppercase tracking-wider">
        {{ date('F, Y', strtotime($news->start_date)) }}
    </p>

    <a href="{{ $news->url }}" class="mt-30 line-clamp-2   text-15 font-semibold capitalize leading-6">
        {{ $news->name }}
    </a>
    @if($news->set_time)
        <div class="mt-30 flex items-center">
            <span class="mr-3 text-lg"><i class="ri-time-fill"></i></span>
            <p class="  text-sm font-normal"> {{ $news->set_time }}</p>
        </div>
    @endif
</a>
