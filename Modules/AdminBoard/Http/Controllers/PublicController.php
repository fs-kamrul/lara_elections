<?php

namespace Modules\AdminBoard\Http\Controllers;

use Assets;
use Illuminate\Http\Request;
use Modules\AdminBoard\Repositories\Interfaces\AdminCategoryInterface;
use Modules\KamrulDashboard\Http\Controllers\DboardController;
use Theme;
use SeoHelper;
use AdminBoardHelper;

class PublicController extends DboardController
{
    public function getWorkshop(Request $request)
    {
        SeoHelper::setTitle(__('Workshop'));

        $workshops = AdminBoardHelper::getWorkshopFilter((int) theme_option('number_of_workshops_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($workshop, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $workshops]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.projects.items', compact('workshops')));
        }
//        dd($projects);

        return Theme::scope('admin_board.workshops', compact('workshops'), 'pag')->render();
    }
    public function getNoticeBoard(Request $request)
    {
//        Asset::
        SeoHelper::setTitle(__('adminboard::lang.adminnoticeboard'));

        $notice_boards = AdminBoardHelper::getNoticeBoardFilter((int) theme_option('number_of_notice_boards_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($notice_board, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);

        Theme::asset()
            ->container('footer')
            ->usePath(false)
            ->add('notice_boards', url('vendor/Modules/AdminBoard/js/notice_boards.js'),
                ['jquery'], [], '1.0.0');
//        Theme::asset()->container('footer')->add('notice_boards', '');
//                Assets::addScriptsDirectly('vendor/Modules/AdminBoard/js/notice_boards.js');
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminnoticeboard'));
        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $notice_boards]));
            }
            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.notice_boards.items', compact('notice_boards')));
        }
//        dd($projects);

        return Theme::scope('admin_board.notice_boards', compact('notice_boards'), 'pag')->render();
    }
    public function filterNoticeBoard(Request $request)
    {
        // Get the category ID and search query from the request
        $categoryId = $request->input('category_id');
        $searchQuery = $request->input('search_query');

        $notice_boards = AdminBoardHelper::getNoticeBoardFilter((int) theme_option('number_of_notice_boards_per_page') ?: 12, []);
//        if ($searchQuery) {
//            $notice_boards->where(function($q) use ($searchQuery) {
//                $q->where('name', 'like', '%' . $searchQuery . '%');
////                    ->orWhere('short_description', 'like', '%' . $searchQuery . '%');
//            });
//        }
//        dd($notice_boards);
        return $this
            ->httpResponse()
            ->setData(Theme::partial('admin_board.notice_boards.items', compact('notice_boards')));
    }

    public function getNews(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminnews'));

        $newses = AdminBoardHelper::getNewsFilter((int) theme_option('number_of_news_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($newses, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminnews'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $newses]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.newses.items', compact('newses')));
        }
//        dd($projects);

        return Theme::scope('admin_board.newses', compact('newses'), 'pag')->render();
    }
    public function getEvent(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminevent'));
        Theme::asset()
            ->container('footer')
            ->usePath(false)
            ->add('language-public-js', asset('vendor/Modules/AdminBoard/js/event_category.js'),
                ['jquery'], [], '1.0.0');
        //(int) theme_option('number_of_event_per_page') ?: 12
        $perPage = (int) theme_option('number_of_events_per_page') ?: 12;
        $events = AdminBoardHelper::getEventFilter($perPage, []);
        $events_categories = AdminBoardHelper::getAdminAdminBoarCategoryFilter($perPage, [],'event');
        $events_types = AdminBoardHelper::getAdminTypeFilter($perPage, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($events, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        $layout = theme_option('admin-layout', 'admin-default');
        Theme::uses(Theme::getThemeName())->layout($layout);
//        dd($layout);

//        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-layout'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($events_types);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminevent'));
        if ($request->ajax()) {
            if ($events->count() === 0) {
                return $this->httpResponse()->setData('<div class="col-lg-12 text-center py-5"><h5 class="text-muted">'.__('No events found').'</h5></div>');
            }
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['events' => $events,'events_categories' => $events_categories,'events_types' => $events_types]));
            }
//            dd($events);

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.event.items', compact('events')));
        }
