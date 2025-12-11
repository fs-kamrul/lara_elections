<?php

//use Theme;
use Illuminate\Support\Arr;
use Modules\AdminBoard\Repositories\Interfaces\AdminEventInterface;
use Modules\KamrulDashboard\Packages\Supports\DboardStatus;
use Modules\Post\Repositories\Interfaces\CategoryInterface;
use Modules\Post\Repositories\Interfaces\PosttypeInterface;
use Modules\Post\Repositories\Interfaces\PostInterface;
use Modules\Theme\Packages\Supports\ThemeSupport;
use Modules\Faq\Repositories\Interfaces\FaqInterface;
use Modules\Faq\Repositories\Interfaces\FaqCategoryInterface;
use Modules\Ecommerce\Repositories\Interfaces\EcommerceProductCategoryInterface;
use Modules\Ecommerce\Repositories\Interfaces\EcommerceProductCollectionInterface;
use Modules\Mentor\Repositories\Interfaces\MentorInterface;

app()->booted(function () {


    ThemeSupport::registerGoogleMapsShortcode(Theme::getThemeNamespace().'::partials.short-codes');
    ThemeSupport::registerYoutubeShortcode(Theme::getThemeNamespace().'::partials.short-codes');

//    if (is_module_active('Newsletter')) {
//        add_shortcode('newsletter-form', __('Newsletter Form'), __('Newsletter Form'), function ($shortcode) {
//            return Theme::partial('short-codes.newsletter-form', [
//                'title' => $shortcode->title,
//                'description' => $shortcode->description,
//            ]);
//        });
//
//        shortcode()->setAdminConfig('newsletter-form', function ($attributes) {
//            return Theme::partial('short-codes.newsletter-form-admin-config', compact('attributes'));
//        });
//    }
//    if (is_module_active('SimpleSlider')) {
//        add_filter(SIMPLE_SLIDER_VIEW_TEMPLATE, function () {
//            return Theme::getThemeNamespace() . '::partials.short-codes.sliders.main';
//        }, 120);
//    }

    add_shortcode('our-offices', __('Our offices'), __('Our offices'), function () {
        return Theme::partial('short-codes.our-offices');
    });

    shortcode()->setAdminConfig('our-offices', function ($attributes) {
        return Theme::partial('short-codes.our-offices-admin-config', compact('attributes'));
    });
    add_shortcode('mission-vision', __('post::lang.mission_vision'), __('post::lang.mission_vision'), function () {
        return Theme::partial('short-codes.mission-vision');
    });

    shortcode()->setAdminConfig('mission-vision', function ($attributes) {
        return Theme::partial('short-codes.mission-vision-admin-config', compact('attributes'));
    });
    if (is_module_active('ContactForm')) {
        add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace() . '::partials.short-codes.contact-form';
        }, 120);
    }
    if (is_module_active('Admission')) {
        add_filter(ADMISSION_FORM_TEMPLATE_VIEW, function () {
            return Theme::getThemeNamespace() . '::partials.short-codes.admission-form';
        }, 121);
    }
    if (is_module_active('Post')) {

//        add_shortcode('marquee-box', __('Marquee Box'), __('Add Marquee Box'),
//            function ($shortcode) {
//                return Theme::partial('short-codes.marquee-box', ['shortcode' => $shortcode]);
//            });
//
//        shortcode()->setAdminConfig('marquee-box', function ($attributes) {
//            return Theme::partial('short-codes.marquee-box-admin-config', compact('attributes'));
//        });

        add_shortcode('div-start-class', __('Div Class Sections'), __('Add Div Class Sections'),
            function ($shortcode) {
//            if ($shortcode->image != 16)
//            dd($shortcode->image);
            if($shortcode->image != null){
                $bg_image = 'style="background: url('. getImageUrlById($shortcode->image, 'shortcodes') .');"';
            }else{
                $bg_image = '';
            }
//            dd($bg_image);
                return "<section class='" . $shortcode->name . "'  ". $bg_image .">";
//                return Theme::partial('short-codes.div-start-class', ['shortcode' => $shortcode]);
            });
        shortcode()->setAdminConfig('div-start-class', function ($attributes) {
            return Theme::partial('short-codes.div-start-class-admin-config', compact('attributes'));
        });
        add_shortcode('div-end', __('Div End Sections'), __('Add Div End Sections'),
            function ($shortcode) {
                return "</section>";
//                return Theme::partial('short-codes.div-end-class', ['shortcode' => $shortcode]);
            });
        shortcode()->setAdminConfig('div-end', function ($attributes) {
            return Theme::partial('short-codes.div-end-class-admin-config', compact('attributes'));
        });
        add_shortcode('set-image', __('Set Image'), __('Add Set Image'),
            function ($shortcode) {
                return Theme::partial('short-codes.set-image', ['shortcode' => $shortcode]);
            });
        shortcode()->setAdminConfig('set-image', function ($attributes) {
            return Theme::partial('short-codes.set-image-admin-config', compact('attributes'));
        });

        add_shortcode('our-services', __('Our Services'), __('Add Our Services'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.our-services', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('our-services', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.our-services-admin-config', compact('attributes','post_types'));
        });


        if (is_module_active('AdminBoard')) {
            add_shortcode('upcoming-event', __('Upcoming Event'), __('Add Upcoming Event'),
                function ($shortcode) {
                    $attributes = $shortcode->toArray();
                    $adminBoardRepository = app(AdminEventInterface::class);
                    $event = $adminBoardRepository->advancedGet(array_merge([
                        'take' => 1,
                        'order_by' => ['start_date' => 'desc'],
                    ]));
                    $events = AdminBoardHelper::getEventFilter((int) Arr::get($attributes, 'number_of_slide'), []);
//                    dd($events);
                    return Theme::partial('short-codes.upcoming-event', ['shortcode' => $shortcode, 'event' => $event, 'events' => $events]);
                });
            shortcode()->setAdminConfig('upcoming-event', function ($attributes) {
                $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
                return Theme::partial('short-codes.upcoming-event-admin-config', compact('attributes', 'post_types'));
            });
        }
        add_shortcode('programs-section', __('Programs section'), __('Add Programs section'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.programs-section', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('programs-section', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.programs-section-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('need-help', __('Need Help'), __('Add Need Help'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.need-help', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('need-help', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.need-help-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('latest-jobs', __('Latest Jobs'), __('Add Latest Jobs'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $api_data = Arr::get($attributes, 'api_data');
//                dd($api_data);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $api_data,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'my_secret: test'
                    ),
                ));
                $response = curl_exec($curl);
                if ($response === false) {
                    echo 'Curl error: ' . curl_error($curl);
                }
                curl_close($curl);
                $get_data = json_decode($response);
                return Theme::partial('short-codes.latest-jobs', ['shortcode' => $shortcode,'post' => $get_data]);
            });
        shortcode()->setAdminConfig('latest-jobs', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.latest-jobs-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('jobs-category', __('Jobs Category'), __('Add Jobs Category'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $api_data = Arr::get($attributes, 'api_data');
//                dd($api_data);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $api_data,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'my_secret: test'
                    ),
                ));
                $response = curl_exec($curl);
                if ($response === false) {
                    echo 'Curl error: ' . curl_error($curl);
                }
                curl_close($curl);
                $get_data = json_decode($response);
                return Theme::partial('short-codes.jobs-category', ['shortcode' => $shortcode,'post' => $get_data]);
            });
        shortcode()->setAdminConfig('jobs-category', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.jobs-category-admin-config', compact('attributes','post_types'));
        });
