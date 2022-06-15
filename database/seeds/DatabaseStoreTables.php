<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseStoreTables extends Seeder
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
                'store_table_id' => 'TB-1622798516521',
                'code' => '01',
                'name' => 'Table 01',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'store_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'store_table_id' => 'TB-1622798516522',
                'code' => '02',
                'name' => 'Table 02',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'store_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'store_table_id' => 'TB-1622798516523',
                'code' => '03',
                'name' => 'Table 03',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'is_available' => 1,
                'store_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('store_tables')->insert($data);
    }
}
