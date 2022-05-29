<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseOrderTopings extends Seeder
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
                'subtotal' => 152000,
                'name' => 'Cheese',
                'order_item_id' => 1,
                'toping_id' => 1,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'price' => 200000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 404000,
                'name' => 'Caramel',
                'order_item_id' => 1,
                'toping_id' => 2,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'price' => 150000,
                'discount' => 0,
                'quantity' => 2,
                'subtotal' => 304000,
                'name' => 'Strawberry',
                'order_item_id' => 2,
                'toping_id' => 3,
                'status' => 'waiting',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('order_topings')->insert($data);
    }
}
