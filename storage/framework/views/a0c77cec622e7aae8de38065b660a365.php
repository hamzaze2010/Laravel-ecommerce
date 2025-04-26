
<?php $__env->startSection('content'); ?>

<?php if(session('success created')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success created')); ?>

    </div>
<?php endif; ?>

<?php if(session('success update')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success update')); ?>

    </div>
<?php endif; ?>

<?php if(session('success deleted')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('success deleted')); ?>

    </div>
<?php endif; ?>

<div class="container">
<div class="searchable">
    <div class="mb-3">
        <a class="btn btn-success" href="<?php echo e(route('createUser')); ?>">Add a User</a>
    </div>
    
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">EMAIL</th>
                <th scope="col">ADDRESS</th>
                <th scope="col">PHONE</th>
                <th scope="col">IMAGE</th>
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td scope="row"><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td><?php echo e($user->email); ?></td>
                <td><?php echo e($user->address); ?></td>
                <td><?php echo e($user->phone); ?></td>
                <td><img src="<?php echo e(asset('storage/' . $user->image)); ?>" alt="<?php echo e($user->name); ?>" height="50" width="50"></td>
                <td class="d-flex">
                    <a class="btn btn-info mr-2" href="<?php echo e(route('edit.User', ['id' => $user->id ])); ?>" role="button">Edit</a>
                    <form action="<?php echo e(route('deleteAdmin', ['id' => $user->id ])); ?>" method="POST">
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

<!-- Pagination links -->
<div class="justify-content-center">
    <?php echo e($users->links()); ?>

</div>
</div>
<div id="search-results"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Admin/userManage.blade.php ENDPATH**/ ?>