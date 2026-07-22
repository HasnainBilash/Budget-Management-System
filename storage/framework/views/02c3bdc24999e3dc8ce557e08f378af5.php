<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Task and Budget Manager'); ?></title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="text-4xl font-extrabold text-green-800">Task & Budget Manager</a>
                <div>
                    <?php if(Route::has('login')): ?>
                        <?php if(auth()->guard()->check()): ?>
                            <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-800 hover:text-green-500">Dashboard</a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button class="ml-4 text-red-600 hover:text-red-800">Logout</button>
                            </form>
                            
                            <?php if(Auth::user()->role !== 'user'): ?>
                                <a href="<?php echo e(route('admin')); ?>" class="ml-4 text-gray-800 hover:text-green-500">Admin</a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="text-gray-800 hover:text-green-500">Login</a>
                            <?php if(Route::has('register')): ?>
                                <a href="<?php echo e(route('register')); ?>" class="ml-4 text-gray-800 hover:text-green-500">Register</a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mx-auto p-4">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>
</body>
</html>






    <!--</main>
    <footer class="bg-gray-200 py-4 text-center">
        &copy; <?php echo e(date('Y')); ?> Task and Budget Manager. All rights reserved.
    </footer>
</body>
</html>-->



<?php /**PATH C:\Users\shari\OneDrive\Desktop\Atanu\New\task-and-budget\resources\views/layouts/app.blade.php ENDPATH**/ ?>