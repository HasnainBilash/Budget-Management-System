@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md border border-gray-300">
    <h1 class="text-2xl font-bold mb-4 text-center text-blue-800">Add Expense to Your Budget</h1>

    <form method="POST" action="{{ route('budgets.storeSpend') }}">
        @csrf

        <!-- Budget Categories with Months -->
        <div class="mb-6 border border-gray-300 p-4 rounded-md">
            <label for="category_month" class="block font-semibold mb-2">Your Planned Budget Categories and Months</label>
            <div class="border border-gray-300 rounded-md">
                <select name="category_month" required class="w-full border-none rounded-md p-2 focus:ring focus:ring-blue-300">
                    @foreach ($budgets as $budget)
                        <option value="{{ $budget->id }}">
                            {{ $budget->category }} ({{ \Carbon\Carbon::parse($budget->month_year)->format('F Y') }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Amount Spent -->
        <div class="mb-6 border border-gray-300 p-4 rounded-md">
            <label for="amount" class="block font-semibold mb-2">Amount Spent</label>
            <div class="border border-gray-300 rounded-md">
                <input type="number" name="amount" step="0.01" required 
                       class="w-full border-none rounded-md p-2 focus:ring focus:ring-blue-300">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
                Submit Expense
            </button>
        </div>
    </form>
</div>
@endsection
