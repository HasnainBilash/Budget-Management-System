@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
        <p class="text-lg mb-6">View key performance indicators and manage the system.</p>

        <div class="mb-6 flex justify-between">
            <a href="{{ route('projects.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Create Project
            </a>
            <a href="{{ route('projects.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                View Projects
            </a>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Completed vs. Pending Tasks</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-blue-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-blue-800">Completed Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2">{{ $taskStats->completed_tasks }}</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg shadow-sm text-center">
                    <h3 class="text-2xl font-bold text-red-800">Pending Tasks</h3>
                    <p class="text-4xl text-gray-900 mt-2">{{ $taskStats->pending_tasks }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Recent Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($recentProjects as $project)
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-medium text-gray-900">
                                <a href="{{ route('projects.show', $project) }}" class="hover:text-blue-600">
                                    {{ $project->title }}
                                </a>
                            </h3>
                            <span class="px-2 py-1 text-sm rounded-full {{ $project->status === 'completed' ? 'bg-green-100 text-green-800' : ($project->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ str_replace('_', ' ', ucfirst($project->status)) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($project->description, 100) }}</p>
                        <div class="flex justify-between text-sm text-gray-500">
                            <span>{{ $project->tasks_count }} tasks</span>
                            <span>Due {{ $project->end_date->format('M d, Y') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-4 text-gray-500">
                        No projects found
                    </div>
                @endforelse
            </div>
            <div class="mt-4 text-right">
                <a href="{{ route('projects.index') }}" class="text-blue-600 hover:text-blue-800">View all projects →</a>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4">Top Expense Categories</h2>
            <table class="w-full text-left border-collapse bg-white shadow-md">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-4 text-gray-800 font-semibold">Category</th>
                        <th class="p-4 text-gray-800 font-semibold">Total Spent</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topExpenseCategories as $category)
                        <tr class="border-t">
                            <td class="p-4 text-gray-800">{{ $category->category }}</td>
                            <td class="p-4 text-gray-800">${{ number_format($category->total_spent, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
