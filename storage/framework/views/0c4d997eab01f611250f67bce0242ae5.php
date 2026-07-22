<!-- File: resources/views/welcome.blade.php -->


<?php $__env->startSection('content'); ?>
<div class="landing-page">
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4 text-green-800">Welcome to Task & Budget Manager</h1>
        <p class="text-lg text-gray-600 mb-8">Manage your tasks and budget efficiently with our easy-to-use platform.</p>
        <a href="<?php echo e(route('register')); ?>" class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">Try for free</a>
    </div>
</div>
    </nav>
    <!-- Hero Section -->
    <section class="hero bg-green-100 py-16 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl font-bold text-gray-800">Making the Task Management More Human</h1>
            <p class="mt-5 text-lg text-gray-600">Smart tools to customize your work routine for better results, faster.</p>
            <!--<a href="<?php echo e(route('register')); ?>" class="mt-20 px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Try for Free</a>-->
        </div>
    </section>

    <!-- About Section -->
    <section class="about py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-semibold text-gray-800">About Task & Budget Manager</h2>
            <p class="mt-4 text-gray-600">Simplifying your productivity with modern tools for task and budget management.</p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-semibold text-center text-gray-800">We Have the Most Unique & Modern Features</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature text-center">
                    <img src="/images/feature1.png" alt="Feature 1" class="mx-auto w-16 h-16">
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Clean Design</h3>
                    <p class="mt-2 text-gray-600">Manage your tasks easily with a user-friendly interface.</p>
                </div>
                <!-- Feature 2 -->
                <div class="feature text-center">
                    <img src="/images/feature2.png" alt="Feature 2" class="mx-auto w-16 h-16">
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Efficient Decisions</h3>
                    <p class="mt-2 text-gray-600">Help you make the right decisions with accurate analytics.</p>
                </div>
                <!-- Feature 3 -->
                <div class="feature text-center">
                    <img src="/images/feature3.png" alt="Feature 3" class="mx-auto w-16 h-16">
                    <h3 class="mt-4 text-xl font-semibold text-gray-800">Customizable</h3>
                    <p class="mt-2 text-gray-600">Tailor the tool to fit your specific needs and preferences.</p>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\CSE470\task_manager\resources\views/welcome.blade.php ENDPATH**/ ?>