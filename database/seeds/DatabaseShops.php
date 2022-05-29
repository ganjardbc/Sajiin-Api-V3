<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseShops extends Seeder
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
                'shop_id' => 'SP0001',
                'image' => '',
                'name' => 'Lorem ipsum dolor ismet.',
                'about' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                'location' => 'Lorem ipsum dolor ismet.',
                'email' => 'lorem@gmail.com',
                'phone' => '085111222333',
                'open_day' => 'Monday',
                'close_day' => 'Saturday',
                'open_time' => '07:00',
                'close_time' => '22:00',
                'is_available' => 1,
                'status' => 'active',
                'user_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('shops')->insert($data);
    }
}
