@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-3xl font-bold mb-6 text-center">Sub Task</h1>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Add New Subtask -->
    <form method="POST" action="{{ route('subtasks.store', $task->id) }}" class="flex items-center mb-6">
        @csrf
        <input 
            type="text" 
            name="title" 
            placeholder="New Subtask" 
            required 
            class="flex-1 border rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
        >
        <button 
            type="submit" 
            class="ml-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Add
        </button>
    </form>

    <!-- List of Subtasks -->
    @foreach ($subtasks as $subtask)
        <div class="flex items-center justify-between mb-4 border p-4 rounded bg-white shadow-sm">
            <!-- Subtask Title -->
            <span class="font-semibold">{{ $subtask->title }}</span>

            <!-- Subtask Actions -->
            <div class="flex items-center gap-4">
            <!-- Update Subtask Status -->
            <form method="POST"
                        action="{{ route('subtasks.update', ['task' => $task->id, 'subtask' => $subtask->id]) }}"
                        class="flex items-center">
                        @csrf
                        @method('PUT')

                        <!-- Hidden field to pass the title -->
                        <input type="hidden" name="title" value="{{ $subtask->title }}">

                        <!-- Dropdown to update status -->
                        <select name="status" onchange="this.form.submit()" required class="border rounded px-2 py-1">
                            <option value="to_do" {{ $subtask->status === 'to_do' ? 'selected' : '' }}>To Do</option>
                            <option value="in_progress" {{ $subtask->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ $subtask->status === 'done' ? 'selected' : '' }}>Done</option>
                        </select>
            </form>


                <!-- Delete Subtask -->
                <form method="POST" action="{{ route('subtasks.destroy', ['task' => $task->id, 'subtask' => $subtask->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="bg-red-600 text-black px-4 py-2 rounded hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-400">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection


