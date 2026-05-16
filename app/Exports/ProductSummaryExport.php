<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductSummaryExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($orders)
    {
        $this->data = $orders;
    }

    public function headings(): array
    {
        return [
            'SKU',
            'Product Name',
            'Unit Price',
            'Quantity'
        ];
    }

    public function collection()
    {
        return $this->data->map(function ($order) {
            return [
                $order->sku,
                $order->product_name,
                $order->unit_price,
                $order->total_quantity
            ];
        });
    }
}
