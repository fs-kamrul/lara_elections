@php
    // 1️⃣ Load old input if validation fails
    $oldVideoStories = old('video_stories', []) ?? [];

    // 2️⃣ Load from DB if product exists
    $currentVideoStories = [];
    if (isset($videos) && $videos) {
//        $product = $product->loadMissing(['videoStories']);
        $currentVideoStories = $videos->map(function ($story) {
            return [
                'id' => $story->id,
                'youtube_url' => $story->youtube_url,
                'thumbnail_image' => $story->thumbnail_image,
                'text_story' => $story->text_story,
                'user_name' => $story->user_name,
                'user_designation' => $story->user_designation,
                'user_image' => $story->user_image,
            ];
        })->toArray();
    }
Assets::addScriptsDirectly(['vendor/Modules/KamrulDashboard/js/video-success-stories.js']);
//    dd($videos);
    // 3️⃣ Use old input if available
    if (!empty($oldVideoStories)) {
        $currentVideoStories = $oldVideoStories;
    }

    // 4️⃣ Language flag (optional, similar to product options)
    $isDefaultLanguage = ! defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME') ||
        ! request()->input('ref_lang') ||
        request()->input('ref_lang') == Language::getDefaultLocaleCode();
@endphp


@push('header')
    <script>
        window.videoSuccessStories = {
            videos: {!! Js::from($currentVideoStories) !!},
            routes: {!! Js::from($routes) !!},
            lang: {!! Js::from(trans('kamruldashboard::video-success-stories')) !!},
            isDefaultLanguage: {{ (int) $isDefaultLanguage }}
        }
    </script>
@endpush

{{--<div class="card">--}}
{{--    <div class="card-header">--}}
{{--        <h4 class="card-title">{{ $title }}</h4>--}}
{{--    </div>--}}
{{--    <div class="card-body">--}}
        <div class="video-success-stories-form-wrap">
            <input type="hidden" name="has_video_stories" value="1">
            <div class="accordion" id="accordion-video-stories"></div>

            <div class="mt-3">
                <button type="button" class="btn btn-info add-new-video-story">
                    <i class="fa fa-plus"></i> {{ trans('kamruldashboard::video-success-stories.add_new_story') }}
                </button>
            </div>
        </div>
{{--    </div>--}}
{{--</div>--}}

{{-- Template --}}
<script id="template-video-story" type="text/x-custom-template">
    <div class="accordion-item my-2" data-index="__index__">
        <input type="hidden" name="video_stories[__index__][id]" value="__id__" />
        <h2 class="accordion-header" id="video-story-__index__">
            <button class="accordion-button" type="button" data-toggle="collapse" data-target="#collapse-video-story-__index__" aria-expanded="true">
                {{ trans('kamruldashboard::video-success-stories.story') }} #__index_display__: __user_name__
            </button>
        </h2>
        <div id="collapse-video-story-__index__" class="accordion-collapse collapse show">
            <div class="accordion-body">
{{--                <div class="row mb-3">--}}
{{--                    @if ($isDefaultLanguage)--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label>{{ trans('kamruldashboard::video-success-stories.youtube_url') }}</label>--}}
{{--                            <input type="url" class="form-control" name="video_stories[__index__][youtube_url]" value="__youtube_url__" placeholder="Enter YouTube URL">--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <label>Thumbnail Image</label>--}}
{{--                            <input type="file" class="form-control" name="video_stories[__index__][thumbnail_image]">--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}

                <div class="mb-3">
                    <label>{{ trans('kamruldashboard::video-success-stories.text_story') }}</label>
                    <textarea class="form-control" name="video_stories[__index__][text_story]" rows="3" placeholder="{{ trans('kamruldashboard::video-success-stories.text_story') }}">__text_story__</textarea>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>{{ trans('kamruldashboard::video-success-stories.user_name') }}</label>
                        <input type="text" class="form-control" name="video_stories[__index__][user_name]" value="__user_name__">
                    </div>
                    <div class="col-md-4">
                        <label>{{ trans('kamruldashboard::video-success-stories.user_designation') }}</label>
                        <input type="text" class="form-control" name="video_stories[__index__][user_designation]" value="__user_designation__">
                    </div>
                    @if ($isDefaultLanguage)
                        <div class="col-md-4">
                            <label>{{ trans('kamruldashboard::video-success-stories.user_image') }}</label>
                            <input type="file" class="form-control" name="video_stories[__index__][user_image]">
                        </div>
                    @endif
                </div>

                <div class="text-end">
                    <button type="button" class="btn btn-danger remove-video-story">
                        <i class="fa fa-trash"></i> {{ __('Remove') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</script>
