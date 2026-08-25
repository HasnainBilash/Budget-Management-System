@extends('layouts.app')

@section('title', 'Subtasks')

@section('content')
<div class="page-wrap max-w-2xl">
    <div class="page-header">
        <div>
            <h1 class="page-title">Subtasks</h1>
            <p class="page-subtitle">For <a href="{{ route('tasks.show', $task) }}" class="text-emerald-700 hover:text-emerald-800 font-medium">{{ $task->title }}</a></p>
        </div>
    </div>

    @include('partials.alerts')

    <form method="POST" action="{{ route('subtasks.store', $task->id) }}" class="flex items-center gap-2 mb-6">
        @csrf
        <input type="text" name="title" placeholder="New subtask" required class="input flex-1">
        <button type="submit" class="btn-primary">Add</button>
    </form>

    <div class="space-y-2">
        @forelse ($subtasks as $subtask)
            <div class="card card-body flex items-center justify-between gap-4 py-3">
                <span class="font-medium text-slate-700 {{ $subtask->status === 'done' ? 'line-through text-slate-400' : '' }}">{{ $subtask->title }}</span>
                <div class="flex items-center gap-3 shrink-0">
                    <form method="POST" action="{{ route('subtasks.update', ['task' => $task->id, 'subtask' => $subtask->id]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $subtask->title }}">
                        <select name="status" onchange="this.form.submit()" required class="input text-sm py-1">
                            <option value="to_do" {{ $subtask->status === 'to_do' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ $subtask->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ $subtask->status === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </form>
                    <form method="POST" action="{{ route('subtasks.destroy', ['task' => $task->id, 'subtask' => $subtask->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-link-danger">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <p class="text-slate-500">No subtasks yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
