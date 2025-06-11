<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permission = [
            // Master Products
            [
                'name' => 'master_products_access',
            ],
            [
                'name' => 'master_products_show',
            ],
            [
                'name' => 'master_products_create',
            ],
            [
                'name' => 'master_products_edit',
            ],
            [
                'name' => 'master_products_delete',
            ],

            // Master Inggridients
            [
                'name' => 'master_inggridients_access',
            ],
            [
                'name' => 'master_inggridients_show',
            ],
            [
                'name' => 'master_inggridients_create',
            ],
            [
                'name' => 'master_inggridients_edit',
            ],
            [
                'name' => 'master_inggridients_delete',
            ],

            // Suppliers
            [
                'name' => 'suppliers_access',
            ],
            [
                'name' => 'suppliers_show',
            ],
            [
                'name' => 'suppliers_create',
            ],
            [
                'name' => 'suppliers_edit',
            ],
            [
                'name' => 'suppliers_delete',
            ],

            // Purchases
            [
                'name' => 'purchases_access',
            ],
            [
                'name' => 'purchases_show',
            ],
            [
                'name' => 'purchases_create',
            ],

            // Request Sales
            [
                'name' => 'request_sales_access',
            ],
            [
                'name' => 'request_sales_show',
            ],
            [
                'name' => 'request_sales_create',
            ],

            // Report Stock
            [
                'name' => 'report_stock_access',
            ],

            // Users
            [
                'name' => 'users_access',
            ],
            [
                'name' => 'users_show',
            ],
            [
                'name' => 'users_create',
            ],
            [
                'name' => 'users_edit',
            ],
            [
                'name' => 'users_delete',
            ],

            // Roles
            [
                'name' => 'roles_access',
            ],
            [
                'name' => 'roles_show',
            ],
            [
                'name' => 'roles_create',
            ],
            [
                'name' => 'roles_edit',
            ],
            [
                'name' => 'roles_delete',
            ],

            // Permissions
            [
                'name' => 'permissions_access',
            ],
        ];

        foreach ($permission as $value) {
            Permission::create($value);
        }
    }
}
