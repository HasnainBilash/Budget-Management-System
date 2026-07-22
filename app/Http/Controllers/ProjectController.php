<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    public function index()
    {
        if (! Gate::allows('viewAny', Project::class)) {
            abort(403);
        }

        $projects = auth()->user()->projects()
            ->withCount('tasks')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        if (! Gate::allows('create', Project::class)) {
            abort(403);
        }

        return view('projects.create');
    }

    public function store(Request $request)
    {
        if (! Gate::allows('create', Project::class)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:not_started,in_progress,completed,on_hold',
        ]);

        $project = auth()->user()->projects()->create($validated);

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        if (! Gate::allows('view', $project)) {
            abort(403);
        }
        
        $project->load(['tasks' => function($query) {
            $query->orderBy('due_date');
        }]);
        
        $pendingTasks = $project->tasks->where('status', '!=', 'done');
        $completedTasks = $project->tasks->where('status', 'done');
        
        // Calculate project progress
        $totalDays = $project->start_date->diffInDays($project->end_date);
        $daysRemaining = now()->diffInDays($project->end_date, false);
        $progressPercentage = $totalDays > 0 ? 
            max(0, min(100, (($totalDays - max(0, $daysRemaining)) / $totalDays) * 100)) : 0;
        
        return view('projects.show', compact('project', 'pendingTasks', 'completedTasks', 'daysRemaining', 'progressPercentage'));
    }

    public function edit(Project $project)
    {
        if (! Gate::allows('update', $project)) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        if (! Gate::allows('update', $project)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:not_started,in_progress,completed,on_hold',
        ]);

        $project->update($validated);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if (! Gate::allows('delete', $project)) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }

    public function calendar()
    {
        if (! Gate::allows('viewAny', Project::class)) {
            abort(403);
        }

        $projects = auth()->user()->projects()
            ->with(['tasks' => function($query) {
                $query->orderBy('due_date');
            }])
            ->get()
            ->map(function($project) {
                return [
                    'id' => $project->id,
                    'title' => $project->title,
                    'start' => $project->start_date->format('Y-m-d'),
                    'end' => $project->end_date->format('Y-m-d'),
                    'url' => route('projects.show', $project),
                    'backgroundColor' => $this->getStatusColor($project->status),
                    'borderColor' => $this->getStatusColor($project->status),
                ];
            });

        return view('projects.calendar', compact('projects'));
    }

    private function getStatusColor($status)
    {
        return [
            'not_started' => '#6B7280', // gray
            'in_progress' => '#3B82F6', // blue
            'completed' => '#10B981', // green
            'on_hold' => '#F59E0B', // yellow
        ][$status];
    }
}
