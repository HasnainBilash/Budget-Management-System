@extends('layouts.app')

@section('title', $task->title)

@section('content')
<div class="page-wrap max-w-4xl">
    @include('partials.alerts')

    <div class="card card-body">
        <div class="flex flex-col sm:flex-row justify-between items-start gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 mb-2">{{ $task->title }}</h1>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="{{ match($task->status) { 'done' => 'badge-green', 'in_progress' => 'badge-blue', default => 'badge-gray' } }}">
                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                    </span>
                    <span class="{{ match($task->priority) { 'high' => 'badge-red', 'medium' => 'badge-yellow', default => 'badge-green' } }}">
                        {{ ucfirst($task->priority) }} priority
                    </span>
                </div>
            </div>
            <div class="flex gap-2 shrink-0">
                <a href="{{ route('tasks.edit', $task) }}" class="btn-secondary">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                </form>
            </div>
        </div>

        @if($task->description)
            <p class="text-slate-600 mb-6">{{ $task->description }}</p>
        @endif

        <div class="grid grid-cols-2 gap-4 mb-8 pb-8 border-b border-slate-200">
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-400">Project</h3>
                <a href="{{ route('projects.show', $task->project) }}" class="mt-1 inline-block text-emerald-700 hover:text-emerald-800 font-medium">
                    {{ $task->project->title }}
                </a>
            </div>
            <div>
                <h3 class="text-xs font-semibold uppercase tracking-wide text-slate-400">Due date</h3>
                <p class="mt-1 {{ $task->due_date && $task->due_date->isPast() ? 'text-red-600 font-medium' : 'text-slate-900' }}">
                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                </p>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-slate-900">Subtasks</h2>
                <button type="button" onclick="document.getElementById('add-subtask-form').classList.toggle('hidden')" class="btn-secondary btn-sm">
                    Add subtask
                </button>
            </div>

            <form id="add-subtask-form" action="{{ route('subtasks.store', $task) }}" method="POST" class="hidden mb-4 flex gap-2">
                @csrf
                <input type="text" name="title" placeholder="Enter subtask title" required class="input flex-1">
                <button type="submit" class="btn-primary">Add</button>
            </form>

            <div class="space-y-2">
                @forelse($task->subtasks as $subtask)
                    <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-lg p-3">
                        <div class="flex items-center gap-3 min-w-0">
                            <form action="{{ route('subtasks.update', [$task, $subtask]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="input text-sm py-1">
                                    <option value="to_do" {{ $subtask->status === 'to_do' ? 'selected' : '' }}>To Do</option>
                                    <option value="in_progress" {{ $subtask->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="done" {{ $subtask->status === 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </form>
                            <span class="text-slate-700 truncate {{ $subtask->status === 'done' ? 'line-through text-slate-400' : '' }}">{{ $subtask->title }}</span>
                        </div>
                        <form action="{{ route('subtasks.destroy', [$task, $subtask]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-slate-400 hover:text-red-600" onclick="return confirm('Are you sure you want to delete this subtask?')">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-slate-500 text-sm text-center py-4">No subtasks yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
