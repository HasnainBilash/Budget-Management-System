

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <!-- Table Header with Filter Button -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-blue-800">Your Budgets</h1>

        <!-- Filter Button -->
        <button id="filterButton" 
                class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
            Filter
        </button>
    </div>

    <!-- Budget Table -->
    <?php if($budgets->isEmpty()): ?>
        <p class="text-center">No budgets added yet.</p>
    <?php else: ?>
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Month</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Budget Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Remaining Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Amount Exceeded</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $budgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $budget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr data-id="<?php echo e($budget->id); ?>">
                        <td class="border border-gray-300 px-4 py-2"><?php echo e(\Carbon\Carbon::parse($budget->month_year)->format('F Y')); ?></td>
                        <td class="border border-gray-300 px-4 py-2"><?php echo e($budget->category); ?></td>
                        <td class="border border-gray-300 px-4 py-2">$<?php echo e(number_format($budget->budget_amount, 2)); ?></td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if($budget->remaining_amount < 0): ?>
                                0
                            <?php else: ?>
                                $<?php echo e(number_format($budget->remaining_amount, 2)); ?>

                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <?php if($budget->remaining_amount < 0): ?>
                                <span class="text-red-600 font-bold">
                                    $<?php echo e(number_format(abs($budget->remaining_amount), 2)); ?>

                                </span>
                            <?php else: ?>
                                0
                            <?php endif; ?>
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <!-- Delete Button -->
                            <button 
                                style="background-color: #dc2626; color: white; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;"
                                onmouseover="this.style.backgroundColor='#b91c1c'" 
                                onmouseout="this.style.backgroundColor='#dc2626'"
                                class="deleteButton"
                                data-id="<?php echo e($budget->id); ?>">
                                Delete
                            </button>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <!-- Centered Buttons Below the Table -->
    <div class="text-center mt-6">
        <a href="<?php echo e(route('budgets.create')); ?>" 
           class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
           Add Budget
        </a>

        <a href="<?php echo e(route('budgets.spend')); ?>" 
           class="inline-block px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition ml-4">
           Add Expense
        </a>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" 
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full border border-black">
            <h2 class="text-xl font-bold mb-4 text-center">Filter Budgets</h2>
            <form method="GET" action="<?php echo e(route('budgets.index')); ?>">
                <!-- Horizontal Layout for Dropdowns -->
                <div class="flex flex-wrap justify-between gap-4">
                    <!-- Year Dropdown -->
                    <div class="flex flex-col">
                        <label for="year" class="font-semibold mb-2">Year</label>
                        <select name="year" id="year" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Month Dropdown -->
                    <div class="flex flex-col">
                        <label for="month" class="font-semibold mb-2">Month</label>
                        <select name="month" id="month" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($num); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="flex flex-col">
                        <label for="category" class="font-semibold mb-2">Category</label>
                        <select name="category" id="category" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category); ?>"><?php echo e($category); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button type="button" id="closeModal" 
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
                        Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButton = document.getElementById('filterButton');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementById('closeModal');

        // Show modal in the center of the page
        filterButton.addEventListener('click', () => {
            filterModal.classList.remove('hidden');
        });

        // Hide modal
        closeModal.addEventListener('click', () => {
            filterModal.classList.add('hidden');
        });

        // Delete functionality
        const deleteButtons = document.querySelectorAll('.deleteButton');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const budgetId = event.target.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this budget?')) {
                    fetch(`/budgets/${budgetId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh the page after successful deletion
                        } else {
                            alert('Failed to delete the budget.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/budget/index.blade.php ENDPATH**/ ?>