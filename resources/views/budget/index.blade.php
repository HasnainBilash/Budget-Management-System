@extends('layouts.app')

@section('title', 'Budgets')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Your budgets</h1>
            <p class="page-subtitle">Track what you've planned to spend, and what's left.</p>
        </div>
        <div class="flex gap-2">
            <button type="button" id="filterButton" class="btn-secondary">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                Filter
            </button>
            <a href="{{ route('budgets.spend') }}" class="btn-secondary">Add expense</a>
            <a href="{{ route('budgets.create') }}" class="btn-primary">Add budget</a>
        </div>
    </div>

    @include('partials.alerts')

    <div class="card overflow-hidden">
        @if ($budgets->isEmpty())
            <div class="empty-state border-0">
                <p class="text-slate-500">No budgets added yet.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Month</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Category</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Budget</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Remaining</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Exceeded</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($budgets as $budget)
                            <tr>
                                <td class="px-4 py-3 text-sm text-slate-700">{{ \Carbon\Carbon::parse($budget->month_year)->format('F Y') }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $budget->category }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">${{ number_format($budget->budget_amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">
                                    ${{ number_format($budget->remaining_amount < 0 ? 0 : $budget->remaining_amount, 2) }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($budget->remaining_amount < 0)
                                        <span class="font-semibold text-red-600">${{ number_format(abs($budget->remaining_amount), 2) }}</span>
                                    @else
                                        <span class="text-slate-400">&mdash;</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-link-danger" onclick="return confirm('Are you sure you want to delete this budget?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <!-- Filter Modal -->
    <div id="filterModal" class="fixed inset-0 bg-slate-900/50 flex justify-center items-center hidden z-50 px-4">
        <div class="card w-full max-w-lg">
            <div class="card-body">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Filter budgets</h2>
                <form method="GET" action="{{ route('budgets.index') }}">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="field mb-0">
                            <label for="year" class="label">Year</label>
                            <select name="year" id="year" class="input">
                                <option value="">Any</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field mb-0">
                            <label for="month" class="label">Month</label>
                            <select name="month" id="month" class="input">
                                <option value="">Any</option>
                                @foreach ($months as $num => $name)
                                    <option value="{{ $num }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="field mb-0">
                            <label for="category" class="label">Category</label>
                            <select name="category" id="category" class="input">
                                <option value="">Any</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category }}">{{ $category }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" id="closeModal" class="btn-secondary">Cancel</button>
                        <button type="submit" class="btn-primary">Apply filter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterButton = document.getElementById('filterButton');
        const filterModal = document.getElementById('filterModal');
        const closeModal = document.getElementById('closeModal');

        filterButton.addEventListener('click', () => filterModal.classList.remove('hidden'));
        closeModal.addEventListener('click', () => filterModal.classList.add('hidden'));
    });
</script>
@endsection
