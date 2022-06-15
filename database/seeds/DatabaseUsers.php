<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseUsers extends Seeder
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
                'user_id' => 'US-1626330482781',
                'name' => 'Ahmad',
                'username' => 'ahmad',
                'email' => 'ahmad@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '1',
                'merchant_id' => '1',
                'employee_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'user_id' => 'US-1626330482782',
                'name' => 'Gustavian',
                'username' => 'gustavian',
                'email' => 'gustavian@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '2',
                'merchant_id' => '1',
                'employee_id' => '2',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'user_id' => 'US-1626330482783',
                'name' => 'Rina',
                'username' => 'rina',
                'email' => 'rina@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '3',
                'merchant_id' => '1',
                'employee_id' => '3',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('users')->insert($data);
    }
}
