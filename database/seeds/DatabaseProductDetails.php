<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseProductDetails extends Seeder
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
                'proddetail_id' => 'PD0001',
                'name' => 'SIZE S',
                'description' => 'Lorem ipsum dolor ismet.',
                'price' => 150000,
                'is_available' => 1,
                'status' => 'active',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'proddetail_id' => 'PD0002',
                'name' => 'SIZE L',
                'description' => 'Lorem ipsum dolor ismet.',
                'price' => 200000,
                'is_available' => 1,
                'status' => 'active',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'proddetail_id' => 'PD0003',
                'name' => 'SIZE M',
                'description' => 'Lorem ipsum dolor ismet.',
                'price' => 250000,
                'is_available' => 1,
                'status' => 'active',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'proddetail_id' => 'PD0004',
                'name' => 'SIZE XL',
                'description' => 'Lorem ipsum dolor ismet.',
                'price' => 300000,
                'is_available' => 1,
                'status' => 'active',
                'product_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('product_details')->insert($data);
    }
}
