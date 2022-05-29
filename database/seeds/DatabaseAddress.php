<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseAddress extends Seeder
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
                'address_id' => 'AD0001',
                'name' => 'Rumah',
                'address' => 'Jl. Lorem ipsum dolor ismet 40391',
                'is_selected' => true,
                'type' => 'shipping',
                'customer_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'address_id' => 'AD0002',
                'name' => 'Kosan',
                'address' => 'Jl. Lorem ipsum dolor ismet 40391',
                'is_selected' => false,
                'type' => 'shipping',
                'customer_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'address_id' => 'AD0003',
                'name' => 'Tempat Kerja',
                'address' => 'Jl. Lorem ipsum dolor ismet 40391',
                'is_selected' => false,
                'type' => 'shipping',
                'customer_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('addresses')->insert($data);
    }
}
