<?php

namespace Modules\Election\Http\Controllers;

use Illuminate\Routing\Controller;
use Menu;
use Dboard;
use Modules\Election\Http\Models\Election;

class DataController  extends Controller
{

    /**
     * Adds Election menus
     * @return null
     */
    public function modifyAdminMenu()
    {

        Menu::modify(
            'admin-sidebar-menu',
            function ($menu){

                if(auth()->user()->can('election_access') ||
                    auth()->user()->can('election_access')) {
                    $menu->dropdown(__('election::lang.election'), function ($sub) {
                        if (auth()->user()->can('election_access')) {
                            $sub->url(
                                action('\Modules\Election\Http\Controllers\ElectionController@index'),
                                __('election::lang.election'),
                                ['icon' => 'icon-file-signature']
                            )->order(20); } //next_lint
                    },
                        ['icon' => 'icon-theater-masks']
                    );
                }
            }
        );
    }

    /**
     * Adds KamrulDashboard menus
     * @return null
     */
    public function modifyAdminDashboard()
    {
        if(auth()->user()->can('election_access')) {
            Dboard::modify('main-dashboard', function($menu) {
                // URL, Title, Attributes
                $data = Election::get();
                $menu->header('Total Election', $data->count());
            });
        }
    }
}
