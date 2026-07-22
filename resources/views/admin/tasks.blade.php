@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">All Tasks</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($tasks as $task)
                <div class="bg-white shadow-md rounded-lg p-6 border-t-4 
                @if($task->priority === 'high') border-red-500 
                @elseif($task->priority === 'medium') border-yellow-500 
                @else border-green-500 @endif">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $task->title }}</h2>
                    <p class="text-gray-700 text-sm mb-4">{{ $task->description ?: 'No description provided' }}</p>
                    
                    <div class="text-sm text-gray-500 mb-2">
                        <strong>Due Date:</strong> {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'Not set' }}
                    </div>

                    <div class="text-sm text-gray-500 mb-2">
                        <strong>Priority:</strong>
                        <span class="@if($task->priority === 'high') text-red-500 
                                      @elseif($task->priority === 'medium') text-yellow-500 
                                      @else text-green-500 @endif capitalize">{{ $task->priority }}</span>
                    </div>

                    <div class="text-sm text-gray-500 mb-4">
                        <strong>Status:</strong> 
                        <span class="capitalize">{{ str_replace('_', ' ', $task->status) }}</span>
                    </div>
                </div>
            @empty
                <p class="text-gray-600 text-lg">No tasks available.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
