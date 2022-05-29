<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePositions extends Seeder
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
                'position_id' => 'PS0001',
                'title' => 'Lorem ipsum',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'position_id' => 'PS0002',
                'title' => 'Lorem ipsum',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('positions')->insert($data);
    }
}
