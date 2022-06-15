<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseOrders extends Seeder
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
                'order_id' => 'ODR-1622798516601',
                'total_item' => 2,
                'total_price' => 610000,
                'delivery_price' => 0,
                'bills_price' => 620000,
                'change_price' => 10000,
                'store_name' => 'SAJIIN 1',
                'table_name' => 'Table 01',
                'customer_name' => 'Ahmad',
                'payment_name' => 'CASH',
                'shipment_name' => '',
                'payment_status' => 0,
                'status' => 'unconfirmed',
                'type' => 'personal',
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'table_id' => 1,
                'customer_id' => 1,
                'address_id' => 1,
                'shipment_id' => 1,
                'payment_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'order_id' => 'ODR-1622798516602',
                'total_item' => 1,
                'total_price' => 1500000,
                'delivery_price' => 0,
                'bills_price' => 1500000,
                'change_price' => 0,
                'store_name' => 'SAJIIN 1',
                'table_name' => 'Table 01',
                'customer_name' => 'Ahmad',
                'payment_name' => 'CASH',
                'shipment_name' => '',
                'payment_status' => 0,
                'status' => 'unconfirmed',
                'type' => 'personal',
                'note' => 'Lorem ipsum dolor ismet.',
                'store_id' => 1,
                'table_id' => 2,
                'customer_id' => 1,
                'address_id' => 1,
                'shipment_id' => 2,
                'payment_id' => 2,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('orders')->insert($data);
    }
}
