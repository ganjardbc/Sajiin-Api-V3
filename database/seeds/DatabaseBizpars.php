<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseBizpars extends Seeder
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
                'key' => 'BZ-1625293578601',
                'value' => 'active',
                'type' => 'status',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'key' => 'BZ-1625293578602',
                'value' => 'inactive',
                'type' => 'status',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'key' => 'BZ-1625293578603',
                'value' => 'shipping',
                'type' => 'address',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'key' => 'BZ-1625293578604',
                'value' => 'home',
                'type' => 'address',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '5',
                'key' => 'BZ-1625293578605',
                'value' => 'personal',
                'type' => 'order',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '6',
                'key' => 'BZ-1625293578606',
                'value' => 'partner',
                'type' => 'order',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '7',
                'key' => 'BZ-1625293578607',
                'value' => 'new',
                'type' => 'product',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '8',
                'key' => 'BZ-1625293578608',
                'value' => 'popular',
                'type' => 'product',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '9',
                'key' => 'BZ-1625293578609',
                'value' => 'unconfirmed',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '10',
                'key' => 'BZ-1625293578610',
                'value' => 'confirmed',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '11',
                'key' => 'BZ-1625293578611',
                'value' => 'cooking',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '12',
                'key' => 'BZ-1625293578612',
                'value' => 'delivered',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '13',
                'key' => 'BZ-1625293578613',
                'value' => 'received',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '14',
                'key' => 'BZ-1625293578614',
                'value' => 'done',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '15',
                'key' => 'BZ-1625293578615',
                'value' => 'canceled',
                'type' => 'orderstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '16',
                'key' => 'BZ-1625293578616',
                'value' => 'done',
                'type' => 'orderitemstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '17',
                'key' => 'BZ-1625293578617',
                'value' => 'cooking',
                'type' => 'orderitemstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '18',
                'key' => 'BZ-1625293578618',
                'value' => 'waiting',
                'type' => 'orderitemstatus',
                'description' => 'Lorem ipsum dolor ismet.',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('bizpars')->insert($data);
    }
}
