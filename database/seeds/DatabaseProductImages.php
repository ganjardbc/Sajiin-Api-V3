<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseProductImages extends Seeder
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
                'id' => '1',
                'prodimage_id' => 'PI-1626330482781',
                'image' => 'test',
                'description' => 'Lorem ipsum dolor ismet.',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'prodimage_id' => 'PI-1626330482782',
                'image' => 'test',
                'description' => 'Lorem ipsum dolor ismet.',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'prodimage_id' => 'PI-1626330482783',
                'image' => 'test',
                'description' => 'Lorem ipsum dolor ismet.',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('product_images')->insert($data);
    }
}
