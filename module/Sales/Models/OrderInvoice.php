<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Module\Access\Models\Depot;
use Module\Access\Models\User;

use Module\Market\Models\SalePoint;
use Module\Market\Models\Territory;

class OrderInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'submitted_by_user_id',
        'updated_by_user_id',
        'sale_point_id',
        'territory_id',
        'depot_id',
        'invoice_number',
        'total_amount',
        'discount',
        'addi_discount',
        'paid',
        'due',
        'type',
        'payment_type',
        'status',
        'payment_status',
        'return_amount',
        'return_note',
        'invoice_date',

        'created_at', // temp
        'updated_at' //temp
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function salePoint()
    {
        return $this->belongsTo(SalePoint::class);
    }

    public function territory()
    {
        return $this->belongsTo(Territory::class);
    }

    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }

    // public function collections()
    // {
    //     return $this->hasMany(Collection::class, 'order_invoice_id');
    // }
}
