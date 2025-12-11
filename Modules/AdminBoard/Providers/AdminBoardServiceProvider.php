<?php

namespace Modules\AdminBoard\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\AdminBoard\Enums\AdminStudentGuidelineStatusEnum;
use Modules\AdminBoard\Http\Models\AdminAcademicGroup;
use Modules\AdminBoard\Http\Models\AdminCareerNavigator;
use Modules\AdminBoard\Http\Models\AdminCategory;
use Modules\AdminBoard\Http\Models\AdminClub;
use Modules\AdminBoard\Http\Models\AdminEvent;
use Modules\AdminBoard\Http\Models\AdminFacility;
use Modules\AdminBoard\Http\Models\AdminFtpServer;
use Modules\AdminBoard\Http\Models\AdminGallery;
use Modules\AdminBoard\Http\Models\AdminGalleryBoard;
use Modules\AdminBoard\Http\Models\AdminNews;
use Modules\AdminBoard\Http\Models\AdminNoticeBoard;
use Modules\AdminBoard\Http\Models\AdminPackage;
use Modules\AdminBoard\Http\Models\AdminPartner;
use Modules\AdminBoard\Http\Models\AdminService;
use Modules\AdminBoard\Http\Models\AdminStudentGuideline;
use Modules\AdminBoard\Http\Models\AdminTeam;
use Modules\AdminBoard\Http\Models\AdminWorkshop;
use Modules\AdminBoard\Packages\Facades\AdminBoardFacade;
use Modules\AdminBoard\Packages\Facades\AdminBoardGraphFacade;
use Modules\AdminBoard\Packages\Supports\AdminBoardGraph;
use Modules\KamrulDashboard\Traits\LoadAndPublishDataTrait;
use Modules\LanguageAdvanced\Packages\Supports\LanguageAdvancedManager;
use Modules\Language\Packages\Facades\LanguageFacade;
use Modules\KamrulDashboard\Packages\Supports\Language as BaseLanguage;
use SeoHelper;
use SlugHelper;
use EmailHandler;
//use Language;

class AdminBoardServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'AdminBoard';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'adminboard';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        SlugHelper::registerModule(AdminWorkshop::class, 'Workshop Posts');
        SlugHelper::setPrefix(AdminWorkshop::class, 'workshop', true);

        SlugHelper::registerModule(AdminNews::class, 'News Posts');
        SlugHelper::setPrefix(AdminNews::class, 'news', true);

        SlugHelper::registerModule(AdminEvent::class, 'Event Posts');
        SlugHelper::setPrefix(AdminEvent::class, 'event', true);

        SlugHelper::registerModule(AdminTeam::class, 'Team Posts');
        SlugHelper::setPrefix(AdminTeam::class, 'team', true);

        SlugHelper::registerModule(AdminCategory::class, 'Category Posts');
        SlugHelper::setPrefix(AdminCategory::class, 'category', true);

        SlugHelper::registerModule(AdminCareerNavigator::class, 'Syllabus Posts');
        SlugHelper::setPrefix(AdminCareerNavigator::class, 'syllabus', true);

        SlugHelper::registerModule(AdminFacility::class, 'Facilities Posts');
        SlugHelper::setPrefix(AdminFacility::class, 'facility', true);

        SlugHelper::registerModule(AdminNoticeBoard::class, 'Notice Boards Posts');
        SlugHelper::setPrefix(AdminNoticeBoard::class, 'notice-board', true);

        SlugHelper::registerModule(AdminAcademicGroup::class, 'Academic Group Data');
        SlugHelper::setPrefix(AdminAcademicGroup::class, 'academic-group', true);

        SlugHelper::registerModule(AdminGalleryBoard::class, 'Gallery Board Data');
        SlugHelper::setPrefix(AdminGalleryBoard::class, 'gallery-board', true);

        SlugHelper::registerModule(AdminClub::class, 'AdminClub Data');
        SlugHelper::setPrefix(AdminClub::class, 'clubs', true);

        SlugHelper::registerModule(AdminService::class, 'Service Data');
        SlugHelper::setPrefix(AdminService::class, 'services', true);

        SlugHelper::registerModule(AdminPackage::class, 'Packages Data');
        SlugHelper::setPrefix(AdminPackage::class, 'packages', true);

        SlugHelper::registerModule(AdminFtpServer::class, 'Ftp Server Data');
        SlugHelper::setPrefix(AdminFtpServer::class, 'ftpserver', true);

        SlugHelper::registerModule(AdminPartner::class, 'Ftp Server Data');
        SlugHelper::setPrefix(AdminPartner::class, 'partner', true);

//        SlugHelper::registerModule(AdminStudentGuideline::class, 'Student guidelines Data');
//        SlugHelper::setPrefix(AdminStudentGuideline::class, 'student-guidelines', true);

        $this->setNamespace('Modules/' . $this->moduleName)
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadAndPublishConfigurations(['email','config'])
            ->publishAssets()
