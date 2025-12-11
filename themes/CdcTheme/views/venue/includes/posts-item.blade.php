@if ($post)
    <div class="w-full xs:w-4/6 sm:w-45 rounded-26 bg-white pb-28 pl-28 pr-42 pt-30 lg:w-260">
        <div class="flex h-84 w-84 items-center justify-center rounded-full bg-background-sky-2">
            <img src="{{ getImageUrl($post->icon_set) }}" alt="{{ $post->name }}" class="w-54" />
        </div>

        <a href="{{ $post->url }}"
           class="mt-42 inline-block font-pop text-xl font-bold text-black transition duration-200 ease-linear hover:-translate-y-1 hover:text-primary-blue lg:text-22">
            {{ $post->name }}<i class="ri-arrow-right-line ml-15"></i></a>
    </div>
@endif
