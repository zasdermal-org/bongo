<?php

namespace Module\Market\Seeders;

use Module\Market\Models\Area;
use Module\Market\Models\Territory;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TerritoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rangpur = Area::where('slug', 'rangpur')->first();
        $rajshahi = Area::where('slug', 'rajshahi')->first();
        $thakurgaon = Area::where('slug', 'thakurgaon')->first();
        $dinajpur = Area::where('slug', 'dinajpur')->first();
        $bogura = Area::where('slug', 'bogura')->first();
        $barishal = Area::where('slug', 'barishal')->first();
        $chuadanga = Area::where('slug', 'chuadanga')->first();
        $dhaka = Area::where('slug', 'dhaka')->first();
        $jamalpur = Area::where('slug', 'jamalpur')->first();
        $cumilla = Area::where('slug', 'cumilla')->first();
        $khulna = Area::where('slug', 'khulna')->first();
        $naogaon = Area::where('slug', 'naogaon')->first();
        $faridpur = Area::where('slug', 'faridpur')->first();
        $coxsbazar = Area::where('slug', 'coxs-bazar')->first();
        $gopalgonj = Area::where('slug', 'gopalgonj')->first();
        $corporate = Area::where('slug', 'corporate')->first();

        $territories = [
            [
                'area_id' => $jamalpur->id,
                'name' => 'Jamalpur'
            ],
            [
                'area_id' => $rajshahi->id,
                'name' => 'Natore'
            ],
            [
                'area_id' => $dinajpur->id,
                'name' => 'Birol'
            ],
            [
                'area_id' => $chuadanga->id,
                'name' => 'Chuadanga'
            ],
            [
                'area_id' => $barishal->id,
                'name' => 'Amtoli'
            ],
            [
                'area_id' => $thakurgaon->id,
                'name' => 'Thakurgaon'
            ],
            [
                'area_id' => $barishal->id,
                'name' => 'Bhola'
            ],
            [
                'area_id' => $bogura->id,
                'name' => 'Joypurhat'
            ],
            [
                'area_id' => $bogura->id,
                'name' => 'Birganj'
            ],
            [
                'area_id' => $chuadanga->id,
                'name' => 'Meherpur'
            ],
            [
                'area_id' => $jamalpur->id,
                'name' => 'Sorisabari'
            ],
            [
                'area_id' => $rajshahi->id,
                'name' => 'Tanore'
            ],
            [
                'area_id' => $bogura->id,
                'name' => 'Ghoraghat'
            ],
            [
                'area_id' => $khulna->id,
                'name' => 'Monirampur'
            ],
            [
                'area_id' => $khulna->id,
                'name' => 'Khulna'
            ],
            [
                'area_id' => $naogaon->id,
                'name' => 'Naogaon'
            ],
            [
                'area_id' => $naogaon->id,
                'name' => 'Sapahar'
            ],
            [
                'area_id' => $dhaka->id,
                'name' => 'Manikgonj'
            ],
            [
                'area_id' => $chuadanga->id,
                'name' => 'Jhenaidah'
            ],
            [
                'area_id' => $faridpur->id,
                'name' => 'Faridpur'
            ],
            [
                'area_id' => $thakurgaon->id,
                'name' => 'Pirgonj'
            ],
            [
                'area_id' => $naogaon->id,
                'name' => 'Mohadebpur'
            ],
            [
                'area_id' => $dinajpur->id,
                'name' => 'Birampur'
            ],
            [
                'area_id' => $rajshahi->id,
                'name' => 'Pabna'
            ],

            [
                'area_id' => $naogaon->id,
                'name' => 'Niamatpur'
            ],
            [
                'area_id' => $gopalgonj->id,
                'name' => 'Gopalgonj'
            ],
            [
                'area_id' => $khulna->id,
                'name' => 'Jessore'
            ],
            [
                'area_id' => $dinajpur->id,
                'name' => 'Dinajpur'
            ],
            [
                'area_id' => $coxsbazar->id,
                'name' => "Cox's Bazar"
            ],
            [
                'area_id' => $chuadanga->id,
                'name' => 'Kushtia'
            ],
            [
                'area_id' => $khulna->id,
                'name' => 'Chuknagar'
            ],
            [
                'area_id' => $khulna->id,
                'name' => 'Kaligoanj'
            ],
            [
                'area_id' => $cumilla->id,
                'name' => 'Cumilla'
            ],
            [
                'area_id' => $corporate->id,
                'name' => 'Corporate'
            ],
        ];

        foreach ($territories as $territorie) {
            Territory::create([
                'area_id' => $territorie['area_id'],
                'name' => $territorie['name'],
                'slug' => Str::slug($territorie['name']),
                'is_active' => 'Active'
            ]);
        }
    }
}
