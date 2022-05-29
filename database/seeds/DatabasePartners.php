<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePartners extends Seeder
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
                'partner_id' => 'PR0001',
                'name' => 'Partner 1',
                'description' => 'Lorem ipsum dolor ismet.',
                'percentage' => 0,
                'amount' => 2.5,
                'is_available' => 1,
                'status' => 'active',
                'user_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'partner_id' => 'PR0002',
                'name' => 'Partner 2',
                'description' => 'Lorem ipsum dolor ismet.',
                'percentage' => 0,
                'amount' => 2.5,
                'is_available' => 1,
                'status' => 'active',
                'user_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'partner_id' => 'PR0003',
                'name' => 'Partner 3',
                'description' => 'Lorem ipsum dolor ismet.',
                'percentage' => 0,
                'amount' => 2.5,
                'is_available' => 1,
                'status' => 'active',
                'user_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('partners')->insert($data);
    }
}
