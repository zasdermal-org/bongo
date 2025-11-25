<!DOCTYPE html>
<html>
<head>
    <style>
        table { width: 100%; border-collapse: collapse; }
        td, th { border:1px solid #ccc; padding:6px; text-align: left; }
        th { background: #f2f2f2; }
    </style>
</head>
<body>

<h2>Accepted Invoices Report</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Invoice No</th>
            <th>Order By</th>
            <th>Sales Point</th>
            <th>Type</th>
            <th>Payment</th>
            <th>Territory</th>
            <th>Order Date</th>
            <th>Invoice Date</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orderInvoices as $k => $invoice)
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $invoice->invoice_number }}</td>
                <td>{{ $invoice->user->name }}</td>
                <td>{{ $invoice->salePoint->name }}</td>
                <td>{{ $invoice->type }}</td>
                <td>{{ $invoice->payment_type }}</td>
                <td>{{ $invoice->territory->name }}</td>
                <td>{{ $invoice->created_at->format('d-m-Y') }}</td>
                <td>{{ $invoice->invoice_date->format('d-m-Y') }}</td>
                <td>{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