//        dd($projects);

        return Theme::scope('admin_board.events', compact('events','events_categories','events_types'), 'pag')->render();
    }
    public function getTeam(Request $request)
    {
        SeoHelper::setTitle(__('Faculty'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'team',
        ];
//        $team = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
//        $teams = AdminBoardHelper::getCategoryFilter((int) theme_option('number_of_team_per_page') ?: 12, 6);
        $teams = AdminBoardHelper::getTeamFilter((int) theme_option('number_of_team_per_page') ?: 12, []);
//        $teams = $team->adminteams()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_team_per_page') ?: 12);
//        dd($teams);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('Faculty'));
//            ->add($teams->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($teams, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $teams]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.teams.items', compact('teams')));
        }
//        dd($projects);

        return Theme::scope('admin_board.teams', compact('teams'), 'pag')->render();
    }
    public function getAcademicGroupPrefix(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminacademicgroup'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
//        $academic_group = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
        $academic_groups = AdminBoardHelper::getAcademicGroupFilter((int) theme_option('number_of_academic_group_per_page') ?: 12, []);
//        $academic_groups = $academic_groups->adminacademic_groups()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_academic_group_per_page') ?: 12);
//        dd($academic_groups);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminacademicgroup'));
//            ->add($academic_groups->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($academic_groups, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $academic_groups]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.academic_groups.items', compact('academic_groups')));
        }
//        dd($projects);

        return Theme::scope('admin_board.academic_groups', compact('academic_groups'), 'pag')->render();
    }
    public function getCareerNavigators(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.admincareernavigator'));

        $career_navigators = AdminBoardHelper::getCareerNavigatorFilter((int) theme_option('number_of_career_navigators_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($career_navigators, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.admincareernavigator'));
//        dd($career_navigators);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $career_navigators]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.career_navigators.items', compact('career_navigators')));
        }
