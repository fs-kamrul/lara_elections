<?php

namespace Modules\AdminBoard\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\AdminBoard\Http\Models\AdminBoard;
use Modules\AdminBoard\Repositories\Cache\AdminBoardCacheDecorator;
use Modules\AdminBoard\Repositories\Eloquent\AdminBoardRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminBoardInterface;
//add_new_line_Interface_and_Repository_call
use Modules\AdminBoard\Http\Models\AdminType;
use Modules\AdminBoard\Repositories\Eloquent\AdminTypeRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminTypeInterface;
use Modules\AdminBoard\Repositories\Cache\AdminTypeCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminFtpServer;
use Modules\AdminBoard\Repositories\Eloquent\AdminFtpServerRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminFtpServerInterface;
use Modules\AdminBoard\Repositories\Cache\AdminFtpServerCacheDecorator;
use Modules\AdminBoard\Http\Models\FtpServer;
use Modules\AdminBoard\Repositories\Eloquent\FtpServerRepository;
use Modules\AdminBoard\Repositories\Interfaces\FtpServerInterface;
use Modules\AdminBoard\Repositories\Cache\FtpServerCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminPackage;
use Modules\AdminBoard\Repositories\Eloquent\AdminPackageRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminPackageInterface;
use Modules\AdminBoard\Repositories\Cache\AdminPackageCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminService;
use Modules\AdminBoard\Repositories\Eloquent\AdminServiceRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminServiceInterface;
use Modules\AdminBoard\Repositories\Cache\AdminServiceCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminClub;
use Modules\AdminBoard\Repositories\Eloquent\AdminClubRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminClubInterface;
use Modules\AdminBoard\Repositories\Cache\AdminClubCacheDecorator;
use Modules\AdminBoard\Http\Models\Club;
use Modules\AdminBoard\Repositories\Eloquent\ClubRepository;
use Modules\AdminBoard\Repositories\Interfaces\ClubInterface;
use Modules\AdminBoard\Repositories\Cache\ClubCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminGalleryBoard;
use Modules\AdminBoard\Repositories\Eloquent\AdminGalleryBoardRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminGalleryBoardInterface;
use Modules\AdminBoard\Repositories\Cache\AdminGalleryBoardCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminGallery;
use Modules\AdminBoard\Repositories\Eloquent\AdminGalleryRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminGalleryInterface;
use Modules\AdminBoard\Repositories\Cache\AdminGalleryCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminStudentGuideline;
use Modules\AdminBoard\Repositories\Eloquent\AdminStudentGuidelineRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminStudentGuidelineInterface;
use Modules\AdminBoard\Repositories\Cache\AdminStudentGuidelineCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminAcademicGroup;
use Modules\AdminBoard\Repositories\Eloquent\AdminAcademicGroupRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminAcademicGroupInterface;
use Modules\AdminBoard\Repositories\Cache\AdminAcademicGroupCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminEducation;
use Modules\AdminBoard\Repositories\Eloquent\AdminEducationRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminEducationInterface;
use Modules\AdminBoard\Repositories\Cache\AdminEducationCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminNoticeBoard;
use Modules\AdminBoard\Repositories\Eloquent\AdminNoticeBoardRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminNoticeBoardInterface;
use Modules\AdminBoard\Repositories\Cache\AdminNoticeBoardCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminPartner;
use Modules\AdminBoard\Repositories\Eloquent\AdminPartnerRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminPartnerInterface;
use Modules\AdminBoard\Repositories\Cache\AdminPartnerCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminTestimonial;
use Modules\AdminBoard\Repositories\Eloquent\AdminTestimonialRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminTestimonialInterface;
use Modules\AdminBoard\Repositories\Cache\AdminTestimonialCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminFacility;
use Modules\AdminBoard\Repositories\Eloquent\AdminFacilityRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminFacilityInterface;
use Modules\AdminBoard\Repositories\Cache\AdminFacilityCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminCareerNavigator;
use Modules\AdminBoard\Repositories\Eloquent\AdminCareerNavigatorRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminCareerNavigatorInterface;
use Modules\AdminBoard\Repositories\Cache\AdminCareerNavigatorCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminCategory;
use Modules\AdminBoard\Repositories\Eloquent\AdminCategoryRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminCategoryInterface;
use Modules\AdminBoard\Repositories\Cache\AdminCategoryCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminTeam;
use Modules\AdminBoard\Repositories\Eloquent\AdminTeamRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminTeamInterface;
use Modules\AdminBoard\Repositories\Cache\AdminTeamCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Modules\AdminBoard\Repositories\Eloquent\AdminEventRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminEventInterface;
use Modules\AdminBoard\Repositories\Cache\AdminEventCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminNews;
use Modules\AdminBoard\Repositories\Eloquent\AdminNewsRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminNewsInterface;
use Modules\AdminBoard\Repositories\Cache\AdminNewsCacheDecorator;
use Modules\AdminBoard\Http\Models\AdminWorkshop;
use Modules\AdminBoard\Repositories\Eloquent\AdminWorkshopRepository;
use Modules\AdminBoard\Repositories\Interfaces\AdminWorkshopInterface;
use Modules\AdminBoard\Repositories\Cache\AdminWorkshopCacheDecorator;
use Modules\AdminBoard\Services\HandleFrontPages;
use Modules\KamrulDashboard\Http\Models\Slug;
use Modules\Post\Http\Models\Page;
use Assets;
use MetaBox;
use Route;
use DboardHelper;
use Html;

class HookServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AdminBoardInterface::class, function () {
            return new AdminBoardCacheDecorator(
                new AdminBoardRepository(new AdminBoard)
            );
        });
//add_new_line_Interface_and_Repository_to_hook
        $this->app->bind(AdminTypeInterface::class, function () {
            return new AdminTypeCacheDecorator(
                new AdminTypeRepository(new AdminType)
            );
        });

        $this->app->bind(AdminFtpServerInterface::class, function () {
            return new AdminFtpServerCacheDecorator(
                new AdminFtpServerRepository(new AdminFtpServer)
            );
        });

        $this->app->bind(AdminPackageInterface::class, function () {
            return new AdminPackageCacheDecorator(
                new AdminPackageRepository(new AdminPackage)
            );
        });

        $this->app->bind(AdminServiceInterface::class, function () {
            return new AdminServiceCacheDecorator(
                new AdminServiceRepository(new AdminService)
            );
        });

        $this->app->bind(AdminClubInterface::class, function () {
            return new AdminClubCacheDecorator(
                new AdminClubRepository(new AdminClub)
            );
        });

        $this->app->bind(AdminGalleryBoardInterface::class, function () {
            return new AdminGalleryBoardCacheDecorator(
                new AdminGalleryBoardRepository(new AdminGalleryBoard)
            );
        });

        $this->app->bind(AdminGalleryInterface::class, function () {
            return new AdminGalleryCacheDecorator(
                new AdminGalleryRepository(new AdminGallery)
            );
        });

        $this->app->bind(AdminStudentGuidelineInterface::class, function () {
            return new AdminStudentGuidelineCacheDecorator(
                new AdminStudentGuidelineRepository(new AdminStudentGuideline)
            );
        });

        $this->app->bind(AdminAcademicGroupInterface::class, function () {
            return new AdminAcademicGroupCacheDecorator(
                new AdminAcademicGroupRepository(new AdminAcademicGroup)
            );
        });

        $this->app->bind(AdminEducationInterface::class, function () {
            return new AdminEducationCacheDecorator(
                new AdminEducationRepository(new AdminEducation)
            );
        });

        $this->app->bind(AdminNoticeBoardInterface::class, function () {
            return new AdminNoticeBoardCacheDecorator(
                new AdminNoticeBoardRepository(new AdminNoticeBoard)
            );
        });

        $this->app->bind(AdminPartnerInterface::class, function () {
            return new AdminPartnerCacheDecorator(
                new AdminPartnerRepository(new AdminPartner)
            );
        });

        $this->app->bind(AdminTestimonialInterface::class, function () {
            return new AdminTestimonialCacheDecorator(
                new AdminTestimonialRepository(new AdminTestimonial)
            );
        });

        $this->app->bind(AdminFacilityInterface::class, function () {
            return new AdminFacilityCacheDecorator(
                new AdminFacilityRepository(new AdminFacility)
            );
        });

        $this->app->bind(AdminCareerNavigatorInterface::class, function () {
            return new AdminCareerNavigatorCacheDecorator(
                new AdminCareerNavigatorRepository(new AdminCareerNavigator)
            );
        });

        $this->app->bind(AdminCategoryInterface::class, function () {
            return new AdminCategoryCacheDecorator(
                new AdminCategoryRepository(new AdminCategory)
            );
        });

        $this->app->bind(AdminTeamInterface::class, function () {
            return new AdminTeamCacheDecorator(
                new AdminTeamRepository(new AdminTeam)
            );
        });

        $this->app->bind(AdminEventInterface::class, function () {
            return new AdminEventCacheDecorator(
                new AdminEventRepository(new AdminEvent)
            );
        });

        $this->app->bind(AdminNewsInterface::class, function () {
            return new AdminNewsCacheDecorator(
                new AdminNewsRepository(new AdminNews)
            );
        });

        $this->app->bind(AdminWorkshopInterface::class, function () {
            return new AdminWorkshopCacheDecorator(
                new AdminWorkshopRepository(new AdminWorkshop)
            );
        });


        $this->app->booted(function () {

//            $pages = Page::query()->wherePublished()->pluck('name', 'id')->all();
            add_filter(BASE_FILTER_PUBLIC_SINGLE_DATA, [$this, 'handleSingleView'], 30);


            add_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, function ($screen, $object) {
                add_filter(THEME_FRONT_HEADER, function ($html) use ($object) {
                    if (! defined('FAQ_MODULE_SCREEN_NAME') ||
                        get_class($object) != AdminEvent::class ||
                        ! config('adminboard.enable_faq_in_event_details', false)
                    ) {
                        return $html;
                    }
//                    dd(get_class($object));

                    $value = MetaBox::getMetaData($object, 'faq_schema_config', true);

                    if (! $value || ! is_array($value)) {
                        return $html;
                    }

                    if (! empty($value)) {
                        foreach ($value as $key => $item) {
                            if (! $item[0]['value'] && ! $item[1]['value']) {
                                Arr::forget($value, $key);
                            }
                        }
                    }

                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'FAQPage',
                        'mainEntity' => [],
                    ];

                    foreach ($value as $item) {
                        $schema['mainEntity'][] = [
                            '@type' => 'Question',
                            'name' => DboardHelper::clean($item[0]['value']),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => DboardHelper::clean($item[1]['value']),
                            ],
                        ];
                    }

                    $schema = json_encode($schema);

                    return $html . Html::tag('script', $schema, ['type' => 'application/ld+json'])->toHtml();
                }, 139);

                add_filter(THEME_FRONT_HEADER, function ($html) use ($object) {
                    if (get_class($object) != AdminEvent::class) {
                        return $html;
                    }
//                    dd($object);
                    $logo_image = theme_option('logo');
                    $schema = [
                        '@context' => 'https://schema.org',
                        '@type' => 'Event',
                        'name' => DboardHelper::clean($object->name),
                        'url' => $object->url,
                        'description' => DboardHelper::clean(strip_tags($object->description)),
                        'image' => getImageUrl($object->photo, 'adminboard/adminevent'),
                        'startDate' => $object->start_date,
                        'eventStatus' => $object->status,
                        'inLanguage' => 'en',
                        'isAccessibleForFree' => true,

                        'organizer' => [
                            '@type' => 'Organization',
                            'name' => theme_option('site_title'),
                            'url' => $object->url,
                            'logo' => getImageUrlById($logo_image, 'shortcodes'),
//                            'sameAs' => ["https://facebook.com/organizer", "https://x.com/organizer"],
                        ],
                    ];

                    $schema = json_encode($schema);

                    return $html . Html::tag('script', $schema, ['type' => 'application/ld+json'])->toHtml();
                });
            }, 139, 2);

            theme_option()
                ->setSection([
                    'title' => __('Admin Board'),
                    'desc' => __('Theme options for Admin Board'),
                    'id' => 'opt-text-subsection-admin-board',
                    'subsection' => true,
                    'icon' => 'ti ti-briefcase',
                ])
                ->setField([
                    'id' => 'number_of_workshops_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of workshops per page'),
                    'attributes' => [
                        'name' => 'number_of_workshops_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id'         => 'admin-layout',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type'       => 'select',
                    'label'      => __('Default Workshop Layout'),
                    'attributes' => [
                        'name'    => 'admin-layout',
                        'list'    => get_admin_board_layouts(),
                        'value'   => 'blog-full-width',
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_news_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of News per page'),
                    'attributes' => [
                        'name' => 'number_of_news_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_event_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Events per page'),
                    'attributes' => [
                        'name' => 'number_of_event_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_team_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Team per page'),
                    'attributes' => [
                        'name' => 'number_of_team_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'facilitators_of_team_event_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'select',
                    'label' => __('Facilitators of team event page'),
                    'attributes' => [
                        'name' => 'facilitators_of_team_event_page',
                        'list'    => get_category_adminboard_layouts('team'),
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_career_navigators_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Career Navigators per page'),
                    'attributes' => [
                        'name' => 'number_of_career_navigators_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_notice_boards_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Notice Board per page'),
                    'attributes' => [
                        'name' => 'number_of_notice_boards_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_academic_group_boards_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of academic_group Board per page'),
                    'attributes' => [
                        'name' => 'number_of_academic_group_boards_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_events_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Events per page'),
                    'attributes' => [
                        'name' => 'number_of_events_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_admin_gallery_boards_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Gallery Board per page'),
                    'attributes' => [
                        'name' => 'number_of_admin_gallery_boards_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_admin_service_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Service per page'),
                    'attributes' => [
                        'name' => 'number_of_admin_service_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_admin_package_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Service per page'),
                    'attributes' => [
                        'name' => 'number_of_admin_package_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_admin_ftpserver_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Ftp Server per page'),
                    'attributes' => [
                        'name' => 'number_of_admin_ftpserver_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ])
                ->setField([
                    'id' => 'number_of_admin_partner_per_page',
                    'section_id' => 'opt-text-subsection-admin-board',
                    'type' => 'number',
                    'label' => __('Number of Partner per page'),
                    'attributes' => [
                        'name' => 'number_of_admin_partner_per_page',
                        'value' => 12,
                        'options' => [
                            'class' => 'form-control',
                        ],
                    ],
                ]);
            //admin-layout
//                ->setField([
//                    'id' => 'projects_list_page_id',
//                    'section_id' => 'opt-text-subsection-real-estate',
//                    'type' => 'customSelect',
//                    'label' => __('Projects List page'),
//                    'attributes' => [
//                        'name' => 'projects_list_page_id',
//                        'list' => ['' => __('-- Select --')] + $pages,
//                        'value' => '',
//                        'options' => [
//                            'class' => 'form-control',
//                        ],
//                    ],
//                ]);
        });


//        dd(is_module_active('Faq'));
//        dd(config('adminboard.enable_faq_in_event_details', false));
        if (is_module_active('Faq') && config(
                'adminboard.enable_faq_in_event_details',
                false
            )) {
            add_action(BASE_ACTION_META_BOXES, function ($context, $object) {
                if (! $object || $context != 'advanced') {
                    return false;
                }
                if (! is_in_admin() || get_class($object) != AdminEvent::class) {
                    return false;
                }
                if (! in_array(Route::currentRouteName(), ['adminevent.create', 'adminevent.edit'])) {
                    return false;
                }

                Assets::addStylesDirectly(['vendor/Modules/Faq/css/faq.css'])
                    ->addScriptsDirectly(['vendor/Modules/Faq/js/faq.js']);
//                    ->addScriptsDirectly(['vendor/Modules/Faq/js/lessons_video.js']);
                Assets::addScriptsDirectly(['vendor/Modules/Faq/js/courses_learn.js']);

                MetaBox::addMetaBox('faq_schema_config_wrapper', __('Event FAQs'), function () {
                    $value = [];

                    $args = func_get_args();
                    if ($args[0] && $args[0]->id) {
                        $value = MetaBox::getMetaData($args[0], 'faq_schema_config', true);
                    }

                    $hasValue = ! empty($value);

                    $value = json_encode((array)$value);

                    return view('faq::schema-config-box', compact('value', 'hasValue'))->render();
                }, get_class($object), $context);
                MetaBox::addMetaBox('courses_learn_schema_config_wrapper', __('Event Breakdown'), function () {
                    $value = [];

                    $args = func_get_args();
                    if ($args[0] && $args[0]->id) {
                        $value = MetaBox::getMetaData($args[0], 'courses_learn_schema_config', true);
                    }

                    $hasValue = ! empty($value);

                    $value = json_encode((array)$value);

                    return view('faq::courses-learn-schema-config-box', compact('value', 'hasValue'))->render();
                }, get_class($object), $context);
//                dd(config('adminboard.enable_faq_in_event_details', false));
            }, 140, 2);
        }

    }

    public function handleSingleView($slug)
    {
        return (new HandleFrontPages())->handle($slug);
    }
}
