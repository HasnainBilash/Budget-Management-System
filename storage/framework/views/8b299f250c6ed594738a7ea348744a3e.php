

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Team Productivity</h1>
        <p class="text-lg mb-6">View average task completion times and total task data.</p>

        <?php if($productivityData->total_tasks == 0): ?>
            <p class="text-center text-gray-600">No completed tasks available for analysis.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-6 rounded-lg shadow-sm text-center">
                    <h2 class="text-2xl font-semibold text-blue-800">Total Completed Tasks</h2>
                    <p class="text-4xl font-bold text-gray-900 mt-4"><?php echo e($productivityData->total_tasks); ?></p>
                </div>
                <div class="bg-green-50 p-6 rounded-lg shadow-sm text-center">
                    <h2 class="text-2xl font-semibold text-green-800">Average Completion Time</h2>
                    <p class="text-4xl font-bold text-gray-900 mt-4">
                        <?php echo e(number_format($productivityData->avg_completion_time, 2)); ?> minutes
                    </p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/admin/productivity.blade.php ENDPATH**/ ?>