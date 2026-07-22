

<?php $__env->startSection('content'); ?>
<div class="admin-container bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4 text-gray-900">Manage Users</h1>
        <p class="text-lg mb-6 text-gray-700">View and update user information with ease.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                <h3 class="text-2xl font-semibold text-gray-800"><?php echo e($user->name); ?></h3>
                <p class="text-lg text-gray-600"><?php echo e($user->email); ?></p>
                <p class="text-gray-600">Status: <?php echo e($user->active ? 'Active' : 'Inactive'); ?></p>
                <form action="<?php echo e(route('admin.update-user-status', $user->id)); ?>" method="POST" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition-colors duration-300">
                        <?php echo e($user->active ? 'Deactivate' : 'Activate'); ?>

                    </button>
                </form>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/admin/manage-users.blade.php ENDPATH**/ ?>