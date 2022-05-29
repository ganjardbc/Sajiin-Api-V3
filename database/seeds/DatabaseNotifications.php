<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseNotifications extends Seeder
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
                'notification_id' => 'NF0001',
                'title' => 'CASHE',
                'subtitle' => 'Lorem ipsum dolor ismet.',
                'link' => 'Lorem',
                'is_read' => 0,
                'status' => 'active',
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'notification_id' => 'NF0002',
                'title' => 'TRANSFER BANK',
                'subtitle' => 'Lorem ipsum dolor ismet.',
                'link' => 'Lorem',
                'is_read' => 0,
                'status' => 'active',
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'notification_id' => 'NF0003',
                'title' => 'E-MONEY',
                'subtitle' => 'Lorem ipsum dolor ismet.',
                'link' => 'Lorem',
                'is_read' => 0,
                'status' => 'active',
                'user_id' => 1,
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('notifications')->insert($data);
    }
}
