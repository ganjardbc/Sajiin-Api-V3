<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseTables extends Seeder
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
                'table_id' => 'TB-0000000001',
                'code' => '01',
                'name' => 'Table 01',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'shop_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'table_id' => 'TB-0000000002',
                'code' => '02',
                'name' => 'Table 02',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'shop_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'table_id' => 'TB-0000000003',
                'code' => '03',
                'name' => 'Table 03',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'shop_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('tables')->insert($data);
    }
}
