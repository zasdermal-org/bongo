<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Module\Access\Models\User;
use Module\Market\Models\SalePoint;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sale_point_id',
        'invoice_numbers',
        'total_collect',
        'adjustment_amt',
        'return_amt',
        'advance',
        'payment_type',
        'receipt_number',
        'created_at',
        'updated_at',
    ];

    public function orderInvoice()
    {
        return $this->belongsTo(OrderInvoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salePoint()
    {
        return $this->belongsTo(SalePoint::class);
    }
}
