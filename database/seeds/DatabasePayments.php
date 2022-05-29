<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePayments extends Seeder
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
                'payment_id' => 'PY0001',
                'name' => 'CASHE',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'payment_id' => 'PY0002',
                'name' => 'TRANSFER BANK',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'payment_id' => 'PY0003',
                'name' => 'E-MONEY',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                'user_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('payments')->insert($data);
    }
}
