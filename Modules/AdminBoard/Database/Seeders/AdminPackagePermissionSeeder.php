<?php

namespace Modules\AdminBoard\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class AdminPackagePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "adminpackage_access" ],
            [ 'name'         => "adminpackage_list_own" ],
            [ 'name'         => "adminpackage_list_all" ],
            [ 'name'         => "adminpackage_create" ],
            [ 'name'         => "adminpackage_edit" ],
            [ 'name'         => "adminpackage_show" ],
            [ 'name'         => "adminpackage_pdf" ],
            [ 'name'         => "adminpackage_destroy" ],
            [ 'name'         => "adminpackage_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
