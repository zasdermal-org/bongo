<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Module\Access\Models\User;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sale_point_id',
        'invoice_numbers',
        'total_collect',
        'payment_type',
        'tracking_number'
    ];

    public function orderInvoice()
    {
        return $this->belongsTo(OrderInvoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
