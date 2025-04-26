@extends('Admin.adminLayout')
@section('content')
<div class="container">
    <h2>Orders Management</h2>
    
    <div class="row">
        <!-- Orders List Section -->
        <div class="col-md-6">
            <h5>Orders List</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                        <td>${{ number_format($order->total_amount, 2) }}</td>
                        <td><span class="badge bg-{{ $order->order_status == 'Confirmed' ? 'info' : ($order->order_status == 'Canceled' ? 'danger' : 'secondary') }}">{{ $order->order_status }}</span></td>
                        <td>
                            <button class="btn btn-sm btn-primary view-order" data-id="{{ $order->id }}">View</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Pagination -->
            {{ $orders->links() }}
        </div>

        <!-- Order Details Section -->
        <div class="col-md-6">
            <h5>Order Details</h5>
            <div id="orderDetails">
                <p>Select an order to view details.</p>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle AJAX -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".view-order").forEach(button => {
            button.addEventListener("click", function() {
                let orderId = this.getAttribute("data-id");

                fetch(`/admin/orders/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("orderDetails").innerHTML = data.order_items;
                })
                .catch(error => console.error("Error fetching order details:", error));
            });
        });
    });
</script>

@endsection


