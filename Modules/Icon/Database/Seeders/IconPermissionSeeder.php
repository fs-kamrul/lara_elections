<?php

namespace Modules\Icon\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class IconPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "icon_access" ],
            [ 'name'         => "icon_list_own" ],
            [ 'name'         => "icon_list_all" ],
            [ 'name'         => "icon_create" ],
            [ 'name'         => "icon_edit" ],
            [ 'name'         => "icon_pdf" ],
            [ 'name'         => "icon_show" ],
            [ 'name'         => "icon_destroy" ],
            [ 'name'         => "icon_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
