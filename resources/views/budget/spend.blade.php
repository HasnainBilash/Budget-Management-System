@extends('layouts.app')

@section('title', 'Add Expense')

@section('content')
<div class="page-wrap max-w-lg">
    <div class="page-header">
        <h1 class="page-title">Log an expense</h1>
    </div>

    <div class="card card-body">
        @include('partials.alerts')

        <form method="POST" action="{{ route('budgets.storeSpend') }}">
            @csrf

            <div class="field">
                <label for="category_month" class="label">Budget category</label>
                <select name="category_month" id="category_month" required class="input">
                    @foreach ($budgets as $budget)
                        <option value="{{ $budget->id }}">
                            {{ $budget->category }} ({{ \Carbon\Carbon::parse($budget->month_year)->format('F Y') }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="field">
                <label for="amount" class="label">Amount spent</label>
                <input type="number" name="amount" id="amount" step="0.01" required class="input" placeholder="0.00">
            </div>

            <button type="submit" class="btn-primary w-full py-2.5 mt-2">Submit expense</button>
        </form>
    </div>
</div>
@endsection
