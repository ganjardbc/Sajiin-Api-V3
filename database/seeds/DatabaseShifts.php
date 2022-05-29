<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseShifts extends Seeder
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
                'shift_id' => 'SF0001',
                'title' => 'Lorem ipsum',
                'start_time' => '07:00',
                'end_time' => '15:00',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'shift_id' => 'SF0002',
                'title' => 'Lorem ipsum',
                'start_time' => '15:00',
                'end_time' => '22:00',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('shifts')->insert($data);
    }
}
