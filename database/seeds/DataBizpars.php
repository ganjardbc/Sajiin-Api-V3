<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataBizpars extends Seeder
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
                'key' => 'DS0001',
                'value' => 'active',
                'type' => 'status',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'key' => 'DS0002',
                'value' => 'inactive',
                'type' => 'status',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'key' => 'AD0001',
                'value' => 'shipping',
                'type' => 'address',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'key' => 'AD0002',
                'value' => 'home',
                'type' => 'address',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '5',
                'key' => 'OD0001',
                'value' => 'personal',
                'type' => 'order',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '6',
                'key' => 'OD0002',
                'value' => 'partner',
                'type' => 'order',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '7',
                'key' => 'PR0001',
                'value' => 'new',
                'type' => 'product',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '8',
                'key' => 'PR0002',
                'value' => 'popular',
                'type' => 'product',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '9',
                'key' => 'OS0001',
                'value' => 'unconfirmed',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '10',
                'key' => 'OS0002',
                'value' => 'confirmed',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '11',
                'key' => 'OS0003',
                'value' => 'cooking',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '12',
                'key' => 'OS0004',
                'value' => 'delivered',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '13',
                'key' => 'OS0005',
                'value' => 'received',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '14',
                'key' => 'OS0006',
                'value' => 'done',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '15',
                'key' => 'OS0007',
                'value' => 'canceled',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('bizpars')->insert($data);
    }
}
