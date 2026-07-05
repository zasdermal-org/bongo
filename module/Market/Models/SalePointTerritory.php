<?php

namespace Module\Market\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePointTerritory extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_point_id', 
        'territory_id'
    ];

    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }
}
