<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseOrderItems extends Seeder
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
                'price' => 150000,
                'discount' => 0,
                'quantity' => 1,
                'subtotal' => 150000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'order_id' => 1,
                'product_id' => 1,
                'proddetail_id' => 1,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 400000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'order_id' => 1,
                'product_id' => 1,
                'proddetail_id' => 3,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 300000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'order_id' => 2,
                'product_id' => 1,
                'proddetail_id' => 1,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('order_items')->insert($data);
    }
}