//        dd($projects);

        return Theme::scope('admin_board.career_navigators', compact('career_navigators'), 'pag')->render();
    }
    public function getStudentGuidelines(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminstudentguideline'));

        $student_guidelines = AdminBoardHelper::getStudentGuidelineFilter((int) theme_option('number_of_student_guidelines_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($career_navigators, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));

        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminstudentguideline'));
//        dd($career_navigators);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $student_guidelines]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.student_guidelines.items', compact('student_guidelines')));
        }
//        dd($projects);

        return Theme::scope('admin_board.student_guidelines', compact('student_guidelines'), 'pag')->render();
    }
    public function getGalleryBoard(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.admingalleryboard'));

        //(int) theme_option('number_of_gallery_per_page') ?: 12
        $admin_gallery_boards = AdminBoardHelper::getGalleryBoardFilter(theme_option('number_of_admin_gallery_boards_per_page') ?: 12, []);

        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);

        Theme::asset()
            ->usePath(false)
            ->add('gallery', url('vendor/Modules/AdminBoard/css/gallery.css'),
                [], [], '1.0.0',true);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.admingalleryboard'));
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_gallery_boards]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_gallery_board.items', compact('admin_gallery_boards')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_gallery_boards', compact('admin_gallery_boards'), 'pag')->render();
    }
    public function getFacility(Request $request){
        return redirect(url('/'));
    }
    public function getAdminClubPrefix(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminclub'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
//        $admin_club = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
        $admin_clubs = AdminBoardHelper::getAdminClubFilter((int) theme_option('number_of_admin_club_per_page') ?: 12, []);
//        $admin_clubs = $admin_clubs->adminadmin_clubs()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_admin_club_per_page') ?: 12);
//        dd($admin_clubs);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminclub'));
//            ->add($admin_clubs->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($admin_clubs, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_clubs]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_clubs.items', compact('admin_clubs')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_clubs', compact('admin_clubs'), 'pag')->render();
    }
    public function getAdminServicePrefix(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminservice'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
//        $admin_service = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
        $admin_services = AdminBoardHelper::getAdminServiceFilter((int) theme_option('number_of_admin_service_per_page') ?: 12, []);
//        $admin_services = $admin_services->adminadmin_services()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_admin_service_per_page') ?: 12);
//        dd($admin_services);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminservice'));
//            ->add($admin_services->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($admin_services, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_services]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_services.items', compact('admin_services')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_services', compact('admin_services'), 'pag')->render();
    }
    public function getAdminPackagePrefix(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminpackage'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
//        $admin_package = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
        $admin_packages = AdminBoardHelper::getAdminPackageFilter((int) theme_option('number_of_admin_package_per_page') ?: 12, []);
//        $admin_packages = $admin_packages->adminadmin_packages()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_admin_package_per_page') ?: 12);
//        dd($admin_packages);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminpackage'));
//            ->add($admin_packages->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($admin_packages, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_packages]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_packages.items', compact('admin_packages')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_packages', compact('admin_packages'), 'pag')->render();
    }
    public function getAdminFtpserverPrefix(Request $request)
    {
        SeoHelper::setTitle(__('adminboard::lang.adminftpserver'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
//        $admin_ftpserver = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
//        $admin_ftpservers = AdminBoardHelper::getAdminFtpserverFilter((int) theme_option('number_of_admin_ftpserver_per_page') ?: 12, []);
        $admin_ftpservers = AdminBoardHelper::getAdminFtpserverCategoryFilter((int) theme_option('number_of_admin_ftpserver_per_page') ?: 12, []);
//        $admin_ftpservers = $admin_ftpservers->adminadmin_ftpservers()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_admin_ftpserver_per_page') ?: 12);
//        dd($admin_ftpservers);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('adminboard::lang.adminftpserver'));
//            ->add($admin_ftpservers->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($admin_ftpservers, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_ftpservers]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_ftpservers.items', compact('admin_ftpservers')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_ftpservers', compact('admin_ftpservers'), 'pag')->render();
    }
    public function getAdminPartnerPrefix(Request $request)
    {
        SeoHelper::setTitle(__('Partner Offers'));
//        SeoHelper::setTitle(__('adminboard::lang.adminpartner'));

        $conditions = [
            'id' => '6',
            'adminboard' => 'academicgroup',
        ];
        Theme::asset()->container('footer')->usePath()->add('partner', 'js/partner.js', ['jquery']);
//        $admin_partner = app(AdminCategoryInterface::class)->advancedGet([
//            'condition' => $conditions,
//            'take'      => 1,
////            'order_by' => ['created_at' => 'desc'],
//        ]);
        $admin_partners = AdminBoardHelper::getAdminPartnerFilter((int) theme_option('number_of_admin_partner_per_page') ?: 12, []);
        $admin_categories = AdminBoardHelper::getAdminAdminBoarCategoryFilter((int) theme_option('number_of_admin_partner_per_page') ?: 12, [],'partner');
//        $admin_partners = AdminBoardHelper::getAdminAdminBoarCategoryFilter((int) theme_option('number_of_admin_partner_per_page') ?: 12, [],'partner');
//        $admin_partners = $admin_partners->adminadmin_partners()->orderBy('id', 'DESC')->Paginate((int)theme_option('number_of_admin_partner_per_page') ?: 12);
//        dd($admin_partners);
        Theme::breadcrumb()
            ->add(__('Home'), route('public.index'))
            ->add(__('Partner Offers'));
//            ->add(__('adminboard::lang.adminpartner'));
//            ->add($admin_partners->name);
//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($admin_partners, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd(1);
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $admin_partners]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('admin_board.admin_partners.items', compact('admin_partners')));
        }
//        dd($projects);

        return Theme::scope('admin_board.admin_partners', compact('admin_partners', 'admin_categories'), 'pag')->render();
    }
}
