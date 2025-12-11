<?php

namespace Modules\Election\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ElectionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(
            [
                ElectionPermissionSeeder::class,
                ElectionPermissionSeeder::class,

            ]
        );
    }
}

