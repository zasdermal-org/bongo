<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_id',
        'sku',
        'quantity',
        'unit_price',
        'total_amount'
    ];
}
