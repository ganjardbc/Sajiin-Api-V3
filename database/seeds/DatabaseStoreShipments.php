<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseStoreShipments extends Seeder
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
                'store_shipment_id' => 'SS-1622798516521',
                'status' => 'active',
                'store_id' => '1',
                'shipment_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'store_shipment_id' => 'SS-1622798516522',
                'status' => 'active',
                'store_id' => '1',
                'shipment_id' => '2',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'store_shipment_id' => 'SS-1622798516523',
                'status' => 'active',
                'store_id' => '1',
                'shipment_id' => '3',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('store_shipments')->insert($data);
    }
}
