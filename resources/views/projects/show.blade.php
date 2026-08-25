@extends('layouts.app')

@section('title', $project->title)

@php
use Illuminate\Support\Str;
use Carbon\Carbon;
@endphp

@section('content')
<div class="page-wrap max-w-6xl">
    @include('partials.alerts')

    <div class="card card-body mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 mb-2">{{ $project->title }}</h1>
                <span class="{{ match($project->status) { 'completed' => 'badge-green', 'in_progress' => 'badge-blue', 'on_hold' => 'badge-yellow', default => 'badge-gray' } }}">
                    {{ str_replace('_', ' ', ucfirst($project->status)) }}
                </span>
            </div>
            <div class="flex gap-2 shrink-0">
                <a href="{{ route('projects.edit', $project) }}" class="btn-secondary">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                </form>
            </div>
        </div>

        @if($project->description)
            <p class="text-slate-600 mb-6">{{ $project->description }}</p>
        @endif

        <div class="bg-slate-50 rounded-lg p-4">
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-400">Start date</h3>
                    <p class="mt-1 text-slate-900">{{ $project->start_date->format('M d, Y') }}</p>
                </div>
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-400">End date</h3>
                    <p class="mt-1 text-slate-900">{{ $project->end_date->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="mb-2">
                <div class="flex justify-between text-sm text-slate-600 mb-1.5">
                    <span>Progress</span>
                    <span class="font-medium">{{ number_format($progressPercentage, 1) }}%</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2">
                    <div class="bg-emerald-600 h-2 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                </div>
            </div>

            <div class="text-sm mt-3">
                @if($daysRemaining > 0)
                    <span class="font-medium text-slate-600">{{ $daysRemaining }} days remaining</span>
                @elseif($daysRemaining == 0)
                    <span class="font-medium text-amber-600">Due today</span>
                @else
                    <span class="font-medium text-red-600">Overdue by {{ abs($daysRemaining) }} days</span>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card card-body">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-base font-semibold text-slate-900">Pending tasks ({{ $pendingTasks->count() }})</h2>
                <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="btn-secondary btn-sm">Add task</a>
            </div>
            <div class="space-y-3">
                @forelse($pendingTasks as $task)
                    <div class="bg-slate-50 border border-slate-200 p-3 rounded-lg">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-medium text-slate-900">
                                <a href="{{ route('tasks.show', $task) }}" class="hover:text-emerald-700">{{ $task->title }}</a>
                            </h3>
                            <span class="{{ $task->status === 'in_progress' ? 'badge-blue' : 'badge-gray' }} shrink-0">
                                {{ str_replace('_', ' ', ucfirst($task->status)) }}
                            </span>
                        </div>
                        @if($task->description)
                            <p class="text-sm text-slate-500 mt-1">{{ Str::limit($task->description, 100) }}</p>
                        @endif
                        <div class="mt-2 flex justify-between text-xs text-slate-500">
                            <span>Priority: {{ ucfirst($task->priority) }}</span>
                            @if($task->due_date)
                                <span class="{{ Carbon::parse($task->due_date)->isPast() ? 'text-red-600 font-medium' : '' }}">
                                    Due {{ Carbon::parse($task->due_date)->format('M d, Y') }}
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm text-center py-4">No pending tasks.</p>
                @endforelse
            </div>
        </div>

        <div class="card card-body">
            <h2 class="text-base font-semibold text-slate-900 mb-4">Completed tasks ({{ $completedTasks->count() }})</h2>
            <div class="space-y-3">
                @forelse($completedTasks as $task)
                    <div class="bg-slate-50 border border-slate-200 p-3 rounded-lg opacity-70">
                        <div class="flex justify-between items-start gap-2">
                            <h3 class="font-medium text-slate-900">
                                <a href="{{ route('tasks.show', $task) }}" class="hover:text-emerald-700 line-through decoration-slate-300">{{ $task->title }}</a>
                            </h3>
                            <span class="badge-green shrink-0">Done</span>
                        </div>
                        <div class="mt-2 flex justify-between text-xs text-slate-500">
                            <span>Priority: {{ ucfirst($task->priority) }}</span>
                            @if($task->updated_at)
                                <span>Completed {{ $task->updated_at->format('M d, Y') }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm text-center py-4">No completed tasks yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
