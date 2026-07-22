

<?php $__env->startSection('content'); ?>
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-gray-900">Spending Trends</h1>
        <p class="text-lg text-gray-600 mb-4">Analyze total spending trends across the user base.</p>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-green-800">Total Spending</h2>
            <p class="text-4xl font-bold text-gray-800 mt-2">$<?php echo e(number_format($totalSpending, 2)); ?></p>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-blue-800">Spending by Category</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <?php $__currentLoopData = $spendingByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-blue-50 p-4 rounded-lg shadow-md text-center">
                        <h3 class="text-xl font-bold text-blue-600"><?php echo e($category); ?></h3>
                        <p class="text-lg text-gray-800 mt-2">$<?php echo e(number_format($amount, 2)); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-purple-800">Spending by Month</h2>
            <div class="mt-4">
                <table class="w-full text-left border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-purple-100">
                            <th class="p-4 text-purple-800 font-semibold">Month</th>
                            <th class="p-4 text-purple-800 font-semibold">Total Spending</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $spendingByMonth; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $amount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t">
                                <td class="p-4 text-gray-800"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y')); ?></td>
                                <td class="p-4 text-gray-800">$<?php echo e(number_format($amount, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-red-800">Detailed Budget Information</h2>
            <div class="mt-4">
                <table class="w-full text-left border-collapse bg-white shadow-md">
                    <thead>
                        <tr class="bg-red-100">
                            <th class="p-4 text-red-800 font-semibold">Category</th>
                            <th class="p-4 text-red-800 font-semibold">Budget Amount</th>
                            <th class="p-4 text-red-800 font-semibold">Remaining Amount</th>
                            <th class="p-4 text-red-800 font-semibold">Amount Spent</th>
                            <th class="p-4 text-red-800 font-semibold">Amount Exceeded</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $spendingData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="border-t">
                                <td class="p-4 text-gray-800"><?php echo e($data->category); ?></td>
                                <td class="p-4 text-gray-800">$<?php echo e(number_format($data->budget_amount, 2)); ?></td>
                                <td class="p-4 text-gray-800">$<?php echo e(number_format($data->remaining_amount, 2)); ?></td>
                                <td class="p-4 text-gray-800">$<?php echo e(number_format($data->spent_amount, 2)); ?></td>
                                <td class="p-4 text-gray-800">
                                    <?php if($data->amount_exceeded > 0): ?>
                                        <span class="text-red-600">$<?php echo e(number_format($data->amount_exceeded, 2)); ?></span>
                                    <?php else: ?>
                                        <span class="text-green-600">None</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/admin/spendings.blade.php ENDPATH**/ ?>