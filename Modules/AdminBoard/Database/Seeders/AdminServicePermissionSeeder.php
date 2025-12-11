<?php

namespace Modules\AdminBoard\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class AdminServicePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "adminservice_access" ],
            [ 'name'         => "adminservice_list_own" ],
            [ 'name'         => "adminservice_list_all" ],
            [ 'name'         => "adminservice_create" ],
            [ 'name'         => "adminservice_edit" ],
            [ 'name'         => "adminservice_show" ],
            [ 'name'         => "adminservice_pdf" ],
            [ 'name'         => "adminservice_destroy" ],
            [ 'name'         => "adminservice_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
