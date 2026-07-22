<!-- File: resources/views/tasks/create.blade.php -->



<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Create Task</h1>

    <?php if($errors->any()): ?>
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('tasks.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo e(old('title')); ?>" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600"><?php echo e(old('description')); ?></textarea>
        </div>
        <div class="mb-4">
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date:</label>
            <input type="datetime-local" id="due_date" name="due_date" value="<?php echo e(old('due_date')); ?>"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div class="mb-4">
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority:</label>
            <select id="priority" name="priority" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="low" <?php echo e(old('priority') == 'low' ? 'selected' : ''); ?>>Low</option>
                <option value="medium" <?php echo e(old('priority') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                <option value="high" <?php echo e(old('priority') == 'high' ? 'selected' : ''); ?>>High</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select id="status" name="status" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="to_do" <?php echo e(old('status') == 'to_do' ? 'selected' : ''); ?>>To Do</option>
                <option value="in_progress" <?php echo e(old('status') == 'in_progress' ? 'selected' : ''); ?>>In Progress</option>
                <option value="done" <?php echo e(old('status') == 'done' ? 'selected' : ''); ?>>Done</option>
            </select>
        </div>
       
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
            Create Task
        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/tasks/create.blade.php ENDPATH**/ ?>