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
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '2',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'name' => 'Partner',
                'username' => 'partner',
                'email' => 'partner@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                'role_id' => '3',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('users')->insert($data);
    }
}
