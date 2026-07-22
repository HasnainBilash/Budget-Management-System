

<?php $__env->startSection('content'); ?>
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-300">
    <h1 class="text-2xl font-bold mb-4 text-center text-blue-800">Add New Budget</h1>

    <form method="POST" action="<?php echo e(route('budgets.store')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Month Section -->
        <div class="mb-6 border border-gray-300 p-4 rounded-md">
            <label for="month_year" class="block font-semibold mb-2">Month:</label>
            <input type="month" name="month_year" required 
                   class="w-full border border-gray-400 p-2 rounded-md focus:ring focus:ring-blue-300">
        </div>

        <!-- Category Section -->
        <div class="mb-6 border border-gray-300 p-4 rounded-md">
            <label for="category" class="block font-semibold mb-2">Category:</label>
            <input type="text" name="category" required 
                   class="w-full border border-gray-400 p-2 rounded-md focus:ring focus:ring-blue-300">
        </div>

        <!-- Budget Amount Section -->
        <div class="mb-6 border border-gray-300 p-4 rounded-md">
            <label for="budget_amount" class="block font-semibold mb-2">Budget Amount:</label>
            <input type="number" name="budget_amount" step="0.01" required 
                   class="w-full border border-gray-400 p-2 rounded-md focus:ring focus:ring-blue-300">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                Add Budget
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/budget/create.blade.php ENDPATH**/ ?>