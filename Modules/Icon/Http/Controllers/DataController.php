<?php

namespace Modules\Icon\Http\Controllers;

use Illuminate\Routing\Controller;
use Menu;
use Dboard;
use Modules\Icon\Http\Models\Icon;

class DataController  extends Controller
{

    /**
     * Adds Icon menus
     * @return null
     */
    public function modifyAdminMenu()
    {

//        Menu::modify(
//            'admin-sidebar-menu',
//            function ($menu){
//                if(auth()->user()->can('icon_access')) {
//                    $menu->url(
//                        action('\Modules\Icon\Http\Controllers\IconController@index'),
//                        __('icon::lang.icon'),
//                        ['icon' => 'icon-file-signature']
//                    )->order(20); } //next_lint
//            }
//        );
    }

    /**
     * Adds KamrulDashboard menus
     * @return null
     */
    public function modifyAdminDashboard()
    {
//        if(auth()->user()->can('icon_access')) {
//            Dboard::modify('main-dashboard', function($menu) {
//                // URL, Title, Attributes
//                $data = Icon::get();
//                $menu->header('Total Icon', $data->count());
//            });
//        }
    }
}
