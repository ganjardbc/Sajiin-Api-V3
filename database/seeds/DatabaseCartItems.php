<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseCartItems extends Seeder
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
                'cart_item_id' => 'CRI-1622798516601',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 1,
                'subtotal' => 150000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'product_id' => 1,
                'cart_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'cart_item_id' => 'CRI-1622798516602',
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 400000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'product_id' => 2,
                'cart_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'cart_item_id' => 'CRI-1622798516603',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 300000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'product_id' => 1,
                'cart_id' => 2,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('cart_items')->insert($data);
    }
}