//        add_shortcode('notice-board', __('Notice Board'), __('Add Notice Board'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                return Theme::partial('short-codes.notice-board', ['shortcode' => $shortcode,'post_types' => $post_types]);
//            });
//        shortcode()->setAdminConfig('notice-board', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.notice-board-admin-config', compact('attributes','post_types'));
//        });
//        add_shortcode('all-notice-board', __('All Notice Board'), __('Add All Notice Board'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
////                return Theme::partial('short-codes.all-notice-board', ['shortcode' => $shortcode,'post_types' => $post_types]);
//                $posts = $post_types->post()->orderBy('id', 'DESC')->Paginate((int)Arr::get($attributes, 'number_of_slide'));
//                return Theme::partial('short-codes.all-notice-board', ['shortcode' => $shortcode,'posts' => $posts]);
//            });
//        shortcode()->setAdminConfig('all-notice-board', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.all-notice-board-admin-config', compact('attributes','post_types'));
//        });
//        add_shortcode('homepage-box', __('Homepage Box'), __('Add Homepage Box'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $categories = app(CategoryInterface::class)->advancedGet([
//                    'condition' => ['status' => DboardStatus::PUBLISHED],
//                    'order_by'  => ['order' => 'asc'],
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                return Theme::partial('short-codes.homepage-box', ['shortcode' => $shortcode,'categories' => $categories]);
//            });
//        shortcode()->setAdminConfig('homepage-box', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.homepage-box-admin-config', compact('attributes','post_types'));
//        });

        add_shortcode('single-banner-sections', __('Single Banner Sections'), __('Add Single Banner Sections'),
            function ($shortcode) {
                return Theme::partial('short-codes.single-banner-sections', ['shortcode' => $shortcode]);
            });

        shortcode()->setAdminConfig('single-banner-sections', function ($attributes) {
            return Theme::partial('short-codes.single-banner-sections-admin-config', compact('attributes'));
        });
