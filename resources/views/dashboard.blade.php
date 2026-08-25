@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Welcome back{{ Auth::user()?->name ? ', '.explode(' ', Auth::user()->name)[0] : '' }}</h1>
            <p class="page-subtitle">Here's a quick jump-off point for your projects, tasks, and budget.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card card-body">
            <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-slate-900">Projects</h2>
            <p class="mt-1 text-sm text-slate-500">Plan and track projects from start to finish.</p>
            <div class="mt-5 flex gap-2">
                <a href="{{ route('projects.index') }}" class="btn-secondary btn-sm">View all</a>
                <a href="{{ route('projects.create') }}" class="btn-primary btn-sm">New project</a>
            </div>
        </div>

        <div class="card card-body">
            <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-slate-900">Tasks</h2>
            <p class="mt-1 text-sm text-slate-500">Organize and track your to-dos by priority.</p>
            <div class="mt-5 flex gap-2">
                <a href="{{ route('tasks.index') }}" class="btn-secondary btn-sm">View all</a>
                <a href="{{ route('tasks.create') }}" class="btn-primary btn-sm">New task</a>
            </div>
        </div>

        <div class="card card-body">
            <div class="w-10 h-10 rounded-lg bg-amber-100 text-amber-700 flex items-center justify-center mb-4">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-slate-900">Budget</h2>
            <p class="mt-1 text-sm text-slate-500">Keep your monthly spending in check.</p>
            <div class="mt-5 flex gap-2">
                <a href="{{ route('budgets.index') }}" class="btn-secondary btn-sm">View all</a>
                <a href="{{ route('budgets.create') }}" class="btn-primary btn-sm">Add budget</a>
            </div>
        </div>
    </div>
</div>
@endsection
