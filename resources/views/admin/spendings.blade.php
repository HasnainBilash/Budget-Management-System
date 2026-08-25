@extends('layouts.app')

@section('title', 'Spending Trends')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Spending trends</h1>
            <p class="page-subtitle">Total spending across the whole user base.</p>
        </div>
    </div>

    <div class="card card-body mb-10">
        <h2 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Total spending</h2>
        <p class="text-4xl font-bold text-slate-900 mt-2">${{ number_format($totalSpending, 2) }}</p>
    </div>

    <div class="mb-10">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Spending by category</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($spendingByCategory as $category => $amount)
                <div class="card card-body text-center">
                    <h3 class="font-semibold text-slate-900">{{ $category }}</h3>
                    <p class="text-lg text-emerald-700 font-bold mt-1">${{ number_format($amount, 2) }}</p>
                </div>
            @empty
                <div class="col-span-full empty-state">
                    <p class="text-slate-500">No spending data yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Spending by month</h2>
        <div class="card overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Month</th>
                        <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Total spending</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($spendingByMonth as $month => $amount)
                        <tr>
                            <td class="px-4 py-3 text-sm text-slate-700">{{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}</td>
                            <td class="px-4 py-3 text-sm font-medium text-slate-900">${{ number_format($amount, 2) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="2" class="px-4 py-6 text-center text-sm text-slate-500">No data yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Detailed budget information</h2>
        <div class="card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Category</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Budget</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Remaining</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Spent</th>
                            <th class="px-4 py-3 text-xs font-semibold uppercase tracking-wide text-slate-500">Exceeded</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($spendingData as $data)
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900">{{ $data->category }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">${{ number_format($data->budget_amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">${{ number_format($data->remaining_amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-slate-700">${{ number_format($data->spent_amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($data->amount_exceeded > 0)
                                        <span class="font-semibold text-red-600">${{ number_format($data->amount_exceeded, 2) }}</span>
                                    @else
                                        <span class="text-slate-400">&mdash;</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">No budget data yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
