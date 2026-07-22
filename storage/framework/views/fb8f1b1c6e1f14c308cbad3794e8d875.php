

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
        <p class="text-lg mb-6">View key performance indicators and manage the system.</p>

        <!-- Completed vs Pending Tasks -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Completed vs. Pending Tasks</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-blue-800">Completed Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2"><?php echo e($taskStats->completed_tasks); ?></p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-red-800">Pending Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2"><?php echo e($taskStats->pending_tasks); ?></p>
                </div>
            </div>
        </div>

        <!-- Top Expense Categories -->
        <div>
            <h2 class="text-xl font-semibold mb-4">Top Expense Categories</h2>
            <table class="w-full text-left border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 text-gray-800 font-semibold">Category</th>
                        <th class="p-4 text-gray-800 font-semibold">Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $topExpenseCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-t">
                            <td class="p-4 text-gray-800"><?php echo e($category->category); ?></td>
                            <td class="p-4 text-gray-800">$<?php echo e(number_format($category->total_spent, 2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>