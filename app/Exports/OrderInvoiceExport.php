<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrderInvoiceExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($orderInvoices)
    {
        $this->data = $orderInvoices;
    }

    public function headings(): array
    {
        return [
            'Invoice No',
            'Order By',
            'Sale Point',
            'Type',
            'Payment Type',
            'Territory',
            'Order Date',
            'Invoice Date',
            'Amount',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return $this->orders->map(function ($row) {
        //     return [
        //         'Invoice No'      => $row->invoice_number,
        //         'Order By'        => $row->user->name,
        //         'Sale Point'      => $row->salePoint->name,
        //         'Type'            => $row->type,
        //         'Payment Type'    => $row->payment_type,
        //         'Territory'       => $row->territory->name,
        //         'Order Date'      => $row->created_at?->format('d-m-Y'),
        //         'Invoice Date'    => $row->invoice_date?->format('d-m-Y'),
        //         'Amount'          => $row->total_amount,
        //         'Status'          => $row->status,
        //     ];
        // });

        return $this->data->map(function ($invoice) {
            return [
                $invoice->invoice_number,
                $invoice->user->name,
                $invoice->salePoint->name,
                $invoice->type,
                $invoice->payment_type,
                $invoice->territory->name,
                $invoice->created_at->format('d-m-Y'),
                $invoice->invoice_date->format('d-m-Y'),
                $invoice->total_amount,
            ];
        });
    }
}
