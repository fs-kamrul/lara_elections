<?php

namespace Modules\AdminBoard\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\KamrulDashboard\Http\Models\Permission;

class AdminFtpServerPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name'         => "adminftpserver_access" ],
            [ 'name'         => "adminftpserver_list_own" ],
            [ 'name'         => "adminftpserver_list_all" ],
            [ 'name'         => "adminftpserver_create" ],
            [ 'name'         => "adminftpserver_edit" ],
            [ 'name'         => "adminftpserver_show" ],
            [ 'name'         => "adminftpserver_pdf" ],
            [ 'name'         => "adminftpserver_destroy" ],
            [ 'name'         => "adminftpserver_import" ]
        ];

        Permission::upsert($data, ['name']);
    }
}
