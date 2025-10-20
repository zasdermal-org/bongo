<?php

namespace Module\Market\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Module\Sales\Models\OrderInvoice;

class SalePoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'territory_id',
        'name',
        'code_number',
        'address',
        'contact_name',
        'contact_number',
        'is_active'
    ];

    public function territory() // used
    {
        return $this->belongsTo(Territory::class);
    }

    public function orderInvoices()
    {
        return $this->hasMany(OrderInvoice::class);
    }
}
