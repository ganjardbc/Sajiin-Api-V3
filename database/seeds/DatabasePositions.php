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
                'position_id' => 'PS-1622798516609',
                'title' => 'Owner',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'position_id' => 'PS-1622798516610',
                'title' => 'Kitchen',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'position_id' => 'PS-1622798516611',
                'title' => 'Cashier',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'position_id' => 'PS-1622798516612',
                'title' => 'Waiter',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('positions')->insert($data);
    }
}
