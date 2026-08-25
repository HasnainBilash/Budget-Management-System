@extends('layouts.app')

@section('title', 'All Tasks')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <h1 class="page-title">All tasks</h1>
    </div>

    @include('partials.alerts')

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($tasks as $task)
            <div class="card card-body border-t-4
                @if($task->priority === 'high') border-t-red-500
                @elseif($task->priority === 'medium') border-t-amber-500
                @else border-t-emerald-500 @endif">
                <h2 class="text-lg font-semibold text-slate-900 mb-2">{{ $task->title }}</h2>
                <p class="text-sm text-slate-500 mb-4">{{ $task->description ?: 'No description provided' }}</p>

                <div class="flex flex-wrap gap-2 mb-3">
                    <span class="{{ match($task->priority) { 'high' => 'badge-red', 'medium' => 'badge-yellow', default => 'badge-green' } }}">
                        {{ ucfirst($task->priority) }}
                    </span>
                    <span class="{{ match($task->status) { 'done' => 'badge-green', 'in_progress' => 'badge-blue', default => 'badge-gray' } }}">
                        {{ str_replace('_', ' ', ucfirst($task->status)) }}
                    </span>
                </div>

                <div class="text-sm text-slate-500">
                    Due {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'Not set' }}
                </div>
            </div>
        @empty
            <div class="col-span-full empty-state">
                <p class="text-slate-500">No tasks available.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
