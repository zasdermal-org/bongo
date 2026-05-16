<?php

use Illuminate\Support\Facades\Route;

use Module\Market\Controllers\AreaController;
use Module\Market\Controllers\RegionController;
use Module\Market\Controllers\SalePointController;
use Module\Market\Controllers\TerritoryController;

Route::post('/sale-points-by-territory', [SalePointController::class, 'salePoints_by_territory']);

Route::get('/regions', [RegionController::class, 'region_list']);
Route::get('/areas-by-region/{id}', [AreaController::class, 'area_list']);
Route::get('/territories-by-area/{id}', [TerritoryController::class, 'territory_list']);