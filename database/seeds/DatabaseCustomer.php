<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseCustomer extends Seeder
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
                'customer_id' => 'CC0001',
                'name' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'customer_id' => 'CC0002',
                'name' => 'Gustavian',
                'email' => 'gustavian@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'customer_id' => 'CC0003',
                'name' => 'Rina',
                'email' => 'rina@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'status' => 'inactive',
                'shop_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('customers')->insert($data);
    }
}
