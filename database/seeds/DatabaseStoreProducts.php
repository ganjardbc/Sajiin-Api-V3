<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseStoreProducts extends Seeder
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
                'store_product_id' => 'SP-1626330482781',
                'is_pinned' => 0,
                'is_available' => 1,
                'status' => 'active',
                'store_id' => 1,
                'category_id' => 1,
                'product_id' => 1,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'store_product_id' => 'SP-1626330482782',
                'is_pinned' => 0,
                'is_available' => 1,
                'status' => 'active',
                'store_id' => 1,
                'category_id' => 2,
                'product_id' => 2,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'store_product_id' => 'SP-1626330482783',
                'is_pinned' => 0,
                'is_available' => 1,
                'status' => 'active',
                'store_id' => 1,
                'category_id' => 1,
                'product_id' => 3,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'store_product_id' => 'SP-1626330482784',
                'is_pinned' => 0,
                'is_available' => 1,
                'status' => 'active',
                'store_id' => 1,
                'category_id' => 2,
                'product_id' => 4,
                'created_by' => '1',
                'updated_by' => '1',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('store_products')->insert($data);
    }
}
