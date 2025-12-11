<?php

namespace Modules\AdminBoard\Services;


use Modules\AdminBoard\Http\Models\AdminEventVideoStory;

class StoreVideoStoriesService
{
//    public function execute(AdminEventVideoStory $item, $adminEvent): void
    public function execute($request, $adminevent): void
    {
        if (! $adminevent || ! is_object($adminevent)) {
            return;
        }
        if ($request->input('has_video_stories')) {
//                $this->productRepository->saveVideoStories((array)$request->input('video_stories', []), $product);
            $videoStories = (array) $request->input('video_stories', []);
            $videoStoryFiles = (array) $request->file('video_stories', []);

            // Merge file inputs with text inputs
            foreach ($videoStoryFiles as $index => $fileSet) {
                if (!isset($videoStories[$index])) {
                    $videoStories[$index] = [];
                }

                foreach ($fileSet as $fileKey => $fileValue) {
                    if ($fileValue instanceof \Illuminate\Http\UploadedFile) {
                        $videoStories[$index][$fileKey] = $fileValue;
                    }
                }
            }
            $this->saveVideoStories($videoStories, $adminevent);
        }



        if (empty($request->input('has_video_stories'))) {
            return;
        }
    }

    public function saveVideoStories(array $stories, $adminevent)
    {
        try {
            $existingIds = [];

//            dd($adminevent);
            foreach ($stories as $story) {
                $storyModel = null;

                // Update existing
                if (!empty($story['id'])) {
                    $storyModel = $adminevent->videoStories()->find($story['id']);
                }

                if (!$storyModel) {
                    $storyModel = $adminevent->videoStories()->make();
                }

                // Handle file uploads
                if (isset($story['thumbnail_image']) && $story['thumbnail_image'] instanceof \Illuminate\Http\UploadedFile) {
                    $storyModel->thumbnail_image = $story['thumbnail_image']->store('adminboard/video-stories/thumbnails', 'public');
                }

                if (isset($story['user_image']) && $story['user_image'] instanceof \Illuminate\Http\UploadedFile) {
                    $storyModel->user_image = $story['user_image']->store('adminboard/video-stories/users', 'public');
                }

                $storyModel->fill([
                    'youtube_url' => $story['youtube_url'] ?? null,
//                    'thumbnail_image' => $story['thumbnail_image'] ?? null,
                    'text_story' => $story['text_story'] ?? null,
                    'user_name' => $story['user_name'] ?? null,
                    'user_designation' => $story['user_designation'] ?? null,
//                    'user_image' => $story['user_image'] ?? null,
                ]);

                $storyModel->save();

                $existingIds[] = $storyModel->id;
            }

            // Delete removed stories
            if (!empty($existingIds)) {
                $adminevent->videoStories()->whereNotIn('id', $existingIds)->delete();
            } else {
                $adminevent->videoStories()->delete();
            }

        } catch (\Exception $e) {
            info('Error saving video stories: ' . $e->getMessage());
        }
    }
}
