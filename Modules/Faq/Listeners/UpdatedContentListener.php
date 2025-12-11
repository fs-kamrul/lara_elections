<?php

namespace Modules\Faq\Listeners;

use Exception;
use Illuminate\Support\Arr;
use MetaBox;
use Modules\KamrulDashboard\Events\UpdatedContentEvent;

class UpdatedContentListener
{
    public function handle(UpdatedContentEvent $event): void
    {
        try {
            if ($event->request->has('content') && $event->request->has('faq_schema_config')) {
                $config = $event->request->input('faq_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'faq_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'faq_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('curriculum_schema_config')) {
                $config = $event->request->input('curriculum_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'curriculum_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'curriculum_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('lessons_video_schema_config')) {
                $config = $event->request->input('lessons_video_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'lessons_video_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'lessons_video_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('courses_learn_schema_config')) {
                $config = $event->request->input('courses_learn_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'courses_learn_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'courses_learn_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('courses_intended_schema_config')) {
                $config = $event->request->input('courses_intended_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'courses_intended_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'courses_intended_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('courses_requirements_schema_config')) {
                $config = $event->request->input('courses_requirements_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'courses_requirements_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'courses_requirements_schema_config', $config);
                }
            }
            if ($event->request->has('content') && $event->request->has('courses_prospects_schema_config')) {
                $config = $event->request->input('courses_prospects_schema_config');
                if (! empty($config)) {
                    foreach ($config as $key => $item) {
                        if (! $item[0]['value'] && ! $item[1]['value']) {
                            Arr::forget($config, $key);
                        }
                    }
                }

                if (empty($config)) {
                    MetaBox::deleteMetaData($event->data, 'courses_prospects_schema_config');
                } else {
                    MetaBox::saveMetaBoxData($event->data, 'courses_prospects_schema_config', $config);
                }
            }
//            if ($event->request->has('content') && $event->request->has('courses_stories_schema_config')) {
//                $config = $event->request->input('courses_stories_schema_config');
//                if (! empty($config)) {
//                    foreach ($config as $key => $item) {
//                        if (! $item[0]['value'] && ! $item[1]['value']) {
//                            Arr::forget($config, $key);
//                        }
//                    }
//                }
//
//                if (empty($config)) {
//                    MetaBox::deleteMetaData($event->data, 'courses_stories_schema_config');
//                } else {
//                    MetaBox::saveMetaBoxData($event->data, 'courses_stories_schema_config', $config);
//                }
//            }
        } catch (Exception $exception) {
            info($exception->getMessage());
        }
    }
}
