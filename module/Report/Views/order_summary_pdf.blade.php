<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Summary</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        h2 { text-align: center; }
    </style>
</head>
<body>
    <h2>Order Summary</h2>
    @if(isset($fromDate) && isset($toDate))
        <p>Date Range: {{ $fromDate }} - {{ $toDate }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>SKU</th>
                <th>Product Name</th>
                <th>Required Quantity</th>
                <th>Available Quantity</th>
                <th>Remaining Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->sku }}</td>
                    <td>{{ $order->product_name }}</td>
                    <td>{{ $order->total_quantity }}</td>
                    <td>{{ $order->available_stock }}</td>
                    <td>{{ $order->available_stock - $order->total_quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
