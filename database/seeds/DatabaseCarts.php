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
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 400000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'status' => 'waiting',
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'customer_id' => 1,
                'product_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'cart_id' => 'CRT-1622798516602',
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 400000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'status' => 'waiting',
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'customer_id' => 2,
                'product_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('carts')->insert($data);
    }
}
