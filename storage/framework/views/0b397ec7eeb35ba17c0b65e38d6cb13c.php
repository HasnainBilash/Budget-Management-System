<!-- File: resources/views/auth/register.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Register</h1>
        
        <!-- Success Message -->
        <?php if(session('success')): ?>
            <div class="mb-4 text-green-600">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Error Messages -->
        <?php if($errors->any()): ?>
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo e(old('name')); ?>" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="dob" class="block text-sm font-medium text-gray-700">Date of Birth:</label>
                <input type="date" id="dob" name="dob" value="<?php echo e(old('dob')); ?>" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                Register
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/auth/register.blade.php ENDPATH**/ ?>