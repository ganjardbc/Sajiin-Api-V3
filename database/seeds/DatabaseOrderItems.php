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
                'order_item_id' => 'ODI-1622798516601',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 1,
                'subtotal' => 150000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'status' => 'waiting',
                'order_id' => 1,
                'product_id' => 1,
                'store_id' => 1,
                'employee_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'order_item_id' => 'ODI-1622798516602',
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 400000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'status' => 'waiting',
                'order_id' => 1,
                'product_id' => 2,
                'store_id' => 1,
                'employee_id' => 3,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'order_item_id' => 'ODI-1622798516603',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 300000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'status' => 'waiting',
                'order_id' => 2,
                'product_id' => 3,
                'store_id' => 1,
                'employee_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('order_items')->insert($data);
    }
}
