<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task and Budget Manager')</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-green-500">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button class="ml-4 text-red-600 hover:text-red-800">Logout</button>
                            </form>
                            
                            @if(Auth::user()->role !== 'user')
                                <a href="{{ route('admin') }}" class="ml-4 text-gray-800 hover:text-green-500">Admin</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 hover:text-green-500">Login</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-gray-800 hover:text-green-500">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>
    <main>
        <div class="container mx-auto p-4">
            @yield('content')
        </div>
    </main>
</body>
</html>






    <!--</main>
    <footer class="bg-gray-200 py-4 text-center">
        &copy; {{ date('Y') }} Task and Budget Manager. All rights reserved.
    </footer>
</body>
</html>-->