//            ->loadRoutes(['web', 'fronts'])
            ->loadHelpers();

        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        $this->app->booted(function () {
            SeoHelper::registerModule([
                AdminWorkshop::class,
                AdminNews::class,
                AdminEvent::class,
                AdminTeam::class,
                AdminNoticeBoard::class,
                AdminAcademicGroup::class,
                AdminGalleryBoard::class,
                AdminClub::class,
                AdminService::class,
                AdminPackage::class,
                AdminFtpServer::class,
                AdminPartner::class,
//                AdminCareerNavigator::class,
//                AdminFacility::class,
            ]);
            EmailHandler::addTemplateSettings(ADMIN_BOARD_MODULE_SCREEN_NAME, config('Modules.AdminBoard.email', []));
        });

//        SiteMapManager::registerKey([
//            'properties-((?:19|20|21|22)\d{2})-(0?[1-9]|1[012])',
//            'projects-((?:19|20|21|22)\d{2})-(0?[1-9]|1[012])',
//            'property-categories',
//            'agents',
//            'properties-city',
//            'projects-city',
//        ]);

        if (defined('LANGUAGE_MODULE_SCREEN_NAME')) {
//            dd($this->app['config']->get('Modules.AdminBoard.config.use_language_v2'));
            if (
                defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME') &&
                $this->app['config']->get('Modules.AdminBoard.config.use_language_v2')
            ) {
                $this->loadRoutes(['language-advanced']);

                LanguageAdvancedManager::registerModule(AdminPartner::class, [
                    'name',
                    'tag_line',
                    'description',
                    'short_description',
                ]);
                LanguageAdvancedManager::registerModule(AdminEvent::class, [
                    'name',
//                    'start_date',
                    'set_time',
                    'content',
                    'short_description',
                    'description',
                ]);
                LanguageAdvancedManager::registerModule(AdminNews::class, [
                    'name',
                    'description',
                    'short_description',
                ]);
//                LanguageAdvancedManager::addTranslatableMetaBox('custom_fields_box');
                if (config('Modules.AdminBoard.config.enable_faq_in_event_details', false)) {
                    LanguageAdvancedManager::addTranslatableMetaBox('faq_schema_config_wrapper');
                    LanguageAdvancedManager::addTranslatableMetaBox('courses_learn_schema_config_wrapper');

                    LanguageAdvancedManager::registerModule(AdminEvent::class, array_merge(
                        LanguageAdvancedManager::getTranslatableColumns(AdminEvent::class),
                        [
                            'faq_schema_config',
                            'courses_learn_schema_config',
                        ]
                    ));
                }


                add_action(LANGUAGE_ADVANCED_ACTION_SAVED, function ($data, $request) {
//                    dd($data);
                    switch (get_class($data)) {
//                        case AdminPartner::class:
//                            break;
//                        case AdminEvent::class:
//                            $options = $request->input('custom_fields', []) ?: [];
//
//                            if (! $options) {
//                                return;
//                            }
//
//                            foreach ($options as $value) {
//                                $newRequest = new Request();
//
//                                $newRequest->replace([
//                                    'language' => $request->input('language'),
//                                    'ref_lang' => LanguageFacade::getRefLang(),
//                                ]);
//
//                                if (! $value['id']) {
//                                    continue;
//                                }
//
//                                $optionValue = CustomFieldValue::query()->find($value['id']);
//
//                                if ($optionValue) {
//                                    $newRequest->merge([
//                                        'name' => $value['name'],
//                                        'value' => $value['value'],
//                                    ]);
//
//                                    LanguageAdvancedManager::save($optionValue, $newRequest);
//                                }
//                            }
//
//                            break;
//                        case CustomField::class:
//
//                            $customFieldOptions = $request->input('options', []) ?: [];
//
//                            if (! $customFieldOptions) {
//                                return;
//                            }
//
//                            $newRequest = new Request();
//
//                            $newRequest->replace([
//                                'language' => $request->input('language'),
//                                'ref_lang' => $request->input('ref_lang'),
//                            ]);
//
//                            foreach ($customFieldOptions as $option) {
//                                if (empty($option['id'])) {
//                                    continue;
//                                }
//
//                                $customFieldOption = CustomFieldOption::query()->find($option['id']);
//
//                                if ($customFieldOption) {
//                                    $newRequest->merge([
//                                        'label' => $option['label'],
//                                        'value' => $option['value'],
//                                    ]);
//
//                                    LanguageAdvancedManager::save($customFieldOption, $newRequest);
//                                }
//                            }
//
//                            break;

                    }
                }, 1234, 2);
            } else {
                Language::registerModule([
                    AdminPartner::class,
                    AdminNews::class,
                    AdminEvent::class,
                ]);
            }
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->singleton('adminboardgraph', function () {
            return new AdminBoardGraph();
        });
//        $this->app->bind(
//            \Modules\AdminBoard\Packages\Supports\AdminBoardGraphContract::class
//        );
        $loader = AliasLoader::getInstance();
        $loader->alias('AdminBoardHelper', AdminBoardFacade::class);
        $loader->alias('AdminBoardGraph', AdminBoardGraphFacade::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/' . $this->moduleNameLower);

        $sourcePath = module_path($this->moduleName, 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ], ['views', $this->moduleNameLower . '-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/' . $this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'Resources/lang'), $this->moduleNameLower);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths;
    }
}
