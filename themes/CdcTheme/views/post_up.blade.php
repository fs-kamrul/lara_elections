@php
    $layout = MetaBox::getMetaData($post, 'layout', true);
    $layout = ($layout && in_array($layout, array_keys(get_blog_single_layouts()))) ? $layout : 'post-full-width';
    Theme::layout($layout);
//    dd($layout);
$columns = 'twelve';
if($layout == 'post-full-width'){
    $columns = 'sixteen';
}
@endphp
@php
    //    $right = $key % 2;
            $path_post = 'uploads/post/';
            $photo = getImageUrl($post->photo);
            if($post->document_file != ''){
                $photo_download = $path_post . $post->document_file;
            }else{
                $photo_download = '';
            }
//            dd(getImageUrl($post->document_file, ));
@endphp


@if($post->post_types->id == 6)
{{--    @php--}}
{{--        $number_of_gallery = $post->PostGalleryParameter->count();--}}
{{--    @endphp--}}
{{--    @if($number_of_gallery)--}}
{{--        <section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">--}}
{{--            <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">--}}
{{--                <h3 class="section_heading">{{ $post->name }}</h3>--}}
{{--                <div class="gallery_main mt_35">--}}
{{--                    <div class="row gallery_row">--}}
{{--                        @foreach($post->PostGalleryParameter as $key=>$gallery)--}}
{{--                            @php--}}
{{--                                $odd_num = 0; if ($key % 2 == 0) { $odd_num = 1; }--}}
{{--                            @endphp--}}
{{--                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">--}}
{{--                                <div class="gallery_img">--}}
{{--                                    <a href="{{ getImageUrl($gallery->name, 'post') }}" target="_blank"><img--}}
{{--                                            src="{{ getImageUrl($gallery->name, 'post') }}" alt="{{ $post->name }}"></a>--}}

{{--                                    <div class="overlay">--}}
{{--                                        <p>{{ $post->name }}</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    @endif--}}
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
                        {!! $post->description !!}
                    </p>
                </div>
            </div>

            <div class="w-5/12">
                <div class="w-444">
                    <div class="w-full h-605">
                        <img src="{{ getImageUrl($post->photo) }}" alt="{{ $post->name }}" class="w-full h-full object-cover rounded-30">
                    </div>

                    <div class="mt-11 text-center px-10">
                        <h2 class="text-xl font-semibold text-blue-950">{{ $post->name }}</h2>
{{--                        <h3 class="mt-3">Adviser, CDC</h3>--}}
                        <p class="mt-8 text-slate-500 leading-relaxed">{{ $post->designation }}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@elseif($post->post_types->id == 4)
    <section class="mt-100 mb-142">
        <div class="xl:max-w-container mx-auto">
            <div class="flex justify-between">
                <div class="w-6/12 pr-10">
                    <h1 class="text-23 font-bold capitalize text-primary-dark lg:text-43">
                        <span
                            class="after:content[''] relative z-20 after:absolute after:bottom-3 after:left-0 after:top-1.5 after:-z-10 after:h-22 after:w-full after:bg-text-highlight lg:after:top-5">
                            {{ $post->name }}
                        </span>
                    </h1>

                    <div class="mt-10">
                        <p class="text-sm font-normal text-p-color-70 lg:text-base !leading-loose">
                            {!! $post->description !!}</p>
                    </div>

                    <div class="mt-44">
                        <a href="#"
                           class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-primary-blue px-5 py-2.5 text-base font-normal uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black first:mr-4">
                            <span class="relative z-10">Book for Appointment</span>
                        </a>

                    </div>
                </div>

                <div class="w-5/12">
                    <div class="w-444 h-full">
                        <img src="{{ getImageUrl($post->photo, 'post') }}" alt="{{ $post->name }}"
                             class="w-full h-full object-cover rounded-30">
                    </div>
                </div>
            </div>
        </div>
    </section>

@elseif($post->post_types->id == 6)
@else
    {{--    twelve--}}

    <section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">
        <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
            <h1 class="mb-10 w-full font-pop text-23 font-extrabold capitalize lg:max-w-542 lg:text-43 lg:leading-58">{{ $post->name }}</h1>
            <div class="details_text raper_text">
                <p class="">{!! $post->description !!}</p>
                @if($post->document_file)
                    <div class="mt-44 flex items-center">
                        <a class="before:btn_clip before:content[''] hover:before:btn_clip_hover relative inline-block overflow-hidden rounded-full bg-btn-blue px-42 py-18 font-pop text-base font-medium uppercase text-white before:absolute before:inset-0 before:duration-500 before:ease-in-out hover:before:bg-black" download=""
                           href="{{ getImageUrl($post->document_file, ) }}"><span class="relative z-10">@lang('Download')</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif

@if($post->post_types->id != 6)
    @php
        $number_of_gallery = $post->PostGalleryParameter->count();
    @endphp
    @if($number_of_gallery)
        <section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">
            <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
                @foreach($post->PostGalleryParameter as $key=>$gallery)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 col-sm-12">
                        <div class="news_events_blog_gallery_img mb_24">
                            <img src="{{ getImageUrl($gallery->name, 'post') }}" alt="{{ $post->name }}">
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endif
@php
    $relatedPosts = get_related_posts($post->id, 3);
@endphp
@if($relatedPosts->count())
    <section class="mb-130 mt-20 bg-white px-4 lg:mt-32 lg:px-0">
        <div class="mx-auto xl:max-w-container lg:max-w-lg-container xs:max-w-xs-container sm:max-w-sm-container px-4 lg:px-0">
                @php
                    $category = '';
                    foreach($post->categories as $value) {
                        $category .= $value->name . ', '; //like this
                    }
                @endphp
                <div class="news_events_top">
                    <h3 class="mt_45">@lang('Explore More') {{ rtrim($category, ", ") }}</h3>
                    {{--                <a class="outline_btn" href="#">@lang('Learn More')</a>--}}
                </div>
                <div class="new_event_main">
                    @include(Theme::getThemeNamespace() . '::views.venue.includes.news-items', ['posts' => $relatedPosts])
                    {{--                @foreach($relatedPosts as $key => $relatedPost)--}}
                    {{--                    <div class="more_venue_item">--}}
                    {{--                        <div class="main_venue_img">--}}
                    {{--                            <img src="{{ getImageUrl($relatedPost->photo) }}" alt="{{ $relatedPost->name }}">--}}
                    {{--                        </div>--}}

                    {{--                        <h2 class="sub_heading_30 blue_text mt_45">{{ $relatedPost->name }}</h2>--}}
                    {{--                        <p class="mt_30">{!! $relatedPost->description !!}</p>--}}
                    {{--                        <a href="{{ url($relatedPost->url) }}" class="outline_btn mt_30">@lang('Learn More')</a>--}}
                    {{--                    </div>--}}
                    {{--                @endforeach--}}
                </div>
        </div>
    </section>
@endif
