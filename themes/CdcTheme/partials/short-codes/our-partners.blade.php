<section class="bg-black pb-24 pt-42">
    <div
        class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container md:max-w-md-container px-4 lg:px-0">
        <h6 class="font-pop text-lg font-normal text-white sm:text-center lg:text-left">
            {{ $shortcode->title }}
        </h6>

        <div class="mt-20">
            <div class="logos group relative overflow-hidden whitespace-nowrap px-0">
                <div class="group-hover:pause logos-slide group inline-block animate-slide-logo">
                    @foreach($post_types->post as $post)
                    <img src="{{ getImageUrl($post->photo) }}" class="mx-7 inline h-10 w-auto max-w-none" alt="{{ $post->name }}" />
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
