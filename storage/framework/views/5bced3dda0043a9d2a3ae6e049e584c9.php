
<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

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
<div class="searchable">
    <div>
        <a class="btn btn-success mb-3" href="<?php echo e(route('createCategory')); ?>">Add a Category</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Description</th>
                
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $categorys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td scope="row"><?php echo e($category->id); ?></td>
                    <td><?php echo e($category->name); ?></td>
                    <td><img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="<?php echo e($category->name); ?>" height="50" width="50"></td>
                    <td><?php echo e($category->status); ?></td>
                    <td><?php echo e($category->description); ?></td>
                         
                    <td class="d-flex">
                        <a class="btn btn-info mr-2" href="<?php echo e(route('editCategory', ['id' => $category->id ])); ?>" role="button">Edit</a>
                        <form action="<?php echo e(route('deleteCategory', ['id' => $category->id ])); ?>" method="POST">
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
</div>
<div id="search-results"></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('Admin.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Category/indexCategory.blade.php ENDPATH**/ ?>