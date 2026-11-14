<?php

namespace Module\Sales\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionRequest extends Model
{
    protected $fillable = [
        'submitted_by_user_id',
        'approved_by_user_id',
        'sale_point_id',
        'selected_invoices',
        'invoice_type',
        'total_collect',
        'adjustment_amt',
        'return_amt',
        'advance',
        'payment_type',
        'receipt_number',
        'status',
        'collection_date',
        'remark'
    ];

    protected $casts = [
        'selected_invoices' => 'array',
        'collection_date' => 'datetime'
    ];
}
