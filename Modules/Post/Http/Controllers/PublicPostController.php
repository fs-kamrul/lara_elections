<?php

namespace Modules\Post\Http\Controllers;

use Assets;
use Illuminate\Http\Request;
use Modules\KamrulDashboard\Http\Controllers\DboardController;
use Theme;
use SeoHelper;
use PostHelper;

class PublicPostController extends DboardController
{
    public function getPostData(Request $request)
    {
        SeoHelper::setTitle(__('Post'));

        $perPage = (int) $request->input('per_page',  theme_option('number_of_post_per_page') ?: 12);
        $posts = PostHelper::getPostFilter($perPage ?: 12, []);
//        $post_types = PostHelper::getTypeFilter(30 ?: 12, []);
//                $post_categories = PostHelper::getCategoryFilter(30 ?: 12, []);
//        $workshops = AdminBoardHelper::getWorkshopFilter((int) theme_option('number_of_workshops_per_page') ?: 12, []);

//        theme_option('site_title','');
//        $layout = MetaBox::getMetaData($workshop, 'layout', true);
//        $layout = ($layout && in_array($layout, array_keys(get_admin_board_layouts()))) ? $layout : 'admin-default';
        Theme::uses(Theme::getThemeName())->layout(theme_option('admin-layout', 'admin-default'));
//        Theme::uses(Theme::getThemeName())->layout('other_page');
//        dd($projects);
        if ($request->ajax()) {
//            dd($posts);


            return $this
                ->httpResponse()
                ->setData(Theme::partial('short-codes.blog-post-item', compact('posts')));
        }
//        dd($projects);

        return Theme::scope('short-codes.blog-post', compact('posts'), 'pag')->render();
    }
}
