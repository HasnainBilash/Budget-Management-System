@extends('layouts.app')

@section('title', 'New Project')

@section('content')
<div class="page-wrap max-w-2xl">
    <div class="page-header">
        <h1 class="page-title">New project</h1>
    </div>

    <div class="card card-body">
        @include('partials.alerts')

        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="field">
                <label for="title" class="label">Project title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="input">
            </div>

            <div class="field">
                <label for="description" class="label">Description</label>
                <textarea name="description" id="description" rows="4" class="input">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="field">
                    <label for="start_date" class="label">Start date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="input">
                </div>
                <div class="field">
                    <label for="end_date" class="label">End date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="input">
                </div>
            </div>

            <div class="field">
                <label for="status" class="label">Status</label>
                <select name="status" id="status" class="input">
                    <option value="not_started" {{ old('status') == 'not_started' ? 'selected' : '' }}>Not Started</option>
                    <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="on_hold" {{ old('status') == 'on_hold' ? 'selected' : '' }}>On Hold</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 mt-6">
                <a href="{{ route('projects.index') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Create project</button>
            </div>
        </form>
    </div>
</div>
@endsection
