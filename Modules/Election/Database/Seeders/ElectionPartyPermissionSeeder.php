<?php

namespace Modules\Election\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class ElectionPartyPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "electionparty_access" ],
            [ 'name'         => "electionparty_list_own" ],
            [ 'name'         => "electionparty_list_all" ],
            [ 'name'         => "electionparty_create" ],
            [ 'name'         => "electionparty_edit" ],
            [ 'name'         => "electionparty_show" ],
            [ 'name'         => "electionparty_pdf" ],
            [ 'name'         => "electionparty_destroy" ],
            [ 'name'         => "electionparty_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
