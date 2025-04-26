
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
<div class="searchable">
    <div>
        <a class="btn btn-success mb-3" href="<?php echo e(route('createProduct')); ?>">Add a Product</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">price</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                
                
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td scope="row"><?php echo e($product->id); ?></td>
                    <td><?php echo e($product->name); ?></td>
                    <td><?php echo e($product->description); ?></td>
                    <td><?php echo e($product->price); ?></td>
                    <td><?php echo e($product->category ? $product->category->name : 'No Category'); ?></td>
                    <td><img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->name); ?>" height="50" width="50"></td>
                    <td><?php echo e($product->status); ?></td>
                    
                         
                    <td class="d-flex">
                        <a class="btn btn-info mr-2" href="<?php echo e(route('editProduct', ['id' => $product->id ])); ?>" role="button">Edit</a>
                        <form action="<?php echo e(route('deleteProduct', ['id' => $product->id ])); ?>" method="POST">
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

<?php echo $__env->make('Admin.adminLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\shopShatarat\resources\views/Product/productManage.blade.php ENDPATH**/ ?>