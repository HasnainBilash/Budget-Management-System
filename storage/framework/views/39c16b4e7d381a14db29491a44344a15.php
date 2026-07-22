
<!-- File: resources/views/auth/passwordOtp.blade.php -->



<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Reset Password</h1>

        <?php if(session('status')): ?>
            <div class="mb-4 text-green-600">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-4">
                <ul class="list-disc list-inside text-red-600">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form to request OTP -->
        <form method="POST" action="<?php echo e(route('password.email')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                Send OTP
            </button>
        </form>

        <!-- Form to verify OTP -->
        <form method="POST" action="<?php echo e(route('otp.verify')); ?>" class="mt-6">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="email" value="<?php echo e(session('email')); ?>">
            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">OTP:</label>
                <input type="text" id="otp" name="otp" required
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                Verify OTP
            </button>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CSE470\task_manager\resources\views/auth/passwordOtp.blade.php ENDPATH**/ ?>