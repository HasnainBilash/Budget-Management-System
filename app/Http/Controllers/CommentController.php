<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        Gate::authorize('view', $task);

        $validated = $request->validate([
            'content' => 'required|string'
        ]);

        $comment = $task->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id()
        ]);

        if ($request->ajax()) {
            return response()->json([
                'comment' => $comment->load('user'),
                'success' => true
            ]);
        }

        return back()->with('success', 'Comment added successfully.');
    }

    public function destroy(Task $task, Comment $comment)
    {
        if ($comment->task_id !== $task->id || $comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $comment->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Comment deleted successfully.');
    }
}
