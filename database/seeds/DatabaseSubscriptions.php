<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSubscriptions extends Seeder
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
                'subscription_id' => 'SU-1622798516526',
                'name' => 'Bronze',
                'description' => 'Bronze Packet',
                'is_available' => true,
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'subscription_id' => 'SU-1622798516527',
                'name' => 'Silver',
                'description' => 'Silver Packet',
                'is_available' => true,
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'subscription_id' => 'SU-1622798516528',
                'name' => 'Gold',
                'description' => 'Gold Packet',
                'is_available' => true,
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
        ];

        DB::table('subscriptions')->insert($data);
    }
}
