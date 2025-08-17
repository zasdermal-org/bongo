<?php

namespace Module\Market\Seeders;

use Module\Market\Models\Region;
use Module\Market\Models\Division;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $north = Division::where('slug', 'north')->first();
        $south = Division::where('slug', 'south')->first();

        $regions = [
            [
                'division_id' => $north->id,
                'name' => 'East'
            ],
            [
                'division_id' => $south->id,
                'name' => 'West'
            ],
            [
                'division_id' => $north->id,
                'name' => 'North'
            ],
            [
                'division_id' => $south->id,
                'name' => 'South'
            ]
        ];

        foreach ($regions as $region) {
            Region::create([
                'division_id' => $region['division_id'],
                'name' => $region['name'],
                'slug' => Str::slug($region['name']),
                'is_active' => 'Active'
            ]);
        }
    }
}
