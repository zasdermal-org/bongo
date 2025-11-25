<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderSummaryExport implements FromCollection, WithHeadings
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
            'Required Quantity',
            'Available Quantity',
            'Remaining Quantity',
        ];
    }

    public function collection()
    {
        return $this->data->map(function ($order) {
            return [
                $order->sku,
                $order->product_name,
                $order->total_quantity,
                $order->available_stock,
                $order->available_stock - $order->total_quantity,
            ];
        });
    }
}
