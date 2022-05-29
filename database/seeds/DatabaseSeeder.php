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
            'DataBizpars',
            'DatabaseRoles',
            'DatabaseUsers',
            'DatabaseShipments',
            'DatabasePayments',
            'DatabaseTopings',
            'DatabaseProducts',
            'DatabaseProductDetails',
            'DatabaseProductImages',
            'DatabaseProductTopings',
            'DatabasePartners',
            'DatabasePartnerConfigurations',
            'DatabaseOrders',
            'DatabaseOrderItems',
            'DatabaseOrderTopings',
            'DatabaseCarts',
            'DatabaseWishelists',
            'DatabasePermission',
            'DatabaseRolePermission',
            'DatabaseShops',
            'DatabaseTables',
            'DatabaseCustomer',
            'DatabaseAddress',
            'DatabaseCatalogs',
            'DatabasePositions',
            'DatabaseEmployees',
            'DatabaseShifts',
            'DatabaseEmployeeShifts',
            'DatabaseNotifications'
        ]);
    }
}
