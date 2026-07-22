@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Task</h1>

    @if ($errors->any())
        <div class="mb-4">
            <ul class="list-disc list-inside text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task) }}">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description:</label>
            <textarea id="description" name="description"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="due_date" class="block text-sm font-medium text-gray-700">Due Date:</label>
            <input type="datetime-local" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}"
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>
        <div class="mb-4">
            <label for="priority" class="block text-sm font-medium text-gray-700">Priority:</label>
            <select id="priority" name="priority" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700">Status:</label>
            <select id="status" name="status" required
                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                <option value="to_do" {{ old('status', $task->status) == 'to_do' ? 'selected' : '' }}>To Do</option>
                <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
            </select>
        </div>
        <button type="submit"
            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
            Update Task
        </button>
    </form>
</div>
@endsection