@extends('layouts.app')

@section('title', 'Add Budget')

@section('content')
<div class="page-wrap max-w-lg">
    <div class="page-header">
        <h1 class="page-title">Add a budget</h1>
    </div>

    <div class="card card-body">
        @include('partials.alerts')

        <form method="POST" action="{{ route('budgets.store') }}">
            @csrf

            <div class="field">
                <label for="month_year" class="label">Month</label>
                <input type="month" name="month_year" id="month_year" required class="input">
            </div>

            <div class="field">
                <label for="category" class="label">Category</label>
                <input type="text" name="category" id="category" required class="input" placeholder="e.g. Groceries">
            </div>

            <div class="field">
                <label for="budget_amount" class="label">Budget amount</label>
                <input type="number" name="budget_amount" id="budget_amount" step="0.01" required class="input" placeholder="0.00">
            </div>

            <button type="submit" class="btn-primary w-full py-2.5 mt-2">Add budget</button>
        </form>
    </div>
</div>
@endsection