//        add_shortcode('about-us', __('About Us'), __('Add About Us'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
////                $post_types = app(PosttypeInterface::class)
////                    ->findById($shortcode->post_types_id, [
////                        'post' => function ($query) use ($shortcode) {
////                            $query
////                                ->latest()
////                                ->where('status', DboardStatus::PUBLISHED)
////                                ->limit($shortcode->number_of_slide);
////                        },
////                    ]);
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                return Theme::partial('short-codes.about-us', ['shortcode' => $shortcode,'post_types' => $post_types]);
//            });
//        shortcode()->setAdminConfig('about-us', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.about-us-admin-config', compact('attributes','post_types'));
//        });
        add_shortcode('single-section-page', __('Single Section Page'), __('Add Single Section Page'), function ($shortcode) {
            return Theme::partial('short-codes.single-section-page', ['shortcode' => $shortcode]);
        });

        shortcode()->setAdminConfig('single-section-page', function ($attributes) {
            return Theme::partial('short-codes.single-section-page-admin-config', compact('attributes'));
        });


//        add_shortcode('dsc-different', __('DSC Different'), __('Add DSC Different'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                return Theme::partial('short-codes.dsc-different', ['shortcode' => $shortcode,'post_types' => $post_types]);
//            });
//        shortcode()->setAdminConfig('dsc-different', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.dsc-different-admin-config', compact('attributes','post_types'));
//        });
//        add_shortcode('news-event', __('News And Event'), __('Add News And Event'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                $posts = $post_types->post()->orderBy('id', 'DESC')->Paginate((int)Arr::get($attributes, 'number_of_slide'));
//                return Theme::partial('short-codes.news-event', ['shortcode' => $shortcode,'post_types' => $post_types]);
//            });
//        shortcode()->setAdminConfig('news-event', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.news-event-admin-config', compact('attributes','post_types'));
//        });
//        add_shortcode('all-news-event', __('All News And Event'), __('Add All News And Event'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->Paginate(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                $posts = $post_types->post()->orderBy('id', 'DESC')->Paginate((int)Arr::get($attributes, 'number_of_slide'));
//                return Theme::partial('short-codes.all-news-event', ['shortcode' => $shortcode,'posts' => $posts]);
//            });
//        shortcode()->setAdminConfig('all-news-event', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.all-news-event-admin-config', compact('attributes','post_types'));
//        });

        add_shortcode('note-box', __('Note Box'), __('Add Note Box'),
            function ($shortcode) {
                return Theme::partial('short-codes.note-box', ['shortcode' => $shortcode]);
            });

        shortcode()->setAdminConfig('note-box', function ($attributes) {
            return Theme::partial('short-codes.note-box-admin-config', compact('attributes'));
        });

        add_shortcode('photo-gallery', __('Photo Gallery'), __('Add Photo Gallery'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.photo-gallery', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('photo-gallery', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.photo-gallery-admin-config', compact('attributes','post_types'));
        });
//        add_shortcode('banner-sections', __('Banner Sections'), __('Add Banner Sections'),
//            function ($shortcode) {
//                return Theme::partial('short-codes.banner-sections', ['shortcode' => $shortcode]);
//            });
//
//        shortcode()->setAdminConfig('banner-sections', function ($attributes) {
//            return Theme::partial('short-codes.banner-sections-admin-config', compact('attributes'));
//        });
        add_shortcode('our-partners', __('Our Partners'), __('Add Our Partners'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.our-partners', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('our-partners', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.our-partners-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('success-stories', __('Success Stories'), __('Add Success Stories'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.success-stories', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });
        shortcode()->setAdminConfig('success-stories', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.success-stories-admin-config', compact('attributes','post_types'));
        });
