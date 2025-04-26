@extends('Admin.adminLayout')
@section('content')

<div class="container mt-4">
    <a href="{{ route('admin.order.manage') }}" class="btn btn-secondary mb-3">
        &larr; Back to Orders
    </a>
    
    <div class="card">
        <div class="card-header">
            Order #{{ $order->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Order Summary</h5>
            <p><strong>Order Date:</strong> {{ $order->created_at->format('d M, Y H:i') }}</p>
            <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
            <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</p>
            <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
            <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
            
            <!-- Update Form for Order and Payment Status -->
            <form id="updateOrderForm" action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="mt-3">
                @csrf
                <div class="form-group">
                    <label for="order_status"><strong>Order Status:</strong></label>
                    <select id="order_status" name="order_status" class="form-control" required>
                        <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Confirmed" {{ $order->order_status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="Canceled" {{ $order->order_status == 'Canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment_status"><strong>Payment Status:</strong></label>
                    <select id="payment_status" name="payment_status" class="form-control" required>
                        <option value="Pending" {{ $order->payment_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ $order->payment_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        <option value="Failed" {{ $order->payment_status == 'Failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
            </form>
            
            <!-- Order Items Table -->
            <h5 class="mt-4">Order Items</h5>
            <table class="table table-bordered">
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
            
            <!-- PDF Download Button -->
            <div class="text-center mt-3">
                <a href="{{ route('admin.order.downloadReceipt', $order->id) }}" class="btn btn-secondary">
                    Download Receipt as PDF <i class="fa fa-download"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
