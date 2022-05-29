<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseShipments extends Seeder
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
                'shipment_id' => 'SP0001',
                'name' => 'GO-JEK',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'shipment_id' => 'SP0002',
                'name' => 'JNE',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'shipment_id' => 'SP0003',
                'name' => 'KURIR TOKO',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('shipments')->insert($data);
    }
}
