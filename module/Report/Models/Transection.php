<?php

namespace Module\Report\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Module\Sales\Models\OrderInvoice;

class Transection extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stock_id',
        'order_invoice_id',
        'product_name',
        'sku',
        'pre_stock',
        'tran_quant',
        'curr_stock',
        'sales_value',
        'tran_type',
        'status'
    ];

    public function orderInvoice()
    {
        return $this->belongsTo(OrderInvoice::class);
    }
}
