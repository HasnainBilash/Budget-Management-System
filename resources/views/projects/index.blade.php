@extends('layouts.app')

@section('title', 'Projects')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Projects</h1>
            <p class="page-subtitle">Everything you're planning, in one place.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('projects.calendar') }}" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                Calendar
            </a>
            <a href="{{ route('projects.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                New project
            </a>
        </div>
    </div>

    @include('partials.alerts')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div class="card flex flex-col">
                <div class="card-body flex-1">
                    <div class="flex justify-between items-start mb-3 gap-2">
                        <h2 class="text-lg font-semibold text-slate-900">
                            <a href="{{ route('projects.show', $project) }}" class="hover:text-emerald-700">
                                {{ $project->title }}
                            </a>
                        </h2>
                        <span class="{{ match($project->status) { 'completed' => 'badge-green', 'in_progress' => 'badge-blue', 'on_hold' => 'badge-yellow', default => 'badge-gray' } }} shrink-0">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>
                    </div>
                    <p class="text-sm text-slate-500 mb-4 line-clamp-2">{{ $project->description }}</p>
                    <div class="flex justify-between items-center text-sm text-slate-500">
                        <span>{{ $project->tasks_count }} {{ Str::plural('task', $project->tasks_count) }}</span>
                        <span>Due {{ $project->end_date->format('M d, Y') }}</span>
                    </div>
                </div>
                <div class="border-t border-slate-100 px-6 py-3 flex justify-end gap-4">
                    <a href="{{ route('projects.edit', $project) }}" class="btn-link">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-link-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full empty-state">
                <h3 class="text-lg font-medium text-slate-900 mb-1">No projects yet</h3>
                <p class="text-slate-500 mb-5">Get started by creating your first project.</p>
                <a href="{{ route('projects.create') }}" class="btn-primary">Create a project</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
