@extends('layouts.app')

@section('title', 'Admin')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Admin panel</h1>
            <p class="page-subtitle">Manage users and see how the whole team is doing.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $tiles = [
                ['route' => 'admin.dashboard', 'title' => 'Team dashboard', 'desc' => 'Key metrics and recent projects at a glance.', 'iconClasses' => 'bg-emerald-100 text-emerald-700', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route' => 'admin.manage-users', 'title' => 'Manage users', 'desc' => 'Activate or deactivate user accounts.', 'iconClasses' => 'bg-blue-100 text-blue-700', 'icon' => 'M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 10-4-4 4 4 0 004 4zm6 0a4 4 0 10-4-4'],
                ['route' => 'admin.tasks', 'title' => 'All tasks', 'desc' => 'Browse every task across every user.', 'iconClasses' => 'bg-amber-100 text-amber-700', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4'],
                ['route' => 'admin.spendings', 'title' => 'Spending trends', 'desc' => 'Total spending, by category and by month.', 'iconClasses' => 'bg-purple-100 text-purple-700', 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                ['route' => 'admin.productivity', 'title' => 'Team productivity', 'desc' => 'Average task completion time.', 'iconClasses' => 'bg-red-100 text-red-700', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
            ];
        @endphp
        @foreach ($tiles as $tile)
            <a href="{{ route($tile['route']) }}" class="card card-body hover:shadow-md hover:-translate-y-0.5 transition-all">
                <div class="w-10 h-10 rounded-lg {{ $tile['iconClasses'] }} flex items-center justify-center mb-4">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $tile['icon'] }}" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-slate-900">{{ $tile['title'] }}</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $tile['desc'] }}</p>
            </a>
        @endforeach
    </div>
</div>
@endsection
