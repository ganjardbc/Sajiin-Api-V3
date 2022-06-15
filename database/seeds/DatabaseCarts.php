<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseCarts extends Seeder
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
                'cart_id' => 'CRT-1622798516601',
                'quantity' => 2,
                'total_price' => 610000,
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'customer_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'cart_id' => 'CRT-1622798516602',
                'quantity' => 1,
                'total_price' => 1500000,
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'customer_id' => 2,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('carts')->insert($data);
    }
}
