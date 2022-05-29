<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseRoles extends Seeder
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
                'role_id' => 'ROLE0001',
                'role_name' => 'admin',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'role_id' => 'ROLE0002',
                'role_name' => 'customer',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'role_id' => 'ROLE0003',
                'role_name' => 'partner',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'role_id' => 'ROLE0004',
                'role_name' => 'owner',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('roles')->insert($data);

    }
}
