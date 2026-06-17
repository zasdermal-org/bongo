<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OReturnInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sale_point_id',
        'invoice_number',
        'return_amount'
    ];

    public function o_returns()
    {
        return $this->belongsToMany(OReturn::class)->withTimestamps();
    }
}
