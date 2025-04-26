<?php $__env->startComponent('mail::message'); ?>
# Order Update Notification

Dear <?php echo e($order->user ? $order->user->name : 'Customer'); ?>,

Your order **#<?php echo e($order->id); ?>** has been updated.

**Order Status:** <?php echo e(ucfirst($order->order_status)); ?>  
**Payment Status:** <?php echo e(ucfirst($order->payment_status)); ?>


<?php $__env->startComponent('mail::button', ['url' => route('orders.view', $order->id)]); ?>
View Order Details
<?php echo $__env->renderComponent(); ?>

Thank you for shopping with us!

Regards,  
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\wamp64\www\shopShatarat\resources\views/emails/order/status_updated.blade.php ENDPATH**/ ?>