<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showAdmin()
    {
        return view('admin.index');
    }

    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    public function showTasks()
    {
        $tasks = Task::orderByRaw("FIELD(priority, 'high', 'medium', 'low')")->get();
        return view('admin.tasks', compact('tasks'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $user->active = !$user->active;
        $user->save();

        return redirect()->route('admin.manage-users')->with('status', 'User status updated successfully.');
    }

    public function spendingTrends()
    {
        $spendingData = \App\Models\Budget::selectRaw(
            'category, budget_amount, remaining_amount, 
            (budget_amount - remaining_amount) as spent_amount, 
            GREATEST(0, remaining_amount) as remaining_amount, 
            GREATEST(0, -remaining_amount) as amount_exceeded,
            MONTH(month_year) as month, 
            YEAR(month_year) as year'
        )
            ->groupBy('id', 'category', 'budget_amount', 'remaining_amount', 'month', 'year')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        $totalSpending = $spendingData->sum('spent_amount');

        $spendingByCategory = $spendingData->groupBy('category')->map(function ($data) {
            return $data->sum('spent_amount');
        });

        $spendingByMonth = $spendingData->groupBy(function ($data) {
            return $data->year . '-' . str_pad($data->month, 2, '0', STR_PAD_LEFT);
        })->map(function ($data) {
            return $data->sum('spent_amount');
        });

        return view('admin.spendings', compact('spendingData', 'totalSpending', 'spendingByCategory', 'spendingByMonth'));
    }

    public function showProductivity()
    {
        $productivityData = \App\Models\Task::selectRaw("
            COUNT(*) as total_tasks,
            AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_completion_time
        ")
        ->where('status', 'done')
        ->first();

        return view('admin.productivity', compact('productivityData'));
    }

    public function showDashboard()
    {
        $taskStats = Task::selectRaw('
            SUM(CASE WHEN status = "done" THEN 1 ELSE 0 END) as completed_tasks,
            SUM(CASE WHEN status != "done" THEN 1 ELSE 0 END) as pending_tasks
        ')->first();

        $topExpenseCategories = \App\Models\Budget::selectRaw("
            category, 
            SUM(budget_amount - remaining_amount) as total_spent
        ")
        ->groupBy('category')
        ->orderBy('total_spent', 'desc')
        ->take(5)
        ->get();

        $recentProjects = Project::withCount('tasks')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return view('admin.dashboard', compact('taskStats', 'topExpenseCategories', 'recentProjects'));
    }
}
