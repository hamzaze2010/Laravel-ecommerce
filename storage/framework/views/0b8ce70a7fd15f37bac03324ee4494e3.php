
<?php $__env->startSection('content'); ?>

<?php if(session('update_success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('update_success')); ?>

    </div>
<?php endif; ?>

<?php if(session('success created')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success created')); ?>

    </div>
<?php endif; ?>

<?php if(session('success deleted')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('success deleted')); ?>

    </div>
<?php endif; ?>

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
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($order->id); ?></td>
                            <td><?php echo e($order->user ? $order->user->name : 'Guest'); ?></td>
                            <td>$<?php echo e(number_format($order->total_amount, 2)); ?></td>
                            <td><?php echo e(ucfirst($order->payment_method)); ?></td>
                            <td><?php echo e(ucfirst($order->order_status)); ?></td>
                            <td><?php echo e(ucfirst($order->payment_status)); ?></td>
                            <td><?php echo e($order->created_at->format('d M, Y')); ?></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="<?php echo e(route('orderview', $order->id)); ?>">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php echo e($orders->links()); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Admin/orders/index.blade.php ENDPATH**/ ?>