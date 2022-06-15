<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            'DatabaseAdmins',
            'DatabaseBizpars',
            'DatabaseSubscriptions',
            'DatabaseRoles',
            'DatabasePermissions',
            'DatabaseRolePermissions',
            'DatabaseMerchants',
            'DatabasePositions',
            'DatabaseEmployees',
            'DatabaseUsers',
            'DatabaseCategories',
            'DatabaseProducts',
            'DatabaseProductImages',
            'DatabasePayments',
            'DatabaseShipments',
            'DatabaseStores',
            'DatabaseStoreTables',
            'DatabaseStorePayments',
            'DatabaseStoreShipments',
            'DatabaseStoreProducts',
            'DatabaseShifts',
            'DatabaseEmployeeShifts',
            'DatabaseCustomers',
            'DatabaseAddresses',
            'DatabaseWishLists',
            'DatabaseOrders',
            'DatabaseOrderPlans',
            'DatabaseOrderItems',
            'DatabaseCarts',
            'DatabaseCartItems'
        ]);
    }
}
