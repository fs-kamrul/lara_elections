<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Post\Http\Models\Category;
use Modules\Post\Http\Models\PostType;

class PostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'            => 1,
                'uuid'          => gen_uuid(),
                'name'          => "None",
                'description'   => "none",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 2,
                'uuid'          => gen_uuid(),
                'name'          => "Notice Board",
                'description'   => "Notice Board",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 3,
                'uuid'          => gen_uuid(),
                'name'          => "Home Page Box Info",
                'description'   => "Home Page Box Info",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 4,
                'uuid'          => gen_uuid(),
                'name'          => 'Our Facilities',
                'description'   => 'Our Facilities',
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 5,
                'uuid'          => gen_uuid(),
                'name'          => "Photo Gallery",
                'description'   => "Photo Gallery",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 6,
                'uuid'          => gen_uuid(),
                'name'          => "Testimonial",
                'description'   => "Testimonial",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 7,
                'uuid'          => gen_uuid(),
                'name'          => "Training",
                'description'   => "Training",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 8,
                'uuid'          => gen_uuid(),
                'name'          => "Workshop",
                'description'   => "Workshop",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 9,
                'uuid'          => gen_uuid(),
                'name'          => "Our Feature",
                'description'   => "Our Feature",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 10,
                'uuid'          => gen_uuid(),
                'name'          => "News",
                'description'   => "News",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 11,
                'uuid'          => gen_uuid(),
                'name'          => "Events",
                'description'   => "Events",
                'status'        => 1,
                'user_id'       => 1,
            ],
            [
                'id'            => 12,
                'uuid'          => gen_uuid(),
                'name'          => "Blog",
                'description'   => "Blog",
                'status'        => 1,
                'user_id'       => 1,
            ],
        ];

        PostType::upsert($data, ['name']);
    }
}
