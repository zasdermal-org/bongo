<?php

namespace Module\Access\Seeders;

use Module\Access\Models\Menu;

use Illuminate\Database\Seeder;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            'User Management',
            'Catalog',
            'Stock',
            'Location',
            'Sale Point',
            'Order',
            'Collection',
            'Report',
        ];

        foreach ($menus as $menu) {
            $slug = strtolower(str_replace(' ', '-', $menu));
            Menu::create([
                'name' => $menu,
                'slug' => $slug
            ]);
        }
    }
}
