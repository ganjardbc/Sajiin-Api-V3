<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseTopings extends Seeder
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
                'toping_id' => 'TP0001',
                'image' => 'test',
                'name' => 'Cheese',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'price' => 20000,
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'toping_id' => 'TP0002',
                'image' => 'test',
                'name' => 'Caramel',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'price' => 20000,
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'toping_id' => 'TP0003',
                'image' => 'test',
                'name' => 'Strawberry',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'price' => 20000,
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('topings')->insert($data);
    }
}
