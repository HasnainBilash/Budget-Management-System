@extends('layouts.app')

@section('title', 'Team Productivity')

@section('content')
<div class="page-wrap">
    <div class="page-header">
        <div>
            <h1 class="page-title">Team productivity</h1>
            <p class="page-subtitle">Average task completion times across the team.</p>
        </div>
    </div>

    @if ($productivityData->total_tasks == 0)
        <div class="empty-state">
            <p class="text-slate-500">No completed tasks available for analysis.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="card card-body text-center">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-blue-700">Total completed tasks</h2>
                <p class="text-4xl font-bold text-slate-900 mt-3">{{ $productivityData->total_tasks }}</p>
            </div>
            <div class="card card-body text-center">
                <h2 class="text-sm font-semibold uppercase tracking-wide text-emerald-700">Average completion time</h2>
                <p class="text-4xl font-bold text-slate-900 mt-3">
                    {{ number_format($productivityData->avg_completion_time, 2) }} <span class="text-lg font-medium text-slate-500">min</span>
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
