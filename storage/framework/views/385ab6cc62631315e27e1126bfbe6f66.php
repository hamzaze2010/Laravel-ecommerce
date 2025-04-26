
    <!-- Offcanvas Menu End -->

    <?php echo $__env->make('User.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="content">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->make('User.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>  <?php /**PATH C:\wamp64\www\shopShatarat\resources\views/User/userLayout.blade.php ENDPATH**/ ?>