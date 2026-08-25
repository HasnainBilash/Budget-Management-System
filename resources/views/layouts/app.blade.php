<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Task & Budget Manager')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="min-h-screen flex flex-col bg-slate-50">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-slate-900 font-bold text-lg">
                    <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-600 text-white">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                    <span class="hidden sm:inline">Task &amp; Budget Manager</span>
                </a>

                @auth
                    <div class="hidden md:flex items-center gap-1">
                        @php
                            $navLinks = [
                                ['route' => 'dashboard', 'label' => 'Dashboard'],
                                ['route' => 'projects.index', 'label' => 'Projects'],
                                ['route' => 'tasks.index', 'label' => 'Tasks'],
                                ['route' => 'budgets.index', 'label' => 'Budgets'],
                            ];
                        @endphp
                        @foreach ($navLinks as $link)
                            <a href="{{ route($link['route']) }}"
                                class="px-3 py-2 rounded-md text-sm font-medium transition-colors
                                    {{ request()->routeIs($link['route'].'*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                        @if (Auth::user()->role !== 'user')
                            <a href="{{ route('admin') }}"
                                class="px-3 py-2 rounded-md text-sm font-medium transition-colors
                                    {{ request()->routeIs('admin*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:text-slate-900 hover:bg-slate-100' }}">
                                Admin
                            </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="hidden lg:flex items-center justify-center w-8 h-8 rounded-full bg-slate-200 text-slate-600 text-sm font-semibold">
                            {{ Str::of(Auth::user()->name)->substr(0, 1)->upper() }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn-secondary btn-sm">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary btn-sm">Get started</a>
                        @endif
                    </div>
                @endauth
            </div>

            @auth
                <div class="md:hidden flex items-center gap-1 pb-3 overflow-x-auto">
                    @foreach ($navLinks as $link)
                        <a href="{{ route($link['route']) }}"
                            class="px-3 py-1.5 rounded-md text-sm font-medium whitespace-nowrap
                                {{ request()->routeIs($link['route'].'*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:bg-slate-100' }}">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                    @if (Auth::user()->role !== 'user')
                        <a href="{{ route('admin') }}"
                            class="px-3 py-1.5 rounded-md text-sm font-medium whitespace-nowrap
                                {{ request()->routeIs('admin*') ? 'text-emerald-700 bg-emerald-50' : 'text-slate-600 hover:bg-slate-100' }}">
                            Admin
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </nav>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-slate-200 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-400">
            &copy; {{ date('Y') }} Task &amp; Budget Manager
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
