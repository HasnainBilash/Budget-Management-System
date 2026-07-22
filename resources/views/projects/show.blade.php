@extends('layouts.app')

@php
use Illuminate\Support\Str;
use Carbon\Carbon;
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
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $project->title }}</h1>
                        <span class="px-3 py-1 rounded-full text-sm {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('projects.edit', $project) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Edit Project
                        </a>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this project?')">
                                Delete Project
                            </button>
                        </form>
                    </div>
                </div>

                <div class="prose max-w-none mb-6">
                    <p class="text-gray-600">{{ $project->description }}</p>
                </div>

                <!-- Project Timeline -->
                <div class="mb-8">
                    <h2 class="text-lg font-semibold mb-4">Project Timeline</h2>
                    <div class="bg-gray-100 rounded-lg p-4">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                                <p class="mt-1 text-gray-900">{{ $project->start_date->format('M d, Y') }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">End Date</h3>
                                <p class="mt-1 text-gray-900">{{ $project->end_date->format('M d, Y') }}</p>
                            </div>
                        </div>
                        
                        <!-- Progress Bar -->
                        <div class="mb-2">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Progress</span>
                                <span>{{ number_format($progressPercentage, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>
                        
                        <div class="text-sm text-gray-600">
                            @if($daysRemaining > 0)
                                <span class="font-medium">{{ $daysRemaining }} days remaining</span>
                            @elseif($daysRemaining == 0)
                                <span class="font-medium text-yellow-600">Due today</span>
                            @else
                                <span class="font-medium text-red-600">Overdue by {{ abs($daysRemaining) }} days</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tasks Section -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Pending Tasks -->
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-lg font-semibold">Pending Tasks ({{ $pendingTasks->count() }})</h2>
                            <a href="{{ route('tasks.create', ['project_id' => $project->id]) }}" class="bg-green-600 text-white px-3 py-1 rounded-md text-sm hover:bg-green-700">
                                Add Task
                            </a>
                        </div>
                        <div class="space-y-3">
                            @forelse($pendingTasks as $task)
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-gray-900">
                                                <a href="{{ route('tasks.show', $task) }}" class="hover:text-blue-600">
                                                    {{ $task->title }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full {{ $task->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ str_replace('_', ' ', ucfirst($task->status)) }}
                                        </span>
                                    </div>
                                    <div class="mt-2 flex justify-between text-xs text-gray-500">
                                        <span>Priority: {{ ucfirst($task->priority) }}</span>
                                        @if($task->due_date)
                                            <span class="{{ Carbon::parse($task->due_date)->isPast() ? 'text-red-600' : '' }}">
                                                Due: {{ Carbon::parse($task->due_date)->format('M d, Y') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-4">No pending tasks</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- Completed Tasks -->
                    <div class="border rounded-lg p-4">
                        <h2 class="text-lg font-semibold mb-4">Completed Tasks ({{ $completedTasks->count() }})</h2>
                        <div class="space-y-3">
                            @forelse($completedTasks as $task)
                                <div class="bg-gray-50 p-3 rounded-lg opacity-75">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-gray-900">
                                                <a href="{{ route('tasks.show', $task) }}" class="hover:text-blue-600">
                                                    {{ $task->title }}
                                                </a>
                                            </h3>
                                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($task->description, 100) }}</p>
                                        </div>
                                        <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">
                                            Done
                                        </span>
                                    </div>
                                    <div class="mt-2 flex justify-between text-xs text-gray-500">
                                        <span>Priority: {{ ucfirst($task->priority) }}</span>
                                        @if($task->updated_at)
                                            <span>Completed: {{ $task->updated_at->format('M d, Y') }}</span>
                                        @endif
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
</div>
@endsection
