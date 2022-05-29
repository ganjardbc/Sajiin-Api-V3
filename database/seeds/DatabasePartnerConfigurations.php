<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePartnerConfigurations extends Seeder
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
                'partconfig_id' => 'PC0001',
                'name' => 'Config test',
                'description' => 'Lorem ipsum dolor ismet.',
                'promo_code' => 'TESTPROMO001',
                'expire_date' => date('now'),
                'status' => 'active',
                'partner_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'partconfig_id' => 'PC0002',
                'name' => 'Config test',
                'description' => 'Lorem ipsum dolor ismet.',
                'promo_code' => 'TESTPROMO002',
                'expire_date' => date('now'),
                'status' => 'active',
                'partner_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'partconfig_id' => 'PC0003',
                'name' => 'Config test',
                'description' => 'Lorem ipsum dolor ismet.',
                'promo_code' => 'TESTPROMO003',
                'expire_date' => date('now'),
                'status' => 'active',
                'partner_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('partner_configurations')->insert($data);
    }
}
