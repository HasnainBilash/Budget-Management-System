@extends('layouts.app')

@section('title', 'Tasks')

@php
use Illuminate\Support\Str;

$priorityBadge = fn ($p) => match ($p) {
    'high' => 'badge-red',
    'medium' => 'badge-yellow',
    default => 'badge-green',
};
$statusBadge = fn ($s) => match ($s) {
    'in_progress' => 'badge-blue',
    'done' => 'badge-green',
    default => 'badge-gray',
};
@endphp

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Tasks</h1>
            <p class="page-subtitle">Everything you're working on, across every project.</p>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
            New task
        </a>
    </div>

    @include('partials.alerts')

    <div class="mb-10">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500 mb-4">Active</h2>
        <div class="space-y-3">
            @forelse($activeTasks as $task)
                <div class="card card-body flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('tasks.show', $task) }}" class="text-base font-semibold text-slate-900 hover:text-emerald-700">
                                {{ $task->title }}
                            </a>
                            <span class="{{ $priorityBadge($task->priority) }}">{{ ucfirst($task->priority) }}</span>
                            <span class="{{ $statusBadge($task->status) }}">{{ str_replace('_', ' ', ucfirst($task->status)) }}</span>
                        </div>
                        @if($task->project)
                            <a href="{{ route('projects.show', $task->project) }}" class="mt-1 inline-block text-sm text-slate-500 hover:text-emerald-700">
                                {{ $task->project->title }}
                            </a>
                        @endif
                        @if($task->description)
                            <p class="mt-2 text-sm text-slate-500">{{ Str::limit($task->description, 100) }}</p>
                        @endif
                    </div>
                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 shrink-0">
                        @if($task->due_date)
                            <span class="text-sm {{ $task->due_date->isPast() ? 'text-red-600 font-medium' : 'text-slate-500' }}">
                                Due {{ $task->due_date->format('M d, Y') }}
                            </span>
                        @endif
                        <div class="flex items-center gap-3">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-link">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p class="text-slate-500">No active tasks right now.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500 mb-4">Completed</h2>
        <div class="space-y-3">
            @forelse($completedTasks as $task)
                <div class="card card-body flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 opacity-70">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <a href="{{ route('tasks.show', $task) }}" class="text-base font-semibold text-slate-700 hover:text-emerald-700 line-through decoration-slate-300">
                                {{ $task->title }}
                            </a>
                            <span class="badge-green">Done</span>
                        </div>
                        @if($task->project)
                            <a href="{{ route('projects.show', $task->project) }}" class="mt-1 inline-block text-sm text-slate-500 hover:text-emerald-700">
                                {{ $task->project->title }}
                            </a>
                        @endif
                    </div>
                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2 shrink-0">
                        <span class="text-sm text-slate-500">Completed {{ $task->updated_at->format('M d, Y') }}</span>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-link">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-link-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <p class="text-slate-500">No completed tasks yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
