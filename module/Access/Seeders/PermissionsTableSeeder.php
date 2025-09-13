<?php

namespace Module\Access\Seeders;

use Module\Access\Models\SubMenu;
use Module\Access\Models\Permission;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run(): void
    {
        // user management
        $permissions = SubMenu::where('slug', 'permissions')->first();
        $roles = SubMenu::where('slug', 'roles')->first();
        $users = SubMenu::where('slug', 'users')->first();
        // catalog
        $categories = SubMenu::where('slug', 'categories')->first();
        $subCategories = SubMenu::where('slug', 'sub-categories')->first();
        $products = SubMenu::where('slug', 'products')->first();
        // Stocks
        $stocks = SubMenu::where('slug', 'stocks')->first();
        // location
        $zones = SubMenu::where('slug', 'zones')->first();
        $divisions = SubMenu::where('slug', 'divisions')->first();
        $regions = SubMenu::where('slug', 'regions')->first();
        $areas = SubMenu::where('slug', 'areas')->first();
        $territories = SubMenu::where('slug', 'territories')->first();
        $designs = SubMenu::where('slug', 'designs')->first();
        // sale point
        $sale_points = SubMenu::where('slug', 'sale-points')->first();
        // order
        $invoices = SubMenu::where('slug', 'invoices')->first();
        $acceptedInvoices = SubMenu::where('slug', 'accepted-invoices')->first();
        // collection
        $dues = SubMenu::where('slug', 'dues')->first();
        $updateDues = SubMenu::where('slug', 'update-dues')->first();
        // report
        $orderSummary = SubMenu::where('slug', 'order-summary')->first();
        $sales = SubMenu::where('slug', 'sales')->first();
        $transections = SubMenu::where('slug', 'transections')->first();

        $permissions = [
            [
                'sub_menu_id' => $permissions->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $permissions->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $permissions->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $permissions->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $roles->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $roles->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $roles->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $roles->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $users->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $users->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $users->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $users->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $categories->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $categories->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $categories->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $categories->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $subCategories->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $subCategories->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $subCategories->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $subCategories->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $products->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $products->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $products->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $products->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $stocks->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $stocks->id,
                'name' => 'Read',
            ],
            
            [
                'sub_menu_id' => $zones->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $zones->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $zones->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $zones->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $divisions->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $divisions->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $divisions->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $divisions->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $regions->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $regions->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $regions->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $regions->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $areas->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $areas->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $areas->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $areas->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $territories->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $territories->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $territories->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $territories->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $designs->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $sale_points->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $sale_points->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $sale_points->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $sale_points->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $invoices->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $invoices->id,
                'name' => 'Read',
            ],
            [
                'sub_menu_id' => $invoices->id,
                'name' => 'Update',
            ],
            [
                'sub_menu_id' => $invoices->id,
                'name' => 'Delete',
            ],

            [
                'sub_menu_id' => $acceptedInvoices->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $dues->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $dues->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $updateDues->id,
                'name' => 'Create',
            ],
            [
                'sub_menu_id' => $updateDues->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $orderSummary->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $sales->id,
                'name' => 'Read',
            ],

            [
                'sub_menu_id' => $transections->id,
                'name' => 'Read',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'sub_menu_id' => $permission['sub_menu_id'],
                'name' => $permission['name'],
                'slug' => Str::slug($permission['name'])
            ]);
        }
    }
}