//        add_shortcode('upcoming-news', __('Upcoming News'), __('Add Upcoming News'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $category = app(PostInterface::class)->advancedGet([
//                    'condition' => [
//                        'post_types_id' => Arr::get($attributes, 'post_types_id'),
//                        'status' => DboardStatus::PUBLISHED,
//                    ],
//                    'order_by' => [
//                        'created_at' => 'DESC',
//                    ],
//                    'take'      => 1,
//                ]);
//                return Theme::partial('short-codes.upcoming-news', ['shortcode' => $shortcode,'post' => $category]);
//            });
//
//        shortcode()->setAdminConfig('upcoming-news', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.upcoming-news-admin-config', compact('attributes','post_types'));
//        });
//        add_shortcode('our-team', __('Our Team'), __('Add Our Team'),
//            function ($shortcode) {
//                $attributes = $shortcode->toArray();
//                $post_types = app(PosttypeInterface::class)->advancedGet([
//                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
//                    'take'      => 1,
//                    'with'      => [
//                        'post' => function ($query) use ($attributes) {
//                            return $query
//                                ->latest()
//                                ->where('status', DboardStatus::PUBLISHED)
//                                ->limit(Arr::get($attributes, 'number_of_slide'));
//                        },
//                    ],
//                ]);
//                return Theme::partial('short-codes.our-team', ['shortcode' => $shortcode,'post_types' => $post_types]);
//            });
//        shortcode()->setAdminConfig('our-team', function ($attributes) {
//            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
//            return Theme::partial('short-codes.our-team-admin-config', compact('attributes','post_types'));
//        });
        add_shortcode('testimonial', __('Testimonial'), __('Add Testimonial'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.testimonial', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });

        shortcode()->setAdminConfig('testimonial', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.testimonial-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('testimonial-all', __('Testimonial All'), __('Add Testimonial All'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.testimonial-all', ['shortcode' => $shortcode,'posts' => $post_types->post()->paginate((int)Arr::get($attributes, 'number_of_slide'))]);
            });

        shortcode()->setAdminConfig('testimonial-all', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.testimonial-all-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('partners', __('Partners'), __('Add Partners'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $post_types = app(PosttypeInterface::class)->advancedGet([
                    'condition' => ['post_types.id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 1,
                    'with'      => [
                        'post' => function ($query) use ($attributes) {
                            return $query
                                ->latest()
                                ->where('status', DboardStatus::PUBLISHED)
                                ->limit(Arr::get($attributes, 'number_of_slide'));
                        },
                    ],
                ]);
                return Theme::partial('short-codes.partners', ['shortcode' => $shortcode,'post_types' => $post_types]);
            });

        shortcode()->setAdminConfig('partners', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.partners-admin-config', compact('attributes','post_types'));
        });
        add_shortcode('resources-news', __('Resources News'), __('Add Resources News'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $category = app(PostInterface::class)->advancedGet([
                    'condition' => ['post_types_id' => Arr::get($attributes, 'post_types_id')],
                    'take'      => 3,
                ]);
                return Theme::partial('short-codes.resources-news', ['shortcode' => $shortcode,'posts' => $category]);
        });
        shortcode()->setAdminConfig('resources-news', function ($attributes) {
            $post_types = app(PosttypeInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.resources-news-admin-config', compact('attributes','post_types'));
        });

        add_shortcode('faq-option', __('Our FAQ Option'), __('Add FAQ Option'),
            function ($shortcode) {
                Theme::asset()->container('footer')->usePath()->add('faq_page', 'js/faq_page.js');
//                $attributes = $shortcode->toArray();
//                $faqs = app(FaqInterface::class)->advancedGet([
//                    'condition' => ['category_id' => Arr::get($attributes, 'category_id')],
////                    'take'      => 1,
////                    'with'      => [
////                        'faqs' => function ($query) {
////                            return $query
////                                ->latest()
////                                ->where('status', DboardStatus::PUBLISHED);
////                        },
////                    ],
//                ]);
                $faq_categories = app(FaqCategoryInterface::class)->advancedGet([
//                    'condition' => ['category_id' => Arr::get($attributes, 'category_id')],
                    'condition' => ['status' => Dboardstatus::PUBLISHED],
                    'order_by' => [
                        'order' => 'ASC',
                    ],
//                    'take'      => 1,\
                    'with'      => ['faqs' => function ($q) {
                        $q->where('status', Dboardstatus::PUBLISHED)
                            ->orderBy('created_at', 'ASC');
                    }],
                ]);
                return Theme::partial('short-codes.faq-option', ['shortcode' => $shortcode,'faq_categories' => $faq_categories]);
            });

        shortcode()->setAdminConfig('faq-option', function ($attributes) {
            $categories = app(FaqCategoryInterface::class)->allBy(['status' => Dboardstatus::PUBLISHED]);
            return Theme::partial('short-codes.faq-option-admin-config', compact('attributes','categories'));
        });
        add_shortcode('contact-us', __('Contact Us'), __('Add Contact Us'),
            function ($shortcode) {
                $attributes = $shortcode->toArray();
                $contact = app(MentorInterface::class)->advancedGet([
                    'condition' => ['status' => DboardStatus::PUBLISHED],
//                    'take'      => 1,
//                    'paginate'  => [
//                        'per_page'      => Arr::get($attributes, 'number_of_course'),
//                        'current_paged' => 1,
//                    ],
                    'with'      => ['slugable'],
                ]);
                return Theme::partial('short-codes.contact-us', ['title' => $shortcode->title,'image' => $shortcode->image,'contact' => $contact]);
            });
        shortcode()->setAdminConfig('contact-us', function ($attributes) {
            return Theme::partial('short-codes.contact-us-admin-config', compact('attributes'));
        });
    }
});
