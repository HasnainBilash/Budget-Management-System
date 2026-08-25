@extends('layouts.app')

@section('title', 'Admin Dashboard')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Team dashboard</h1>
            <p class="page-subtitle">Key performance indicators across the whole system.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('projects.index') }}" class="btn-secondary">View projects</a>
            <a href="{{ route('projects.create') }}" class="btn-primary">New project</a>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-10">
        <div class="card card-body text-center">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Completed tasks</h3>
            <p class="text-4xl font-bold text-slate-900 mt-2">{{ $taskStats->completed_tasks }}</p>
        </div>
        <div class="card card-body text-center">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-amber-700">Pending tasks</h3>
            <p class="text-4xl font-bold text-slate-900 mt-2">{{ $taskStats->pending_tasks }}</p>
        </div>
    </div>

    <div class="mb-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-slate-900">Recent projects</h2>
            <a href="{{ route('projects.index') }}" class="btn-link">View all &rarr;</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($recentProjects as $project)
                <div class="card card-body">
                    <div class="flex justify-between items-start mb-2 gap-2">
                        <h3 class="font-medium text-slate-900">
                            <a href="{{ route('projects.show', $project) }}" class="hover:text-emerald-700">{{ $project->title }}</a>
                        </h3>
                        <span class="{{ match($project->status) { 'completed' => 'badge-green', 'in_progress' => 'badge-blue', 'on_hold' => 'badge-yellow', default => 'badge-gray' } }} shrink-0">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 mb-2">{{ Str::limit($project->description, 100) }}</p>
                    <div class="flex justify-between text-sm text-slate-500">
                        <span>{{ $project->tasks_count }} tasks</span>
                        <span>Due {{ $project->end_date->format('M d, Y') }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 empty-state">
                    <p class="text-slate-500">No projects found.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Top expense categories</h2>
        <div class="card overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Category</th>
                        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Total spent</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($topExpenseCategories as $category)
                        <tr>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $category->category }}</td>
                            <td class="px-4 py-3 text-sm text-slate-700">${{ number_format($category->total_spent, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-4 py-6 text-center text-sm text-slate-500">No expense data yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
