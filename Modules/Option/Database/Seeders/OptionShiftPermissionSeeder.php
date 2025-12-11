<?php

namespace Modules\Option\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class OptionShiftPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "optionshift_access" ],
            [ 'name'         => "optionshift_list_own" ],
            [ 'name'         => "optionshift_list_all" ],
            [ 'name'         => "optionshift_create" ],
            [ 'name'         => "optionshift_edit" ],
            [ 'name'         => "optionshift_show" ],
            [ 'name'         => "optionshift_pdf" ],
            [ 'name'         => "optionshift_destroy" ],
            [ 'name'         => "optionshift_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
