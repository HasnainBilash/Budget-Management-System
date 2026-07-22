@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-6xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Tasks</h1>
                    <a href="{{ route('tasks.create') }}" 
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        New Task
                    </a>
                </div>

                <!-- Active Tasks Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Active Tasks</h2>
                    <div class="space-y-4">
                        @forelse($activeTasks as $task)
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('tasks.show', $task) }}" 
                                                class="text-lg font-medium text-gray-900 hover:text-blue-600">
                                                {{ $task->title }}
                                            </a>
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $task->priority === 'high' ? 'bg-red-100 text-red-800' : 
                                                   ($task->priority === 'medium' ? 'bg-yellow-100 text-yellow-800' : 
                                                   'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($task->priority) }} Priority
                                            </span>
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                {{ $task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 
                                                   'bg-gray-100 text-gray-800' }}">
                                                {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                            </span>
                                        </div>
                                        @if($task->project)
                                            <div class="mt-1">
                                                <a href="{{ route('projects.show', $task->project) }}" 
                                                    class="text-sm text-blue-600 hover:text-blue-800">
                                                    {{ $task->project->title }}
                                                </a>
                                            </div>
                                        @endif
                                        @if($task->description)
                                            <p class="mt-2 text-sm text-gray-600">
                                                {{ Str::limit($task->description, 100) }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="text-sm text-gray-500">
                                            @if($task->due_date)
                                                <span class="{{ $task->due_date->isPast() ? 'text-red-600' : '' }}">
                                                    Due {{ $task->due_date->format('M d, Y') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task) }}" 
                                                class="text-blue-600 hover:text-blue-800">
                                                Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="text-red-600 hover:text-red-800"
                                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No active tasks</p>
                        @endforelse
                    </div>
                </div>

                <!-- Completed Tasks Section -->
                <div>
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">Completed Tasks</h2>
                    <div class="space-y-4">
                        @forelse($completedTasks as $task)
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm opacity-75">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('tasks.show', $task) }}" 
                                                class="text-lg font-medium text-gray-700 hover:text-blue-600">
                                                {{ $task->title }}
                                            </a>
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                                Done
                                            </span>
                                        </div>
                                        @if($task->project)
                                            <div class="mt-1">
                                                <a href="{{ route('projects.show', $task->project) }}" 
                                                    class="text-sm text-blue-600 hover:text-blue-800">
                                                    {{ $task->project->title }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="text-sm text-gray-500">
                                            Completed {{ $task->updated_at->format('M d, Y') }}
                                        </div>
                                        <div class="flex space-x-2">
                                            <a href="{{ route('tasks.edit', $task) }}" 
                                                class="text-blue-600 hover:text-blue-800">
                                                Edit
                                            </a>
                                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="text-red-600 hover:text-red-800"
                                                    onclick="return confirm('Are you sure you want to delete this task?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-center py-4">No completed tasks</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
