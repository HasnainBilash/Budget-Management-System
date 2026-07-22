<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    // Show the Budget Table
    public function index(Request $request)
    {
        // Fetch distinct months from the database
        $months = Budget::selectRaw('DISTINCT MONTH(month_year) as month')
            ->orderBy('month') // Sort months in ascending order
            ->pluck('month')
            ->mapWithKeys(function ($month) {
                return [$month => \DateTime::createFromFormat('!m', $month)->format('F')];
            });

        // Fetch distinct years from the database
        $years = Budget::selectRaw('DISTINCT YEAR(month_year) as year')
            ->orderBy('year', 'desc') // Sort years in descending order
            ->pluck('year');

        // Fetch distinct categories
        $categories = Budget::distinct('category')
            ->pluck('category');

        // Apply filters based on the request
        $query = Budget::query();
        if ($request->filled('month')) {
            $query->whereMonth('month_year', $request->input('month'));
        }
        if ($request->filled('year')) {
            $query->whereYear('month_year', $request->input('year'));
        }
        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $budgets = $query->get();

        return view('budget.index', compact('budgets', 'months', 'years', 'categories'));
    }



    // Show the Add Budget Form
    public function create()
    {
        return view('budget.create');
    }

    // Handle Budget Form Submission
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'month_year' => 'required|date_format:Y-m', // Ensures it's in YYYY-MM format
            'category' => 'required|string|max:255',
            'budget_amount' => 'required|numeric',
        ]);
    
        // Append '-01' to create a valid date
        $formattedMonthYear = $request->month_year . '-01';
    
        // Save the budget
        Budget::create([
            'user_id' => auth()->id(),
            'month_year' => $formattedMonthYear,
            'category' => $request->category,
            'budget_amount' => $request->budget_amount,
            'remaining_amount' => $request->budget_amount,
        ]);
    
        // Redirect back with a success message
        return redirect()->route('budgets.index')->with('success', 'Budget added successfully!');
    }
    public function destroy($id)
    {
        // Ensure the budget belongs to the authenticated user
        $budget = Budget::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Delete the budget
        $budget->delete();

        // Redirect with a success message
        return redirect()->route('budgets.index')->with('success', 'Budget deleted successfully!');
    }
    public function spend()
    {
        // Get all budgets for the authenticated user
        $budgets = Budget::where('user_id', auth()->id())->get();

        // Pass the budgets to the view
        return view('budget.spend', compact('budgets'));
    }

    public function storeSpend(Request $request)
    {
        $request->validate([
            'category_month' => 'required|exists:budgets,id', // Ensure the selected budget ID exists
            'amount' => 'required|numeric|min:0',
        ]);

        // Find the budget record by its ID
        $budget = Budget::where('id', $request->category_month)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // Subtract the amount spent from the remaining amount
        $budget->remaining_amount -= $request->amount;

        // Save the updated budget
        $budget->save();

        // Check for overspending
        if ($budget->remaining_amount < 0) {
            $overspent = abs($budget->remaining_amount);
            return redirect()->route('budgets.index')->with('success', "Expense recorded! You have overspent by $${overspent} in the '{$budget->category}' category for " . \Carbon\Carbon::parse($budget->month_year)->format('F Y') . ".");
        }

        return redirect()->route('budgets.index')->with('success', 'Expense recorded successfully!');
    }
}
