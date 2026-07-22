@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Create Project
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">
                            <a href="{{ route('projects.show', $project) }}" class="hover:text-blue-600">
                                {{ $project->title }}
                            </a>
                        </h2>
                        <span class="px-2 py-1 text-sm rounded-full {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                            {{ str_replace('_', ' ', ucfirst($project->status)) }}
                        </span>
                    </div>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $project->description }}</p>
                    <div class="flex justify-between items-center text-sm text-gray-500">
                        <span>{{ $project->tasks_count }} tasks</span>
                        <span>Due {{ $project->end_date->format('M d, Y') }}</span>
                    </div>
                </div>
                <div class="bg-gray-50 px-6 py-3 flex justify-end space-x-2">
                    <a href="{{ route('projects.edit', $project) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure you want to delete this project?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <h3 class="text-lg font-medium text-gray-900 mb-2">No projects yet</h3>
                <p class="text-gray-500">Get started by creating your first project.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
