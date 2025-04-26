@extends('Admin.adminLayout')
@section('content')

@if(session('update_success'))
    <div class="alert alert-success">
        {{ session('update_success') }}
    </div>
@endif

@if(session('success created'))
    <div class="alert alert-success">
        {{ session('success created') }}
    </div>
@endif

@if(session('success deleted'))
    <div class="alert alert-danger">
        {{ session('success deleted') }}
    </div>
@endif

<div class="container">
    <div class="row">
        <!-- Orders List Section -->
        <div class="col-md-12">
            <h2>Orders Management</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>{{ ucfirst($order->payment_method) }}</td>
                            <td>{{ ucfirst($order->order_status) }}</td>
                            <td>{{ ucfirst($order->payment_status) }}</td>
                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('orderview', $order->id) }}">
                                    View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>

@endsection
