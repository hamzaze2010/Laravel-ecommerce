@if($order)
<div class="card">
    <div class="card-header">
        Order #{{ $order->id }}
    </div>
    <div class="card-body">
        <h5>Customer Information</h5>
        <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
        <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->address }}</p>

        <h5>Order Summary</h5>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Payment Status:</strong> {{ $order->payment_status }}</p>
        <p><strong>Order Status:</strong> {{ $order->order_status }}</p>

        <h5>Order Items</h5>
        <ul>
            @foreach ($order->orderItems as $item)
                <li>{{ $item->product->name }} - {{ $item->quantity }} x ${{ number_format($item->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
</div>
@else
<p>No order details available.</p>
@endif
