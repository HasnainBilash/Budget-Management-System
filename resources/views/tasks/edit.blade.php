@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="page-wrap max-w-2xl">
    <div class="page-header">
        <h1 class="page-title">Edit task</h1>
    </div>

    <div class="card card-body">
        @include('partials.alerts')

        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="title" class="label">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required class="input">
            </div>

            <div class="field">
                <label for="description" class="label">Description</label>
                <textarea id="description" name="description" rows="3" class="input">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="field">
                    <label for="priority" class="label">Priority</label>
                    <select id="priority" name="priority" required class="input">
                        <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="field">
                    <label for="status" class="label">Status</label>
                    <select id="status" name="status" required class="input">
                        <option value="to_do" {{ old('status', $task->status) == 'to_do' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="due_date" class="label">Due date</label>
                <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}" class="input">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 mt-6">
                <a href="{{ route('tasks.show', $task) }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Update task</button>
            </div>
        </form>
    </div>
</div>
@endsection
