<?php

namespace Module\Access\Seeders;

use Module\Access\Models\Designation;

use Illuminate\Database\Seeder;

class DesignationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            'Chairman',
            'Managing Director',
            'Chief Executive Officer',
            'Executive, Logistics',
            'Sr. Executive Reg. & Admin',
            'Jr. Executive Accounts',
            'Store Officer',
            'Divisional Sales Manager',
            'Regional Sales Manager',
            'Sr. Marketing Officer',
            'Marketing Officer',
            'Assistant Marketing Officer',
            'Area Sales Executive',
            'Territory Manager'
        ];

        foreach ($designations as $designation) {
            $slug = strtolower(str_replace(' ', '-', $designation));
            Designation::create([
                'name' => $designation,
                'slug' => $slug
            ]);
        }
    }
}
