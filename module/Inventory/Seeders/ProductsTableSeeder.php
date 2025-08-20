<?php

namespace Module\Inventory\Seeders;


use Module\Inventory\Models\Product;
use Module\Inventory\Models\Category;
use Module\Inventory\Models\SubCategory;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $boricAcid = SubCategory::where('slug', 'boric-acid')->first();
        $humicGoldPlus = SubCategory::where('slug', 'humic-gold-plus')->first();
        $bongoMag = SubCategory::where('slug', 'bongo-mag')->first();
        $rootGrow = SubCategory::where('slug', 'root-grow')->first();
        $soluborBoron = SubCategory::where('slug', 'solubor-boron')->first();
        $bongoZinc = SubCategory::where('slug', 'bongo-zinc')->first();
        $zypsum = SubCategory::where('slug', 'zypsum')->first();
        $sakuraGold = SubCategory::where('slug', 'sakura-gold')->first();
        $tonic = SubCategory::where('slug', 'tonic')->first();
        $bongoShot = SubCategory::where('slug', 'bongo-shot')->first();
        $cipro = SubCategory::where('slug', 'cipro')->first();
        $imo = SubCategory::where('slug', 'imo')->first();
        $karmo = SubCategory::where('slug', 'karmo')->first();
        $mestra = SubCategory::where('slug', 'mestra')->first();
        $pairaits = SubCategory::where('slug', 'pairaits')->first();
        $rafyel = SubCategory::where('slug', 'rafyel')->first();
        $strip = SubCategory::where('slug', 'strip')->first();
        $bitterGourd = SubCategory::where('slug', 'bitter-gourd')->first();
        $okra = SubCategory::where('slug', 'okra')->first();
        $bottleGourd = SubCategory::where('slug', 'bottle-gourd')->first();
        $chili = SubCategory::where('slug', 'chili')->first();
        $pumpkin = SubCategory::where('slug', 'pumpkin')->first();
        $cucumber = SubCategory::where('slug', 'cucumber')->first();
        $snackGourd = SubCategory::where('slug', 'snack-gourd')->first();
        $ridgeGourd = SubCategory::where('slug', 'ridge-gourd')->first();
        $spongeGourd = SubCategory::where('slug', 'sponge-gourd')->first();
        $watermealon = SubCategory::where('slug', 'watermealon')->first();
        $brinjal = SubCategory::where('slug', 'brinjal')->first();
        $radish = SubCategory::where('slug', 'radish')->first();
        $knolkhol = SubCategory::where('slug', 'knolkhol')->first();
        $tometo = SubCategory::where('slug', 'tometo')->first();
        $cauliflower = SubCategory::where('slug', 'cauliflower')->first();
        
        $products = [
            [
                'category_id' => $boricAcid->category_id,
                'sub_category_id' => $boricAcid->id,
                'title' => 'Bongo Boric (Boric Acid) 500gm',
                'sku' => 'FBA1649',
                'unit_price' => 110
            ],
            [
                'category_id' => $humicGoldPlus->category_id,
                'sub_category_id' => $humicGoldPlus->id,
                'title' => 'Bongo Humic Gold Plus 500gm',
                'sku' => 'FHGP8614',
                'unit_price' => 75
            ],
            [
                'category_id' => $bongoMag->category_id,
                'sub_category_id' => $bongoMag->id,
                'title' => 'Bongo Mag (Crystal) 1kg',
                'sku' => 'FBM3774',
                'unit_price' => 45
            ],
            [
                'category_id' => $bongoMag->category_id,
                'sub_category_id' => $bongoMag->id,
                'title' => 'Bongo Mag (Dust) 1kg',
                'sku' => 'FBM1978',
                'unit_price' => 35
            ],
            [
                'category_id' => $rootGrow->category_id,
                'sub_category_id' => $rootGrow->id,
                'title' => 'Bongo Root Grow (NAA) 1kg',
                'sku' => 'FRG3917',
                'unit_price' => 70
            ],
            [
                'category_id' => $soluborBoron->category_id,
                'sub_category_id' => $soluborBoron->id,
                'title' => 'Bongo Solubor (Solubor Boron) 500gm',
                'sku' => 'FSB4692',
                'unit_price' => 210
            ],
            [
                'category_id' => $soluborBoron->category_id,
                'sub_category_id' => $soluborBoron->id,
                'title' => 'Bongo Solubor (Solubor Boron) 100gm',
                'sku' => 'FSB8858',
                'unit_price' => 45
            ],
            [
                'category_id' => $bongoZinc->category_id,
                'sub_category_id' => $bongoZinc->id,
                'title' => 'Bongo Zinc (Chelated) 17gm',
                'sku' => 'FBZ1099',
                'unit_price' => 17
            ],
            [
                'category_id' => $bongoZinc->category_id,
                'sub_category_id' => $bongoZinc->id,
                'title' => 'Bongo Zinc (Hepta) 1kg',
                'sku' => 'FBZ9198',
                'unit_price' => 135
            ],
            [
                'category_id' => $bongoZinc->category_id,
                'sub_category_id' => $bongoZinc->id,
                'title' => 'Bongo Zinc (Mono) 1kg',
                'sku' => 'FBZ1229',
                'unit_price' => 220
            ],
            [
                'category_id' => $zypsum->category_id,
                'sub_category_id' => $zypsum->id,
                'title' => 'Bongo Zypsum 10kg',
                'sku' => 'FZ2453',
                'unit_price' => 280
            ],
            [
                'category_id' => $zypsum->category_id,
                'sub_category_id' => $zypsum->id,
                'title' => 'Bongo Zypsum 5kg',
                'sku' => 'FZ7527',
                'unit_price' => 155
            ],
            [
                'category_id' => $sakuraGold->category_id,
                'sub_category_id' => $sakuraGold->id,
                'title' => 'Sakura Gold (PGR) 1000ml',
                'sku' => 'FSG7209',
                'unit_price' => 450
            ],
            [
                'category_id' => $sakuraGold->category_id,
                'sub_category_id' => $sakuraGold->id,
                'title' => 'Sakura Gold (PGR) 500ml',
                'sku' => 'FSG3344',
                'unit_price' => 250
            ],
            [
                'category_id' => $sakuraGold->category_id,
                'sub_category_id' => $sakuraGold->id,
                'title' => 'Sakura Gold (PGR) 250ml',
                'sku' => 'FSG8409',
                'unit_price' => 140
            ],
            [
                'category_id' => $sakuraGold->category_id,
                'sub_category_id' => $sakuraGold->id,
                'title' => 'Sakura Gold (PGR) 100ml',
                'sku' => 'FSG1035',
                'unit_price' => 60
            ],
            [
                'category_id' => $tonic->category_id,
                'sub_category_id' => $tonic->id,
                'title' => 'Tonic (GA-3) 10gm',
                'sku' => 'FT7370',
                'unit_price' => 85
            ],
            [
                'category_id' => $bongoShot->category_id,
                'sub_category_id' => $bongoShot->id,
                'title' => 'Bongo Shot 20 EC 400ml',
                'sku' => 'PBS6699',
                'unit_price' => 625
            ],
            [
                'category_id' => $bongoShot->category_id,
                'sub_category_id' => $bongoShot->id,
                'title' => 'Bongo Shot 20 EC 100ml',
                'sku' => 'PBS8465',
                'unit_price' => 169
            ],
            [
                'category_id' => $bongoShot->category_id,
                'sub_category_id' => $bongoShot->id,
                'title' => 'Bongo Shot 20 EC 50ml',
                'sku' => 'PBS2410',
                'unit_price' => 88
            ],
            [
                'category_id' => $cipro->category_id,
                'sub_category_id' => $cipro->id,
                'title' => 'Cipro 55 EC 1000ml',
                'sku' => 'PC1550',
                'unit_price' => 995
            ],
            [
                'category_id' => $cipro->category_id,
                'sub_category_id' => $cipro->id,
                'title' => 'Cipro 55 EC 500ml',
                'sku' => 'PC8935',
                'unit_price' => 502
            ],
            [
                'category_id' => $cipro->category_id,
                'sub_category_id' => $cipro->id,
                'title' => 'Cipro 55 EC 400ml',
                'sku' => 'PC1256',
                'unit_price' => 410
            ],
            [
                'category_id' => $cipro->category_id,
                'sub_category_id' => $cipro->id,
                'title' => 'Cipro 55 EC 100ml',
                'sku' => 'PC9165',
                'unit_price' => 112
            ],
            [
                'category_id' => $cipro->category_id,
                'sub_category_id' => $cipro->id,
                'title' => 'Cipro 55 EC 50ml',
                'sku' => 'PC3712',
                'unit_price' => 65
            ],
            [
                'category_id' => $imo->category_id,
                'sub_category_id' => $imo->id,
                'title' => 'IMO WDG 300gm',
                'sku' => 'PI3405',
                'unit_price' => 675
            ],
            [
                'category_id' => $imo->category_id,
                'sub_category_id' => $imo->id,
                'title' => 'IMO 60 WDG 100gm',
                'sku' => 'PI1175',
                'unit_price' => 230
            ],
            [
                'category_id' => $imo->category_id,
                'sub_category_id' => $imo->id,
                'title' => 'IMO 60 WDG 50gm',
                'sku' => 'PI1035',
                'unit_price' => 128
            ],
            [
                'category_id' => $karmo->category_id,
                'sub_category_id' => $karmo->id,
                'title' => 'Karmo 75 WP 500gm',
                'sku' => 'PK4742',
                'unit_price' => 445
            ],
            [
                'category_id' => $karmo->category_id,
                'sub_category_id' => $karmo->id,
                'title' => 'Karmo 75 WP 100gm',
                'sku' => 'PK6933',
                'unit_price' => 103
            ],
            [
                'category_id' => $mestra->category_id,
                'sub_category_id' => $mestra->id,
                'title' => 'Mestra 55 SC 500ml',
                'sku' => 'PM5726',
                'unit_price' => 498
            ],
            [
                'category_id' => $mestra->category_id,
                'sub_category_id' => $mestra->id,
                'title' => 'Mestra 55 SC 250ml',
                'sku' => 'PM7201',
                'unit_price' => 255
            ],
            [
                'category_id' => $mestra->category_id,
                'sub_category_id' => $mestra->id,
                'title' => 'Mestra 55 SC 100ml',
                'sku' => 'PM5881',
                'unit_price' => 108
            ],
            [
                'category_id' => $pairaits->category_id,
                'sub_category_id' => $pairaits->id,
                'title' => 'Pairaits 70 WG 100gm',
                'sku' => 'PP6703',
                'unit_price' => 575
            ],
            [
                'category_id' => $pairaits->category_id,
                'sub_category_id' => $pairaits->id,
                'title' => 'Pairaits 70 WG 50gm',
                'sku' => 'PP7384',
                'unit_price' => 300
            ],
            [
                'category_id' => $pairaits->category_id,
                'sub_category_id' => $pairaits->id,
                'title' => 'Pairaits 70 WG 15gm',
                'sku' => 'PP8465',
                'unit_price' => 95
            ],
            [
                'category_id' => $rafyel->category_id,
                'sub_category_id' => $rafyel->id,
                'title' => 'Rafayel 18 WP 100gm',
                'sku' => 'PR1093',
                'unit_price' => 60
            ],
            [
                'category_id' => $strip->category_id,
                'sub_category_id' => $strip->id,
                'title' => 'Strip 500ml',
                'sku' => 'PS6397',
                'unit_price' => 1492
            ],
            [
                'category_id' => $strip->category_id,
                'sub_category_id' => $strip->id,
                'title' => 'Strip 400ml',
                'sku' => 'PS8373',
                'unit_price' => 1258
            ],
            [
                'category_id' => $strip->category_id,
                'sub_category_id' => $strip->id,
                'title' => 'Strip 100ml',
                'sku' => 'PS7313',
                'unit_price' => 344
            ],
            [
                'category_id' => $strip->category_id,
                'sub_category_id' => $strip->id,
                'title' => 'Strip 50ml',
                'sku' => 'PS1002',
                'unit_price' => 182
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Kaveri-88 10gm',
                'sku' => 'SBG9084'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Captain 10gm',
                'sku' => 'SBG8385'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Utshob 10gm',
                'sku' => 'SBG9389'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Utshob 20gm',
                'sku' => 'SBG1391'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Jhumka Super 10gm',
                'sku' => 'SBG8961'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Maharaza Plus 10gm',
                'sku' => 'SBG2391'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Samira Plus 10gm',
                'sku' => 'SBG1012'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Hasi 10gm',
                'sku' => 'SBG6971'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Hasi 20gm',
                'sku' => 'SBG4104'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Shokh 10gm',
                'sku' => 'SBG7865'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Shokh 20gm',
                'sku' => 'SBG3270'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Kajol Super 10gm',
                'sku' => 'SBG5326'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Jui 10gm',
                'sku' => 'SBG6246'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Jui 20gm',
                'sku' => 'SBG9292'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Bongo Queen 5gm',
                'sku' => 'SBG1001'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Bongo Queen 10gm',
                'sku' => 'SBG1517'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Chamok 10gm',
                'sku' => 'SBG8883'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Khushi 10gm',
                'sku' => 'SBG7050'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Khushi 20gm',
                'sku' => 'SBG7006'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Bongo King 5gm',
                'sku' => 'SBG7758'
            ],
            [
                'category_id' => $bitterGourd->category_id,
                'sub_category_id' => $bitterGourd->id,
                'title' => 'Bongo King 10gm',
                'sku' => 'SBG2479'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Punam 50gm',
                'sku' => 'SO9926'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Priya 10gm',
                'sku' => 'SO4832'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Priya 25gm',
                'sku' => 'SO6850'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Priya 50gm',
                'sku' => 'SO9956'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Priya 100gm',
                'sku' => 'SO7087'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Laboni 50gm',
                'sku' => 'SO4678'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Laboni 100gm',
                'sku' => 'SO4326'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Boishakhi 50gm',
                'sku' => 'SO3694'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Boishakhi 100gm',
                'sku' => 'SO6388'
            ],
            [
                'category_id' => $okra->category_id,
                'sub_category_id' => $okra->id,
                'title' => 'Bharat 100gm',
                'sku' => 'SO1506'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Ovi 10gm',
                'sku' => 'SBG4969'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Rosia 5gm',
                'sku' => 'SBG2790'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Rosia 10gm',
                'sku' => 'SBG2066'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Mayuri 5gm',
                'sku' => 'SBG3217'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Mayuri 10gm',
                'sku' => 'SBG4865'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Bongo Super 5gm',
                'sku' => 'SBG3260'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Bongo Super 10gm',
                'sku' => 'SBG6048'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Bongo Gold 5gm',
                'sku' => 'SBG3045'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Bongo Gold 10gm',
                'sku' => 'SBG3932'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Deizi 5gm',
                'sku' => 'SBG6869'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Deizi 10gm',
                'sku' => 'SBG6554'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Super Green 5gm',
                'sku' => 'SBG3725'
            ],
            [
                'category_id' => $bottleGourd->category_id,
                'sub_category_id' => $bottleGourd->id,
                'title' => 'Super Green 10gm',
                'sku' => 'SBG8545'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'KHC-179 10gm',
                'sku' => 'SC8084'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'BS-1701 DG 5gm',
                'sku' => 'SC2171'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'BS-1701 DG 10gm',
                'sku' => 'SC5353'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'KHC-177 10gm',
                'sku' => 'SC3683'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'Lalgolapi 5gm',
                'sku' => 'SC7464'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'Lalgolapi 10gm',
                'sku' => 'SC6792'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'Boby 10gm',
                'sku' => 'SC6714'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'Fire Green 5gm',
                'sku' => 'SC5181'
            ],
            [
                'category_id' => $chili->category_id,
                'sub_category_id' => $chili->id,
                'title' => 'Fire Green 10gm',
                'sku' => 'SC1099'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Sweet Star 5gm',
                'sku' => 'SP1919'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Sweet Star 10gm',
                'sku' => 'SP2668'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Chitra Sweet-2 5gm',
                'sku' => 'SP5889'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Chitra Sweet-2 10gm',
                'sku' => 'SP9425'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Royel Bangle 5gm',
                'sku' => 'SP7650'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Royel Bangle 10gm',
                'sku' => 'SP7250'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Sweet Plus 5gm',
                'sku' => 'SP1796'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Sweet Plus 10gm',
                'sku' => 'SP6477'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Bongo Sweet 5gm',
                'sku' => 'SP4152'
            ],
            [
                'category_id' => $pumpkin->category_id,
                'sub_category_id' => $pumpkin->id,
                'title' => 'Bongo Sweet 10gm',
                'sku' => 'SP5719'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Deluxe-777 1gm',
                'sku' => 'SC7597'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Deluxe-777 5gm',
                'sku' => 'SC5895'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Deluxe-777 10gm',
                'sku' => 'SC3431'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Super King 10gm',
                'sku' => 'SC4798'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Juboraj 10gm',
                'sku' => 'SC2228'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Sabuj Shathi 5gm',
                'sku' => 'SC1758'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Sabuj Shathi 10gm',
                'sku' => 'SC9742'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Champion-1122 5gm',
                'sku' => 'SC2753'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Champion-1122 10gm',
                'sku' => 'SC1688'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'BS-1122 5gm',
                'sku' => 'SC1458'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'BS-1122 10gm',
                'sku' => 'SC6710'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Rajmoti 5gm',
                'sku' => 'SC6630'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Rajmoti 10gm',
                'sku' => 'SC2654'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Kiyara 10gm',
                'sku' => 'SC2100'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Bongo Green 5gm',
                'sku' => 'SC4669'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Bongo Green 10gm',
                'sku' => 'SC1031'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Excellent 5gm',
                'sku' => 'SC8793'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Excellent 10gm',
                'sku' => 'SC4526'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Anonna 5gm',
                'sku' => 'SC5243'
            ],
            [
                'category_id' => $cucumber->category_id,
                'sub_category_id' => $cucumber->id,
                'title' => 'Anonna 10gm',
                'sku' => 'SC5448'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Bongo Rekha 5gm',
                'sku' => 'SSG2274'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Bongo Rekha 10gm',
                'sku' => 'SSG4257'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Varosha 5gm',
                'sku' => 'SSG7686'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Varosha 10gm',
                'sku' => 'SSG2070'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Bipasha 5gm',
                'sku' => 'SSG9986'
            ],
            [
                'category_id' => $snackGourd->category_id,
                'sub_category_id' => $snackGourd->id,
                'title' => 'Bipasha 10gm',
                'sku' => 'SSG9883'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Super Shot 5gm',
                'sku' => 'SRG9572'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Super Shot 10gm',
                'sku' => 'SRG7801'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Green Shot 10gm',
                'sku' => 'SRG3091'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Sangram 5gm',
                'sku' => 'SRG2101'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Sangram 10gm',
                'sku' => 'SRG6260'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Green Star 5gm',
                'sku' => 'SRG9050'
            ],
            [
                'category_id' => $ridgeGourd->category_id,
                'sub_category_id' => $ridgeGourd->id,
                'title' => 'Green Star 10gm',
                'sku' => 'SRG1603'
            ],
            [
                'category_id' => $spongeGourd->category_id,
                'sub_category_id' => $spongeGourd->id,
                'title' => 'Mukti 5gm',
                'sku' => 'SSG6771'
            ],
            [
                'category_id' => $spongeGourd->category_id,
                'sub_category_id' => $spongeGourd->id,
                'title' => 'Mukti 10gm',
                'sku' => 'SSG9110'
            ],
            [
                'category_id' => $spongeGourd->category_id,
                'sub_category_id' => $spongeGourd->id,
                'title' => 'Mitaly 5gm',
                'sku' => 'SSG9973'
            ],
            [
                'category_id' => $spongeGourd->category_id,
                'sub_category_id' => $spongeGourd->id,
                'title' => 'Mitaly 10gm',
                'sku' => 'SSG1405'
            ],
            [
                'category_id' => $spongeGourd->category_id,
                'sub_category_id' => $spongeGourd->id,
                'title' => 'Aliya 10gm',
                'sku' => 'SSG4958'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Ullash 20gm',
                'sku' => 'SW4428'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Ullash 50gm',
                'sku' => 'SW5747'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Ullash 100gm',
                'sku' => 'SW4606'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Top Dragon 100gm',
                'sku' => 'SW8179'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Five Star Dragon 50gm',
                'sku' => 'SW9344'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Five Star Dragon 100gm',
                'sku' => 'SW5587'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Mithai 50gm',
                'sku' => 'SW5041'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Mithai 100gm',
                'sku' => 'SW5660'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Shahi 50gm',
                'sku' => 'SW8711'
            ],
            [
                'category_id' => $watermealon->category_id,
                'sub_category_id' => $watermealon->id,
                'title' => 'Shahi 100gm',
                'sku' => 'SW4016'
            ],
            [
                'category_id' => $brinjal->category_id,
                'sub_category_id' => $brinjal->id,
                'title' => 'KEP-1509 10gm',
                'sku' => 'SB6094'
            ],
            [
                'category_id' => $brinjal->category_id,
                'sub_category_id' => $brinjal->id,
                'title' => 'Bagun King 5gm',
                'sku' => 'SB7563'
            ],
            [
                'category_id' => $brinjal->category_id,
                'sub_category_id' => $brinjal->id,
                'title' => 'Bagun King 10gm',
                'sku' => 'SB5828'
            ],
            [
                'category_id' => $brinjal->category_id,
                'sub_category_id' => $brinjal->id,
                'title' => 'Aporupa 5gm',
                'sku' => 'SB9511'
            ],
            [
                'category_id' => $brinjal->category_id,
                'sub_category_id' => $brinjal->id,
                'title' => 'Aporupa 10gm',
                'sku' => 'SB8020'
            ],
            [
                'category_id' => $radish->category_id,
                'sub_category_id' => $radish->id,
                'title' => 'BS-305 100gm',
                'sku' => 'SR3952'
            ],
            [
                'category_id' => $knolkhol->category_id,
                'sub_category_id' => $knolkhol->id,
                'title' => 'Happy 10gm',
                'sku' => 'SK4853'
            ],
            [
                'category_id' => $tometo->category_id,
                'sub_category_id' => $tometo->id,
                'title' => 'Anjali 5gm',
                'sku' => 'ST6843'
            ],
            [
                'category_id' => $tometo->category_id,
                'sub_category_id' => $tometo->id,
                'title' => 'KTM-1405 5gm',
                'sku' => 'ST1931'
            ],
            [
                'category_id' => $cauliflower->category_id,
                'sub_category_id' => $cauliflower->id,
                'title' => 'White Express 10gm',
                'sku' => 'SC3588'
            ],
        ];

        foreach ($products as $product) {
            // $category = Category::find($product['category_id']);
            // $catPrefix = strtoupper(substr($category->name, 0, 1));

            // $subCategory = SubCategory::find($product['sub_category_id']);
            // $subWords = explode(' ', $subCategory->name);

            // $subPrefix = '';
            // foreach ($subWords as $word) {
            //     $subPrefix .= strtoupper(substr($word, 0, 1));
            // }

            // $randNum = mt_rand(1000, 9999);

            // $sku = $catPrefix . $subPrefix . $randNum;
            
            Product::create([
                'category_id' => $product['category_id'],
                'sub_category_id' => $product['sub_category_id'],
                'title' => $product['title'],
                'slug' => Str::slug($product['title']),
                'sku' => $product['sku'],
                'unit_price' => $product['unit_price'] ?? 0,
                'is_active' => 'Active'
            ]);
        }
    }
}
