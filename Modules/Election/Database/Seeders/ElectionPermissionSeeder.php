<?php

namespace Modules\Election\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class ElectionPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "election_access" ],
            [ 'name'         => "election_list_own" ],
            [ 'name'         => "election_list_all" ],
            [ 'name'         => "election_create" ],
            [ 'name'         => "election_edit" ],
            [ 'name'         => "election_show" ],
            [ 'name'         => "election_pdf" ],
            [ 'name'         => "election_destroy" ],
            [ 'name'         => "election_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
