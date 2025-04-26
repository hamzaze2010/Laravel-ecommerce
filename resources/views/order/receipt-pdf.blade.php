<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .order-details, .order-items, .summary { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: left; }
        .footer { text-align: center; margin-top: 20px; font-size: 12px; }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h2>Order Receipt</h2>
        <p>Thank you for shopping with us!</p>
    </div>

    <div class="order-details">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y H:i') }}</p>
        <p><strong>Customer:</strong> {{ $order->name }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
    </div>

    <div class="order-items">
        <h4>Order Items</h4>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="summary">
        <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
        <p><strong>Total:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
        <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        <p><strong>Order Status:</strong> {{ $order->order_status }}</p>
    </div>

    <div class="footer">
        <p>Thank you for shopping with us!</p>
    </div>
</div>

</body>
</html>
