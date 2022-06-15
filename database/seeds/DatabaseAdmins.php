<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseAdmins extends Seeder
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
                'admin_id' => 'AD-1622798516526',
                'name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'admin_id' => 'AD-1622798516527',
                'name' => 'Ganjar Hadiatna',
                'username' => 'ganjardbc',
                'email' => 'ganjardbc@gmail.com',
                'password' => '$2y$10$SAxExoRE0MLJojGiG44uMuh1zGd2uClaoW7qNab1PzYVhsrGh.i0S',
                'status' => 'active',
                'enabled' => true,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('admins')->insert($data);
    }
}
