<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseEmployees extends Seeder
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
                'employee_id' => 'EE0001',
                'name' => 'Ahmad',
                'email' => 'ahmad@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'address' => 'Jl. Lorem 40391',
                'status' => 'active',
                'shop_id' => '1',
                'position_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'employee_id' => 'EE0002',
                'name' => 'Gustavian',
                'email' => 'gustavian@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'address' => 'Jl. Lorem 40391',
                'status' => 'active',
                'shop_id' => '1',
                'position_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'employee_id' => 'EE0003',
                'name' => 'Rina',
                'email' => 'rina@gmail.com',
                'phone' => '085111222333',
                'about' => 'Lorem ipsum dolor ismet.',
                'address' => 'Jl. Lorem 40391',
                'status' => 'inactive',
                'shop_id' => '1',
                'position_id' => '1',
                'created_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('employees')->insert($data);
    }
}
