<!-- File: resources/views/tasks/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-6">Create Task</h1>

            @if ($errors->any())
                <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="text-red-700">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('tasks.store') }}" class="space-y-4">
                @csrf
                
                @if($project)
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                        <p class="text-blue-700">Creating task for project: <strong>{{ $project->title }}</strong></p>
                    </div>
                @else
                    <div class="space-y-1">
                        <label for="project_id" class="block text-sm font-medium text-gray-700">Project</label>
                        <select name="project_id" id="project_id" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach(auth()->user()->projects as $proj)
                                <option value="{{ $proj->id }}" {{ old('project_id') == $proj->id ? 'selected' : '' }}>
                                    {{ $proj->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <div class="space-y-1">
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="space-y-1">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                        <select name="priority" id="priority" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                    </div>

                    <div class="space-y-1">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="to_do" {{ old('status') == 'to_do' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1">
                    <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date') }}" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ url()->previous() }}" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Create Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection