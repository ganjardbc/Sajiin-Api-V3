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
                'cart_id' => 'CR-08000000001',
                'toping_price' => 2000,
                'price' => 150000,
                'discount' => 0,
                'quantity' => 1,
                'subtotal' => 152000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'product_toping' => 'Cheese',
                'product_id' => 1,
                'owner_id' => 1,
                'proddetail_id' => 1,
                'toping_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'cart_id' => 'CR-08000000002',
                'toping_price' => 2000,
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 404000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE M',
                'product_toping' => 'Caramel',
                'product_id' => 1,
                'owner_id' => 1,
                'proddetail_id' => 3,
                'toping_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'cart_id' => 'CR-08000000003',
                'toping_price' => 2000,
                'price' => 150000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 304000,
                'product_name' => 'Lorem ipsum dolor ismet',
                'product_detail' => 'SIZE S',
                'product_toping' => 'Strawberry',
                'product_id' => 1,
                'owner_id' => 1,
                'proddetail_id' => 1,
                'toping_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('carts')->insert($data);
    }
}
