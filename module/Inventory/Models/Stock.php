<?php

namespace Module\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Module\Report\Models\Transection;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'sku',
        'quantity',
        'unit_price'
    ];

    public function transaction()
    {
        return $this->hasOne(Transection::class, 'stock_id')->latest('created_at');
    }
}
