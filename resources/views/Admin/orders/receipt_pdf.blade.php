@extends('Admin.adminLayout')
@section('content')


<div class="container">
    <div class="header">
        <h2>Order Receipt</h2>
        <p>Order #{{ $order->id }}</p>
    </div>
    <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y H:i') }}</p>
    <p><strong>Customer:</strong> {{ $order->user ? $order->user->name : 'Guest' }}</p>
    <p><strong>Email:</strong> {{ $order->user ? $order->user->email : 'N/A' }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>
    <hr>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Unit Price</th>
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
    <hr>
    <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
    <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
    <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
    <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
    <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
    <div class="footer">
        <p>Thank you for shopping with us!</p>
    </div>
</div>
@endsection