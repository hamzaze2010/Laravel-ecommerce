
<?php $__env->startSection('content'); ?>

<?php if(session('update_success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('update_success')); ?>

    </div>
<?php endif; ?>

<?php if(session('success deleted')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('success deleted')); ?>

    </div>
<?php endif; ?>
<div class="container">
<div class="searchable">
    <div>
        <a class="btn btn-success" href="<?php echo e(route('createAdmin')); ?>">Add an Admin</a>
    </div>
    
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">Gender</th>
                <th scope="col">IMAGE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td scope="row"><?php echo e($admin->id); ?></td>
                <td><?php echo e($admin->name); ?></td>
                <td><?php echo e($admin->email); ?></td>
                <td><?php echo e($admin->Gender); ?></td>
                <td><img src="<?php echo e(asset('storage/' . $admin->image_path)); ?>" alt="<?php echo e($admin->name); ?>" height="50" width="50"></td>
                <td class="d-flex">
                    <a class="btn btn-info mr-2" href="<?php echo e(route('editAdmin', ['id' => $admin->id ])); ?>" role="button">Edit</a>
                    <form action="<?php echo e(route('deleteAdmin', ['id' => $admin->id ])); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Admin.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Admin/adminManage.blade.php ENDPATH**/ ?>