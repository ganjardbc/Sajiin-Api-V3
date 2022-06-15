<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabasePermissions extends Seeder
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
                'permission_id' => 'PR-1622798516609',
                'name' => 'dashboard',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '2',
                'permission_id' => 'PR-1622798516610',
                'name' => 'bizpars',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '3',
                'permission_id' => 'PR-1622798516691',
                'name' => 'customers',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '4',
                'permission_id' => 'PR-1622798516692',
                'name' => 'orders',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '5',
                'permission_id' => 'PR-1622798516693',
                'name' => 'carts',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '6',
                'permission_id' => 'PR-1622798516694',
                'name' => 'wiselists',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '7',
                'permission_id' => 'PR-1622798516695',
                'name' => 'categories',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '8',
                'permission_id' => 'PR-1622798516696',
                'name' => 'toppings',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '9',
                'permission_id' => 'PR-1622798516697',
                'name' => 'products',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '10',
                'permission_id' => 'PR-1622798516698',
                'name' => 'shipments',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '11',
                'permission_id' => 'PR-1622798516699',
                'name' => 'payments',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '12',
                'permission_id' => 'PR-1622798516621',
                'name' => 'articles',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '13',
                'permission_id' => 'PR-1622798516513',
                'name' => 'benefits',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '14',
                'permission_id' => 'PR-1622798516514',
                'name' => 'feedbacks',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '15',
                'permission_id' => 'PR-1622798516515',
                'name' => 'permissions',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '16',
                'permission_id' => 'PR-1622798516516',
                'name' => 'roles',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '17',
                'permission_id' => 'PR-1622798516517',
                'name' => 'users',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '18',
                'permission_id' => 'PR-1622798516518',
                'name' => 'cashier',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '19',
                'permission_id' => 'PR-1622798516519',
                'name' => 'shops',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '20',
                'permission_id' => 'PR-1622798516520',
                'name' => 'employees',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '21',
                'permission_id' => 'PR-1622798516521',
                'name' => 'positions',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '22',
                'permission_id' => 'PR-1622798516522',
                'name' => 'shift',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '23',
                'permission_id' => 'PR-1622798516523',
                'name' => 'catalog',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '24',
                'permission_id' => 'PR-1622798516524',
                'name' => 'tables',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '25',
                'permission_id' => 'PR-1622798516525',
                'name' => 'tasklists',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '26',
                'permission_id' => 'PR-1622798516526',
                'name' => 'notifications',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '27',
                'permission_id' => 'PR-1622798516527',
                'name' => 'profile',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '28',
                'permission_id' => 'PR-1622798516528',
                'name' => 'reports',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ],
            [
                'id' => '29',
                'permission_id' => 'PR-1622798516529',
                'name' => 'shifts',
                'description' => 'Lorem ipsum dolor ismet.',
                'status' => 'active',
                "created_at" => '2020-06-28 19:08:45',
                "updated_at" => '2020-06-28 19:08:45'
            ]
        ];

        DB::table('permissions')->insert($data);
    }
}
