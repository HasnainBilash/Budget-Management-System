<!-- File: resources/views/tasks/create.blade.php -->
@extends('layouts.app')

@section('title', 'New Task')

@section('content')
<div class="page-wrap max-w-2xl">
    <div class="page-header">
        <h1 class="page-title">New task</h1>
    </div>

    <div class="card card-body">
        @include('partials.alerts')

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            @if($project)
                <input type="hidden" name="project_id" value="{{ $project->id }}">
                <div class="alert-success mb-6">Creating a task for <strong>{{ $project->title }}</strong></div>
            @else
                <div class="field">
                    <label for="project_id" class="label">Project</label>
                    <select name="project_id" id="project_id" required class="input">
                        @foreach(auth()->user()->projects as $proj)
                            <option value="{{ $proj->id }}" {{ old('project_id') == $proj->id ? 'selected' : '' }}>
                                {{ $proj->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif

            <div class="field">
                <label for="title" class="label">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="input">
            </div>

            <div class="field">
                <label for="description" class="label">Description</label>
                <textarea name="description" id="description" rows="3" class="input">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="field">
                    <label for="priority" class="label">Priority</label>
                    <select name="priority" id="priority" required class="input">
                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <div class="field">
                    <label for="status" class="label">Status</label>
                    <select name="status" id="status" required class="input">
                        <option value="to_do" {{ old('status') == 'to_do' ? 'selected' : '' }}>To Do</option>
                        <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="due_date" class="label">Due date</label>
                <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" required class="input">
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 mt-6">
                <a href="{{ url()->previous() }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Create task</button>
            </div>
        </form>
    </div>
</div>
@endsection
