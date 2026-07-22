<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subtask;

class SubtaskController extends Controller
{
    /**
     * Display the list of subtasks for a task.
     */
    public function index(Task $task)
    {
        $subtasks = $task->subtasks()->orderByRaw("FIELD(status, 'to_do', 'in_progress', 'done')")->get();

        return view('subtasks.index', compact('task', 'subtasks'));
    }

    /**
     * Store a new subtask for the given task.
     */
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->subtasks()->create([
            'title' => $request->title,
            'status' => 'to_do', // Default status
        ]);

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Subtask created successfully.');
    }

    /**
     * Show the form for editing a subtask.
     */
    public function edit(Task $task, Subtask $subtask)
    {
        return view('subtasks.edit', compact('task', 'subtask'));
    }

    /**
     * Update the given subtask.
     */
    public function update(Request $request, Task $task, Subtask $subtask)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:to_do,in_progress,done',
        ]);

        $subtask->update($request->only(['title', 'status']));

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Subtask updated successfully.');
    }

    /**
     * Remove the specified subtask.
     */
    public function destroy(Task $task, Subtask $subtask)
    {
        $subtask->delete();

        return redirect()
            ->route('tasks.show', $task)
            ->with('success', 'Subtask deleted successfully.');
    }
}
