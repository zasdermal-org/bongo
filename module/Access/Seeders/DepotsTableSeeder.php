<?php

namespace Module\Access\Seeders;

use Illuminate\Database\Seeder;

use Module\Access\Models\Depot;

class DepotsTableSeeder extends Seeder
{
    public function run(): void
    {
        $depots = [
            'Mirpur',
            'Bogura'
        ];

        foreach ($depots as $depot) {
            Depot::create([
                'name' => $depot,
                'is_active' => 'Active'
            ]);
        }
    }
}
