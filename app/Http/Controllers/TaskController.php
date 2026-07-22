<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        // Get active tasks (to_do and in_progress) sorted by priority
        $activeTasks = auth()->user()->tasks()
            ->with('project')
            ->whereIn('tasks.status', ['to_do', 'in_progress'])
            ->orderByRaw("FIELD(tasks.priority, 'high', 'medium', 'low')")
            ->orderBy('tasks.due_date')
            ->get();

        // Get completed tasks
        $completedTasks = auth()->user()->tasks()
            ->with('project')
            ->where('tasks.status', 'done')
            ->orderBy('tasks.updated_at', 'desc')
            ->get();
        
        return view('tasks.index', compact('activeTasks', 'completedTasks'));
    }

    public function create(Request $request)
    {
        $project = null;
        if ($request->has('project_id')) {
            $project = Project::findOrFail($request->project_id);
        }
        
        return view('tasks.create', compact('project'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to_do,in_progress,done',
            'due_date' => 'required|date',
        ]);

        $task = auth()->user()->tasks()->create($validated);

        return redirect()->route('projects.show', $task->project_id)
            ->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:to_do,in_progress,done',
            'due_date' => 'nullable|date',
        ]);

        $task->update($validated);

        return redirect()->route('projects.show', $task->project_id)
            ->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $projectId = $task->project_id;
        $task->delete();

        return redirect()->route('projects.show', $projectId)
            ->with('success', 'Task deleted successfully.');
    }
}