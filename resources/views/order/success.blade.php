@extends('User.userLayout')
@section('content')

<div class="container mt-5">
    <div class="receipt-container shadow-lg p-4 bg-white rounded">
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Order Receipt</h2>
            <small class="text-muted">Thank you for shopping with us!</small>
        </div>

        <!-- Order Information -->
        <div class="border p-3 mb-4">
            <h5 class="text-primary">Order #{{ $order->id }}</h5>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y H:i') }}</p>
            <p><strong>Customer Name:</strong> {{ $order->name }}</p>
            <p><strong>Email:</strong> {{ $order->email }}</p>
            <p><strong>Shipping Address:</strong> {{ $order->address }}</p>
            <p><strong>Phone:</strong> {{ $order->phone }}</p>
        </div>

        <!-- Order Items -->
        <h5 class="mb-3">Order Items</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->orderItems ?? [] as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Order Summary -->
        <div class="border p-3 mt-3">
            <p><strong>Subtotal:</strong> ${{ number_format($order->subtotal, 2) }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
            <p><strong>Payment Status:</strong> <span class="badge bg-{{ $order->payment_status == 'Completed' ? 'success' : 'warning' }}">{{ $order->payment_status }}</span></p>
            <p><strong>Order Status:</strong> <span class="badge bg-{{ $order->order_status == 'Confirmed' ? 'success' : 'danger' }}">{{ $order->order_status }}</span></p>
        </div>

        <!-- Download PDF Button -->
        <div class="text-center mt-4">
            <a href="{{ route('order.downloadReceipt', $order->id) }}" class="btn btn-primary">
                Download PDF <i class="fa fa-download"></i>
            </a>
        </div>
    </div>
</div>

@endsection
