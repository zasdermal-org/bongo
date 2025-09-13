<?php

namespace Module\Access\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

use Module\Access\Models\Menu;
use Module\Access\Models\SubMenu;

class SubMenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_management = Menu::where('slug', 'user-management')->first();
        $catalog = Menu::where('slug', 'catalog')->first();
        $stock = Menu::where('slug', 'stock')->first();
        $location = Menu::where('slug', 'location')->first();
        $sale_point = Menu::where('slug', 'sale-point')->first();
        $order = Menu::where('slug', 'order')->first();
        $collection = Menu::where('slug', 'collection')->first();
        $report = Menu::where('slug', 'report')->first();

        $sub_menus = [
            // user management
            [
                'menu_id' => $user_management->id,
                'name' => 'Permissions'
            ],
            [
                'menu_id' => $user_management->id,
                'name' => 'Roles'
            ],
            [
                'menu_id' => $user_management->id,
                'name' => 'Users'
            ],

            // catalog
            [
                'menu_id' => $catalog->id,
                'name' => 'Categories'
            ],
            [
                'menu_id' => $catalog->id,
                'name' => 'Sub Categories'
            ],
            [
                'menu_id' => $catalog->id,
                'name' => 'Products'
            ],

            // stocks
            [
                'menu_id' => $stock->id,
                'name' => 'Stocks'
            ],

            // location
            [
                'menu_id' => $location->id,
                'name' => 'Zones'
            ],
            [
                'menu_id' => $location->id,
                'name' => 'Divisions'
            ],
            [
                'menu_id' => $location->id,
                'name' => 'Regions'
            ],
            [
                'menu_id' => $location->id,
                'name' => 'Areas'
            ],
            [
                'menu_id' => $location->id,
                'name' => 'Territories'
            ],
            [
                'menu_id' => $location->id,
                'name' => 'Designs'
            ],

            // sale points
            [
                'menu_id' => $sale_point->id,
                'name' => 'Sale Points'
            ],

            // order
            [
                'menu_id' => $order->id,
                'name' => 'Invoices'
            ],
            [
                'menu_id' => $order->id,
                'name' => 'Accepted Invoices'
            ],

            // collection
            [
                'menu_id' => $collection->id,
                'name' => 'Dues'
            ],
            [
                'menu_id' => $collection->id,
                'name' => 'Update Dues'
            ],

            // report
            [
                'menu_id' => $report->id,
                'name' => 'Order Summary'
            ],
            [
                'menu_id' => $report->id,
                'name' => 'Sales'
            ],
            [
                'menu_id' => $report->id,
                'name' => 'Transections'
            ],
        ];

        foreach ($sub_menus as $sub_menu) {
            SubMenu::create([
                'menu_id' => $sub_menu['menu_id'],
                'name' => $sub_menu['name'],
                'slug' => Str::slug($sub_menu['name'])
            ]);
        }
    }
}
