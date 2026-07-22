@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">

    <!-- Success Message -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Header with Filter Button -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-blue-800">Your Budgets</h1>

        <!-- Filter Button -->
        <button id="filterButton" 
                class="px-4 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition">
            Filter
        </button>
    </div>

    <!-- Budget Table -->
    @if ($budgets->isEmpty())
        <p class="text-center">No budgets added yet.</p>
    @else
        <table class="w-full border-collapse border border-gray-300 mb-6">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">Month</th>
                    <th class="border border-gray-300 px-4 py-2">Category</th>
                    <th class="border border-gray-300 px-4 py-2">Budget Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Remaining Amount</th>
                    <th class="border border-gray-300 px-4 py-2">Amount Exceeded</th>
                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($budgets as $budget)
                    <tr data-id="{{ $budget->id }}">
                        <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($budget->month_year)->format('F Y') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $budget->category }}</td>
                        <td class="border border-gray-300 px-4 py-2">${{ number_format($budget->budget_amount, 2) }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($budget->remaining_amount < 0)
                                0
                            @else
                                ${{ number_format($budget->remaining_amount, 2) }}
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($budget->remaining_amount < 0)
                                <span class="text-red-600 font-bold">
                                    ${{ number_format(abs($budget->remaining_amount), 2) }}
                                </span>
                            @else
                                0
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2 text-center">
                            <!-- Delete Button -->
                            <button 
                                style="background-color: #dc2626; color: white; padding: 8px 16px; border-radius: 6px; border: none; cursor: pointer;"
                                onmouseover="this.style.backgroundColor='#b91c1c'" 
                                onmouseout="this.style.backgroundColor='#dc2626'"
                                class="deleteButton"
                                data-id="{{ $budget->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Centered Buttons Below the Table -->
    <div class="text-center mt-6">
        <a href="{{ route('budgets.create') }}" 
           class="inline-block px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
           Add Budget
        </a>

        <a href="{{ route('budgets.spend') }}" 
           class="inline-block px-6 py-2 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition ml-4">
           Add Expense
        </a>
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" 
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
        <div class="bg-white p-4 rounded-lg shadow-lg max-w-xl w-full border border-black">
            <h2 class="text-xl font-bold mb-4 text-center">Filter Budgets</h2>
            <form method="GET" action="{{ route('budgets.index') }}">
                <!-- Horizontal Layout for Dropdowns -->
                <div class="flex flex-wrap justify-between gap-4">
                    <!-- Year Dropdown -->
                    <div class="flex flex-col">
                        <label for="year" class="font-semibold mb-2">Year</label>
                        <select name="year" id="year" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            @foreach ($years as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Month Dropdown -->
                    <div class="flex flex-col">
                        <label for="month" class="font-semibold mb-2">Month</label>
                        <select name="month" id="month" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            @foreach ($months as $num => $name)
                                <option value="{{ $num }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <div class="flex flex-col">
                        <label for="category" class="font-semibold mb-2">Category</label>
                        <select name="category" id="category" class="border border-black rounded-md p-2">
                            <option value="">Any</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-4">
                    <button type="button" id="closeModal" 
                            class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
                        Apply Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButton = document.getElementById('filterButton');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementById('closeModal');

        // Show modal in the center of the page
        filterButton.addEventListener('click', () => {
            filterModal.classList.remove('hidden');
        });

        // Hide modal
        closeModal.addEventListener('click', () => {
            filterModal.classList.add('hidden');
        });

        // Delete functionality
        const deleteButtons = document.querySelectorAll('.deleteButton');
        deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const budgetId = event.target.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this budget?')) {
                    fetch(`/budgets/${budgetId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Refresh the page after successful deletion
                        } else {
                            alert('Failed to delete the budget.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });
        });
    });
</script>
@endsection
