

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">All Tasks</h1>

        <?php if(session('success')): ?>
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="bg-white shadow-md rounded-lg p-6 border-t-4 
                <?php if($task->priority === 'high'): ?> border-red-500 
                <?php elseif($task->priority === 'medium'): ?> border-yellow-500 
                <?php else: ?> border-green-500 <?php endif; ?>">
                    <h2 class="text-xl font-bold text-gray-900 mb-2"><?php echo e($task->title); ?></h2>
                    <p class="text-gray-700 text-sm mb-4"><?php echo e($task->description ?: 'No description provided'); ?></p>
                    
                    <div class="text-sm text-gray-500 mb-2">
                        <strong>Due Date:</strong> <?php echo e($task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'Not set'); ?>

                    </div>

                    <div class="text-sm text-gray-500 mb-2">
                        <strong>Priority:</strong>
                        <span class="<?php if($task->priority === 'high'): ?> text-red-500 
                                      <?php elseif($task->priority === 'medium'): ?> text-yellow-500 
                                      <?php else: ?> text-green-500 <?php endif; ?> capitalize"><?php echo e($task->priority); ?></span>
                    </div>

                    <div class="text-sm text-gray-500 mb-4">
                        <strong>Status:</strong> 
                        <span class="capitalize"><?php echo e(str_replace('_', ' ', $task->status)); ?></span>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-gray-600 text-lg">No tasks available.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/admin/tasks.blade.php ENDPATH**/ ?>