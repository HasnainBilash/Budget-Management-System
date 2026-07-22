@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <!-- Task Header -->
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $task->title }}</h1>
                        <div class="flex items-center space-x-4">
                            <span class="px-3 py-1 rounded-full text-sm 
                                {{ $task->status === 'done' ? 'bg-green-100 text-green-800' : 
                                   ($task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                   'bg-gray-100 text-gray-800') }}">
                                {{ str_replace('_', ' ', ucfirst($task->status)) }}
                            </span>
                            <span class="px-3 py-1 rounded-full text-sm 
                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                   ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 
                                   'bg-green-100 text-green-800') }}">
                                {{ ucfirst($task->priority) }} Priority
                            </span>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('tasks.edit', $task) }}" 
                            class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Edit Task
                        </a>
                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                                Delete Task
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Task Details -->
                <div class="mb-8">
                    @if($task->description)
                        <div class="prose max-w-none mb-4">
                            <p class="text-gray-600">{{ $task->description }}</p>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Project</h3>
                            <p class="mt-1">
                                <a href="{{ route('projects.show', $task->project) }}" 
                                    class="text-blue-600 hover:text-blue-800">
                                    {{ $task->project->title }}
                                </a>
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Due Date</h3>
                            <p class="mt-1 {{ $task->due_date && $task->due_date->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                                {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Subtasks Section -->
                <div class="border-t pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold">Subtasks</h2>
                        <button onclick="document.getElementById('add-subtask-form').classList.toggle('hidden')"
                            class="bg-green-600 text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                            Add Subtask
                        </button>
                    </div>

                    <!-- Add Subtask Form -->
                    <form id="add-subtask-form" action="{{ route('subtasks.store', $task) }}" method="POST" 
                        class="hidden mb-4 bg-gray-50 p-4 rounded-lg">
                        @csrf
                        <div class="flex gap-2">
                            <input type="text" name="title" placeholder="Enter subtask title" required
                                class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <button type="submit" 
                                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Add
                            </button>
                        </div>
                    </form>

                    <!-- Subtasks List -->
                    <div class="space-y-3">
                        @forelse($task->subtasks as $subtask)
                            <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg">
                                <div class="flex items-center space-x-3">
                                    <form action="{{ route('subtasks.update', [$task, $subtask]) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="to_do" {{ $subtask->status === 'to_do' ? 'selected' : '' }}>To Do</option>
                                            <option value="in_progress" {{ $subtask->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="done" {{ $subtask->status === 'done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                    </form>
                                    <span class="text-gray-700">{{ $subtask->title }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <form action="{{ route('subtasks.destroy', [$task, $subtask]) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Are you sure you want to delete this subtask?')">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No subtasks yet</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
