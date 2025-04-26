
<?php $__env->startSection('content'); ?>

<div class="container mt-5">
    <div class="receipt-container shadow-lg p-4 bg-white rounded">
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Order Receipt</h2>
            <small class="text-muted">Thank you for shopping with us!</small>
        </div>

        <!-- Order Information -->
        <div class="border p-3 mb-4">
            <h5 class="text-primary">Order #<?php echo e($order->id); ?></h5>
            <p><strong>Order Date:</strong> <?php echo e($order->created_at->format('d M, Y H:i')); ?></p>
            <p><strong>Customer Name:</strong> <?php echo e($order->name); ?></p>
            <p><strong>Email:</strong> <?php echo e($order->email); ?></p>
            <p><strong>Shipping Address:</strong> <?php echo e($order->address); ?></p>
            <p><strong>Phone:</strong> <?php echo e($order->phone); ?></p>
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
                <?php $__currentLoopData = $order->orderItems ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->product->name); ?></td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td>$<?php echo e(number_format($item->price, 2)); ?></td>
                    <td>$<?php echo e(number_format($item->price * $item->quantity, 2)); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <!-- Order Summary -->
        <div class="border p-3 mt-3">
            <p><strong>Subtotal:</strong> $<?php echo e(number_format($order->subtotal, 2)); ?></p>
            <p><strong>Total Amount:</strong> $<?php echo e(number_format($order->total_amount, 2)); ?></p>
            <p><strong>Payment Method:</strong> <?php echo e(strtoupper($order->payment_method)); ?></p>
            <p><strong>Payment Status:</strong> <span class="badge bg-<?php echo e($order->payment_status == 'Completed' ? 'success' : 'warning'); ?>"><?php echo e($order->payment_status); ?></span></p>
            <p><strong>Order Status:</strong> <span class="badge bg-<?php echo e($order->order_status == 'Confirmed' ? 'success' : 'danger'); ?>"><?php echo e($order->order_status); ?></span></p>
        </div>

        <!-- Download PDF Button -->
        <div class="text-center mt-4">
            <a href="<?php echo e(route('order.downloadReceipt', $order->id)); ?>" class="btn btn-primary">
                Download PDF <i class="fa fa-download"></i>
            </a>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('User.userLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/order/success.blade.php ENDPATH**/ ?>