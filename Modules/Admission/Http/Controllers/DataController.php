<?php

namespace Modules\Admission\Http\Controllers;

use Illuminate\Routing\Controller;
use Menu;
use Dboard;
use Modules\Admission\Http\Models\Admission;

class DataController  extends Controller
{

    /**
     * Adds Admission menus
     * @return null
     */
    public function modifyAdminMenu()
    {

        Menu::modify(
            'admin-sidebar-menu',
            function ($menu){
                if(auth()->user()->can('option_access') ||
                    auth()->user()->can('optionsection_access') ||
                    auth()->user()->can('optiongroup_access')||
                    auth()->user()->can('optionyear_access')||
                    auth()->user()->can('optionclass_access')) {
                    $menu->dropdown('Admission', function ($sub) {

                        if(auth()->user()->can('optionclass_access')) {
                            $sub->url(
                                action('\Modules\Admission\Http\Controllers\AdmissionClassController@index'),
                                __('option::lang.optionclass'),
                                ['icon' => 'icon-project-diagram']
                            )->order(20); }

                        if(auth()->user()->can('admission_access')) {
                            $sub->url(
                                action('\Modules\Admission\Http\Controllers\AdmissionController@index'),
                                __('admission::lang.admission_list'),
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
        if(auth()->user()->can('admission_access')) {
            Dboard::modify('main-dashboard', function($menu) {
                // URL, Title, Attributes
                $data = Admission::get();
                $menu->header('Total Admission', $data->count());
            });
        }
    }
}
