<?php

namespace Modules\AdminBoard\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class AdminTypePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "admintype_access" ],
            [ 'name'         => "admintype_list_own" ],
            [ 'name'         => "admintype_list_all" ],
            [ 'name'         => "admintype_create" ],
            [ 'name'         => "admintype_edit" ],
            [ 'name'         => "admintype_show" ],
            [ 'name'         => "admintype_pdf" ],
            [ 'name'         => "admintype_destroy" ],
            [ 'name'         => "admintype_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
