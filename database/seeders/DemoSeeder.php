<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoSeeder extends Seeder
{
    public const EMAIL = 'demo@example.com';
    public const PASSWORD = 'Demo1234!';

    /**
     * Seed a demo account with realistic sample data, so the app is
     * populated the moment someone logs in to try it out. Safe to run
     * more than once - only creates data the first time.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => self::EMAIL],
            [
                'name' => 'Demo User',
                'phone' => '5550100100',
                'dob' => '1994-05-14',
                'password' => Hash::make(self::PASSWORD),
                'active' => true,
                'role' => 'user',
            ]
        );

        if ($user->projects()->exists()) {
            return;
        }

        $now = Carbon::now();

        $projects = [
            [
                'title' => 'Website Redesign',
                'description' => 'Refresh the marketing site with a new visual identity and improved page speed.',
                'start_date' => $now->copy()->subWeeks(3),
                'end_date' => $now->copy()->addWeeks(2),
                'status' => 'in_progress',
                'tasks' => [
                    ['title' => 'Audit current site content', 'priority' => 'medium', 'status' => 'done', 'due_date' => $now->copy()->subWeeks(2)],
                    ['title' => 'Design new homepage mockup', 'priority' => 'high', 'status' => 'done', 'due_date' => $now->copy()->subWeek()],
                    ['title' => 'Build responsive navigation', 'priority' => 'high', 'status' => 'in_progress', 'due_date' => $now->copy()->addDays(3),
                        'subtasks' => ['Mobile menu', 'Sticky header on scroll', 'Active-link highlighting']],
                    ['title' => 'Optimize images and fonts', 'priority' => 'medium', 'status' => 'to_do', 'due_date' => $now->copy()->addWeek()],
                    ['title' => 'Cross-browser QA pass', 'priority' => 'low', 'status' => 'to_do', 'due_date' => $now->copy()->addWeeks(2)],
                ],
            ],
            [
                'title' => 'Q3 Marketing Campaign',
                'description' => 'Plan and launch the Q3 social + email push for the new product line.',
                'start_date' => $now->copy()->subWeeks(6),
                'end_date' => $now->copy()->subDays(2),
                'status' => 'completed',
                'tasks' => [
                    ['title' => 'Finalize campaign budget', 'priority' => 'high', 'status' => 'done', 'due_date' => $now->copy()->subWeeks(5)],
                    ['title' => 'Write email sequence', 'priority' => 'medium', 'status' => 'done', 'due_date' => $now->copy()->subWeeks(3)],
                    ['title' => 'Schedule social posts', 'priority' => 'medium', 'status' => 'done', 'due_date' => $now->copy()->subDays(5)],
                ],
            ],
            [
                'title' => 'Home Renovation',
                'description' => 'Kitchen and living room refresh - contractors, permits, and a budget to keep it all honest.',
                'start_date' => $now->copy()->addWeek(),
                'end_date' => $now->copy()->addMonths(3),
                'status' => 'not_started',
                'tasks' => [
                    ['title' => 'Get three contractor quotes', 'priority' => 'high', 'status' => 'to_do', 'due_date' => $now->copy()->addWeeks(2)],
                    ['title' => 'Apply for renovation permit', 'priority' => 'medium', 'status' => 'to_do', 'due_date' => $now->copy()->addWeeks(3)],
                    ['title' => 'Pick tile and countertop samples', 'priority' => 'low', 'status' => 'to_do', 'due_date' => $now->copy()->addWeeks(4)],
                ],
            ],
        ];

        foreach ($projects as $projectData) {
            $tasks = $projectData['tasks'];
            unset($projectData['tasks']);

            $project = $user->projects()->create($projectData);

            foreach ($tasks as $taskData) {
                $subtasks = $taskData['subtasks'] ?? [];
                unset($taskData['subtasks']);

                $task = $project->tasks()->create($taskData + ['description' => null]);

                foreach ($subtasks as $index => $subtaskTitle) {
                    $task->subtasks()->create([
                        'title' => $subtaskTitle,
                        'status' => $index === 0 ? 'done' : 'to_do',
                    ]);
                }
            }
        }

        $budgets = [
            ['category' => 'Groceries', 'month_year' => $now->copy()->startOfMonth(), 'budget_amount' => 500, 'remaining_amount' => 128.50],
            ['category' => 'Dining Out', 'month_year' => $now->copy()->startOfMonth(), 'budget_amount' => 150, 'remaining_amount' => -22.75],
            ['category' => 'Transport', 'month_year' => $now->copy()->startOfMonth(), 'budget_amount' => 120, 'remaining_amount' => 64.00],
            ['category' => 'Groceries', 'month_year' => $now->copy()->subMonthNoOverflow()->startOfMonth(), 'budget_amount' => 500, 'remaining_amount' => 0],
            ['category' => 'Entertainment', 'month_year' => $now->copy()->subMonthNoOverflow()->startOfMonth(), 'budget_amount' => 80, 'remaining_amount' => 15.20],
        ];

        foreach ($budgets as $budgetData) {
            Budget::create($budgetData + ['user_id' => $user->id]);
        }
    }
}
